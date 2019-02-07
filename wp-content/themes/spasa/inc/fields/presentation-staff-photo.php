<div class="file-uploads">
	<p>
		<label for="presentation-staff-photo" <?php if($wp_query->query_vars['id'] && get_field('entry_presentation_staff_photo', $wp_query->query_vars['id'])): ?>style="display: none;"<?php endif; ?>>
			Presentation of staff <span class="info">(1 photo)</span> <span class="required">*</span>
			<span class="file"></span>
			<input type="file" id="presentation-staff-photo" name="presentation_staff_photo" accept=".jpg,.jpeg,.gif,.png" multiple="false" data-required="required" />
			<span class="smalltext">Accepted file types: jpg, gif or png)</span>
		</label>
		<?php
			if($wp_query->query_vars['id'] && get_field('entry_presentation_staff_photo', $wp_query->query_vars['id'])):
			$presentation_staff_photo = get_field('entry_presentation_staff_photo', $wp_query->query_vars['id']);
		?>
			<label for="existing-presentation-staff-photo">
				Presentation of staff <span class="info">(1 photo)</span> <span class="required">*</span> 
				<span class="existing-file"><a href="<?php echo $presentation_staff_photo[url]; ?>" target="_blank" class="view"><?php echo $presentation_staff_photo[filename]; ?></a> &nbsp;- &nbsp;<a href="#change-presentation-staff-photo" class="change">Change</a></span>
				<input type="hidden" id="existing-presentation-staff-photo" name="existing_presentation_staff_photo" value="<?php echo $presentation_staff_photo[id]; ?>" />
			</label>
		<?php endif; ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('input[name="presentation_staff_photo"]').on('change', 
				function() {
					$this = jQuery(this);
					jQuery($this).closest('p').find('label .file').html(this.value.replace('C:\\fakepath\\', '') || '');
				}
			);
			jQuery(document).on('click', 'a[href="#change-presentation-staff-photo"]', 
				function(e) {
					e.preventDefault();
					jQuery(this).closest('p').find('label[for="presentation-staff-photo"]').show();
					jQuery(this).closest('p').find('label[for="existing-presentation-staff-photo"]').remove();
					jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					jQuery(this).blur();
				}
			);
		}
	);
</script>
