<?php
// This landing page template file is offered for reference purposes and is not necessarily functional without proper implementation

$support = new MILO_Support();

$buckets = $support->get_buckets();

print_r( $buckets );