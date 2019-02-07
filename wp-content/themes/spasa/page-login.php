<?php
	get_header();
	the_post();
	if(!is_user_logged_in()) {
		get_template_part('inc/page-intro');
		get_template_part('inc/login-content');
		get_template_part('inc/banners-bottom');
	} else {
		$user = wp_get_current_user();
		$role = (array) $user->roles;
		if(in_array('judge', $role) || in_array('member', $role)) {
			header('Location: '.get_bloginfo('url').'/dashboard/');
			exit();
		} else {
			header('Location: '.get_bloginfo('url').'/wp-admin/');
			exit();
		}
	}
	get_footer();
?>