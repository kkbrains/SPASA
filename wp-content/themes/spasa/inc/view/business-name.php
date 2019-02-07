<?php if(get_field('entry_member_business') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Business name</h3>
		</div>
		<div class="value">
			<p><?php the_field('entry_member_business'); ?></p>
		</div>
	</div>
<?php endif; ?>
