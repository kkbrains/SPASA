<?php
	if($wp_query->query_vars['id']):
		$value = str_ireplace(array('<br />','<br>','<br/>'), '', get_field('entry_innovation_specifics', $wp_query->query_vars['id']));
	endif;
?>
<p> 
	<label for="innovation-specifics">Innovation specifics <span class="required">*</span></label><br />
	<textarea id="innovation-specifics" name="innovation_specifics" data-required="required"><?php echo $value; ?></textarea>
</p>

