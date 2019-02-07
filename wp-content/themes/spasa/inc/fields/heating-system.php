<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_heating_system', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="heating-system">Heating system</label><br />
	<input type="text" id="heating-system" name="heating_system" value="<?php echo $value; ?>" />
</p>
