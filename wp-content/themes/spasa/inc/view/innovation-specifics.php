<?php if(get_field('entry_innovation_specifics') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Innovation specifics</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_innovation_specifics'); ?></p>
		</div>
	</div>
<?php endif; ?>
