<?php
// Displays the login form for protected content

if( function_exists('get_field') ):
  $heading = get_field('milos3_login_heading', 'milo_s3_browser');
  $subhead = get_field('milos3_login_subhead', 'milo_s3_browser');
  $description = get_field('milos3_login_description', 'milo_s3_browser');
  $disclosure = get_field('milos3_login_disclosures', 'milo_s3_browser');
else:
  $heading = 'Lorem Ipsum';
  $subhead = 'Dolor sit amet';
  $description = 'Lorem ipsum dolor sit amet';
  $disclosure = 'Lorem ipsum dolor <a href="#">sit amet</a>';
endif;
?>
<section class="o-browserLogin <?php echo $divisionName; ?>">
  <h2 class="o-browserLogin__heading">
    <?php echo $heading; ?>
  </h2>
  <p class="o-browserLogin__subhead">
    <?php echo $subhead; ?>
  </p>
  <div class="o-browserLogin__description">
    <?php echo $description; ?>
  </div>
  <div class="o-browserLogin__form">
    <?php
      echo get_the_password_form();
    ?>
  </div>
  <div class="o-browserLogin__disclosure">
    <?php echo $disclosure; ?>
  </div>
</section>