<?php
/**
 * MILO Support Class
 */

use Aws\S3\S3Client;
use Aws\Credentials\Credentials;
use Aws\S3\Exception\S3Exception;

class MILO_Support {

  // Plugin slug
  public $plugin_slug = "milo-browser-plugin";

  // AWS Key
  public $aws_key;

  // AWS Secret
  public $aws_secret;

  // AWS Region
  public $aws_region;

  // MILO generated password
  public $password;

  // AWS credentials
  public $aws_credentials;

  // S3 client
  public $s3_client;

  function __construct() {
    $this->aws_key = get_option( 'aws_key' );
    $this->aws_secret = get_option( 'aws_secret' );
    $this->aws_region = get_option( 'aws_region' );
    $this->password = get_option( 'milo_generated_key' );

    // Sets AWS Credentials
    $this->aws_credentials = new Aws\Credentials\Credentials(
      esc_attr( $this->aws_key ),
      esc_attr( $this->aws_secret )
    );

    // Creates S3 client
    $this->s3_client = new S3Client([
      'region' => esc_attr( $this->aws_region ),
      'version' => 'latest',
      'credentials' => $this->aws_credentials
    ]);
  }

  // Returns the AWS buckets
  public function get_buckets() {
    return $this->s3_client->listBuckets([]);
  }

  // Returns a specific file, given an input bucket name
  public function get_file( $filename, $bucket ) {
    return $this->s3_client->getObject([
      'Bucket'      => $bucket,
      'Key'         => $filename
    ]);
  }

  // Returns the password to access files
  public function get_password() {
    return $this->password;
  }
}