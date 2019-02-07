<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_project_name', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="project-name">Project name <span class="required">*</span></label><br />
	<input type="text" id="project-name" name="project_name" value="<?php echo $value; ?>" data-required="required" />
</p>
