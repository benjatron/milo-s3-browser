<?php
// Recursive function to display the directory
function milo_directory($directory, $objectArray) {
  global $post;
  // Creates the encapsulating list
  ?>
  <ul class="m-fileList">
    <?php
    // Displays all directories first
    foreach( array_keys($directory) as $item ):
      // If $item has children (i.e. is a directory), repeat the function on it
      if( $directory[$item]['children'] ):
      ?>
        <li class="m-fileList__item m-fileList__item--hasChildren">
          <div class="a-fileFolder">
            <img class="a-fileFolder__icon" src="<?php echo get_png('folder'); ?>" />
            <img class="a-fileFolder__icon a-fileFolder__icon--open a-fileFolder__icon--hidden" src="<?php echo get_png('folder-open'); ?>" />
            <h3 class="a-fileFolder__folder">
              <?php echo $item; ?>
            </h3>
          </div>
          <ul class="m-fileList --preload">
            <?php milo_directory($directory[$item]['children'], $objectArray); ?>
          </ul>
        </li>
      <?php
      endif;
    endforeach;

    // Displays all non-directory files
    foreach( array_keys($directory) as $item ):
      // If $item is a normal file, display that
      if( !$directory[$item]['children'] ):
        $description = '';
        $id = $directory[$item]['id'];
        $link = $directory[$item]['link'];
        $name = $directory[$item]['name'];
        $path = $directory[$item]['path'];
        $size = $directory[$item]['size'];

        $fileTypes = array(
          'archive' => array(
            '7z', 'arj', 'deb', 'gz', 'pkg', 'rar', 'rpm', 'tar', 'z', 'zip'
          ),
          'audio' => array(
            'aif', 'cda', 'mid', 'midi', 'mp3', 'mpa', 'ogg', 'wav', 'wma', 'wpl'
          ),
          'document' => array(
            'key', 'odp', 'pps', 'ppt', 'pptx', 'ods', 'xlr', 'xls', 'xlsx', 'doc', 'docx', 'rtf', 'tex', 'txt', 'wks', 'wps', 'wpd'
          ),
          'executable' => array(
            'exe'
          ),
          'image' => array(
            'ai', 'bmp', 'eps', 'gif', 'ico', 'jpg', 'jpeg', 'png', 'ps', 'psd', 'svg', 'tif', 'tiff'
          ),
          'milo' => array(
            'milo'
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
            <?php
            // Retrieves the icon based on file extension
            $ext = strtolower( end( explode( '.', $name ) ) );
            if( in_array( $ext, $fileTypes['archive'] ) ):
              $file = 'file-archive';
            elseif( in_array( $ext, $fileTypes['audio'] ) ):
              $file = 'file-audio';
            elseif( in_array( $ext, $fileTypes['document'] ) ):
              $file = 'file-alt';
            elseif( in_array( $ext, $fileTypes['executable'] ) ):
              $file = 'file-exe';
            elseif( in_array( $ext, $fileTypes['image'] ) ):
              $file = 'file-image';
            elseif( in_array( $ext, $fileTypes['milo'] ) ):
              $file = 'file-milo';
            elseif( in_array( $ext, $fileTypes['pdf'] ) ):
              $file = 'file-pdf';
            elseif( in_array( $ext, $fileTypes['video'] ) ):
              $file = 'file-video';
            else:
              $file = 'file';
            endif;
            ?>
            <img class="a-browserItem__icon" src="<?php echo get_png($file); ?>" />
            <h3 class="a-browserItem__text">
              <a class="a-browserItem__text--title" href="<?php echo milo_get_domain() .  'milo-' . $post->post_name . '?u=' . urlencode($path); ?>" target="_blank">
                <?php echo $name; ?>
              </a>
              <br/>
              Size: <?php echo formatBytes($size); ?>
            </h3>
          </div>
          <a class="a-browserButton" href="<?php echo milo_get_domain() .  'milo-' . $post->post_name . '?u=' . urlencode($path); ?>" target="_blank">
            <div class="a-browserButton__link">Continue to download <svg class="
          a-browserButton__icon"><?php get_svg('download'); ?></svg></div>
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
                <?php
                $description = file_get_contents($objectArray[$id+1]['link']);
                echo $description;
                ?>
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