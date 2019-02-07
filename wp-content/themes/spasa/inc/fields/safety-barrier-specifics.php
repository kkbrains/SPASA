<?php
	if($wp_query->query_vars['id']):
		$value = str_ireplace(array('<br />','<br>','<br/>'), '', get_field('entry_safety_barrier_specifics', $wp_query->query_vars['id']));
	endif;
?>
<p> 
	<label for="safety-barrier-specifics">Safety barrier specifics <span class="required">*</span></label><br />
	<textarea id="safety-barrier-specifics" name="safety_barrier_specifics" data-required="required"><?php echo $value; ?></textarea>
</p>

