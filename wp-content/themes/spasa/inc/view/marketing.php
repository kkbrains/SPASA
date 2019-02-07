<?php if(get_field('entry_marketing') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Marketing</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_marketing'); ?></p>
		</div>
	</div>
<?php endif; ?>
