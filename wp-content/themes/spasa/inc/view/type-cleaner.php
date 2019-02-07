<?php if(get_field('entry_type_cleaner') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Type of cleaner</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_type_cleaner'); ?></p>
		</div>
	</div>
<?php endif; ?>
