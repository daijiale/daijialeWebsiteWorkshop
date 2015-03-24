<?php if ( post_password_required() ) return; ?>

<?php if ( have_comments() ) : ?>
<div class="postComments">
	
	<h2><?php printf( _n( '<span>1</span> Comment on this post', '<span>%1$s</span> Comments on this post', get_comments_number(), 'blogo' ), number_format_i18n( get_comments_number() ) ); ?></h2>
	
	<ul class="commentlist" id="comments">
		<?php wp_list_comments('max_depth=2&callback=blogo_comments'); ?>
	</ul>
	
	<?php if ( get_option( 'page_comments' ) && ( get_option( 'comments_per_page' ) < get_comments_number() ) ): ?>
	<div class="pagination">
		<?php paginate_comments_links(); ?>
	</div>
	<?php endif; ?>
	
</div>
<?php endif; ?>

<div class="submitComment" id="respond">
	<?php

		$fields =  array(
			'author' => '<div class="left"><input type="text" name="author" placeholder="' . __('Name', 'blogo') . '" />',
			'email' => '<input type="text" name="email" placeholder="' . __('E-mail', 'blogo') . '" />',
			'url' => '<input type="text" name="url" placeholder="' . __('Website', 'blogo') . '" /></div>'
		);
		
		if ( is_user_logged_in() ) {
			$comment_field = '<div class="right logged_in"><textarea name="comment" placeholder="' . __('Leave a comment...', 'blogo') . '"></textarea><input type="submit" value="' . __('Submit Comment', 'blogo') . '" />' . get_cancel_comment_reply_link( __('Cancel Reply', 'blogo') ) . '</div>';
		} else {
			$comment_field = '<div class="right"><textarea name="comment" placeholder="' . __('Leave a comment...', 'blogo') . '"></textarea><input type="submit" value="' . __('Submit Comment', 'blogo') . '" />' . get_cancel_comment_reply_link( __('Cancel Reply', 'blogo') ) . '</div><div class="clear"></div>';
		}

		$comments_args = array(
			'fields' => $fields,
			'comment_field' => $comment_field,
			'comment_notes_after' => ''
		);

		comment_form($comments_args);

	?>
</div>