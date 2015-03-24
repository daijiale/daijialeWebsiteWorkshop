<?php

	// Template Name: Contact Page

	get_header();
	
	if ( !empty($_POST) ) {
		
		$blogo_contact_name = wp_filter_nohtml_kses(stripslashes_deep($_POST['contact_name']));
		$blogo_contact_email = wp_filter_nohtml_kses(stripslashes_deep($_POST['contact_email']));
		$blogo_contact_subject = wp_filter_nohtml_kses(stripslashes_deep($_POST['contact_subject']));
		$blogo_contact_text = wp_filter_nohtml_kses(stripslashes_deep($_POST['contact_text']));
		
		if ( !empty($blogo_contact_name) && is_email($blogo_contact_email) && !empty($blogo_contact_subject) && !empty($blogo_contact_text) ) {
			$blogo_contact_headers = __('From:', 'blogo') . ' ' . $blogo_contact_name . ' <' . $blogo_contact_email . '>' . "\r\n";
			wp_mail( get_option('admin_email'), $blogo_contact_subject, $blogo_contact_text, $blogo_contact_headers );
		} else {
			$blogo_contact_error = '<p class="error">' . __('Please, fill out all fields correctly and try again.', 'blogo') . '</p>';
		}
		
	}
	
?>

<div id="content">
	
	<?php if (have_posts()) : the_post(); ?>
	
		<div class="post">
			
			<div class="content full contactForm">
				
				<h1><?php the_title(); ?></h1>
				
				<?php the_content(); ?>
				
				<?php if ( !empty($blogo_contact_error) ) echo $blogo_contact_error; ?>
				
				<form action="" method="post">
					<input type="text" name="contact_name" placeholder="<?php _e('Name', 'blogo'); ?>" value="<?php if ( !empty($blogo_contact_name) ) echo $blogo_contact_name; ?>" />
					<input type="text" name="contact_email" placeholder="<?php _e('E-mail', 'blogo'); ?>" value="<?php if ( !empty($blogo_contact_email) ) echo $blogo_contact_email; ?>" />
					<input type="text" name="contact_subject" placeholder="<?php _e('Subject', 'blogo'); ?>" value="<?php if ( !empty($blogo_contact_subject) ) echo $blogo_contact_subject; ?>" />
					<textarea name="contact_text" placeholder="<?php _e('Leave a comment...', 'blogo'); ?>"><?php if ( !empty($blogo_contact_text) ) echo $blogo_contact_text; ?></textarea>
					<input type="submit" value="<?php _e('Submit', 'blogo'); ?>" />
					<div class="clear"></div>
				</form>
				
			</div>
			
			<div class="clear"></div>
			
		</div>
	
		<?php comments_template( '', true ); ?>
	
	<?php endif; ?>
	
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>