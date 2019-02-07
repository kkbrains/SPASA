<?php
	if($wp_query->query_vars['id']):
		$value = str_ireplace(array('<br />','<br>','<br/>'), '', get_field('entry_presentation_service_fleet', $wp_query->query_vars['id']));
	endif;
?>
<p> 
	<label for="presentation-service-fleet">Presentation of service fleet / van <span class="info">(description if applicable)</span></label><br />
	<textarea id="presentation-service-fleet" name="presentation_service_fleet"><?php echo $value; ?></textarea>
</p>