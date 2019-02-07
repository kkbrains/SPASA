<div class="file-uploads">
	<p>
		<label for="portfolio" <?php if($wp_query->query_vars['id'] && get_field('entry_portfolio', $wp_query->query_vars['id'])): ?>style="display: none;"<?php endif; ?>>
			Portfolio <span class="info">(1 file)</span> <span class="required">*</span>
			<span class="file"></span>
			<input type="file" id="portfolio" name="portfolio" accept=".pdf" multiple="false" data-required="required" />
			<span class="smalltext">Accepted file types: pdf</span>
		</label>
		<?php
			if($wp_query->query_vars['id'] && get_field('entry_portfolio', $wp_query->query_vars['id'])):
			$portfolio = get_field('entry_portfolio', $wp_query->query_vars['id']);
		?>
			<label for="existing-portfolio">
				Portfolio <span class="info">(1 file)</span> <span class="required">*</span> 
				<span class="existing-file"><a href="<?php echo $portfolio[url]; ?>" target="_blank" class="view"><?php echo $portfolio[filename]; ?></a> &nbsp;- &nbsp;<a href="#change-portfolio" class="change">Change</a></span>
				<input type="hidden" id="existing-portfolio" name="existing_portfolio" value="<?php echo $portfolio[id]; ?>" />
			</label>
		<?php endif; ?>
	</p>
	<div class="additional-info">
		<p>Portfolio to include:</p>
		<ul>
			<li>Background / About business</li>
			<li>Achievements</li>
			<li>Customer Service</li>
			<li>Problem solving skills</li>
			<li>Communication skills</li>
			<li>Staff presentation / uniforms</li>
			<li>Display centre / showroom</li>
			<li>Marketing</li>
			<li>Client testimonials</li>
			<li>Technical knowledge</li>
			<li>Education &amp; training</li>
			<li>Business growth</li>
			<li>Adaption to new technology</li>
			<li>Project management</li>
			<li>Workmanship</li>
			<li>Compliance with regulations, safety, industry, OH&amp;S</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('input[name="portfolio"]').on('change', 
				function() {
					$this = jQuery(this);
					jQuery($this).closest('p').find('label .file').html(this.value.replace('C:\\fakepath\\', '') || '');
				}
			);
			jQuery(document).on('click', 'a[href="#change-portfolio"]', 
				function(e) {
					e.preventDefault();
					jQuery(this).closest('p').find('label[for="portfolio"]').show();
					jQuery(this).closest('p').find('label[for="existing-portfolio"]').remove();
					jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					jQuery(this).blur();
				}
			);
		}
	);
</script>