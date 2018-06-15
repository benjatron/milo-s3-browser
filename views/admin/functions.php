<?php
// The values necessary for the plugin
$milo_adminSettings = array(
  'aws_key',
  'aws_secret',
  'aws_region',
  'milo_generated_key'
);

// Creates a menu item for the S3 browser plugin and settings pages
function milo_s3_acf_menus() {
  if( function_exists('acf_add_options_page') ):
    acf_add_options_page(array(
      'page_title' => 'Browser Dashboard Settings',
      'menu_title' => 'Dashboard Settings',
      'capability' => 'manage_options',
      'parent_slug' => 'edit.php?post_type=milos3_bucket',
      'post_id' => 'milo_s3_browser'
    ));
  endif;
}
add_action('admin_menu', 'milo_s3_acf_menus');
function milo_s3_browser_plugin_menu() {
  add_submenu_page(
    'edit.php?post_type=milos3_bucket',
    'AWS S3 & Security',
    'AWS S3 & Security',
    'manage_options',
    'milo-s3-browser-plugin',
    'milo_s3_browse_display_settings'
  );
}
add_action('admin_menu', 'milo_s3_browser_plugin_menu', 105);

// Sets up required options for the plugin on load
function milo_s3_browser_settings() {
  register_setting( 'milo-s3-browser-plugin', 'aws_key');
  register_setting( 'milo-s3-browser-plugin', 'aws_secret');
  register_setting( 'milo-s3-browser-plugin', 'aws_region');
  register_setting( 'milo-s3-browser-plugin', 'milo_generated_key');
}
add_action('admin_init', 'milo_s3_browser_settings');

// Creates a new cron schedule every month
function milo_cron_schedule( $schedule ) {
  $schedule['every-month'] = array(
    'interval' => 1 * MONTH_IN_SECONDS,
    'display' => __( 'Every month', 'milo')
  );
  return $schedule;
}
add_filter( 'cron_schedules', 'milo_cron_schedule' );

// Schedules the auto-generated password cron event
function milo_cron_passgen() {
  $pass = base64_encode( random_bytes(12) );
  if( get_option( 'milo_generated_key') !== false ):
    update_option( 'milo_generated_key', $pass );
  else:
    add_option( 'milo_generated_key', $pass, null, 'no' );
  endif;
}
add_action( 'milo_cron_hook' , 'milo_cron_passgen' );
if( !wp_next_scheduled( 'milo_cron_hook') ):
  wp_schedule_event( time() ,'every-month', 'milo_cron_hook');
endif;