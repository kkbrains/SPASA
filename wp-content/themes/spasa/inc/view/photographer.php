<?php if(get_field('entry_photographer') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Photographer</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_photographer'); ?></p>
		</div>
	</div>
<?php endif; ?>
