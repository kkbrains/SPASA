<div class="page-intro">
	<div class="center">
		<div class="text">
			<?php
				$titles = get_post_types(array('name' => 'award-'.sprintf('%02d', $wp_query->query_vars['award_category'])), 'objects');
				foreach ($titles as $title) {
				   $title = $title->label;
				}
			?>
			<h1><?php echo $title; ?></h1>
			<?php if(get_field('category_intro_'.$wp_query->query_vars['award_category'], 'options') != ''): ?>
				<p><?php the_field('category_intro_'.$wp_query->query_vars['award_category'], 'options'); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<div class="background"></div>
</div>
<style type="text/css">
	@media (min-width: 1024px) {
		.page-intro .background {
			background-image: url(<?php bloginfo('template_url'); ?>/images/page-intro/<?php echo(mt_rand(1,6)); ?>.jpg); 
		}
	}
	@media (max-width: 1024px) {
		.page-intro .background {
			background-image: url(<?php bloginfo('template_url'); ?>/images/page-intro/default.jpg); 
		}
	}
</style>
