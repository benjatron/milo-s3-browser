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

  // Page query
  public $query = array();

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

    // Sets the page query
    $r = $_SERVER['REQUEST_URI']; 
    parse_str( substr( $r, strpos( $r, '?' ) + 1 ), $this->query );
  }

  /**
   * @return array AWS buckets tied to the current S3 client
   */
  public function get_buckets() {
    $buckets = array();

    // Get the Buckets object
    $object = $this->s3_client->listBuckets([])['Buckets'];

    // Add just the bucket names to our $buckets array
    foreach( $object as $bucket ):
      $buckets[] = $bucket['Name'];
    endforeach;

    // Return just the Buckets array
    return $buckets;
  }

  /**
   * Gets the download URL for a specific file, given a bucket
   * 
   * @var string $filename      The key of the file to query
   * @var string $bucket        The AWS bucket to search in
   * 
   * @return string A URI to download the requested file
   */
  public function get_file( $filename, $bucket ) {
    // Get the filetype
    $base = basename( $key );

    // Create a request for the file's URI
    $cmd = $this->s3_client->getCommand( 'GetObject',
      [
        'Bucket'                        => $bucket,
        'Key'                           => $filename,
        'ResponseContentType'           => 'application/octet-stream',
        'ResponseContentDisposition'    => 'attachment; filename="' . $base . '"'
      ]
    );
    $request = $this->s3_client->createPresignedRequest( $cmd, '+180 minutes' );
    $uri = $request->getUri();

    // Return a string of the full URI needed to download the file
    return (string) $uri ;
  }

  /**
   * Gets all object keys in a bucket
   * 
   * @var string $bucket      The AWS bucket to query
   * 
   * @return array The keys of all objects in the bucket
   */
  public function get_objects( $bucket ) {
    // Creates an array to add keys to
    $keys = array();

    // Gets all objects in a bucket
    $results = $this->s3_client->getPaginator( 'ListObjects', [
      'Bucket'    => $bucket
    ]);

    // Adds object keys to $keys array
    foreach( $results as $result ):
      foreach( $result['Contents'] as $object ):
        $keys[] = $object['Key'];
      endforeach;
    endforeach;

    // Return the $keys array
    return $keys;
  }

  /** 
   * @return string The password to access support portal pages
   */
  public function get_password() {
    return $this->password;
  }
}