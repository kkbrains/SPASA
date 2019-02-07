<div class="page-intro">
	<div class="center">
		<div class="text">
			<h1><?php the_title(); ?></h1>
			<?php the_field('page_intro'); ?>
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
