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

  // An array of the page slugs for landing pages
  $slugs = array(
    'milo-content',
    'milo-software',
    'milo-videos'
  );
  // Add these pages to an array
  $pages = array();
  foreach ( $slugs as $page ):
    $pages[] = get_page_by_path($page)->ID;
  endforeach;

  $pageGroup = array_merge( $dashboards, $browsers, $pages );
  return $pageGroup;
}