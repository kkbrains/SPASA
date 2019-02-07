<?php if(get_field('entry_project_name') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Project name</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_project_name'); ?></p>
		</div>
	</div>
<?php endif; ?>
