<?php
// Returns the file that is the newest, given the same folder
function milo_get_latest( $needle, $haystack) {

  // Splits the file into a prefix, short name, version, and file type
  function milo_file_parser( $file ) {
    // If the file is in a folder, separate that out
    $prefixParts = array();
    if( strpos($file, '/') !== false ):
      $result = array();
      $prefixParts = explode( '/', $file);

      for( $i=0; $i<(count($prefixParts)-1); $i++ ):
        $prefix .= $prefixParts[$i] . '/';
      endfor;
      $result = $prefixParts[count($prefixParts)-1];
    else:
      $prefix = '';
      $result = $file;
    endif;


    // If the name contains a space, splits it
    // into the name and version/file type
    $name = '';
    $version = '';
    $type = '';
    if( strpos( $result, ' ' ) !== false ):
      $nameParts = explode( ' ', $result );
      for( $i=0; $i<(count($nameParts)-1); $i++ ):
        $name .= $nameParts[$i] . ' ';
      endfor;
      $name = trim($name);
      $version = explode( '.', $nameParts[count($nameParts)-1] )[0];
      $type = explode( '.', $nameParts[count($nameParts)-1] )[1];
    else:
      $name = explode( '.', $result)[0];
      $type = explode( '.', $result)[1];
    endif;
    return array(
      'prefix' => $prefix,
      'short_name' => $name,
      'version' => $version,
      'type' => $type
    );
  }
  $startingFile = milo_file_parser( $needle );

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
  $similarFiles = milo_find_similarFiles($startingFile, $haystack);

  // Expands an array of files
  function milo_expandSimilars( $array ) {
    $reults = array();
    for( $i=0; $i<count($array); $i++ ):
    $results[] = array_merge( $array[$i], milo_file_parser($file['path']));
    endfor;
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