<?php
	if($wp_query->query_vars['id']):
		if(get_field('entry_project_date', $wp_query->query_vars['id']) != '') {
			$value = date('Y-m-d', strtotime(str_replace('/', '-', get_field('entry_project_date', $wp_query->query_vars['id']))));
		} else {
			$value = '';
		}
	endif;
?>
<p> 
	<label for="project-date">Project date <span class="required">*</span></label><br />
	<input type="date" id="project-date" name="project_date" value="<?php echo $value; ?>" data-required="required" />
</p>
