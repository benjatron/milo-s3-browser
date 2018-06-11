<?php
// Functions used on the front-end

// Routes posts of "downloads" type to use the custom templates
function milo_downloads_template($single) {
  global $wp_query, $post;

  // Check for single template by post type
  if( $post->post_type == 'milos3_bucket' ):
    if( file_exists( plugin_dir_path(__FILE__) . './templates/single-downloads.php' ) ):
      // Sets post password to match the option generated by the plugin
      $post->post_password = get_option('milo_generated_key');
      return plugin_dir_path(__FILE__) . './templates/single-downloads.php';
    endif;
  endif;

  // If post matches the archive ID, use that template
  if( $post->ID == (get_field('milos3_welcome_page', 'milo_s3_browser')->ID) ):
    if( file_exists( plugin_dir_path(__FILE__) . './templates/archive-downloads.php' ) ):
      // Sets post password to match the option generated by the plugin
      $post->post_password = get_option('milo_generated_key');
      return plugin_dir_path(__FILE__) . './templates/archive-downloads.php';
    endif;
  endif;

  return $single;
}
add_filter('template_include', 'milo_downloads_template', 110);

function milo_password_form() {
  global $post;
  if(
    $post->ID == (get_field('milos3_welcome_page', 'milo_s3_browser')->ID) ||
    $post->post_type == 'milos3_bucket'
  ):
    $checkLabel = get_field('milos3_login_tosLabel', 'milo_s3_browser');
    $checkLink = get_field('milos3_login_tosLink', 'milo_s3_browser');
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="m-browserForm protected-post-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post"><label class="m-browserForm__label m-browserForm__label--password" for="' . $label . '">' . __( "Password" ) . ' </label><input class="m-browserForm__pass" name="post_password" id="' . $label . '" placeholder="Enter your password" type="password" size="20" /><input class="m-browserForm__checkbox" name="tos_checkbox" id="tos-checkbox" type="checkbox"><label class="m-browserForm__label m-browserForm__label--check" for="tos-checkbox">I agree to the <a class="m-browserForm__link" href="' . $checkLink . '" target="_blank">' . $checkLabel . '</a></label><input class="m-browserForm__button --inactive" type="submit" name="Submit" value="' . esc_attr__( "Sign In" ) . '" />
    </form>
    ';
  else:
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="protected-post-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( "To view this protected post, enter the password below:" ) . '
    <label for="' . $label . '">' . __( "Password:" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
    </form>
    ';
  endif;
  return $o;
}
add_filter( 'the_password_form', 'milo_password_form');

// SVG importer
function get_svg( $file ) {
  echo file_get_contents( plugins_url() . '/milo-s3-browser/assets/images/dist/' . $file . '.svg');
}

// Function to format sizes from bytes to KB, MB, GB, or TB
// @link: https://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes/2510459
function formatBytes($bytes, $precision = 2) {
  $units = array('B', 'KB', 'MB', 'GB', 'TB');

  $bytes = max($bytes, 0);
  $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
  $pow = min($pow, count($units) - 1);

  // Uncomment one of the following alternatives
  $bytes /= pow(1024, $pow);
  // $bytes /= (1 << (10 * $pow));

  return round($bytes, $precision) . ' ' . $units[$pow];
}

// Determines the estimated download time
// Default speed is 20 Mbps
function downloadTime($bytes, $speed = 20000) {
  $time = $bytes / $speed;

  // Formats $speed to Mbps
  $speedPerSecond = floor($speed / 1000) . 'Mbps';

  // Breaks time up into hours, minutes, and seconds
  $hours = floor($time / 3600);
  $minutes = floor($time / 60 % 60);
  $seconds = floor($time % 60);

  return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) . ' at ' . $speedPerSecond;
}

