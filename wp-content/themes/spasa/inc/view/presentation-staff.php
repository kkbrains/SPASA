<?php if(get_field('entry_presentation_staff') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Presentation of staff <span>(description)</span></h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_presentation_staff'); ?></p>
		</div>
	</div>
<?php endif; ?>
