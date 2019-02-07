<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_business', $wp_query->query_vars['id']);
	endif;
	if($value == ''):
		$member = wp_get_current_user();
		$value = $member->member_business;
	endif;
?>
<p> 
	<label for="business">Member business name <span class="required">*</span></label><br />
	<input type="text" id="business" name="business" value="<?php echo $value; ?>" data-required="required" />
</p>
