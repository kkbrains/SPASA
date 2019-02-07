<?php // Template Name: Contact Page ?>
<?php
	if (function_exists('wpcf7_enqueue_scripts')) {
        wpcf7_enqueue_scripts();
    }
	get_header();
	the_post();
	get_template_part('inc/page-intro');
	get_template_part('inc/contact-content');
	get_template_part('inc/map');
	get_footer();
?>
