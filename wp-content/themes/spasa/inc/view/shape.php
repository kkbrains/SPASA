<?php if(get_field('entry_shape') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Shape</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_shape'); ?></p>
		</div>
	</div>
<?php endif; ?>
