<?php if(get_field('entry_coping_materials') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Coping materials</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_coping_materials'); ?></p>
		</div>
	</div>
<?php endif; ?>
