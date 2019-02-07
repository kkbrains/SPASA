<?php if(get_field('entry_background') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Background</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_background'); ?></p>
		</div>
	</div>
<?php endif; ?>
