<?php // Template Name: Awards Page ?>
<?php
	get_header();
	the_post();
	get_template_part('inc/page-intro');
	get_template_part('inc/awards-content');
	get_template_part('inc/banners-bottom');
	get_footer();
?>
