<?php
	get_header();
	the_post();
	get_template_part('inc/view-intro');
	get_template_part('inc/view-content');
	get_template_part('inc/lightbox-image');
	get_footer();
?>
