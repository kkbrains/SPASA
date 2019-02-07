<?php // Template Name: Payment Page ?>
<?php
	get_header();
	the_post();
	if(get_field('site_status', options) != '1') {
		header('Location: '.get_bloginfo('url').'/dashboard/');
		exit();
	}
	if(!isset($_POST['payment_type'])):
		header('Location: '.get_bloginfo('url').'/dashboard/');
		exit();
	else:
		get_template_part('inc/payment-content');
		get_footer();
	endif;
?>
