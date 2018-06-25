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

/**
 * This plugin accomplishes the following:
 * 1. Creates a "Support Portal" for access to guides and support material
 * 2. Automates the security and access to that portal with a hands-off approach
 * 3. Displays files hosted on Amazon S3 and provides an interface for
 *    downloading them through the website
*/

// Load vendor files
require 'vendor/autoload.php';

/**
 * Helper Functions
 */
// Format file sizes in bytes to other formats
require 'app/helpers/byte-format.php';
// Determines download time based on a given download speed
require 'app/helpers/download-time.php';
// Imports the contents of an SVG file
require 'app/helpers/get-svg.php';
// Imports the contents of a PNG file
require 'app/helpers/get-png.php';
// Generates a cryptographically secure string
require 'app/helpers/password-generator.php';

/**
 * Admin Functionality
 */

// Names global administration settings used in this plugin
$milo_pluginSlug = 'milo-browser-plugin';
$milo_adminSettings = array(
  'aws_key',
  'aws_secret',
  'aws_region',
  'milo_generated_key',
  'email_addresses'
);

// Registers the plugin settings in $milo_adminSettings
function milo_register_settings() {
  global $milo_adminSettings;
  global $milo_pluginSlug;

  foreach( $milo_adminSettings as $setting ):
    register_setting(
      $milo_pluginSlug,
      $setting,
      array(
        'show_in_rest' => true,
        'autoload' => 'yes'
      )
    );
  endforeach;
}
add_action( 'admin_init', 'milo_register_settings');

// Creates menu items for the Browser post type
function milo_menu_items() {
  global $milo_pluginSlug;

  // Creates a "Dashboard Settings" page
  if( function_exists('acf_add_options_page') ):
    acf_add_options_sub_page(array(
      'page_title' => 'Login Form Settings',
      'menu_title' => 'Login Form Settings',
      'capability' => 'manage_options',
      'parent_slug' => $milo_pluginSlug
    ));
    acf_add_options_sub_page(array(
      'page_title' => 'Sidebar Settings',
      'menu_title' => 'Sidebar Settings',
      'capability' => 'manage_options',
      'parent_slug' => $milo_pluginSlug
    ));
  endif;

  // Creates a "S3 Browsers" page in the admin menu
  add_menu_page(
    'S3 Browsers',
    'S3 Browsers',
    'manage_options',
    $milo_pluginSlug,
    'milo_browser_display_settings',
    'dashicons-admin-generic',
    51
  );
}
add_action('admin_menu', 'milo_menu_items');

// Sets up the view for the AWS & Security admin menu page
require 'views/admin/browser-security.php';

// Loads the email form used for notifying of password updates
require 'app/forms/email-form.php';

// Creates a new cron schedule - every month
function milo_cron_monthly( $schedule ) {
  $schedule['every-month'] = array(
    'interval' => 1 * MONTH_IN_SECONDS,
    'display' => __( 'Every month', 'milo' )
  );
  return $schedule;
}
add_filter( 'cron_schedules', 'milo_cron_monthly' );

// Schedules password generation for every month
add_action( 'milo_password_cron', 'milo_password_generator' );

// If the cron is not currently scheduled, sets it
if( !wp_next_scheduled( 'milo_password_cron' ) ):
  wp_schedule_event( time(), 'every-month', 'milo_password_cron' );
endif;

// Queries which pages have the templates that should be password protected
require 'app/helpers/browser-query.php';

// Displays the content of the password meta box
require 'app/forms/page-password.php';

// For particular page templates, show the page password meta box
function milo_show_password_meta() {
  if(
    current_user_can('administrator') &&
    in_array( get_the_ID(), milo_browser_pages() )
  ):
    add_meta_box(
      'page-password',
      'Page Password',
      'milo_page_password',
      'page',
      'side',
      'high'
    );
  endif;
}
add_action( 'add_meta_boxes', 'milo_show_password_meta' );

// When saving a browser page, update its post password
function milo_set_password() {
  if( in_array( get_the_ID(), milo_browser_pages() ) ):
    // Unhooking to avoid infinite loop
    remove_action( 'save_post', 'milo_set_password' );

    $browserPages = milo_browser_pages();
    foreach( $browserPages as $page ):
      wp_update_post( array(
        'ID' => $page,
        'post_password' => get_option('milo_generated_key')
      ) );
    endforeach;

    // Rehooking function for next save
    add_action( 'save_post', 'milo_set_password' );
  endif;
}
add_action( 'save_post', 'milo_set_password' );




/**
 * Public Functionality
 */

// Registers the shortcode and directory functions
require 'app/post-types/browser/directory-listing.php';
require 'app/post-types/browser/shortcode.php';
require 'app/post-types/browser/download-modal.php';
require 'app/post-types/browser/modal-listing.php';

// Registers the styles and scripts used in public templates
function milo_register_scripts() {
  wp_enqueue_script( 's3-browser', plugins_url( 'assets/scripts/dist/main.min.js', __FILE__), array('sage/js') );

  wp_register_style('s3-browser', plugins_url( 'assets/styles/dist/main.css', __FILE__), array('sage/css') );
  wp_enqueue_style('s3-browser');
}
add_action( 'wp_enqueue_scripts', 'milo_register_scripts');

// Updates the login form for plugin pages
require 'app/forms/login-form.php';