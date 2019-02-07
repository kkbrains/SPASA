<div class="file-uploads">
	<p>
		<label for="product-data-sheet" <?php if($wp_query->query_vars['id'] && get_field('entry_product_data_sheet', $wp_query->query_vars['id'])): ?>style="display: none;"<?php endif; ?>>
			Product data sheet <span class="info">(1 file)</span> <span class="required">*</span>
			<span class="file"></span>
			<input type="file" id="product-data-sheet" name="product_data_sheet" accept=".pdf,.doc" multiple="false" data-required="required" />
			<span class="smalltext">Accepted file types: pdf or doc</span>
		</label>
		<?php
			if($wp_query->query_vars['id'] && get_field('entry_product_data_sheet', $wp_query->query_vars['id'])):
			$product_data_sheet = get_field('entry_product_data_sheet', $wp_query->query_vars['id']);
		?>
			<label for="existing-product-data-sheet">
				Product data sheet <span class="info">(1 file)</span> <span class="required">*</span> 
				<span class="existing-file"><a href="<?php echo $product_data_sheet[url]; ?>" target="_blank" class="view"><?php echo $product_data_sheet[filename]; ?></a> &nbsp;- &nbsp;<a href="#change-product-data-sheet" class="change">Change</a></span>
				<input type="hidden" id="existing-product-data-sheet" name="existing_product_data_sheet" value="<?php echo $product_data_sheet[id]; ?>" />
			</label>
		<?php endif; ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('input[name="product_data_sheet"]').on('change', 
				function() {
					$this = jQuery(this);
					jQuery($this).closest('p').find('label .file').html(this.value.replace('C:\\fakepath\\', '') || '');
				}
			);
			jQuery(document).on('click', 'a[href="#change-product-data-sheet"]', 
				function(e) {
					e.preventDefault();
					jQuery(this).closest('p').find('label[for="product-data-sheet"]').show();
					jQuery(this).closest('p').find('label[for="existing-product-data-sheet"]').remove();
					jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					jQuery(this).blur();
				}
			);
		}
	);
</script>
