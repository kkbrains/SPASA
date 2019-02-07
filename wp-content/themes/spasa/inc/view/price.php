<?php if(get_field('entry_price') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Price</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_price'); ?></p>
		</div>
	</div>
<?php endif; ?>
