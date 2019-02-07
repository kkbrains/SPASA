<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_resident_owner_declaration', $wp_query->query_vars['id']);
	endif;
?>
<p> 
	<label for="resident-owner-declaration" class="checkbox">
		<input type="checkbox" id="resident-owner-declaration" name="resident_owner_declaration" value="yes" data-required="required" <?php if($value == 'yes'): ?> checked="checked"<?php endif; ?> >
		Resident / Owner have given permission <span class="required">*</span> <span class="marker"></span>
	</label>
</p>
