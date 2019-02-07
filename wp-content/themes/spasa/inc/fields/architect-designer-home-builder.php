<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_architect_designer_home_builder', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="architect-designer-home-builder">Architect / Designer / Home builder  <span class="required">*</span></label><br />
	<input type="text" id="architect-designer-home-builder" name="architect_designer_home_builder" value="<?php echo $value; ?>" data-required="required" />
</p>
