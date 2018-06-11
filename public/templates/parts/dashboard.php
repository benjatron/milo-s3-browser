<?php
// Displays a "welcome" area and dashboard for the browser interface

if( function_exists('get_field') ):
  $intro = get_field('milos3_welcome_intro', 'milo_s3_browser');
  $lower = get_field('milos3_welcome_lower', 'milo_s3_browser');
endif;
?>
<section class="o-browserDashboard">
  <div class="o-browserDashboard__intro">
    <?php echo $intro; ?>
  </div>
  <div class="o-browserDashboard__grid">
    <?php
    while( have_rows('milos3_welcome_grid', 'milo_s3_browser') ): the_row();
      if( get_row_layout() == 'full-width' ):
        $browser = get_sub_field('browser');
          $browserLink = get_permalink($browser->ID);
          $browserImage = get_field('milos3_bucket_preview', $browser->ID);
        $button = get_sub_field('button');
        ?>
        <div class="m-gridCell m-gridCell--full" style="background-image: url('<?php echo $browserImage['url']; ?>');">
          <h3 class="m-gridCell__title">
            <?php
            while( have_rows('name') ): the_row();
              if( get_row_layout() == 'normal' ):
                the_sub_field('text');
              elseif( get_row_layout() == 'emphasized'):
              ?>
                <span class="m-gridCell__title m-gridCell__title--emphasized">
                  <?php the_sub_field('text'); ?>
                </span>
              <?php
              endif;
            endwhile;
            ?>
          </h3>
          <a href="<?php echo $browserLink; ?>">
            <div class="m-gridCell__link">
              <?php echo $button; ?>
            </div>
          </a>
        </div>
        <?php
      elseif( get_row_layout() == 'two-up'):
        $browser_01 = get_sub_field('browser_01');
          $browserLink_01 = get_permalink($browser_01->ID);
          $browserImage_01 = get_field('milos3_bucket_preview', $browser_01->ID);
        $browser_02 = get_sub_field('browser_02');
          $browserLink_02 = get_permalink($browser_02->ID);
          $browserImage_02 = get_field('milos3_bucket_preview', $browser_02->ID);
        $button_01 = get_sub_field('button_01');
        $button_02 = get_sub_field('button_02');
        ?>
        <div class="m-gridCell m-gridCell--half" style="background-image: url('<?php echo $browserImage_01['url']; ?>');">
          <h3 class="m-gridCell__title">
            <?php
            while( have_rows('name_01') ): the_row();
              if( get_row_layout() == 'normal' ):
                the_sub_field('text');
              ?>
                <br/>
              <?php
              elseif( get_row_layout() == 'emphasized'):
              ?>
                <span class="m-gridCell__title m-gridCell__title--emphasized">
                  <?php the_sub_field('text'); ?>
                </span>
                <br/>
              <?php
              endif;
            endwhile;
            ?>
          </h3>
          <a href="<?php echo $browserLink_01; ?>">
            <div class="m-gridCell__link">
              <?php echo $button_01; ?>
            </div>
          </a>
        </div>
        <div class="m-gridCell m-gridCell--half" style="background-image: url('<?php echo $browserImage_02['url']; ?>');">
          <h3 class="m-gridCell__title">
            <?php
            while( have_rows('name_02') ): the_row();
              if( get_row_layout() == 'normal' ):
                the_sub_field('text');
              ?>
                <br/>
              <?php
              elseif( get_row_layout() == 'emphasized'):
              ?>
                <span class="m-gridCell__title m-gridCell__title--emphasized">
                  <?php the_sub_field('text'); ?>
                </span>
                <br/>
              <?php
              endif;
            endwhile;
            ?>
          </h3>
          <a href="<?php echo $browserLink_02; ?>">
            <div class="m-gridCell__link">
              <?php echo $button_02; ?>
            </div>
          </a>
        </div>
        <?php
      endif;
    endwhile;
    ?>
  </div>
  <div class"o-browserDashboard__lower">
    <?php echo $lower; ?>
  </div>
</section>