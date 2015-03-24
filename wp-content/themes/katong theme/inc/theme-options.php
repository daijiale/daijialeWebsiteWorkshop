<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'General Options'
      ),
      array(
        'id'          => 'social',
        'title'       => 'Social Links'
      ),
      array(
        'id'          => 'footer',
        'title'       => 'Footer / Credits'
      )
    ),
    'settings'        => array( 
	  array(
        'id'          => 'theme_style',
        'label'       => 'Theme Style',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'boy',
            'label'       => 'Boy',
            'src'         => ''
          ),
          array(
            'value'       => 'girl',
            'label'       => 'Girl',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'theme_color',
        'label'       => 'Theme Color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'blue',
            'label'       => 'Blue',
            'src'         => ''
          ),
          array(
            'value'       => 'dark',
            'label'       => 'Dark (Purple)',
            'src'         => ''
          ),
          array(
            'value'       => 'green',
            'label'       => 'Green',
            'src'         => ''
          ),
          array(
            'value'       => 'grey-blue',
            'label'       => 'Grey-Blue',
            'src'         => ''
          ),
          array(
            'value'       => 'grey-light',
            'label'       => 'Grey-Light',
            'src'         => ''
          ),
          array(
            'value'       => 'yellow',
            'label'       => 'Yellow',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'logo_image',
        'label'       => 'Logo Image',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'logo_offset',
        'label'       => 'Logo Offset (Top)',
        'desc'        => '',
        'std'         => '55',
        'type'        => 'numeric-slider',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'favicon',
        'label'       => 'Favicon',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_facebook',
        'label'       => 'Facebook',
        'desc'        => 'Please, enter the full URL to your facebook page/account/group.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_twitter',
        'label'       => 'Twiiter',
        'desc'        => 'Please, enter the full URL to your twitter page.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_vimeo',
        'label'       => 'Vimeo',
        'desc'        => 'Please, enter the full URL to your vimeo channel.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_flickr',
        'label'       => 'Flickr',
        'desc'        => 'Please, enter the full URL to your flickr page.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_left',
        'label'       => 'Left Column Text',
        'desc'        => '',
        'std'         => '© 2013 <strong>Blogo</strong>. All rights reserved.',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_right',
        'label'       => 'Right Column Text',
        'desc'        => '',
        'std'         => 'Powered by <a href="http://dodoweb.eu/" title="Web design by DodoWeb" class="dodoweb"></a>',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}