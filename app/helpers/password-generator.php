<?php
// Generates a base-64-encoded value and stores it to 'milo_generated_key'
function milo_password_generator() {
  $option = 'milo_generated_key';
  $passphrase = esc_attr( base64_encode( random_bytes( 12 ) ) );
  update_option( $option, $passphrase );
}