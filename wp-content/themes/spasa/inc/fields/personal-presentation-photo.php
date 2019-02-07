<div class="file-uploads">
	<p>
		<label for="personal-presentation-photo" <?php if($wp_query->query_vars['id'] && get_field('entry_personal_presentation_photo', $wp_query->query_vars['id'])): ?>style="display: none;"<?php endif; ?>>
			Personal presentation  <span class="info">(1 photo)</span>
			<span class="file"></span>
			<input type="file" id="personal-presentation-photo" name="personal_presentation_photo" accept=".jpg,.jpeg" multiple="false" />
			<span class="smalltext">Accepted file types: jpg)</span>
		</label>
		<?php
			if($wp_query->query_vars['id'] && get_field('entry_personal_presentation_photo', $wp_query->query_vars['id'])):
			$personal_presentation_photo = get_field('entry_personal_presentation_photo', $wp_query->query_vars['id']);
		?>
			<label for="existing-personal-presentation-photo">
				Personal presentation <span class="info">(1 photo)</span> 
				<span class="existing-file"><a href="<?php echo $personal_presentation_photo[url]; ?>" target="_blank" class="view"><?php echo $personal_presentation_photo[filename]; ?></a> &nbsp;- &nbsp;<a href="#change-personal-presentation-photo" class="change">Change</a></span>
				<input type="hidden" id="existing-personal-presentation-photo" name="existing_personal_presentation_photo" value="<?php echo $personal_presentation_photo[id]; ?>" />
			</label>
		<?php endif; ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('input[name="personal_presentation_photo"]').on('change', 
				function() {
					$this = jQuery(this);
					jQuery($this).closest('p').find('label .file').html(this.value.replace('C:\\fakepath\\', '') || '');
				}
			);
			jQuery(document).on('click', 'a[href="#change-personal-presentation-photo"]', 
				function(e) {
					e.preventDefault();
					jQuery(this).closest('p').find('label[for="personal-presentation-photo"]').show();
					jQuery(this).closest('p').find('label[for="existing-personal-presentation-photo"]').remove();
					jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					jQuery(this).blur();
				}
			);
		}
	);
</script>