// Recursive function to display the directory
function milo_directory($directory, &$objectArray) {
  // Creates the encapsulating list
  echo '<ul class="m-fileList">';

  foreach( array_keys($directory) as $item ):
    // If $item has children (i.e. is a directory), repeat the function on it
    if( $directory[$item]['children'] ):
    ?>
      <li class="m-fileList__item m-fileList__item--hasChildren">
        <div class="a-fileFolder">
          <svg class="a-fileFolder__icon" viewBox="0 0 16 16">
            <?php get_svg('folder'); ?>
          </svg>
          <svg class="a-fileFolder__icon a-fileFolder__icon--open --is-hidden" viewBox="0 0 16 16">
            <?php get_svg('folder-open'); ?>
          </svg>
          <h3 class="a-fileFolder__folder">
            <?php echo $item; ?>
          </h3>
        </div>
        <ul class="m-fileList --preload">
          <?php milo_directory($directory[$item]['children'], $objectArray); ?>
        </ul>
      </li>
    <?php
    // If $item is a normal file, display that
    else:
      $description = '';
      $id = $directory[$item]['id'];
      $link = $directory[$item]['link'];
      $name = $directory[$item]['name'];
      $size = $directory[$item]['size'];

      $fileTypes = array(
        'archive' => array(
          '7z', 'arj', 'deb', 'gz', 'milo', 'pkg', 'rar', 'rpm', 'tar', 'z', 'zip'
        ),
        'audio' => array(
          'aif', 'cda', 'mid', 'midi', 'mp3', 'mpa', 'ogg', 'wav', 'wma', 'wpl'
        ),
        'document' => array(
          'key', 'odp', 'pps', 'ppt', 'pptx', 'ods', 'xlr', 'xls', 'xlsx', 'doc', 'docx', 'rtf', 'tex', 'txt', 'wks', 'wps', 'wpd'
        ),
        'image' => array(
          'ai', 'bmp', 'eps', 'gif', 'ico', 'jpg', 'jpeg', 'png', 'ps', 'psd', 'svg', 'tif', 'tiff'
        ),
        'pdf' => array(
          'pdf'
        ),
        'video' => array(
          '3g2', '3gp', 'avi', 'flv', 'h264', 'm4v', 'mkv', 'mov', 'mp4', 'mpg', 'mpeg', 'rm', 'swf', 'vob', 'wmv'
        ),
      );

      // If the file is a description .txt file, skip it
      if( $name == ($objectArray[$id-1]['name'] . '.txt') ):
        continue;
      endif;

      // Creates the list item for the file
      ?>
      <li id="miloFile-<?php echo $id; ?>" class="m-fileList__item">
        <div class="a-browserItem">
          <svg class="a-browserItem__icon" viewBox="0 0 16 16">
          <?php
            // Retrieves the icon based on file extension
            $ext = end(explode('.', $name));
            if( in_array( $ext, $fileTypes['archive'] ) ):
              get_svg('file-archive');
            elseif( in_array( $ext, $fileTypes['audio'] ) ):
              get_svg('file-audio');
            elseif( in_array( $ext, $fileTypes['document'] ) ):
              get_svg('file-alt');
            elseif( in_array( $ext, $fileTypes['image'] ) ):
              get_svg('file-image');
            elseif( in_array( $ext, $fileTypes['pdf'] ) ):
              get_svg('file-pdf');
            elseif( in_array( $ext, $fileTypes['video'] ) ):
              get_svg('file-video');
            else:
              get_svg('file');
            endif;
          ?>
          </svg>
          <h3 class="a-browserItem__text">
            <a class="a-browserItem__text--title" href="<?php echo $link; ?>" target="_blank" download>
              <?php echo $name; ?>
            </a>
            <br/>
            Size: <?php echo formatBytes($size); ?><span class="a-browserItem__text--spacer"></span>Time: <?php echo downloadTime($size); ?>
          </h3>
        </div>
        <a class="a-browserButton" href="<?php echo $link; ?>" target="_blank" download>
          <div class="a-browserButton__link">Download</div>
        </a>

        <?php
        // If there is a description, display it
        if( $objectArray[$id+1]['name'] == ($name . '.txt') ):
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
            <?php echo file_get_contents($objectArray[$id+1]['link']); ?>
          </p>
        </div>
        <?php
        endif;
        ?>
      </li>
    <?php
    endif;
  endforeach;

  // Closes the encapsulating list
  ?>
  </ul>
  <?php
}