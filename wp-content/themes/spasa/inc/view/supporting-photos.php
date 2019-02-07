<?php
	if(
		(get_field('entry_supporting_photos_1') != '') || 
		(get_field('entry_supporting_photos_2') != '') || 
		(get_field('entry_supporting_photos_3') != '') || 
		(get_field('entry_supporting_photos_4') != '') || 
		(get_field('entry_supporting_photos_5') != '')
	):
?>
	<div class="view-content">
		<div class="title">
			<h3>Supporting photos</h3>
		</div>
		<div class="value">
			<ol class="supporting-photos">
				<?php if(get_field('entry_supporting_photos_1') != ''): ?>
					<li>
						<?php
							$supporting_photos_1 = get_field('entry_supporting_photos_1');
							$supporting_photos_1_url_small = wp_get_attachment_image_src($supporting_photos_1[ID], 'thumbnail');
							$supporting_photos_1_url_large = wp_get_attachment_image_src($supporting_photos_1[ID], large);
						 ?>
						<a href="<?php echo $supporting_photos_1_url_large[0]; ?>" class="view"><img src="<?php echo $supporting_photos_1_url_small[0]; ?>" alt="Supporting photo" /><span></span></a>
					</li>
				<?php endif; ?>
				<?php if(get_field('entry_supporting_photos_2') != ''): ?>
					<li>
						<?php
							$supporting_photos_2 = get_field('entry_supporting_photos_2');
							$supporting_photos_2_url_small = wp_get_attachment_image_src($supporting_photos_2[ID], 'thumbnail');
							$supporting_photos_2_url_large = wp_get_attachment_image_src($supporting_photos_2[ID], large);
						 ?>
						<a href="<?php echo $supporting_photos_2_url_large[0]; ?>" class="view"><img src="<?php echo $supporting_photos_2_url_small[0]; ?>" alt="Supporting photo" /><span></span></a>
					</li>
				<?php endif; ?>
				<?php if(get_field('entry_supporting_photos_3') != ''): ?>
					<li>
						<?php
							$supporting_photos_3 = get_field('entry_supporting_photos_3');
							$supporting_photos_3_url_small = wp_get_attachment_image_src($supporting_photos_3[ID], 'thumbnail');
							$supporting_photos_3_url_large = wp_get_attachment_image_src($supporting_photos_3[ID], large);
						 ?>
						<a href="<?php echo $supporting_photos_3_url_large[0]; ?>" class="view"><img src="<?php echo $supporting_photos_3_url_small[0]; ?>" alt="Supporting photo" /><span></span></a>
					</li>
				<?php endif; ?>
				<?php if(get_field('entry_supporting_photos_4') != ''): ?>
					<li>
						<?php
							$supporting_photos_4 = get_field('entry_supporting_photos_4');
							$supporting_photos_4_url_small = wp_get_attachment_image_src($supporting_photos_4[ID], 'thumbnail');
							$supporting_photos_4_url_large = wp_get_attachment_image_src($supporting_photos_4[ID], large);
						 ?>
						<a href="<?php echo $supporting_photos_4_url_large[0]; ?>" class="view"><img src="<?php echo $supporting_photos_4_url_small[0]; ?>" alt="Supporting photo" /><span></span></a>
					</li>
				<?php endif; ?>
				<?php if(get_field('entry_supporting_photos_5') != ''): ?>
					<li>
						<?php
							$supporting_photos_5 = get_field('entry_supporting_photos_5');
							$supporting_photos_5_url_small = wp_get_attachment_image_src($supporting_photos_5[ID], 'thumbnail');
							$supporting_photos_5_url_large = wp_get_attachment_image_src($supporting_photos_5[ID], large);
						 ?>
						<a href="<?php echo $supporting_photos_5_url_large[0]; ?>" class="view"><img src="<?php echo $supporting_photos_5_url_small[0]; ?>" alt="Supporting photo" /><span></span></a>
					</li>
				<?php endif; ?>
			</ol>
		</div>
	</div>
<?php endif; ?>
