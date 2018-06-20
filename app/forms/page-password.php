<?php
function milo_page_password() {
  ?>
  <p>The password for this page is handled by a plugin. It is displayed below. </p>
  <code>
    <?php echo get_option('milo_generated_key'); ?>
  </code>
  <input type="hidden" name="post_password" value="<?php echo get_option('milo_generated_key'); ?>" />
  <?php
}