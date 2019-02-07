<div class="file-uploads">
	<p>
		<label for="marketing-material" <?php if($wp_query->query_vars['id'] && get_field('entry_marketing_material', $wp_query->query_vars['id'])): ?>style="display: none;"<?php endif; ?>>
			Marketing material <span class="info">(1 file)</span> <span class="required">*</span>
			<span class="file"></span>
			<input type="file" id="marketing-material" name="marketing_material" accept=".pdf,.doc,.jpg,.jpeg,.mp4,.mov" multiple="false" data-required="required" />
			<span class="smalltext">Accepted file types: pdf, doc, jpg, mp4 or mov</span>
		</label>
		<?php
			if($wp_query->query_vars['id'] && get_field('entry_marketing_material', $wp_query->query_vars['id'])):
			$marketing_material = get_field('entry_marketing_material', $wp_query->query_vars['id']);
		?>
			<label for="existing-marketing-material">
				Marketing material <span class="info">(1 file)</span> <span class="required">*</span> 
				<span class="existing-file"><a href="<?php echo $marketing_material[url]; ?>" target="_blank" class="view"><?php echo $marketing_material[filename]; ?></a> &nbsp;- &nbsp;<a href="#change-marketing-material" class="change">Change</a></span>
				<input type="hidden" id="existing-marketing-material" name="existing_marketing_material" value="<?php echo $marketing_material[id]; ?>" />
			</label>
		<?php endif; ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('input[name="marketing_material"]').on('change', 
				function() {
					$this = jQuery(this);
					jQuery($this).closest('p').find('label .file').html(this.value.replace('C:\\fakepath\\', '') || '');
				}
			);
			jQuery(document).on('click', 'a[href="#change-marketing-material"]', 
				function(e) {
					e.preventDefault();
					jQuery(this).closest('p').find('label[for="marketing-material"]').show();
					jQuery(this).closest('p').find('label[for="existing-marketing-material"]').remove();
					jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					jQuery(this).blur();
				}
			);
		}
	);
</script>