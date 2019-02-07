<?php // Template Name: Review Page ?>
<?php
	get_header();
	the_post();
	if(get_field('site_status', options) == '2') {
		get_template_part('inc/page-intro');
		get_template_part('inc/review-content');
	} else {
		header('Location: '.get_bloginfo('url'));
		exit();
	}
	get_footer();
?>
