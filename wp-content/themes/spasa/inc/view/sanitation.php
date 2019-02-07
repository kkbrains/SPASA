<?php if(get_field('entry_sanitation') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Sanitation</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_sanitation'); ?></p>
		</div>
	</div>
<?php endif; ?>
