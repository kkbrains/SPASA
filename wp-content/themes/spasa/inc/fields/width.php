<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_width', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="width">Width <span class="required">*</span></label><br />
	<input type="text" id="width" name="width" value="<?php echo $value; ?>" data-required="required" />
</p>
