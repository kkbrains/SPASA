<?php if(get_field('entry_length') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Length</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_length'); ?></p>
		</div>
	</div>
<?php endif; ?>
