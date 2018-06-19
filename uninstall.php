<?php
// if uninstall.php is not called by WordPress, die
if( !defined('WP_UNINSTALL_PLUGIN') ):
  die;
endif;

global $milo_adminSettings;
foreach( $milo_adminSettings as $setting ):
  delete_option($setting);
  // Removes the option for multisite as well
  if( is_multisite() ):
    delete_site_option($setting);
  endif;
endforeach;