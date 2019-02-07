<div class="file-uploads">
	<p>
		<label for="client-testimonials" <?php if($wp_query->query_vars['id'] && get_field('entry_client_testimonials', $wp_query->query_vars['id'])): ?>style="display: none;"<?php endif; ?>>
			Client testimonials <span class="info">(minimum of 5 in 1 file)</span> 
			<span class="file"></span>
			<input type="file" id="client-testimonials" name="client_testimonials" accept=".pdf" multiple="false" />
			<span class="smalltext">Accepted file types: pdf</span>
		</label>
		<?php
			if($wp_query->query_vars['id'] && get_field('entry_client_testimonials', $wp_query->query_vars['id'])):
			$client_testimonials = get_field('entry_client_testimonials', $wp_query->query_vars['id']);
		?>
			<label for="existing-client-testimonials">
				Client testimonials <span class="info">(minimum of 5 in 1 file)</span> 
				<span class="existing-file"><a href="<?php echo $client_testimonials[url]; ?>" target="_blank" class="view"><?php echo $client_testimonials[filename]; ?></a> &nbsp;- &nbsp;<a href="#change-client-testimonials" class="change">Change</a></span>
				<input type="hidden" id="existing-client-testimonials" name="existing_client_testimonials" value="<?php echo $client_testimonials[id]; ?>" />
			</label>
		<?php endif; ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('input[name="client_testimonials"]').on('change', 
				function() {
					$this = jQuery(this);
					jQuery($this).closest('p').find('label .file').html(this.value.replace('C:\\fakepath\\', '') || '');
				}
			);
			jQuery(document).on('click', 'a[href="#change-client-testimonials"]', 
				function(e) {
					e.preventDefault();
					jQuery(this).closest('p').find('label[for="client-testimonials"]').show();
					jQuery(this).closest('p').find('label[for="existing-client-testimonials"]').remove();
					jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					jQuery(this).blur();
				}
			);
		}
	);
</script>