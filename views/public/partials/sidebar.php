<?php
// Displays the plugin sidebar

if( function_exists('get_field') ):
  $ie_instructions = get_field('milos3_sidebar_explorer', 'milo_s3_browser');
  $email = get_field('milos3_sidebar_email', 'milo_s3_browser');
  $phone = get_field('milos3_sidebar_phone', 'milo_s3_browser');
endif;
?>
<section class="o-browserSidebar">
  <div class="o-browserSidebar__section">
    <div class="a-explorerDownload">
      <h3 class="a-explorerDownload__headline">
        Using Internet Explorer?
      </h3>
      <img class="a-explorerDownload__logo" src="<?php echo plugins_url() . '/milo-s3-browser/assets/images/dist/ie-logo.png' ?>"/>
      <a href="<?php echo $ie_instructions['url']; ?>" target="_blank" download>
        <div class="a-explorerDownload__link">
          Download Instructions
        </div>
      </a>
    </div>
  </div>
  <div class="o-browserSidebar__section">
    <div class="a-supportGuides">
      <h3 class="a-supportGuides__headline">
        Support Guides
      </h3>
      <?php
      while( have_rows('milos3_sidebar_guides', 'milo_s3_browser') ): the_row();
        $label = get_sub_field('label');
        $file = get_sub_field('file');
        ?>
        <a href="<?php echo $file['url']; ?>" target="_blank" download>
          <div class="a-supportGuides__link">
            <?php echo $label; ?>
          </div>
        </a>
        <?php
      endwhile;
      ?>
    </div>
  </div>
  <div class="o-browserSidebar__section">
    <div class="a-contactSupport">
      <h3 class="a-contactSupport__headline">
        Contact Support
      </h3>
      <p class="a-contactSupport__description">
        Contact support by email:
      </p>
      <a class="a-contactSupport__email" href="mailto:<?php echo $email; ?>">
        <?php echo $email; ?>
      </a>
      <?php
      if( $post->ID == (get_field('milos3_welcome_page', 'milo_s3_browser')->ID) ):
        ?>
        <p class="a-contactSupport__description">
          Contact support by phone:
        </p>
        <p class="a-contactSupport__phone">
          <?php echo $phone; ?>
        </p>
        <?php
      endif;
      ?>
    </div>
  </div>
</section>