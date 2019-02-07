<?php if(get_field('entry_service_vehicle') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Service vehicle <span>(description)</span></h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_service_vehicle'); ?></p>
		</div>
	</div>
<?php endif; ?>

