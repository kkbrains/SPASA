<?php // Template Name: Edit Page ?>
<?php
	get_header();
	the_post();
	global $wp_query;
	if(get_field('site_status', options) != '1') {
		header('Location: '.get_bloginfo('url').'/dashboard/');
		exit();
	}
	if(!$wp_query->query_vars['id']) {
		header('Location: '.get_bloginfo('url').'/dashboard/');
		exit();
	} else {
		if(get_field('entry_status', $wp_query->query_vars['id']) == 'Completed' || get_field('entry_id', $wp_query->query_vars['id']) == '') {
			header('Location: '.get_bloginfo('url').'/dashboard/');
			exit();
		}
	}
	get_template_part('inc/edit-intro');
	get_template_part('inc/edit-content');
	get_template_part('inc/lightbox-judging-criteria');
	get_footer();
?>
