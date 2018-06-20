<?php
function milo_page_password() {
  ?>
  <p>The password for this page is handled by a plugin. It is displayed below. </p>
  <code>
    <?php echo get_option('milo_generated_key'); ?>
  </code>
  <?php
}