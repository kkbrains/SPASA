<?php if(get_field('entry_chlorinator') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Chlorinator</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_chlorinator'); ?></p>
		</div>
	</div>
<?php endif; ?>
