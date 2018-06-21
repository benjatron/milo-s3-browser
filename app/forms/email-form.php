<?php
// Assign values to message portions
function milo_email_password() {
  $to = get_option( 'email_addresses' );
  $subject = 'The Password for Support Downloads Has Been Updated';
  $message = 'The password for accessing the downloads area has been updated. The new password is:<br/><br/><code style="font-size:18px;">' . esc_attr( get_option( 'milo_generated_key' ) ) . '</code><br/><br/>' . 'The contents of this message are confidential and should not be shared without the consent of the intended party or parties.';
  $headers = array(
    'Content-Type: text/html; charset=UTF-8',
    'From: ' . get_bloginfo('name') . '<' . get_bloginfo('admin_email') . '>'
  );

  wp_mail ( $to, $subject, $message, $headers );
}
