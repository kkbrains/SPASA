<?php if(get_field('entry_customer_service') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Customer service</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_customer_service'); ?></p>
		</div>
	</div>
<?php endif; ?>
