<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_price', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="price">Price <span class="required">*</span></label><br />
	<input type="text" id="price" name="price" value="<?php echo $value; ?>" data-required="required" />
</p>
