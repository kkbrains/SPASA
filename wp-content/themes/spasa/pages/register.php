<?php // Template Name: Register Page ?>
<?php
	get_header();
	the_post();
	if(is_user_logged_in()) {
		$user = wp_get_current_user();
		$role = (array) $user->roles;
		if(in_array('judge', $role)) {
			get_template_part('inc/page-intro');
			get_template_part('inc/judge-content');
		} elseif(in_array('member', $role)) {
			get_template_part('inc/member-intro');
			get_template_part('inc/member-content');
		} else {
			header('Location: '.get_bloginfo('url').'/wp-admin/');
			exit();
		}
	} else {
		get_template_part('inc/page-intro');
		get_template_part('inc/register-content');
	}
	get_footer();
?>
