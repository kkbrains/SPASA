<?php if(get_field('entry_presentation_store') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Presentation of store / warehouse / showroom <span>(description)</span></h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_presentation_store'); ?></p>
		</div>
	</div>
<?php endif; ?>
