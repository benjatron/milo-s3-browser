<?php
// Creates a menu item for the S3 browser plugin
function milo_s3_browser_plugin_menu() {
	add_submenu_page('tools.php', 'MILO S3 Browser', 'MILO S3 Browser', 'manage_options', 'milo-s3-browser-settings', 'milo_s3_browse_display_settings');
}
add_action('admin_menu', 'milo_s3_browser_plugin_menu');

// Sets up required options for the plugin on load
function milo_s3_browser_settings() {
  register_setting( 'milo-s3-browser-plugin', 'aws_key');
  register_setting( 'milo-s3-browser-plugin', 'aws_secret');
  register_setting( 'milo-s3-browser-plugin', 'aws_region');
  register_setting( 'milo-s3-browser-plugin', 'milo_persistent_key');
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

}
add_action( 'milo_cron_hook' , 'milo_cron_passgen' );
if( !wp_next_scheduled( 'milo_cron_hook') ):
  wp_schedule_event( time() ,'every-month', 'milo_cron_hook');
endif;