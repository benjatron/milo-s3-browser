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
  require(plugins_url() . '/milo-s3-browser/views/public/browser.php');
}
add_shortcode('milos3browser', 'milo_browser_shortcode');
