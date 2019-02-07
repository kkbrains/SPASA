<?php if(get_field('entry_promotional_blurb') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Promotional blurb</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_promotional_blurb'); ?></p>
		</div>
	</div>
<?php endif; ?>
