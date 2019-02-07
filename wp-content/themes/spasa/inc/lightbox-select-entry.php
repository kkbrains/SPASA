<?php
	if(!$wp_query->query_vars['copy_entry']):
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
	if($wp_query->query_vars['id']) {
		$args = array(
			'post_type' => $post_types_array,
			'post__not_in' => array($wp_query->query_vars['id']),
			'orderby' => array(
				'post_type' => 'ASC',
				'date' => 'ASC'
			),
			'meta_query' => array(
				array(
					'key' => 'entry_member_id',
					'value' => get_current_user_id()
				)
			),
			'posts_per_page' => -1
		);
		$target = 2;
		$category = intval(str_replace('award-', '', get_post_type($wp_query->query_vars['id'])));
	} else {
		$args = array(
			'post_type' => $post_types_array,
			'orderby' => array(
				'post_type' => 'ASC',
				'date' => 'ASC'
			),
			'meta_query' => array(
				array(
					'key' => 'entry_member_id',
					'value' => get_current_user_id()
				)
			),
			'posts_per_page' => -1
		);
		$target = 1;
		$category = $wp_query->query_vars['award_category'];
	}
	$the_query = new WP_Query($args);
	if($the_query->post_count >= $target):
?>
	<p class="copy-intro">If you would like to copy data from a previous entry please <a href="#copy-entry">click here</a></p>
	<div id="copy-entry" class="lightbox-container">
		<div class="lightbox">
			<div class="lightbox-center">
				<div class="select-entry">
					<p>Select an entry to copy</p>
					<ul>
						<?php
							while($the_query->have_posts()): 
							$the_query->the_post();
						?>
							<li><a href="/" data-entry-id="<?php echo get_the_ID(); ?>" data-category="<?php echo $category;?>"><?php echo str_replace(array(get_field('entry_member_business').' (', ')'), array('<span>ID ', ''), get_the_title()); ?></span></a></li>
						<?php endwhile; ?>
					</ul>
				</div>
				<span class="close">&nbsp;</span>
			</div>
		</div>
	</div>
	<div class="copy-entry-fields"></div>
<?php else: ?>
	<p class="copy-intro">Please complete the following form</p>
<?php
	endif;
	else:
?>
	<p class="copy-intro">&nbsp;</p>
<?php endif; ?>