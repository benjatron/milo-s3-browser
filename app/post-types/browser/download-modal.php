<?php
/**
 * Displays a modal window for downloading a file
 *
 * @var string $id            Identification number for the modal
 * @var string $name          The name of the file
 * @var string $size          The size, in bytes, of the download file
 * @var string $file          The type of the file to download
 * @var string $link          The url of the file to download
 * @var string $description   The description, if any, of the file
 */

function milo_download_modal( $id, $name, $size, $file, $link, $description ) {
  $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  ?>
  <dialog id="download-<?php echo $id; ?>" class="m-downloadDialog">
    <div class="m-downloadDialog__close">
      <?php get_svg('close'); ?>
    </div>
    <img class="m-downloadDialog__icon" src="<?php echo get_png($file); ?>" />
    <div class="m-downloadDialog__masthead">
      <h3 class="m-downloadDialog__name">File Name: <?php echo $name; ?></h3>
      <h4 class="m-downloadDialog__size">File Size: <?php echo formatBytes($size); ?></h4>
    </div>
    <p class="m-downloadDialog__url">Shareable URL: <code class="m-downloadDialog__url--code"><?php echo $url . '#download-' . $id; ?></code></p>

    <?php
    // If there is a description, display it
    if( $description != "" ):
    ?>
      <div class="a-browserDescription">
        <svg class="a-browserDescription__toggle" viewBox="0 0 16 16">
          <path
            d=" M 0,0
                L 16,8
                L 0,16
              "
          />
        </svg>
        <h4 class="a-browserDescription__title">
          Description
        </h4>
        <p class="a-browserDescription__body --preload">
          <?php echo $description; ?>
        </p>
      </div>
    <?php
    endif;
    ?>
    <a class="m-downloadDialog__button" href="<?php echo $link; ?>" target="_blank" download>
      <div class="m-downloadDialog__link">Download</div>
    </a>
    <p class="m-downloadDialog__ieDisclosure --is-hidden">It looks like you're using Internet Explorer. Some download functionality may be different than expected in this browser, which is explained in <a class="m-downloadDialog__textLink" href="" target="_blank" download>this guide</a></p>
  </dialog>
  <?php
  return;
}