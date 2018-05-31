<?php
// Functions used on the front-end

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
      echo '<li class="m-fileList__item m-fileList__item--hasChildren">';
      echo $item . ' has files:<br/>';
      echo '<ul class="m-fileList">';
      milo_directory($directory[$item]['children'], $objectArray);
      echo '</ul>';
      echo '</li>';
    // If $item is a normal file, display that
    else:
      $description = '';
      $id = $directory[$item]['id'];
      $link = $directory[$item]['link'];
      $name = $directory[$item]['name'];
      $size = $directory[$item]['size'];

      // If the file is a description .txt file, skip it
      if( $name == ($objectArray[$id-1]['name'] . '.txt') ):
        continue;
      endif;

      // Creates the list item for the file
      echo '<li id="miloFile-' . $id . '" class="m-fileList__item">';
      echo 'Filename: ' . $name . '<br/>';
      echo 'File size: ' . formatBytes($size) . '<br/>';
      echo 'Download Time: ' . downloadTime($size) . '<br/>';
      // If there is a description, display it
      if( $objectArray[$id+1]['name'] == ($name . '.txt') ):
        echo 'Description: ' . file_get_contents($objectArray[$id+1]['link']) . '<br/>';
      endif;
      echo '<a href="' . $link . '" target="_blank" download>Download</a>';
      echo '</li>';
    endif;
  endforeach;

  // Closes the encapsulating list
  echo '</ul>';
}