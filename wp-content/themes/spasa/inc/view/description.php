<?php if(get_field('entry_description') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Description</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_description'); ?></p>
		</div>
	</div>
<?php endif; ?>
