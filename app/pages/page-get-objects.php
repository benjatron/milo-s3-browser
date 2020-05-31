<?php
// This landing page template file is offered for reference purposes and is not necessarily functional without proper implementation

$support = new MILO_Support();

$bucket_query = $support->query['bucket'];
$buckets = $support->get_buckets();

// Only dumps on valid queries
if( in_array( $bucket_query, $buckets ) ):
  $objects = $support->get_objects( $bucket_query );
  print_r( $objects );
else:
  echo 'You must use a valid bucket name';
endif;