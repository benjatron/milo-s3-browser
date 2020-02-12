<?php
// Handles file downloads from S3 to make a specific landing page

use Aws\S3\S3Client;
use Aws\Credentials\Credentials;
use Aws\S3\Exception\S3Exception;

function the_download_block( $bucket, $queriedFile ) {

  //Creates S3 client and sets up bucket
  $credentials = new Aws\Credentials\Credentials(
    esc_attr( get_option('aws_key') ),
    esc_attr( get_option('aws_secret') )
  );
  $s3Client = new S3Client([
    'region' => esc_attr( get_option('aws_region') ),
    'version' => 'latest',
    'credentials' => $credentials
  ]);

  $objects = $s3Client->getIterator('ListObjectsV2',['Bucket' => $bucket]);

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

  // Gets the query value if it is not set
  if( !$queriedFile ):
    $queriedFile = urldecode( substr( parse_url( $_SERVER[REQUEST_URI], PHP_URL_QUERY), 2) );
  endif;

  // Gets the latest version of the queried file and assigns values
  $file = milo_get_latest( $queriedFile, $objectArray);
  $id = $file['id'];
  $name = $file['name'];
  $path = $file['path'];
  $prefix = $file['prefix'];
  $size = $file['size'];
  $link = $file['link'];
  $type = strtolower($file['type']);

  $fileTypes = array(
    'archive' => array(
      '7z', 'arj', 'deb', 'gz', 'pkg', 'rar', 'rpm', 'tar', 'z', 'zip'
    ),
    'audio' => array(
      'aif', 'cda', 'mid', 'midi', 'mp3', 'mpa', 'ogg', 'wav', 'wma', 'wpl'
    ),
    'document' => array(
      'key', 'odp', 'pps', 'ppt', 'pptx', 'ods', 'xlr', 'xls', 'xlsx', 'doc', 'docx', 'rtf', 'tex', 'txt', 'wks', 'wps', 'wpd'
    ),
    'executable' => array(
      'exe'
    ),
    'image' => array(
      'ai', 'bmp', 'eps', 'gif', 'ico', 'jpg', 'jpeg', 'png', 'ps', 'psd', 'svg', 'tif', 'tiff'
    ),
    'milo' => array(
      'milo'
    ),
    'pdf' => array(
      'pdf'
    ),
    'video' => array(
      '3g2', '3gp', 'avi', 'flv', 'h264', 'm4v', 'mkv', 'mov', 'mp4', 'mpg', 'mpeg', 'rm', 'swf', 'vob', 'wmv'
    ),
  );

  if( in_array( $type, $fileTypes['archive'] ) ):
    $file = 'file-archive';
  elseif( in_array( $type, $fileTypes['audio'] ) ):
    $file = 'file-audio';
  elseif( in_array( $type, $fileTypes['document'] ) ):
    $file = 'file-alt';
  elseif( in_array( $type, $fileTypes['executable'] ) ):
    $file = 'file-exe';
  elseif( in_array( $type, $fileTypes['image'] ) ):
    $file = 'file-image';
  elseif( in_array( $type, $fileTypes['milo'] ) ):
    $file = 'file-milo';
  elseif( in_array( $type, $fileTypes['pdf'] ) ):
    $file = 'file-pdf';
  elseif( in_array( $type, $fileTypes['video'] ) ):
    $file = 'file-video';
  else:
    $file = 'file';
  endif;

  $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . strtok($_SERVER["REQUEST_URI"],'?') . '?u=' . urlencode($path);

  $supportHome = get_posts(array(
    'numberposts' => 1,
    'post_type' => 'page',
    'fields' => 'ids',
    'meta_key' => '_wp_page_template',
    'meta_value' => 'template-browser-dashboard.php'
  ))[0];

  ?>
  <div class="o-fileLanding">
    <img class="o-fileLanding__icon" src="<?php echo get_milo_png($file); ?>" />
    <div class="o-fileLanding__masthead">
      <h3 class="o-fileLanding__name">
        <a href="<?php echo $link; ?>" target="_blank" download>File Name: <?php echo $name; ?></a>
      </h3>
      <h4 class="o-fileLanding__size">File Size: <?php echo formatBytes($size); ?></h4>
      <p class="o-fileLanding__url">Shareable URL:</p>
      <code class="o-fileLanding__code"><?php echo $url; ?></code>
    </div>

    <?php
    // If there is a description, display it
    if( $objectArray[$id+1]['name'] == ($name . '.txt') ):
    ?>
      <div class="o-fileLanding__description">
        <div class="a-browserDescription">
          <svg class="a-browserDescription__toggle" viewBox="0 0 16 16">
            <path
              d=" M 0,0
                L 16,8
                L 0,16
              "
            />
          </svg>
          <h4 class="a-browserDescription__title">
            Description
          </h4>
          <p class="a-browserDescription__body --preload">
            <?php
            $description = file_get_contents($objectArray[$id+1]['link']);
              echo $description;
            ?>
          </p>
        </div>
      </div>
    <?php
    endif;
    ?>

    <div class="o-fileLanding__description">
      If your download does not start automatically after a few seconds, please click the button below.
    </div>

    <a class="o-fileLanding__button" href="<?php echo $link; ?>" target="_blank" download>
      <div class="o-fileLanding__link">Download</div>
    </a>

    <div class="o-fileLanding__lower">
      <?php the_field('disclaimer'); ?>
    </div>
  </div>
  <iframe width="1" height="1" frameborder="0" src="<?php echo $link; ?>"></iframe>
<?php
}