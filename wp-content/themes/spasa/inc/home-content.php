<div class="content center" id="info">
	<div class="home-intro">
		<?php the_field('intro_text'); ?>
	</div>
	<div class="home-columns">
		<div class="column">
			<?php the_field('column_1'); ?>
		</div>
		<div class="column">
			<?php the_field('column_2'); ?>
		</div>
		<div class="column">
			<?php the_field('column_3'); ?>
		</div>
		<div class="awards">
			<img src="<?php bloginfo('template_url'); ?>/images/gold.png" alt="Gold" />
			<img src="<?php bloginfo('template_url'); ?>/images/highly-recommended-1.png" alt="Highly Recommended" />
			<img src="<?php bloginfo('template_url'); ?>/images/highly-recommended-2.png" alt="Highly Recommended" />
		</div>
	</div>
</div>
