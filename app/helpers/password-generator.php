<?php
// Generates a base-64-encoded value and stores it to 'milo_generated_key'
function milo_password_generator() {
  $option = 'milo_generated_key';
  $passphrase = '';
  for( $i = 0; $i < 8; $i++ ):
    $passphrase .= chr(rand(97,122));
  endfor;
  update_option( $option, $passphrase );

  $browserPages = milo_browser_pages();
  foreach( $browserPages as $page ):
    wp_update_post( array(
      'ID' => $page,
      'post_password' => $passphrase
    ) );
  endforeach;

  // Email the password update to assigned emails
  milo_email_password();
}