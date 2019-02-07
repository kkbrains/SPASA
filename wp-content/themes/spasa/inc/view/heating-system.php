<?php if(get_field('entry_heating_system') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Heating system</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_heating_system'); ?></p>
		</div>
	</div>
<?php endif; ?>
