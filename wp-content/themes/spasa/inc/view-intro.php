<div class="page-intro">
	<div class="center">
		<div class="text">
			<?php
				$post = get_post_type_object(get_post_type(get_queried_object()));
				$titles = get_post_types(array('name' => $post->name), 'objects');
				foreach ($titles as $title) {
				   $title = $title->label;
				}
			?>
			<h1><?php echo $title; ?></h1>
			<?php if(get_field('category_intro_'.intval(str_replace('award-', '', $post->name)), 'options') != ''): ?>
				<p><?php the_field('category_intro_'.intval(str_replace('award-', '', $post->name)), 'options'); ?></p>
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
