<?php if(get_field('entry_communication_skills') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Communication skills</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_communication_skills'); ?></p>
		</div>
	</div>
<?php endif; ?>
