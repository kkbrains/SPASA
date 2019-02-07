<?php if(get_field('entry_marketing_material') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Marketing material</h3>
		</div>
		<div class="value">
			<?php $marketing_material = get_field('entry_marketing_material'); ?>
			<p><a href="<?php echo $marketing_material[url]; ?>" target="_blank"><?php echo $marketing_material[filename]; ?></a></p>
		</div>
	</div>
<?php endif; ?>
