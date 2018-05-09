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
}
add_action('admin_init', 'milo_s3_browser_settings');
