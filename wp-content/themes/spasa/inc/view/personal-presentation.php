<?php if(get_field('entry_personal_presentation') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Personal-presentation <span>(description)</span></h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_personal_presentation'); ?></p>
		</div>
	</div>
<?php endif; ?>
