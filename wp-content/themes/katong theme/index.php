<?php get_header(); ?>

<div id="content">
	
	<?php if (have_posts()) : ?>
	<ul class="posts">
		<?php while (have_posts()) : the_post(); ?>
		<li <?php post_class( array('post') ); ?>>
			
			<ul class="meta">
				<li class="date">
					<div class="day"><?php the_time('d') ?></div>
					<div class="month"><?php the_time('M') ?></div>
					<div class="year"><?php the_time('Y') ?></div>
				</li>
				<li class="author">
					<div class="label"><?php _e('Posted by', 'blogo'); ?></div>
					<?php the_author_posts_link(); ?>
				</li>
				<li class="categories">
					<div class="label"><?php _e('Posted in', 'blogo'); ?></div>
					<?php the_category(', ') ?>
				</li>
				<li class="comments<?php if ( !has_tag() ): ?> noborder<?php endif; ?>">
					<div class="label"><?php _e('Discussion', 'blogo'); ?></div>
					<?php comments_popup_link(); ?>
				</li>
				<?php if ( has_tag() ): ?>
				<li class="tags last">
					<div class="label"><?php _e('Tags', 'blogo'); ?></div>
					<?php the_tags('', ', ', ''); ?>
				</li>
				<?php endif; ?>
				<div class="socialButtons">
					<div class="like"><iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=300&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=232334746811154" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:21px;" allowTransparency="true"></iframe></div>
					<div class="tweets">
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>">Tweet</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
				</div>
				<li class="bgTop"></li>
				<li class="bgBottom"></li>
			</ul>
			
			<div class="content">
				<h2><a href="<?php the_permalink(); ?>" title="<?php _e('Read the full post', 'blogo'); ?>"><?php the_title(); ?></a></h2>
				<a href="<?php the_permalink(); ?>" title="<?php _e('Read the full post', 'blogo'); ?>" class="postImage"><?php the_post_thumbnail('medium'); ?></a>
				<?php the_excerpt(); ?>
			</div>
			
			<a href="<?php the_permalink(); ?>" title="<?php _e('Read the full post', 'blogo'); ?>" class="readMore"><?php _e('Read more', 'blogo'); ?></a>
			
			<div class="clear"></div>
			
		</li>
		<?php endwhile; ?>
	</ul>
	<?php endif; ?>
	
	<?php 
		$prev_link = get_previous_posts_link();
		$next_link = get_next_posts_link();
		if ( $prev_link || $next_link ) :
	?>
	<div class="pagination">
			
		<?php
		
			add_filter( 'next_posts_link_attributes', 'sdac_next_posts_link_attributes' );
			function sdac_next_posts_link_attributes() {
				return 'class="next"';
			}
			
			add_filter( 'previous_posts_link_attributes', 'sdac_previous_posts_link_attributes' );
			function sdac_previous_posts_link_attributes() {
				return 'class="prev"';
			}
			
			posts_nav_link(" ", "Previous Page", "Next Page");
			
		?>
	
		<div class="graphicLeft"></div>
		<div class="graphicRight"></div>
		
	</div>
	<?php endif; ?>
	
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>