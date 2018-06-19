<?php
if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_5b19b4d370213',
    'title' => 'MILO S3 Browser - S3 Bucket',
    'fields' => array(
      array(
        'key' => 'field_5b19b520d154c',
        'label' => 'S3 Bucket Name',
        'name' => 'milo_bucket_name',
        'type' => 'text',
        'instructions' => 'The name of the bucket to include on this page',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      array(
        'key' => 'field_5b19b6b5d154e',
        'label' => 'Preview Image',
        'name' => 'milo_bucket_preview',
        'type' => 'image',
        'instructions' => 'The background image to use for previews or links to this bucket',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'array',
        'preview_size' => 'w360',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_5b19b7431f1a5',
        'label' => 'Disclaimer Block',
        'name' => 'milo_bucket_disclaimer',
        'type' => 'wysiwyg',
        'instructions' => 'Disclaimer text to appear below the browser',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 'DISCLAIMER: Lorem ipsum dolor sit amet, consectetur adipiscing elit. At enim hic etiam dolore. Duo Reges: constructio interrete. Cupiditates non Epicuri divisione finiebat, sed sua satietate. Sed erat aequius Triarium aliquid de dissensione nostra iudicare. An vero, inquit, quisquam potest probare, quod perceptfum.',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 0,
        'delay' => 0,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'milo_browser',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
  ));

endif;

/**
 *  Sets the parent page for the post type
 */

// Adds the meta box to browser posts
function milo_browser_post_init() {
  add_meta_box(
    'milo_browser_parent_id',
    'Parent Page',
    'milo_set_browser_parent_id',
    'milo_browser',
    'side',
    'low'
  );
}
add_action( 'admin_init', 'milo_browser_post_init' );

// Adds content to the meta box
function milo_set_browser_parent_id() {
  global $post;
  $parent = get_field('milo_welcome_page', 'milo_browser');
  ?>
  <p>
    All posts created for this plugin will have the following parent page:<br/>
    <ul>
      <li><strong>Title:</strong> <?php echo $parent->post_title; ?></li>
      <li><strong>ID:</strong> <?php echo $parent->ID; ?></li>
      <li><strong>Link:</strong> <a href="<?php echo get_edit_post_link($parent->ID); ?>" target="_blank"><?php echo get_edit_post_link($parent->ID); ?></a></li>
    </ul>
  </p>
  <input type="hidden" id="parent_id" name="parent_id" value="<?php echo $parent->ID; ?>" />
  <input type="hidden" name="parent_id_noncename" value="<?php echo wp_create_nonce(__FILE__); ?>" />
  <?php
}

// Saves the meta data
function milo_save_browser_parent_id() {
  global $post;

  // Make sure data came from the meta box
  if( !wp_verify_nonce( $_POST['parent_id_noncename'], __FILE__ ) ):
    return $post_id;
  endif;

  // If 'parent_id' is set and the post type is correct, save the data
  if(
    isset( $_POST['parent_id'] ) &&
    ( $_POST['post_type'] == 'milo_browser' )
  ):
    $data = $_POST['parent_id'];
    update_post_meta( $post_id, 'parent_id', $data );
  endif;
}
add_action( 'save_post', 'milo_save_browser_parent_id' );