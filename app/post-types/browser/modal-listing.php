<?php
// Recursive function to display the modals
function milo_modals($directory, &$objectArray) {

  foreach( array_keys($directory) as $item ):
    // If $item has children (i.e. is a directory), repeat the function on it
    if( $directory[$item]['children'] ):
      milo_modals($directory[$item]['children'], $objectArray);

    // If $item is a normal file, display the modal
    else:
      $description = '';
      $id = $directory[$item]['id'];
      $link = $directory[$item]['link'];
      $name = $directory[$item]['name'];
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

      // Retrieves the icon based on file extension
      $ext = end(explode('.', $name));
      if( in_array( $ext, $fileTypes['archive'] ) ):
        $file = 'file-archive';
      elseif( in_array( $ext, $fileTypes['audio'] ) ):
        $file = 'file-audio';
      elseif( in_array( $ext, $fileTypes['document'] ) ):
        $file = 'file-alt';
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

      // If there is a description, load it
      if( $objectArray[$id+1]['name'] == ($name . '.txt') ):
        $description = file_get_contents($objectArray[$id+1]['link']);
      endif;

      milo_download_modal( $id, $name, $size, $file, $link, $description );
    endif;
  endforeach;
}