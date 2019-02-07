<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_photographer', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="photographer">Photographer <span class="required">*</span></label><br />
	<input type="text" id="photographer" name="photographer" value="<?php echo $value; ?>" data-required="required" />
</p>
