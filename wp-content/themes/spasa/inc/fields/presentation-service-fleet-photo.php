<div class="file-uploads">
	<p>
		<label for="presentation-service-fleet-photo" <?php if($wp_query->query_vars['id'] && get_field('entry_presentation_service_fleet_photo', $wp_query->query_vars['id'])): ?>style="display: none;"<?php endif; ?>>
			Presentation of service fleet / van <span class="info">(1 photo if applicable)</span>
			<span class="file"></span>
			<input type="file" id="presentation-service-fleet-photo" name="presentation_service_fleet_photo" accept=".jpg,.jpeg,.gif,.png" multiple="false" />
			<span class="smalltext">Accepted file types: jpg, gif or png)</span>
		</label>
		<?php
			if($wp_query->query_vars['id'] && get_field('entry_presentation_service_fleet_photo', $wp_query->query_vars['id'])):
			$presentation_service_fleet_photo = get_field('entry_presentation_service_fleet_photo', $wp_query->query_vars['id']);
		?>
			<label for="existing-presentation-service-fleet-photo">
				Presentation of service fleet / van <span class="info">(1 photo if applicable)</span> 
				<span class="existing-file"><a href="<?php echo $presentation_service_fleet_photo[url]; ?>" target="_blank" class="view"><?php echo $presentation_service_fleet_photo[filename]; ?></a> &nbsp;- &nbsp;<a href="#change-presentation-service-fleet-photo" class="change">Change</a></span>
				<input type="hidden" id="existing-presentation-service-fleet-photo" name="existing_presentation_service_fleet_photo" value="<?php echo $presentation_service_fleet_photo[id]; ?>" />
			</label>
		<?php endif; ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('input[name="presentation_service_fleet_photo"]').on('change', 
				function() {
					$this = jQuery(this);
					jQuery($this).closest('p').find('label .file').html(this.value.replace('C:\\fakepath\\', '') || '');
				}
			);
			jQuery(document).on('click', 'a[href="#change-presentation-service-fleet-photo"]', 
				function(e) {
					e.preventDefault();
					jQuery(this).closest('p').find('label[for="presentation-service-fleet-photo"]').show();
					jQuery(this).closest('p').find('label[for="existing-presentation-service-fleet-photo"]').remove();
					jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					jQuery(this).blur();
				}
			);
		}
	);
</script>
