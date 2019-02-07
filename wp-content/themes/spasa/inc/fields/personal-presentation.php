<?php
	if($wp_query->query_vars['id']):
		$value = str_ireplace(array('<br />','<br>','<br/>'), '', get_field('entry_personal_presentation', $wp_query->query_vars['id']));
	endif;
?>
<p> 
	<label for="personal-presentation">Personal presentation <span class="info">(description)</span></label><br />
	<textarea id="personal-presentation" name="personal_presentation"><?php echo $value; ?></textarea>
</p>