<div class="home-hero">
	<div class="center">
		<div class="block">
			<h1><?php the_field('hero_title'); ?></h1>
			<p><?php the_field('hero_paragraph'); ?></p>
			<ul>
				<?php if(is_user_logged_in()): ?>
					<li><a href="<?php echo esc_url(home_url()); ?>/dashboard/">Account</a></li>
					<li><a href="<?php echo wp_logout_url(); ?>">Log Out</a></li>
				<?php else: ?>
					<?php if(get_field('site_status', options) == '1'): ?>
						<li><a href="<?php echo esc_url(home_url()); ?>/register/">Register</a></li>
					<?php elseif(get_field('site_status', options) == '2'): ?>
						<li><a href="<?php echo esc_url(home_url()); ?>/entries/">Review Entries</a></li>
					<?php endif; ?>
					<li><a href="<?php echo esc_url(home_url()); ?>/login/">Log In</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
	<a href="#info" class="scroll">Scroll</a>
	<div class="background"></div>
</div>
