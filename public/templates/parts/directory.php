<section class="o-browserDashboard">
  <div class="o-browserDashboard__breadcrumbs">
    <div class="a-browserBreadcrumbs">
      <a class="a-browserBreadcrumbs__home" href="<?php echo get_permalink( get_field('milos3_welcome_page', 'milo_s3_browser')->ID ); ?>">
        Home
      </a>
      <span class="a-browserBreadcrumbs__separator">
      /
      </span>
      <span class="a-browserBreadcrumbs__bucket">
        <?php
        // Trims "Protected" or "Private" from title
        echo trim( strstr( get_the_title(), ': ' ), ': ' );
        ?>
      </span>
    </div>
  </div>
  <div class="o-browserDashboard__fileManager">
    <?php
    do_shortcode('[milos3browser bucket=' . get_field('milos3_bucket_name') . ']');
    ?>
  </div>
</section>