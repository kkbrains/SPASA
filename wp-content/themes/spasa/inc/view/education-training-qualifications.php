<?php if(get_field('entry_education_training_qualifications') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Education / Training / Qualifications</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_education_training_qualifications'); ?></p>
		</div>
	</div>
<?php endif; ?>
