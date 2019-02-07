<?php // Template Name: Enter Page ?>
<?php
	get_header();
	the_post();
	global $wp_query;
	if(get_field('site_status', options) != '1') {
		header('Location: '.get_bloginfo('url').'/dashboard/');
		exit();
	}
	if(!$wp_query->query_vars['award_category']) {
		header('Location: '.get_bloginfo('url').'/dashboard/');
		exit();
	}
	get_template_part('inc/enter-intro');
	get_template_part('inc/enter-content');
	if($wp_query->query_vars['copy_entry']) {
		get_template_part('inc/copy-fields');
	}
	get_template_part('inc/lightbox-judging-criteria');
	get_footer();
?>
