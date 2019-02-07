<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_sanitation', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="sanitation">Sanitation <span class="info">(e.g. Chlorine, Mineral, UV etc.)</span></label><br />
	<input type="text" id="sanitation" name="sanitation" value="<?php echo $value; ?>" />
</p>
