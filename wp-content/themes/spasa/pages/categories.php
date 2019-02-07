<?php // Template Name: Categories Page ?>
<?php
	get_header();
	the_post();
	if(get_field('site_status', options) != '1') {
		header('Location: '.get_bloginfo('url').'/dashboard/');
		exit();
	}
	if(is_user_logged_in()) {
		$user = wp_get_current_user();
		$role = (array) $user->roles;
		if(in_array('member', $role)) {
			get_template_part('inc/member-intro');
			get_template_part('inc/categories-content');
		} else {
			header('Location: '.get_bloginfo('url').'/dashboard/');
			exit();
		}
	} else {
		header('Location: '.get_bloginfo('url').'/dashboard/');
		exit();
	}
	get_footer();
?>
