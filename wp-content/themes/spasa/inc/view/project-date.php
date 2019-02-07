<?php if(get_field('entry_project_date') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Project date</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_project_date'); ?></p>
		</div>
	</div>
<?php endif; ?>
