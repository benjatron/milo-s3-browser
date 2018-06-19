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