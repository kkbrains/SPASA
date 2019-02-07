<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_other_equipment_accessories', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="other-equipment-accessories">Other equipment or accessories</label><br />
	<input type="text" id="other-equipment-accessories" name="other_equipment_accessories" value="<?php echo $value; ?>" />
</p>
