<?php
	if($wp_query->query_vars['id']):
		$value = str_ireplace(array('<br />','<br>','<br/>'), '', get_field('entry_service_vehicle', $wp_query->query_vars['id']));
	endif;
?>
<p> 
	<label for="service-vehicle">Service vehicle <span class="info">(description)</span></label><br />
	<textarea id="service-vehicle" name="service_vehicle"><?php echo $value; ?></textarea>
</p>