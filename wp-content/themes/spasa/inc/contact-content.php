<div class="content center">
	<div class="main">
		<?php echo do_shortcode('[contact-form-7 title="Contact"]'); ?>
	</div>
	<div class="sidebar">
		<?php the_field('page_content'); ?>
		<?php if(get_field('twitter_url') || get_field('facebook_url') || get_field('linkedin_url') || get_field('youtube_url')): ?>
			<ul class="social">
				<?php if(get_field('twitter_url')): ?>
					<li><a href="<?php the_field('twitter_url'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/twitter.svg" alt="Twitter" class="svg" /></a></li>
				<?php endif; ?>
				<?php if(get_field('facebook_url')): ?>
					<li><a href="<?php the_field('facebook_url'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/facebook.svg" alt="Facebook" class="svg" /></a></li>
				<?php endif; ?>
				<?php if(get_field('linkedin_url')): ?>
					<li><a href="<?php the_field('linkedin_url'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/linkedin.svg" alt="LinkedIn" class="svg" /></a></li>
				<?php endif; ?>
				<?php if(get_field('youtube_url')): ?>
					<li><a href="<?php the_field('youtube_url'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/youtube.svg" alt="YouTube" class="svg" /></a></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>
	</div>
</div>
