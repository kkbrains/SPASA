<?php
	if($wp_query->query_vars['id']):
		$value = str_ireplace(array('<br />','<br>','<br/>'), '', get_field('entry_background', $wp_query->query_vars['id']));
	endif;
?>
<p> 
	<label for="background">Background <span class="required">*</span></label><br />
	<textarea id="background" name="background" data-required="required"><?php echo $value; ?></textarea>
</p>