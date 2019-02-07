<?php
	if(isset($_GET['delete'])){
		$post_types_array = array();
		$args = array(
		   'public'   => true,
		   '_builtin' => false
		);
		$output = 'names';
		$operator = 'and';
		$post_types = get_post_types($args,$output,$operator );
		if($post_types) {
			foreach($post_types  as $post_type) {
				$post_types_array[] = $post_type;
			}
		}
		$the_query = new WP_Query(
			array(
				'post_type' => $post_types_array,
				'orderby' => 'post_type',
				'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'entry_id',
						'value' => $_GET['delete']
					)
				),
				'posts_per_page' => -1
			)
		);
		if($the_query->have_posts()) {
			while($the_query->have_posts()) {
				$the_query->the_post();
				wp_delete_post($post->ID, true);
				header('Location: '.get_bloginfo('url').'/dashboard/');
				exit();
			}
		}
		header('Location: '.get_bloginfo('url').'/dashboard/');
		exit();
	}
	get_header();
	the_post();
	get_template_part('inc/home-hero');
	if(get_field('site_status', options) == '2') {
		get_template_part('inc/home-review');
	}
	if(get_field('site_status', options) == '4') {
		get_template_part('inc/home-winners');
	}
	get_template_part('inc/home-content');
	if(get_field('site_status', options) == '1') {
		get_template_part('inc/home-account');
	}
	get_footer();
?>
