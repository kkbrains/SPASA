<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_internal_finish', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="internal-finish">Internal finish <span class="required">*</span></label><br />
	<input type="text" id="internal-finish" name="internal_finish" value="<?php echo $value; ?>" data-required="required" />
</p>
