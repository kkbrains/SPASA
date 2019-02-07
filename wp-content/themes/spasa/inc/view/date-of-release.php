<?php if(get_field('entry_date_of_release') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Date of release</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_date_of_release'); ?></p>
		</div>
	</div>
<?php endif; ?>
