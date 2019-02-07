<?php
	if($wp_query->query_vars['id']):
		if(get_field('entry_date_of_release', $wp_query->query_vars['id']) != '') {
			$value = date('Y-m-d', strtotime(str_replace('/', '-', get_field('entry_date_of_release', $wp_query->query_vars['id']))));
		} else {
			$value = '';
		}
	endif;
?>
<p> 
	<label for="date-of-release">Date of release <span class="required">*</span></label><br />
	<input type="date" id="date-of-release" name="date_of_release" value="<?php echo $value; ?>" data-required="required" />
</p>