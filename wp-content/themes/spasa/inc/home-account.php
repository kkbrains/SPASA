<div class="home-account">
	<div class="center">
		<div class="text">
			<h2>We've made it easier than ever with our new Online System</h2>
			<p>To enter the Awards, you simply need to Log In or Register and begin your submission by clicking 'Submit New Entry'</p>
		</div>
		<ul class="account">
			<?php if(is_user_logged_in()): ?>
				<li><a href="<?php echo esc_url(home_url()); ?>/dashboard/">Account</a></li>
				<li><a href="<?php echo wp_logout_url(); ?>">Log Out</a></li>
			<?php else: ?>
				<li><a href="<?php echo esc_url(home_url()); ?>/register/">Register</a></li>
				<li><a href="<?php echo esc_url(home_url()); ?>/login/">Log In</a></li>
			<?php endif; ?>
		</ul>
	</div>
</div>