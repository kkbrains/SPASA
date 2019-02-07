<?php if(get_field('entry_sustainability_specifics') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Sustainability specifics</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_sustainability_specifics'); ?></p>
		</div>
	</div>
<?php endif; ?>
