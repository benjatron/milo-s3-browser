<?php
function milo_post_password_expire( $time ) {
  return 1 * DAY_IN_SECONDS;
}
add_filter( 'post_password_expires', 'milo_post_password_expire' );