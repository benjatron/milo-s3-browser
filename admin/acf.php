<?php
if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_5b198c618ede0',
    'title' => 'MILO S3 Browser - Dashboard Settings',
    'fields' => array(
      array(
        'key' => 'field_5b19a4e221e74',
        'label' => 'Welcome Page',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'left',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_5b198c7960ab7',
        'label' => 'Welcome Page',
        'name' => 'milos3_welcome_page',
        'type' => 'post_object',
        'instructions' => 'Please pick a page to act as the welcome page for this plugin. Your settings here will override some of the content on that page.',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '100',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'page',
        ),
        'taxonomy' => array(
        ),
        'allow_null' => 0,
        'multiple' => 0,
        'return_format' => 'object',
        'ui' => 1,
      ),
      array(
        'key' => 'field_5b19a67f977cc',
        'label' => 'Introductory Content',
        'name' => 'milos3_welcome_intro',
        'type' => 'wysiwyg',
        'instructions' => 'This content block appears above the blocks for each file bucket.',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 'Lorem ipsum dolor sit amet, consetetuer adispiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna sit ametaliquam erat volutpat consectetuer adipiscing elit.',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 0,
        'delay' => 0,
      ),
      array(
        'key' => 'field_5b19ae3a31be6',
        'label' => 'Browser Link Grid',
        'name' => 'milos3_welcome_grid',
        'type' => 'flexible_content',
        'instructions' => 'The grid of browsers to link to',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'layouts' => array(
          '5b19ae8c5577d' => array(
            'key' => '5b19ae8c5577d',
            'name' => 'full-width',
            'label' => 'Full-WIdth',
            'display' => 'block',
            'sub_fields' => array(
              array(
                'key' => 'field_5b19aeb231be7',
                'label' => 'Display Name',
                'name' => 'name',
                'type' => 'flexible_content',
                'instructions' => 'The name of the browser as it should appear on the welcome page',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '50',
                  'class' => '',
                  'id' => '',
                ),
                'layouts' => array(
                  '5b19af3440e8f' => array(
                    'key' => '5b19af3440e8f',
                    'name' => 'normal',
                    'label' => 'Normal Text',
                    'display' => 'row',
                    'sub_fields' => array(
                      array(
                        'key' => 'field_5b19af7f31be8',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => 'The text to display',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                          'width' => '',
                          'class' => '',
                          'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                      ),
                    ),
                    'min' => '',
                    'max' => '',
                  ),
                  '5b19afa331be9' => array(
                    'key' => '5b19afa331be9',
                    'name' => 'emphasized',
                    'label' => 'Emphasized Text',
                    'display' => 'row',
                    'sub_fields' => array(
                      array(
                        'key' => 'field_5b19afb131bea',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => 'The text to display with emphasized styling',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                          'width' => '',
                          'class' => '',
                          'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                      ),
                    ),
                    'min' => '',
                    'max' => '',
                  ),
                ),
                'button_label' => 'Add Row',
                'min' => '',
                'max' => '',
              ),
              array(
                'key' => 'field_5b19afe031beb',
                'label' => 'Linked Browser',
                'name' => 'browser',
                'type' => 'post_object',
                'instructions' => 'The browser object to link to',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '50',
                  'class' => '',
                  'id' => '',
                ),
                'post_type' => array(
                  0 => 'milos3_bucket',
                ),
                'taxonomy' => array(
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'return_format' => 'object',
                'ui' => 1,
              ),
              array(
                'key' => 'field_5b19b15a96028',
                'label' => 'Button Label',
                'name' => 'button',
                'type' => 'text',
                'instructions' => 'The text to show on the button link',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '100',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => 'Click to Access',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
              ),
            ),
            'min' => '',
            'max' => '',
          ),
          '5b19b02a31bec' => array(
            'key' => '5b19b02a31bec',
            'name' => 'two-up',
            'label' => 'Two-Up',
            'display' => 'block',
            'sub_fields' => array(
              array(
                'key' => 'field_5b19b02a31bed',
                'label' => 'Browser 01 - Display Name',
                'name' => 'name_01',
                'type' => 'flexible_content',
                'instructions' => 'The name of the browser as it should appear on the welcome page',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '50',
                  'class' => '',
                  'id' => '',
                ),
                'layouts' => array(
                  '5b19af3440e8f' => array(
                    'key' => '5b19af3440e8f',
                    'name' => 'normal',
                    'label' => 'Normal Text',
                    'display' => 'row',
                    'sub_fields' => array(
                      array(
                        'key' => 'field_5b19b02a31bee',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => 'The text to display',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                          'width' => '',
                          'class' => '',
                          'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                      ),
                    ),
                    'min' => '',
                    'max' => '',
                  ),
                  '5b19afa331be9' => array(
                    'key' => '5b19afa331be9',
                    'name' => 'emphasized',
                    'label' => 'Emphasized Text',
                    'display' => 'row',
                    'sub_fields' => array(
                      array(
                        'key' => 'field_5b19b02a31bef',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => 'The text to display with emphasized styling',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                          'width' => '',
                          'class' => '',
                          'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                      ),
                    ),
                    'min' => '',
                    'max' => '',
                  ),
                ),
                'button_label' => 'Add Row',
                'min' => '',
                'max' => '',
              ),
              array(
                'key' => 'field_5b19b07b31bf1',
                'label' => 'Browser 02 - Display Name',
                'name' => 'name_02',
                'type' => 'flexible_content',
                'instructions' => 'The name of the browser as it should appear on the welcome page',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '50',
                  'class' => '',
                  'id' => '',
                ),
                'layouts' => array(
                  '5b19af3440e8f' => array(
                    'key' => '5b19af3440e8f',
                    'name' => 'normal',
                    'label' => 'Normal Text',
                    'display' => 'row',
                    'sub_fields' => array(
                      array(
                        'key' => 'field_5b19b07b31bf2',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => 'The text to display',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                          'width' => '',
                          'class' => '',
                          'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                      ),
                    ),
                    'min' => '',
                    'max' => '',
                  ),
                  '5b19afa331be9' => array(
                    'key' => '5b19afa331be9',
                    'name' => 'emphasized',
                    'label' => 'Emphasized Text',
                    'display' => 'row',
                    'sub_fields' => array(
                      array(
                        'key' => 'field_5b19b07b31bf3',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => 'The text to display with emphasized styling',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                          'width' => '',
                          'class' => '',
                          'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                      ),
                    ),
                    'min' => '',
                    'max' => '',
                  ),
                ),
                'button_label' => 'Add Row',
                'min' => '',
                'max' => '',
              ),
              array(
                'key' => 'field_5b19b02a31bf0',
                'label' => 'Browser 01 - Linked Browser',
                'name' => 'browser_01',
                'type' => 'post_object',
                'instructions' => 'The browser object to link to',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '50',
                  'class' => '',
                  'id' => '',
                ),
                'post_type' => array(
                  0 => 'milos3_bucket',
                ),
                'taxonomy' => array(
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'return_format' => 'object',
                'ui' => 1,
              ),
              array(
                'key' => 'field_5b19b0ed31bf4',
                'label' => 'Browser 02 - Linked Browser',
                'name' => 'browser_02',
                'type' => 'post_object',
                'instructions' => 'The browser object to link to',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '50',
                  'class' => '',
                  'id' => '',
                ),
                'post_type' => array(
                  0 => 'milos3_bucket',
                ),
                'taxonomy' => array(
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'return_format' => 'object',
                'ui' => 1,
              ),
              array(
                'key' => 'field_5b19b19396029',
                'label' => 'Browser 01 - Button Label',
                'name' => 'button_01',
                'type' => 'text',
                'instructions' => 'The text to show on the button link',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '50',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => 'Click to Access',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
              ),
              array(
                'key' => 'field_5b19b1b89602a',
                'label' => 'Browser 02- Button Label',
                'name' => 'button_02',
                'type' => 'text',
                'instructions' => 'The text to show on the button link',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '50',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => 'Click to Access',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
              ),
            ),
            'min' => '',
            'max' => '',
          ),
        ),
        'button_label' => 'Add Row',
        'min' => '',
        'max' => '',
      ),
      array(
        'key' => 'field_5b19b24cdd25a',
        'label' => 'Lower Content',
        'name' => 'milos3_welcome_lower',
        'type' => 'wysiwyg',
        'instructions' => 'This content block appears below the blocks for each file bucket.',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 'DISCLAIMER: Lorem ipsum dolor sit amet, consectetur adipiscing elit. At enim hic etiam dolore. Duo Reges: constructio interrete. Cupiditates non Epicuri divisione finiebat, sed sua satietate. Sed erat aequius Triarium aliquid de dissensione nostra iudicare.',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 0,
        'delay' => 0,
      ),
      array(
        'key' => 'field_5b19a51b21e75',
        'label' => 'Sidebar Options',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'left',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_5b19b2ec8e620',
        'label' => 'Internet Explorer Instructions',
        'name' => 'milos3_sidebar_explorer',
        'type' => 'file',
        'instructions' => 'Instructions for downloading in Internet Explorer',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'array',
        'library' => 'all',
        'min_size' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      array(
        'key' => 'field_5b19b3648e621',
        'label' => 'Support Guides',
        'name' => 'milos3_sidebar_guides',
        'type' => 'repeater',
        'instructions' => 'Additional manuals available for download',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => '',
        'min' => 0,
        'max' => 0,
        'layout' => 'row',
        'button_label' => 'Add Manual',
        'sub_fields' => array(
          array(
            'key' => 'field_5b19b3aa8e622',
            'label' => 'Download Label',
            'name' => 'label',
            'type' => 'text',
            'instructions' => 'The text to show on the download link',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => 'Download This Manual or Guide',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
          array(
            'key' => 'field_5b19b3f38e623',
            'label' => 'Download File',
            'name' => 'file',
            'type' => 'file',
            'instructions' => 'The file to bind the download to',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'array',
            'library' => 'all',
            'min_size' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
        ),
      ),
      array(
        'key' => 'field_5b19b433eae98',
        'label' => 'Contact Email',
        'name' => 'milos3_sidebar_email',
        'type' => 'email',
        'instructions' => 'The email address to use for email communication',
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
      ),
      array(
        'key' => 'field_5b19b462eae99',
        'label' => 'Contact Phone Number',
        'name' => 'milos3_sidebar_phone',
        'type' => 'text',
        'instructions' => 'The number to use for telephonic communication',
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
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'acf-options-dashboard-settings',
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

  acf_add_local_field_group(array(
    'key' => 'group_5b19b4d370213',
    'title' => 'MILO S3 Browser - S3 Bucket',
    'fields' => array(
      array(
        'key' => 'field_5b19b520d154c',
        'label' => 'S3 Bucket Name',
        'name' => 'milos3_bucket_name',
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
        'name' => 'milos3_bucket_preview',
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
        'name' => 'milos3_bucket_disclaimer',
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
          'value' => 'milos3_bucket',
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