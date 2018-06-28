<?php
// Returns the file that is the newest, given the same folder
// Finds the file within the object array
function milo_get_latest( $needle, $haystack) {

  function milo_objectArray_search( $needle, $haystack, $key ){
    for( $i=0; $i<count($haystack); $i++ ):
      if( $needle == $haystack[$i][$key] ):
        return $haystack[$i];
      endif;
    endfor;
  }
  $file = milo_objectArray_search($needle, $haystack, 'path');

  // Assigns a filename to a file, version, and file type from an array
  function milo_fileNameSplit($array) {
    $fileParts = explode( ' ', $array['name'] );

    // Merge all but last values into the file name
    $file = '';
    if( strpos($array['name'], ' ') !== false ):
      for( $i=0; $i<(count($fileParts)-1); $i++ ):
        $file .= $fileParts[$i] . ' ';
      endfor;
    else:
      $file = $array['name'];
    endif;
    $array['short_name'] = $file;

    // Assigns version and file type
    $parts = explode( '.', $fileParts[(count($fileParts)-1)] );
    $array['version'] = $parts[0];
    $array['type'] = $parts[1];
    return $array;
  }
  $expandedFile = milo_fileNameSplit($file);

  // Finds all files with the same prefix and short_name in an array
  function milo_find_similarFiles( $file, $haystack ) {
    // Set the attributes to check against
    $prefix = $file['prefix'];
    $short_name = $file['short_name'];

    // Create our resulting array
    $results = array();

    // If the array contains a file with the right prefix and
    // the name contains the contents of short_name, add it to our array
    for( $i=0; $i<count($haystack); $i++ ):
      if(
        ($haystack[$i]['prefix'] == $prefix) &&
        (strpos( $haystack[$i]['name'], $short_name) !== false )
      ):
        $results[] = $haystack[$i];
      endif;
    endfor;

    return $results;
  }
  $similarFiles = milo_find_similarFiles($expandedFile, $haystack);

  // Expands an array of files
  function milo_expandSimilars( $array ) {
    $results = array();
    foreach($array as $file ):
      $results[] = milo_filenameSplit($file);
    endforeach;
    return $results;
  }
  $expandedSimilars = milo_expandSimilars($similarFiles);

  // Finds the file with the highest version number in the array
  function milo_get_highest_version( $array ) {

    // Finds the highest version
    $versions = array();
    foreach( $array as $file ):
      $versions[] = $file['version'];
    endforeach;
    $highest = max($versions);

    // Finds the item with that highest version
    foreach( $array as $file ):
      if( $file['version'] == $highest ):
        $result = $file;
      endif;
    endforeach;

    return $result;
  }
  $newestVersion = milo_get_highest_version( $expandedSimilars );
  return $newestVersion;
}