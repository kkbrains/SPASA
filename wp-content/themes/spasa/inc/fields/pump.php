<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_pump', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="pump">Pump</label><br />
	<input type="text" id="pump" name="pump" value="<?php echo $value; ?>" />
</p>
