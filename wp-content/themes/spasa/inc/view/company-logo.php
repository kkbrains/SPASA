<?php if(get_field('entry_company_logo') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Company logo</h3>
		</div>
		<div class="value">
			<?php
				$image = get_field('entry_company_logo');
				$image_url = wp_get_attachment_image_src($image[ID], large);
			 ?>
			<a href="<?php echo $image_url[0]; ?>" class="view company-logo">
				<?php echo fly_get_attachment_image($image[id], array(400, 300), false, array('alt' => '', 'class' => '')); ?>
				<span></span>
			</a>
		</div>
	</div>
<?php endif; ?>
