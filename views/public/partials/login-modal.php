<?php
if( function_exists('get_field') ):
  $email = get_field('milo_sidebar_email', 'milo_browser');
  $phone = get_field('milo_sidebar_phone', 'milo_browser');
endif;
?>
<dialog id="milo-login-modal" class="a-loginModal">
  <div class="a-loginModal__close">
    <?php get_svg('close'); ?>
  </div>
  <h2 class="a-loginModal__headline">
    Password not working?
  </h2>
  <p class="a-loginModal__description">
    No problem. Simply request the latest password for the support portal by clicking the button below or calling us at:
  </p>
  <h3 class="a-loginModal__phone">
    <?php echo $phone; ?>
  </h3>
  <a href="mailto:<?php echo $email; ?>?subject=Support Portal Password Request">
    <div class="a-loginModal__button">
      Request Password
    </div>
  </a>
</dialog>