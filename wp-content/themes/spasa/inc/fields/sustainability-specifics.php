<?php
	if($wp_query->query_vars['id']):
		$value = str_ireplace(array('<br />','<br>','<br/>'), '', get_field('entry_sustainability_specifics', $wp_query->query_vars['id']));
	endif;
?>
<p> 
	<label for="sustainability-specifics">Sustainability specifics <span class="required">*</span></label><br />
	<textarea id="sustainability-specifics" name="sustainability_specifics" data-required="required"><?php echo $value; ?></textarea>
</p>

