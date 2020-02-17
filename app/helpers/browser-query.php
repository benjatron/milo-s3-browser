<?php
function milo_browser_pages() {
  $browsers = get_posts( array(
    'post_type' => 'page',
    'fields' => 'ids',
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-templates/support-browser.php'
  ) );
  $dashboards = get_posts( array(
    'post_type' => 'page',
    'fields' => 'ids',
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-templates/support-dashboard.php'
  ) );
  $downloads = get_posts( array(
    'post_type' => 'page',
    'fields' => 'ids',
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-templates/support-download.php'
  ) );

  $pageGroup = array_merge( $browsers, $dashboards, $downloads );
  return $pageGroup;
}