<?php
	if($wp_query->query_vars['id']):
		if(get_field('entry_date_of_campaign_commencement', $wp_query->query_vars['id']) != '') {
			$value = date('Y-m-d', strtotime(str_replace('/', '-', get_field('entry_date_of_campaign_commencement', $wp_query->query_vars['id']))));
		} else {
			$value = '';
		}
	endif;
?>
<p> 
	<label for="date-of-campaign-commencement">Date of campaign commencement <span class="required">*</span></label><br />
	<input type="date" id="date-of-campaign-commencement" name="date_of_campaign_commencement" value="<?php echo $value; ?>" data-required="required" />
</p>