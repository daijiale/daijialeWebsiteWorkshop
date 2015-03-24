<?php

	global $blogo_options, $blogo_skin, $blogo_color, $blogo_style;
	
	$blogo_current_url = 'http://' . wp_filter_nohtml_kses(stripslashes_deep($_SERVER["HTTP_HOST"])) . wp_filter_nohtml_kses(stripslashes_deep($_SERVER["REQUEST_URI"])); 
	$bcu_arr = $blogo_current_url_exp = explode('?blogo_style=', $blogo_current_url);
	$blogo_current_url = $bcu_arr[0] . '?';
	
	if ( !empty( $blogo_options['logo_offset'] ) ) {
		$logo_offset = ' style="top:' . $blogo_options['logo_offset'] . 'px;"';
	} else {
		$logo_offset = '';
	}
	
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    
<head>
	
    <title>
		<?php

			global $page, $paged;

			wp_title( '|', true, 'right' );
			bloginfo( 'name' );
			$site_description = get_bloginfo( 'description' );

			if( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";

			if( $paged >= 2 || $page >= 2 )
				echo " | " . sprintf( __( 'Page %s', 'blogo' ), max( $paged, $page ) );

		?>
    </title>
	
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	
    <link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $blogo_options['favicon']; ?>" />
	
    <?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	
	<div id="languages"<?php if ( is_admin_bar_showing() ): ?> style="top: 53px;"<?php endif; ?>>
		<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'languages' ) ): ?>
		<?php do_action('icl_language_selector'); ?>
		<?php endif; ?>
	</div>
	
    <div id="header">
        <div class="wrapper">
			
            <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo( 'name' ) . " | " . $site_description; ?>" id="logo"<?php echo $logo_offset; ?>><img src="<?php echo $blogo_options['logo_image'] ?>" title="<?php echo get_bloginfo( 'name' ) . " | " . $site_description; ?>" alt="<?php echo get_bloginfo( 'name' ) . " | " . $site_description; ?>" /></a>
            
			<ul id="topIcons">
                <li class="rss"><a href="<?php bloginfo( 'rss_url' ); ?>" title="<?php _e('RSS Feed', 'blogo'); ?>"></a></li>
                <?php if ( !empty($blogo_options['social_flickr']) ) : ?><li class="flickr"><a href="<?php echo $blogo_options['social_flickr']; ?>" title="Flickr"></a></li><?php endif; ?>
                <?php if ( !empty($blogo_options['social_vimeo']) ) : ?><li class="vimeo"><a href="<?php echo $blogo_options['social_vimeo']; ?>" title="Vimeo"></a></li><?php endif; ?>
                <?php if ( !empty($blogo_options['social_twitter']) ) : ?><li class="twitter"><a href="<?php echo $blogo_options['social_twitter']; ?>" title="Twitter"></a></li><?php endif; ?>
                <?php if ( !empty($blogo_options['social_facebook']) ) : ?><li class="facebook"><a href="<?php echo $blogo_options['social_facebook']; ?>" title="Facebook"></a></li><?php endif; ?>
                <li class="home"><a href="<?php echo home_url(); ?>" title="<?php _e('Home', 'blogo'); ?>"></a></li>
            </ul>
			
            <?php 
				if ( has_nav_menu('main') ) {
					$args = array(
						'theme_location'  => 'main',
						'container'       => false,
						'menu_id'         => 'mainNav',
						'depth'			  => 2
					);
					wp_nav_menu( $args );
				} else {
					echo '<ul id="mainNav">' . wp_list_pages( 'title_li=&echo=0&depth=2' ) . '</ul>';
				}
			?>
			
			<?php if( is_home() ): ?>
            <div id="hpGraphic"></div>
			<?php elseif( is_archive() ): ?>
            <ul id="breadcrumbs">
                <li><a href="<?php echo get_home_url(); ?>"><?php _e('Home', 'blogo'); ?></a></li>
                <li class="current"><?php _e('Archive', 'blogo'); ?></li>
            </ul>
            <div id="innerGraphic"></div>
			<?php elseif( is_search() ): ?>
            <ul id="breadcrumbs">
                <li><a href="<?php echo get_home_url(); ?>"><?php _e('Home', 'blogo'); ?></a></li>
                <li class="current"><?php _e('Search results', 'blogo'); ?></li>
            </ul>
            <div id="innerGraphic"></div>
			<?php elseif( is_404() ): ?>
            <ul id="breadcrumbs">
                <li><a href="<?php echo get_home_url(); ?>"><?php _e('Home', 'blogo'); ?></a></li>
                <li class="current"><?php _e('Page not found', 'blogo'); ?></li>
            </ul>
            <div id="innerGraphic"></div>
			<?php else : ?>
            <ul id="breadcrumbs">
                <li><a href="<?php echo get_home_url(); ?>"><?php _e('Home', 'blogo'); ?></a></li>
                <li class="current"><?php the_title(); ?></li>
            </ul>
            <div id="innerGraphic"></div>
			<?php endif; ?>
			
        </div>
    </div>
	
	<?php if( is_home() ): ?>
	
	<?php
		$slider = new WP_Query('post_type=post&meta_key=blogo_meta_slider_promote&meta_value=on&posts_per_page=9');
		$i = 0;
	?>
	
    <div id="slider" class="wrapper">
		
        <ul class="slides">
			<?php while( $slider->have_posts() ) : $slider->the_post(); $i++; ?>
            <li id="slide<?php echo $i; ?>"<?php if($i==1) echo ' class="active"' ?>>
                <div class="slideContent">
                    <div class="date"><?php the_time('d F Y'); ?></div>
                    <div class="content">
                        <h2><a href="<?php the_permalink(); ?>" title="<?php _e('Read more', 'blogo'); ?>"><?php the_title(); ?></a></h2>
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="categories">
						<?php the_tags('', ', ', ''); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="readMore"><?php _e('Read more', 'blogo'); ?></a>
                </div>
                <div class="slideImg"><?php the_post_thumbnail('slider'); ?></div>
            </li>
			<?php endwhile; ?>
        </ul>
		
        <div class="topGraphic"></div>
        <div class="bottomGraphic"></div>
        <div class="cornerGraphic"></div>
		
        <ul class="controls">
			<?php for( $j = 1; $j <= $i; $j++ ) : ?>
            <li<?php if($j==1) echo ' class="active"' ?> title="<?php _e('View Slide', 'blogo'); ?> <?php echo $j; ?>" id="gotoSlide<?php echo $j; ?>"></li>
			<?php endfor; ?>
        </ul>
		
    </div>
	
	<?php endif; wp_reset_query(); ?>
	
    <div class="wrapper">