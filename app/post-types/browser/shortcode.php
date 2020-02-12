<?php

use Aws\S3\S3Client;
use Aws\Credentials\Credentials;
use Aws\S3\Exception\S3Exception;

// Shortcode to display S3 bucket
function milo_browser_shortcode($atts) {

  //Creates S3 client
  $credentials = new Aws\Credentials\Credentials(
    esc_attr( get_option('aws_key') ),
    esc_attr( get_option('aws_secret') )
  );
  $s3Client = new S3Client([
    'region' => esc_attr( get_option('aws_region') ),
    'version' => 'latest',
    'credentials' => $credentials
  ]);

  // If no bucket name is specified for the shortcode, display error
  $atts = shortcode_atts( array('bucket' => 'none'), $atts, 's3browse' );
  $bucket = $atts['bucket'];
  if( $bucket == 'none' ):
    echo "You must enter a bucket name for your shortcode!";
  endif;

  // Displays the bucket browser
  $objects = $s3Client->getIterator('ListObjectsV2',
    [
      'Bucket' => $bucket
    ]
  );

  // Creates arrays of paths, sizes, and links
  $pathArray = array();
  $sizeArray = array();
  $linkArray = array();
  foreach( $objects as $object ):
    $fileName = $object['Key'];
    $fileSize = $object['Size'];

    // For non-folders, add info to relevant arrays
    if( $object['Size'] != '0' ):
      $fileBase = basename($fileName);

      $cmd = $s3Client->getCommand('GetObject',
        [
          'Bucket' => $bucket,
          'Key' => $fileName,
          'ResponseContentType' => 'application/octet-stream',
          'ResponseContentDisposition' => 'attachment; filename="'.$fileBase.'"',
        ]
      );

      $request = $s3Client->createPresignedRequest($cmd, '+180 minutes');

      $fileLink = (string) $request->getUri();

      $pathArray[] = $fileName;
      $sizeArray[] = $fileSize;
      $linkArray[] = $fileLink;
    endif;
  endforeach;

  // Creates our object array
  $objectArray = array();
  for( $i=0; $i<sizeof($pathArray); $i++ ):
    // Create name of file
    $fileArray = explode('/', $pathArray[$i]);
    $name = $fileArray[sizeof($fileArray)-1];

    // Create prefix for file
    $nameLength = strlen($name);
    $prefix = substr($pathArray[$i], 0, strlen($pathArray[$i]) - $nameLength);

    $objectArray[$i] = array(
      'id' => $i,
      'name' => $name,
      'path' => $pathArray[$i],
      'prefix' => $prefix,
      'size' => $sizeArray[$i],
      'link' => $linkArray[$i]
    );
  endfor;

  // Creates the directory tree
  $childrenTree = array();
  foreach($objectArray as $item):
    $paths = explode('/', $item['path']);

    $current = &$childrenTree;

    foreach($paths as $path):

      if( !isset($current['children'][$path]) ):
        $current['children'][$path] = array();
      endif;

      $current = &$current['children'][$path];

      if( $path == $item['name'] ):
        $current = $item;
      endif;

    endforeach;

  endforeach;
  // We don't need the top level, just take the children within $childrenTree
  $directoryTree = ($childrenTree['children']);

  // Displays the file browser
  ?>
  <div class="o-fileBrowser">
    <div class="o-fileBrowser__manager">
        <?php
          milo_directory($directoryTree, $objectArray);
          // milo_modals($directoryTree, $objectArray);
        ?>
    </div>
  </div>
  <?php
}
add_shortcode('milos3browser', 'milo_browser_shortcode');
