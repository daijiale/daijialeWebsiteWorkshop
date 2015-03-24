<?php get_header(); ?>

<div id="content">
	
	<?php if (have_posts()) : the_post(); ?>
	
		<div class="post">
			
			<div class="content full">
				<h1><?php the_title(); ?></h1>
				<div class="postImage"><?php the_post_thumbnail('medium'); ?></div>
				<?php the_content(); wp_link_pages(); ?>
			</div>
			
			<div class="clear"></div>
			
		</div>
	
		<?php comments_template( '', true ); ?>
	
	<?php endif; ?>
	
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>