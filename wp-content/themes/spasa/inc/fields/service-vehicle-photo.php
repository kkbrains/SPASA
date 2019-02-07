<div class="file-uploads">
	<p>
		<label for="service-vehicle-photo" <?php if($wp_query->query_vars['id'] && get_field('entry_service_vehicle_photo', $wp_query->query_vars['id'])): ?>style="display: none;"<?php endif; ?>>
			Service vehicle <span class="info">(1 photo)</span>
			<span class="file"></span>
			<input type="file" id="service-vehicle-photo" name="service_vehicle_photo" accept=".jpg,.jpeg" multiple="false" />
			<span class="smalltext">Accepted file types: jpg)</span>
		</label>
		<?php
			if($wp_query->query_vars['id'] && get_field('entry_service_vehicle_photo', $wp_query->query_vars['id'])):
			$service_vehicle_photo = get_field('entry_service_vehicle_photo', $wp_query->query_vars['id']);
		?>
			<label for="existing-service-vehicle-photo">
				Service vehicle <span class="info">(1 photo)</span> 
				<span class="existing-file"><a href="<?php echo $service_vehicle_photo[url]; ?>" target="_blank" class="view"><?php echo $service_vehicle_photo[filename]; ?></a> &nbsp;- &nbsp;<a href="#change-service-vehicle-photo" class="change">Change</a></span>
				<input type="hidden" id="existing-service-vehicle-photo" name="existing_service_vehicle_photo" value="<?php echo $service_vehicle_photo[id]; ?>" />
			</label>
		<?php endif; ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('input[name="service_vehicle_photo"]').on('change', 
				function() {
					$this = jQuery(this);
					jQuery($this).closest('p').find('label .file').html(this.value.replace('C:\\fakepath\\', '') || '');
				}
			);
			jQuery(document).on('click', 'a[href="#change-service-vehicle-photo"]', 
				function(e) {
					e.preventDefault();
					jQuery(this).closest('p').find('label[for="service-vehicle-photo"]').show();
					jQuery(this).closest('p').find('label[for="existing-service-vehicle-photo"]').remove();
					jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					jQuery(this).blur();
				}
			);
		}
	);
</script>
