<?php if(get_field('entry_main_photo') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Main photo</h3>
		</div>
		<div class="value">
			<?php
				$image = get_field('entry_main_photo');
				$image_url = wp_get_attachment_image_src($image[ID], large);
			 ?>
			<a href="<?php echo $image_url[0]; ?>" class="view">
				<?php echo fly_get_attachment_image($image[id], array(780, 850), false, array('alt' => '', 'class' => '')); ?>
				<span></span>
			</a>
		</div>
	</div>
<?php endif; ?>
