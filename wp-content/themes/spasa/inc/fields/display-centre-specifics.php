<?php
	if($wp_query->query_vars['id']):
		$value = str_ireplace(array('<br />','<br>','<br/>'), '', get_field('entry_display_centre_specifics', $wp_query->query_vars['id']));
	endif;
?>
<p> 
	<label for="display-centre-specifics">Display centre specifics <span class="required">*</span></label><br />
	<textarea id="display-centre-specifics" name="display_centre_specifics" data-required="required"><?php echo $value; ?></textarea>
</p>

