<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_chlorinator', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="chlorinator">Chlorinator</label><br />
	<input type="text" id="chlorinator" name="chlorinator" value="<?php echo $value; ?>" />
</p>
