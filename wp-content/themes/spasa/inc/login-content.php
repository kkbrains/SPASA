<div class="content center">
	<div class="sidebar">
		<form action="<?php echo site_url('/wp-login.php'); ?>" method="post" autocomplete="off">
			<h2>Log In</h2>
			<p>
				<label for="user_login">Username</label><br />
				<input id="user_login" type="text" size="20" value="" name="log" />
			</p>
			<p>
				<label for="user_pass">Password</label><br />
				<input id="user_pass" type="password" size="20" value="" name="pwd" />
			</p>
			<p>
				<label class="checkbox">
					<input type="checkbox" id="rememberme" name="rememberme" value="forever">
					Remember me <span class="marker"></span>
				</label>
			</p>
			<p><button type="submit">Log In</button></p>
			<br />
			<a href="<?php echo wp_lostpassword_url(site_url('/login/')); ?>">Lost password?</a>
		</form>
	</div>
	<div class="main narrow">
		<?php the_field('page_content'); ?>
	</div>
</div>
