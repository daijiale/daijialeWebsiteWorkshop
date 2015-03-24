<div id="sidebar">
    <?php get_search_form(); ?>
	<ul>
    <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'main_dark' ) ) : ?>
    
    <?php endif; ?>
    <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'main_light' ) ) : ?>
    
    <?php endif; ?>
	</ul>
</div>