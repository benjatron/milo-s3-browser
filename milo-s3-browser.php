<?php
/*
Plugin Name:  Milo S3 Browser
Description:  S3 Bucket Browser for MILO Range
Author:       FWD Creative, LLC
Author URI:   https://designfwd.com/
License:      GPL3
License URI:  https://www.gnu.org/licenses/gpl-3.0.html
Text Domain:  milo
*/

// Load AWS SDK files
require(dirname(__FILE__) . '/aws/aws-autoloader.php');

use Aws\S3\S3Client;

use GuzzleHttp\Promise;
use GuzzleHttp\Promise\RejectedPromise;

// Load admin dashboard files
require(dirname(__FILE__) . '/admin/functions.php');
require(dirname(__FILE__) . '/admin/settings-page.php');

// Load public files
require(dirname(__FILE__) . '/public/shortcode.php');
