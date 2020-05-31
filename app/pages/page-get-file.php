<?php
// This landing page template file is offered for reference purposes and is not necessarily functional without proper implementation

$support = new MILO_Support();

// First, validate the supplied bucket
$buckets = $support->get_buckets();
$bucket_query = $support->query['bucket'];

if( in_array( $bucket_query, $buckets ) ):

  // Next, validate the filename
  $files = $support->get_objects( $bucket_query );
  $file_query = $support->query['path'];
  if( in_array( $file_query, $files ) ):
    print_r( $support->get_file( $file_query, $bucket_query) );
  else:
    echo 'You must use a valid path';
  endif;
else:
  echo 'You must use a valid bucket name';
endif;