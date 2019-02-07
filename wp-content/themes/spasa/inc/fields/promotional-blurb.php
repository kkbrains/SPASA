<?php
	if($wp_query->query_vars['id']):
		$value = str_ireplace(array('<br />','<br>','<br/>'), '', get_field('entry_promotional_blurb', $wp_query->query_vars['id']));
	endif;
?>
<p> 
	<label for="promotional-blurb">Promotional blurb <span class="info">(50 words)</span> <span class="required">*</span></label><br />
	<textarea id="promotional-blurb" name="promotional_blurb" class="small" maxlength="500" data-required="required"><?php echo $value; ?></textarea>
	<span class="smalltext">NB: This blurb will be used in external magazines and for promotional purposes aimed at consumers. Please take this into consideration when composing your blurb</span>
</p>
