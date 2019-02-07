<?php if(get_field('entry_product_data_sheet') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Product data sheet</h3>
		</div>
		<div class="value">
			<?php $product_data_sheet = get_field('entry_product_data_sheet'); ?>
			<p><a href="<?php echo $product_data_sheet[url]; ?>" target="_blank"><?php echo $product_data_sheet[filename]; ?></a></p>
		</div>
	</div>
<?php endif; ?>
