<?php // Template Name: Payment Success Page ?>
<?php
	get_header();
	the_post();
	if(get_field('site_status', options) != '1') {
		header('Location: '.get_bloginfo('url').'/dashboard/');
		exit();
	}
	if($_SESSION['success_total'] == '') {
		header('Location: '.get_bloginfo('url').'/dashboard/');
		exit();
	} else {
		get_template_part('inc/page-intro');
		get_template_part('inc/success-content');
		get_footer();
	}
?>
