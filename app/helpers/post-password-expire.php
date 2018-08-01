<?php
function milo_post_password_expires( ) {
  return time() + 1 * DAY_IN_SECONDS;
}
add_filter( 'post_password_expires', 'milo_post_password_expires', 10, 1 );
