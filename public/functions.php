<?php
// Functions used on the front-end

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
          <svg class="a-fileFolder__icon --is-hidden" viewBox="0 0 16 16">
            <?php get_svg('folder-open'); ?>
          </svg>
          <?php echo $item; ?><br/>
        </div>
        <ul class="m-fileList">
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
          <h3 class="a-browserItem__file">
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
            <?php echo $name; ?>
          </h3>
          <h4 class="a-browserItem__text">
            Size: <?php echo formatBytes($size); ?>
          </h4>
          <h4 class="a-browserItem__text">
            Time: <?php echo downloadTime($size); ?>
          </h4>
        </div>
        <div class="a-browserButton">
          <a class="a-browserButton__link" href="<?php echo $link; ?>" target="_blank" download>Download</a>
        </div>
        <?php
        // If there is a description, display it
        if( $objectArray[$id+1]['name'] == ($name . '.txt') ):
        ?>
        <div class="a-browserDescription">
          <p class="a-browserDescription__text">
            Description: <?php echo file_get_contents($objectArray[$id+1]['link']); ?>
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
  </ul>;
  <?php
}