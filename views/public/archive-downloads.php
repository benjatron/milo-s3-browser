<?php
// Defines a division class to add to sections
$division = get_the_terms( get_the_ID(), 'division' );

$divisionName = $division[0]->name;
  if( $divisionName == 'FAAC Commercial' ){
    $divisionClass = 'faac-commercial';
    $divisionPrefix = 'faacCommercial';
  } elseif( $divisionName == 'FAAC Military' ){
    $divisionClass = 'faac-military';
    $divisionPrefix = 'faacMilitary';
  } elseif( $divisionName == 'MILO Range' ){
    $divisionClass = 'milo-range';
    $divisionPrefix = 'miloRange';
  } elseif( $divisionName == 'Realtime Technologies' ){
    $divisionClass = 'rti';
    $divisionPrefix = 'rti';
  } else {
    $divisionClass = '';
    $divisionPrefix = '';
  }
?>

<!doctype html>
<html <?php language_attributes(); ?> >
<?php get_template_part('templates/head'); ?>
<body <?php body_class($divisionClass); ?>>
  <div id="page-wrapper">
    <?php
    do_action('get_header');
    get_template_part('templates/header', 'division');

    while(have_posts()) : the_post();
      if( $divisionPrefix == ''):
        $headerBackground = get_field('faac_postHeader', 'option');
      else:
        $headerBackground = get_field($divisionPrefix . '_background', 'option');
      endif;
    ?>
    <article <?php post_class(); ?>>
      <section class="post-header">
        <?php
          if( $divisionPrefix == ''):
        ?>
          <img class="post-header post-header__image"
            src="<?php echo $headerBackground['url']; ?>"
            alt="<?php echo $headerBackground['alt']; ?>"
          />
        <?php
          else:
        ?>
          <img class="post-header post-header__image"
            src="<?php echo $headerBackground; ?>"
            alt="<?php echo $divisionName; ?>"
          />
        <?php
          endif;
        ?>
        <figcaption class="slider slider__caption">
          <h2 class="slider slider__text">
            <br />
            <span class="slider slider__text slider__text--bigger"> Downloads </span>
          </h2>
        </figcaption>
      </section>

      <div style="display: flex; flex-wrap: wrap;">
        <?php
        // If the user is an admin or has entered the password, no need to show the password form
        if(
          !is_user_logged_in ||
          !current_user_can('administrator') ||
          post_password_required()
        ):
          require( plugin_dir_path(__FILE__) . 'parts/login.php');
        else:
          require( plugin_dir_path(__FILE__) . 'parts/dashboard.php');
          require( plugin_dir_path(__FILE__) . 'parts/sidebar.php');
        endif;
        ?>
      </div>

    </article>
    <?php
    endwhile;
    ?>


      <?php
        do_action('get_footer');
        get_template_part('templates/footer', 'division');
        wp_footer();
      ?>
    </div>
  </div>
  <?php require( plugin_dir_path(__FILE__) . 'parts/login-modal.php'); ?>
</body>
</html>