<?php

    /////////////////////////////////////
    //      Includes         
    /////////////////////////////////////

    load_template( get_template_directory() . '/inc/theme-options.php' );
    load_template( get_template_directory() . '/inc/shortcodes.php' );
	load_template( get_template_directory() . '/option-tree/ot-loader.php' );
	
    /////////////////////////////////////
    //      Theme Options         
    /////////////////////////////////////
		
	add_filter( 'ot_theme_mode', '__return_true' );
	add_filter( 'ot_show_pages', '__return_false' );
	add_filter( 'ot_show_new_layout', '__return_false' );
	
	function blogo_theme_options() {
		
		global $blogo_options, $blogo_color, $blogo_style, $blogo_skin;

		if ( function_exists( 'ot_get_option' ) ) {
			$blogo_options = get_option( 'option_tree' );
		}
		
		if ( empty($blogo_options['theme_style']) ) {
			$blogo_options['theme_style'] = "boy";
		}
		if ( empty($blogo_options['theme_color']) ) {
			$blogo_options['theme_color'] = "grey-blue";
		}
		
		$blogo_color = $blogo_options['theme_color'];
		$blogo_style = $blogo_options['theme_style'];
		$blogo_skin = get_template_directory_uri() . "/skin/$blogo_style/$blogo_color";

		if ( empty($blogo_options['logo_image']) ) {
			$blogo_options['logo_image'] = $blogo_skin . "/images/logo.png";
		}
		if ( empty($blogo_options['favicon']) ) {
			$blogo_options['favicon'] = $blogo_skin . "/images/favicon.ico";
		}
		
	}
	
    /////////////////////////////////////
    //      After Setup Theme       
    /////////////////////////////////////
	
	add_action( 'after_setup_theme', 'blogo_after_setup' );
	
	function blogo_after_setup() {
		
		load_theme_textdomain( 'blogo', get_template_directory() . '/lang' );
		
		blogo_theme_options();
		
	}
	
    /////////////////////////////////////
    //      Enqueue Scripts & Styles           
    /////////////////////////////////////

	function blogo_scripts() {
		
		global $blogo_skin, $is_IE;
		
		wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ) );
		wp_enqueue_script( 'slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ) );
		if( $is_IE ) {
			wp_enqueue_script( 'placeholder', $blogo_skin . '/js/placeholder.js' );
		}
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		wp_enqueue_style( 'main', get_stylesheet_uri() );
		wp_enqueue_style( 'skin', $blogo_skin . '/css/style.css' );
		
	}
	add_action( 'wp_enqueue_scripts', 'blogo_scripts' );
		
	/////////////////////////////////////
	//      Content Width      
	/////////////////////////////////////
	
	if ( !isset( $content_width ) ) {
		$content_width = 635;
	}
		
	/////////////////////////////////////
	//      Excerpt Length      
	/////////////////////////////////////

	function blogo_excerpt_length( $length ) {
		return 45;
	}
	add_filter( 'excerpt_length', 'blogo_excerpt_length', 999 );
		
	/////////////////////////////////////
	//      Register Menus       
	/////////////////////////////////////

	register_nav_menu( 'main', 'Main Navigation' );

	/////////////////////////////////////
	//      Register Sidebars       
	/////////////////////////////////////

	function widget_params( $params ) { // Add "recurrent numbered" CSS classes to dynamic sidebar after widgets adapted from a code by @MathSmath
		
		global $my_widget_num; // Global a counter array
		
		$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
		$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets 

		if( !$my_widget_num ) { // If the counter array doesn't exist, create it
			$my_widget_num = array();
		}

		if( !isset( $arr_registered_widgets[$this_id] ) || !is_array( $arr_registered_widgets[$this_id] ) ) { // Check if the current sidebar has no widgets
			return $params; // No widgets in this sidebar... bail early.
		}

		if( isset( $my_widget_num[$this_id] ) ) { // See if the counter array has an entry for this sidebar
			$my_widget_num[$this_id] ++;
		} else { // If not, create it starting with 1
			$my_widget_num[$this_id] = 1;
		}

		$class = 'widget widget-' . $my_widget_num[$this_id] . ' widget-' . $params[0]['widget_id'];
		$separator_class = 'class="separator' . (($my_widget_num[$this_id]%2)?$my_widget_num[$this_id]%2:2) . ' ';
		
		switch ( $params[0]['id'] ) {
			case 'main_dark':
				$class .= ' dark';
				break;
			case 'main_light':
				$class .= ' light';
				break;
		}
		
		if ( !empty($my_widget_num['main_light']) && $my_widget_num['main_light'] == 1 ) {
			$class .= ' firstLight';
		}

		if ( $params[0]['id'] == 'main_dark' ) {
			if ( $my_widget_num[$this_id] == count($arr_registered_widgets[$this_id]) ) {
				if ( !$arr_registered_widgets['main_light'] ) {
					$class .= ' last_dark';
					$params[0]['after_widget'] = '</li>';
				} else {
					$params[0]['after_widget'] = '</li><li class="separator3"></li>';
				}
			} else {
				$params[0]['after_widget'] = '</li><li ' . $separator_class . '"></li>';
			}
		} else {
			$params[0]['after_widget'] = '</li>';
		}
		
		$params[0]['before_widget'] = '<li class="' . $class . '">';

		return $params;

	}
	add_filter( 'dynamic_sidebar_params', 'widget_params' );

	register_sidebar( array(
		'name'          => 'Main Sidebar (Dark Widgets)',
		'id'			=> 'main_dark'
	));

	register_sidebar( array(
		'name'          => 'Main Sidebar (Light Widgets)',
		'id'			=> 'main_light'
	));

	register_sidebar( array(
		'name'          => 'Footer Column 1',
		'id'			=> 'footer1'
	));

	register_sidebar( array(
		'name'          => 'Footer Column 2',
		'id'			=> 'footer2'
	));

	register_sidebar( array(
		'name'          => 'Footer Column 3',
		'id'			=> 'footer3'
	));

	register_sidebar( array(
		'name'          => 'Footer Column 4',
		'id'			=> 'footer4'
	));

	register_sidebar( array(
		'name'          => 'Languages',
		'id'			=> 'languages'
	));

	/////////////////////////////////////
	//      Media Sizes       
	/////////////////////////////////////

	add_theme_support( 'post-thumbnails' );
	update_option( 'thumbnail_size_w', 46 );
	update_option( 'thumbnail_size_h', 46 );
	update_option( 'thumbnail_crop', 1 );
	update_option( 'medium_size_w', 498 );
	update_option( 'medium_size_h', 295 );
	update_option( 'medium_crop', 1 );
	update_option( 'large_size_w', 621 );
	update_option( 'large_size_h', 309 );
	update_option( 'large_crop', 1 );
	add_image_size('slider', 979, 315, 1);

	/////////////////////////////////////
	//      Custom Fields   
	/////////////////////////////////////

	add_action( 'add_meta_boxes', 'blogo_meta_slider' );
	add_action( 'save_post', 'blogo_meta_slider_save' );

	function blogo_meta_slider() {
		add_meta_box( 'blogo_slider', __('Promote to Slider', 'blogo'), 'blogo_meta_slider_init', 'post' );
	}

	function blogo_meta_slider_init() {

		global $post;

		$blogo_meta_values = get_post_custom( $post->ID );
		$blogo_meta_checked = isset( $blogo_meta_values['blogo_meta_slider_promote'][0] ) ? esc_attr( $blogo_meta_values['blogo_meta_slider_promote'][0] ) : '';

		wp_nonce_field( 'blogo_meta_slider_nonce', 'meta_box_nonce' );

		?>
			<p>
				<input type="checkbox" id="blogo_meta_slider_promote" name="blogo_meta_slider_promote" <?php checked( $blogo_meta_checked, 'on' ); ?> />
				<label for="blogo_meta_slider_promote">&nbsp;<?php _e('Promote to Slider', 'blogo'); ?></label>
			</p>
		<?php

		function my_admin_scripts() {
			wp_enqueue_script('thickbox');
		}
		function my_admin_styles() {
			wp_enqueue_style('thickbox');
		}

		add_action('admin_print_scripts', 'my_admin_scripts');
		add_action('admin_print_styles', 'my_admin_styles');

		do_action('admin_print_scripts');
		do_action('admin_print_styles');

	}

	function blogo_meta_slider_save($post_id) {
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'blogo_meta_slider_nonce' ) ) return;
		if( !current_user_can( 'edit_post', $post_id ) ) return;
		update_post_meta( $post_id, 'blogo_meta_slider_promote', $_POST['blogo_meta_slider_promote'] ? 'on' : 'off' );
	}
	
	/////////////////////////////////////
	//      Comment Template 
	/////////////////////////////////////
	
	function blogo_comments($comment, $args, $depth) {
		
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
?>
		<li id="comment-<?php comment_ID() ?>"<?php if ( $args['has_children'] ): ?> class="parent"<?php endif; ?>>
			
			<?php if ( $GLOBALS['comment']->comment_parent == 0 ): ?>
			<a href="<?php echo get_comment_author_url(); ?>"><?php echo get_avatar( $comment, 90 ); ?></a>
			<?php else: ?>
			<a href="<?php echo get_comment_author_url(); ?>"><?php echo get_avatar( $comment, 50 ); ?></a>
			<?php endif; ?>
			
			<div id="comment-<?php comment_ID() ?>" class="comment">
				
				<h3 class="comment-author vcard"><?php echo get_comment_author_link(); ?></h3>
				
				<?php if ($comment->comment_approved == '0') : ?>
				<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'blogo'); ?></em>
				<?php endif; ?>

				<em class="meta"><?php printf( '%1$s at %2$s', get_comment_date(),  get_comment_time()) ?><?php edit_comment_link('Edit','  ','' ); ?></em>
				
				<div class="content"><?php echo get_comment_text(); ?></div>
				
				<?php if ( $args['has_children'] ): ?>
				<div class="sub"></div>
				<?php endif; ?>

				<div class="reply"><?php if( empty($add_below) ) $add_below = ''; comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
				
				<div class="arrow"></div>
			
			</div>
			
			<div class="clear"></div>
<?php
	}
	
	/////////////////////////////////////
	//      Default Avatar
	/////////////////////////////////////
	
	add_filter( 'avatar_defaults', 'blogo_default_avatar' );

	function blogo_default_avatar ( $avatar_defaults ) {
		
		global $blogo_skin;
		
		$avatar = get_option('avatar_default');
		$new_avatar_url = $blogo_skin . '/images/default_avatar.png';
		$avatar_defaults[$new_avatar_url] = 'Blogo Default Avatar';
		if( $avatar != $new_avatar_url ) {
			update_option( 'avatar_default', $new_avatar_url );
		}
		
		return $avatar_defaults;
		
	}
    
	/////////////////////////////////////
	//      Misc Theme Support     
	/////////////////////////////////////
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	
?>