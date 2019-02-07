<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_type_cleaner', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="type-cleaner">Type of cleaner <span class="info">(e.g. Suction, Robotic, In-floor etc.)</span></label><br />
	<input type="text" id="type-cleaner" name="type_cleaner" value="<?php echo $value; ?>" />
</p>
