<?php
function milo_browser_pages() {
  $dashboards = get_posts( array(
    'post_type' => 'page',
    'fields' => 'ids',
    'meta_key' => '_wp_page_template',
    'meta_value' => 'template-browser-dashboard.php'
  ) );
  $browsers = get_posts( array(
    'post_type' => 'page',
    'fields' => 'ids',
    'meta_key' => '_wp_page_template',
    'meta_value' => 'template-browser-page.php'
  ) );
  $pageGroup = array_merge( $dashboards, $browsers );
  return $pageGroup;
}