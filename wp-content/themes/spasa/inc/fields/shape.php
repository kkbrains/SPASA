<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_shape', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="shape">Shape <span class="info">(e.g. Geometric, Traditional, Freeform, Kidney etc.)</span> <span class="required">*</span></label><br />
	<input type="text" id="shape" name="shape" value="<?php echo $value; ?>" data-required="required" />
</p>
