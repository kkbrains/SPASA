<?php
	if($wp_query->query_vars['id']) {
		if(get_field('primary_image_min_'.intval(str_replace('award-', '', get_post_type($wp_query->query_vars['id']))), 'options') == '500KB') {
			$min_label = '500KB';
			$min_value = '500000';
		} else {
			$min_label = '3MB';
			$min_value = '3000000';
		}
	} else {
		if(get_field('primary_image_min_'.$wp_query->query_vars['award_category'], 'options') == '500KB') {
			$min_label = '500KB';
			$min_value = '500000';
		} else {
			$min_label = '3MB';
			$min_value = '3000000';	
		}
	}
?>
<div class="file-uploads">
	<p>
		<label for="main-photo" <?php if($wp_query->query_vars['id'] && get_field('entry_main_photo', $wp_query->query_vars['id'])): ?>style="display: none;"<?php endif; ?>>
			Main photo <span class="info">(1 file)</span> <span class="required">*</span>
			<span class="file"></span>
			<input type="file" id="main-photo" name="main_photo" accept=".jpg,.jpeg" multiple="false" data-required="required" />
			<span class="smalltext">Accepted file types: jpg (minimum width 2000px and <?php echo $min_label; ?>)</span>
		</label>
		<?php
			if($wp_query->query_vars['id'] && get_field('entry_main_photo', $wp_query->query_vars['id'])):
			$main_photo = get_field('entry_main_photo', $wp_query->query_vars['id']);
		?>
			<label for="existing-main-photo">
				Main photo <span class="info">(1 file)</span> <span class="required">*</span> 
				<span class="existing-file"><a href="<?php echo $main_photo[url]; ?>" target="_blank" class="view"><?php echo $main_photo[filename]; ?></a> &nbsp;- &nbsp;<a href="#change-main-photo" class="change">Change</a></span>
				<input type="hidden" id="existing-main-photo" name="existing_main_photo" value="<?php echo $main_photo[id]; ?>" />
			</label>
		<?php endif; ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('input[name="main_photo"]').on('change', 
				function() {
					$this = jQuery(this);
					jQuery($this).closest('p').find('label .file').html(this.value.replace('C:\\fakepath\\', '') || '');
					if (window.File && window.FileReader && window.FileList && window.Blob) {
						if(this.files[0].size < <?php echo $min_value; ?>){
							alert('File must be at least <?php echo $min_label; ?>');
							this.value = '';
							jQuery($this).closest('p').find('label .file').html('');
						};
					}
				}
			);
			jQuery(document).on('click', 'a[href="#change-main-photo"]', 
				function(e) {
					e.preventDefault();
					jQuery(this).closest('p').find('label[for="main-photo"]').show();
					jQuery(this).closest('p').find('label[for="existing-main-photo"]').remove();
					jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					jQuery(this).blur();
				}
			);
		}
	);
</script>
