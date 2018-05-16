<?php

use Aws\S3\S3Client;

// Shortcode to display S3 bucket
function milo_s3_browser_shortcode_display($atts) {

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
  $buckets = $s3Client->listBuckets();
  foreach ($buckets['Buckets'] as $bucket){
	  echo $bucket['Name']."\n";
  }

  // If no bucket name is specified for the shortcode, set default
  $atts = shortcode_atts( array('bucket' => 'none'), $atts, 's3browse' );
  $bucket = $atts['bucket'];
  if( $bucket == 'none' ):
    echo "You must enter a bucket name for your shortcode!";
  endif;

  // Displays the bucket browser
  ?>
  <div class="o-fileBrowser">
    <div class="o-fileBrowser__manager">
      <ul class="m-fileList">
        <li>Filename: </li>
        <li>Download</li>
      </ul>

    </div>
  </div>
  <?php

}
add_shortcode('milos3browser', 'milo_s3_browser_shortcode_display');
