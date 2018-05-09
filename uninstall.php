<?php

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$aws_key = 'milo_browse_aws_access_key';
$aws_secret = 'milo_browse_aws_secret';
$aws_region = 'milo_browse_aws_region';

delete_option($aws_key);
delete_option($aws_secret);
delete_option($aws_region);

// for site options in Multisite
delete_site_option($aws_key);
delete_site_option($aws_secret);
delete_site_option($aws_region);
