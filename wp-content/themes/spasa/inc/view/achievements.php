<?php if(get_field('entry_achievements') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Achievements</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_achievements'); ?></p>
		</div>
	</div>
<?php endif; ?>
