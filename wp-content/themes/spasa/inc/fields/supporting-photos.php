<?php
	if($wp_query->query_vars['id']):
		$supporting_photos_1 = get_field('entry_supporting_photos_1', $wp_query->query_vars['id']);
		$supporting_photos_2 = get_field('entry_supporting_photos_2', $wp_query->query_vars['id']);
		$supporting_photos_3 = get_field('entry_supporting_photos_3', $wp_query->query_vars['id']);
		$supporting_photos_4 = get_field('entry_supporting_photos_4', $wp_query->query_vars['id']);
		$supporting_photos_5 = get_field('entry_supporting_photos_5', $wp_query->query_vars['id']);
		$supporting_photos = false;
		if(($supporting_photos_1 != '') || ($supporting_photos_2 != '') || ($supporting_photos_3 != '') || ($supporting_photos_4 != '') || ($supporting_photos_5 != '')) {
			$value = true;
		}
	endif;
?>
<div class="file-uploads">
	<p> 
		<label for="supporting-photos" <?php if($wp_query->query_vars['id'] && $value == true): ?>style="display: none;"<?php endif; ?>>
			Supporting photos <span class="info">(up to 5 files)</span>
			<span class="file"></span>
			<input type="file" id="supporting-photos" name="supporting_photos[]" accept=".jpg,.jpeg,.gif,.png" multiple="multiple" />
			<span class="smalltext">Accepted file types: jpg, gif or png</span>
		</label>
		<?php
			if($wp_query->query_vars['id'] && $value = true):
			$change = false;
		?>
			<label for="existing-supporting-photos">
				Supporting photos <span class="info">(up to 5 files)</span> 
				<span class="existing-file">
					<?php if($supporting_photos_1 != ''): ?>
						<a href="<?php echo $supporting_photos_1[url]; ?>" target="_blank" class="view view-1"><?php echo $supporting_photos_1[filename]; ?></a> 
						<?php
							if($change == false):
							$change = true;
						?>
							&nbsp;- &nbsp;<a href="#change-supporting-photos" class="change">Change</a>
						<?php endif; ?><br />
					<?php endif; ?>
					<?php if($supporting_photos_2 != ''): ?>
						<a href="<?php echo $supporting_photos_2[url]; ?>" target="_blank" class="view view-2"><?php echo $supporting_photos_2[filename]; ?></a> 
						<?php
							if($change == false):
							$change = true;
						?>
							&nbsp;- &nbsp;<a href="#change-supporting-photos" class="change">Change</a>
						<?php endif; ?><br />
					<?php endif; ?>
					<?php if($supporting_photos_3 != ''): ?>
						<a href="<?php echo $supporting_photos_3[url]; ?>" target="_blank" class="view view-3"><?php echo $supporting_photos_3[filename]; ?></a> 
						<?php
							if($change == false):
							$change = true;
						?>
							&nbsp;- &nbsp;<a href="#change-supporting-photos" class="change">Change</a>
						<?php endif; ?><br />
					<?php endif; ?>
					<?php if($supporting_photos_4 != ''): ?>
						<a href="<?php echo $supporting_photos_4[url]; ?>" target="_blank" class="view view-4"><?php echo $supporting_photos_4[filename]; ?></a> 
						<?php
							if($change == false):
							$change = true;
						?>
							&nbsp;- &nbsp;<a href="#change-supporting-photos" class="change">Change</a>
						<?php endif; ?><br />
					<?php endif; ?>
					<?php if($supporting_photos_5 != ''): ?>
						<a href="<?php echo $supporting_photos_5[url]; ?>" target="_blank" class="view view-5"><?php echo $supporting_photos_5[filename]; ?></a> 
						<?php
							if($change == false):
							$change = true;
						?>
							&nbsp;- &nbsp;<a href="#change-supporting-photos" class="change">Change</a>
						<?php endif; ?><br />
					<?php endif; ?>
				</span>
				<input type="hidden" id="existing-supporting-photos-1" name="existing_supporting_photos_1" value="<?php echo $supporting_photos_1[id]; ?>" />
				<input type="hidden" id="existing-supporting-photos-2" name="existing_supporting_photos_2" value="<?php echo $supporting_photos_2[id]; ?>" />
				<input type="hidden" id="existing-supporting-photos-3" name="existing_supporting_photos_3" value="<?php echo $supporting_photos_3[id]; ?>" />
				<input type="hidden" id="existing-supporting-photos-4" name="existing_supporting_photos_4" value="<?php echo $supporting_photos_4[id]; ?>" />
				<input type="hidden" id="existing-supporting-photos-5" name="existing_supporting_photos_5" value="<?php echo $supporting_photos_5[id]; ?>" />
			</label>
		<?php endif; ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('input[name="supporting_photos[]"]').on('change', 
				function() {
					$this = jQuery(this);
					if(parseInt(jQuery($this).get(0).files.length) > 5) {
						alert('You can upload a maximum of 5 files');
						jQuery($this).val('');
					} else if(parseInt(jQuery($this).get(0).files.length)) {
						var file_names = [];
						if(parseInt(jQuery($this).get(0).files.length) == 1) {
							file_names.push(parseInt(jQuery($this).get(0).files.length) + ' file selected');
						} else {
							file_names.push(parseInt(jQuery($this).get(0).files.length) + ' files selected');
						}
						jQuery($this).closest('p').find('label .file').html(file_names || '');
					} else {
						jQuery($this).closest('p').find('label .file').html('');
					}
				}
			);
			jQuery(document).on('click', 'a[href="#change-supporting-photos"]', 
				function(e) {
					e.preventDefault();
					jQuery(this).closest('p').find('label[for="supporting-photos"]').show();
					jQuery(this).closest('p').find('label[for="existing-supporting-photos"]').remove();
					jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					jQuery(this).blur();
				}
			);
		}
	);
</script>
