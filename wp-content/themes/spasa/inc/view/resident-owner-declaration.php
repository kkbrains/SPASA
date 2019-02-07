<?php if(get_field('entry_resident_owner_declaration') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Resident / Owner</h3>
		</div>
		<div class="value">
			<?php if(get_field('entry_resident_owner_declaration') == 'yes'): ?>
				<p>Permission has been given</p>
			<?php else: ?>
				<p>Permission has not been given</p>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
