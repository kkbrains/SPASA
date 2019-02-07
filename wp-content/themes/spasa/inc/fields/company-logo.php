<div class="file-uploads">
	<p>
		<label for="company-logo" <?php if($wp_query->query_vars['id'] && get_field('entry_company_logo', $wp_query->query_vars['id'])): ?>style="display: none;"<?php endif; ?>>
			Company logo <span class="info">(1 file)</span> <span class="required">*</span>
			<span class="file"></span>
			<input type="file" id="company-logo" name="company_logo" accept=".jpg,.jpeg,.gif,.png" multiple="false" data-required="required" />
			<span class="smalltext">Accepted file types: jpg, gif or png (minimum 150KB)</span>
		</label>
		<?php
			if($wp_query->query_vars['id'] && get_field('entry_company_logo', $wp_query->query_vars['id'])):
			$company_logo = get_field('entry_company_logo', $wp_query->query_vars['id']);
		?>
			<label for="existing-company-logo">
				Company logo <span class="info">(1 file)</span> <span class="required">*</span> 
				<span class="existing-file"><a href="<?php echo $company_logo[url]; ?>" target="_blank" class="view"><?php echo $company_logo[filename]; ?></a> &nbsp;- &nbsp;<a href="#change-company-logo" class="change">Change</a></span>
				<input type="hidden" id="existing-company-logo" name="existing_company_logo" value="<?php echo $company_logo[id]; ?>" />
			</label>
		<?php endif; ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('input[name="company_logo"]').on('change', 
				function() {
					$this = jQuery(this);
					jQuery($this).closest('p').find('label .file').html(this.value.replace('C:\\fakepath\\', '') || '');
					if (window.File && window.FileReader && window.FileList && window.Blob) {
						if(this.files[0].size < 150000){
							alert('File must be at least 150KB');
							this.value = '';
							jQuery($this).closest('p').find('label .file').html('');
						};
					}
				}
			);
			jQuery(document).on('click', 'a[href="#change-company-logo"]', 
				function(e) {
					e.preventDefault();
					jQuery(this).closest('p').find('label[for="company-logo"]').show();
					jQuery(this).closest('p').find('label[for="existing-company-logo"]').remove();
					jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					jQuery(this).blur();
				}
			);
		}
	);
</script>

