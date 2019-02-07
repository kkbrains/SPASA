<div class="page-intro">
	<div class="center">
		<div class="text">
			<h1><?php the_title(); ?></h1>
			<p><?php
				$user_id = get_current_user_id();
				echo '<strong>'.get_user_meta($user_id, 'nickname', true).'</strong><br />';
				echo get_user_meta($user_id, 'member_business', true).', ';
				echo get_user_meta($user_id, 'member_address_line_1', true).', ';
				echo get_user_meta($user_id, 'member_state', true).', ';
				echo get_user_meta($user_id, 'member_country', true).'<br />';
				$current_user = wp_get_current_user();
				echo '<a href="mailto:'.$current_user->user_email.'">'.$current_user->user_email.'</a>';
			?></p>
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
