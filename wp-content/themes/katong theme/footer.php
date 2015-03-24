<?php global $blogo_options; ?>        

		<div class="clear"></div>
    </div>
	
    <div id="footer" class="wrapper">
		<ul class="col wide">
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer1' ) ) : ?>
			<li>
				<h2><?php _e('No widgets', 'blogo'); ?></h2>
				<p><?php _e('There are no active widgets in this area', 'blogo'); ?></p>
			</li>
			<?php endif; ?>
		</ul>
		<ul class="col narrow">
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer2' ) ) : ?>
			<li>
				<h2><?php _e('No widgets', 'blogo'); ?></h2>
				<p><?php _e('There are no active widgets in this area', 'blogo'); ?></p>
			</li>
			<?php endif; ?>
		</ul>
		<ul class="col narrow">
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer3' ) ) : ?>
			<li>
				<h2><?php _e('No widgets', 'blogo'); ?></h2>
				<p><?php _e('There are no active widgets in this area', 'blogo'); ?></p>
			</li>
			<?php endif; ?>
		</ul>
		<ul class="col wide">
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer4' ) ) : ?>
			<li>
				<h2><?php _e('No widgets', 'blogo'); ?></h2>
				<p><?php _e('There are no active widgets in this area', 'blogo'); ?></p>
			</li>
			<?php endif; ?>
		</ul>
        <li><a href="#" title="<?php _e('Go to the top of the page', 'blogo'); ?>" class="gotoTop"></a></li>
    </div>
	
    <div id="credits" class="wrapper">
        <div class="left"><?php echo $blogo_options['footer_left']; ?></div>
        <div class="right"><?php echo $blogo_options['footer_right']; ?></div>
        <div class="clear"></div>
    </div>
	
    <?php wp_footer(); ?>
	
</body>

</html>