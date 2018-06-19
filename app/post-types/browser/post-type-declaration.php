<?php
// Sets up ACF for the view
if ( ! function_exists('milo_browser_post_type') ):

  // Registers browser post type
  function milo_browser_post_type() {
    $labels = array(
      'name'                  => _x( 'AWS S3 Buckets', 'Post Type General Name', 'milo' ),
      'singular_name'         => _x( 'AWS S3 Bucket', 'Post Type Singular Name', 'milo' ),
      'menu_name'             => __( 'MILO Browsers', 'milo' ),
      'name_admin_bar'        => __( 'MILO Browser Buckets', 'milo' ),
      'archives'              => __( 'AWS S3 Bucket Archives', 'milo' ),
      'attributes'            => __( 'AWS S3 Bucket Attributes', 'milo' ),
      'parent_item_colon'     => __( 'Parent Bucket:', 'milo' ),
      'all_items'             => __( 'All Buckets', 'milo' ),
      'add_new_item'          => __( 'Add New Bucket', 'milo' ),
      'add_new'               => __( 'Add New', 'milo' ),
      'new_item'              => __( 'New Bucket', 'milo' ),
      'edit_item'             => __( 'Edit Bucket', 'milo' ),
      'update_item'           => __( 'Update Bucket', 'milo' ),
      'view_item'             => __( 'View Bucket', 'milo' ),
      'view_items'            => __( 'View Buckets', 'milo' ),
      'search_items'          => __( 'Search Bucket', 'milo' ),
      'not_found'             => __( 'Not found', 'milo' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'milo' ),
      'featured_image'        => __( 'Featured Image', 'milo' ),
      'set_featured_image'    => __( 'Set featured image', 'milo' ),
      'remove_featured_image' => __( 'Remove featured image', 'milo' ),
      'use_featured_image'    => __( 'Use as featured image', 'milo' ),
      'insert_into_item'      => __( 'Insert into bucket', 'milo' ),
      'uploaded_to_this_item' => __( 'Uploaded to this bucket', 'milo' ),
      'items_list'            => __( 'Buckets list', 'milo' ),
      'items_list_navigation' => __( 'Buckets list navigation', 'milo' ),
      'filter_items_list'     => __( 'Filter buckets list', 'milo' ),
    );
    $rewrite = array(
      'slug'                  => '/',
      'with_front'            => false,
      'pages'                 => false,
      'feeds'                 => false,
    );
    $capabilities = array(
      'edit_post'             => 'manage_options',
      'read_post'             => 'read_post',
      'delete_post'           => 'manage_options',
      'edit_posts'            => 'manage_options',
      'edit_others_posts'     => 'manage_options',
      'publish_posts'         => 'manage_options',
      'read_private_posts'    => 'read_private_posts',
    );
    $args = array(
      'label'                 => __( 'AWS S3 Bucket', 'milo' ),
      'description'           => __( 'AWS S3 Bucket', 'milo' ),
      'labels'                => $labels,
      'supports'              => array( 'title' ),
      'taxonomies'            => array('division'),
      'hierarchical'          => true,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'menu_icon'             => 'dashicons-admin-generic',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => false,
      'can_export'            => true,
      'has_archive'           => false,
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'rewrite'               => $rewrite,
      'capabilities'          => $capabilities,
      'show_in_rest'          => true,
    );
    register_post_type( 'milo_browser', $args );

  }
  add_action( 'init', 'milo_browser_post_type', 0 );

endif;

