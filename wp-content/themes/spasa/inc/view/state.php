<?php if(get_field('entry_state') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>State</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_state'); ?></p>
		</div>
	</div>
<?php endif; ?>
