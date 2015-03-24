<?php get_header(); ?>

<div id="content">
	
	<?php if (have_posts()) : the_post(); ?>
	
		<div <?php post_class(); ?>>
			
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