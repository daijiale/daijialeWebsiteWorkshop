<?php get_header(); ?>
<div id="bg">
	
	<?php get_template_part('mobile-menu') ?>
	<div id="top_bg"></div>
	<div id="holder">
		<?php get_template_part('aside'); ?>
		<div id="content">    
			<div class="article_box p">
				<div class="article_t"></div>
				<div class="article b">
					<h1 class="entry-title _cf">
						<?php if( is_category() ):
							echo __( 'Category archive: ', LANGUAGE_ZONE ).single_cat_title( null, false );
						elseif( is_tag() ):
							echo __( 'Tag archive: ', LANGUAGE_ZONE ).single_tag_title( null, false );
						elseif( is_author() ):
							$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
							echo __( 'Author archive: ', LANGUAGE_ZONE ).$curauth->nickname;
						elseif( is_date() ):
							_e( 'Date archive: ', LANGUAGE_ZONE );
							single_month_title( ' ', true );
						else:
							echo __( 'Archive: ', LANGUAGE_ZONE ).get_post_format_string(get_post_format());
						endif ?>
					</h1>
					<?php if( have_posts() ): ?>
						<?php
						global $dt_post_first;
						$dt_post_first = true;
						?>
						<?php while( have_posts() ): the_post(); ?>
							<?php get_template_part('content', get_post_format()); ?>
						<?php endwhile ?>
						 <div id="nav-above" class="navigation blog">
							<?php 
						    if( function_exists('wp_pagenavi') ) {
								wp_pagenavi( '', '', 'paginator-small');
							}else {
								wp_link_pages();
							}
							?>
						</div>
					<?php else:?>
					<?php endif ?>
				</div><!-- .article b end -->
				<div class="article_b"></div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>