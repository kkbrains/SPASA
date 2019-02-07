<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_filter', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="filter">Filter</label><br />
	<input type="text" id="filter" name="filter" value="<?php echo $value; ?>" />
</p>
