<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_length', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="length">Length <span class="required">*</span></label><br />
	<input type="text" id="length" name="length" value="<?php echo $value; ?>" data-required="required" />
</p>
