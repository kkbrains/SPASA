<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_coping_materials', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="coping-materials">Coping materials <span class="required">*</span></label><br />
	<input type="text" id="coping-materials" name="coping_materials" value="<?php echo $value; ?>" data-required="required" />
</p>
