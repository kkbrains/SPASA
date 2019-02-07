<?php if($wp_query->query_vars['id']): ?>
	<p> 
		<label for="state">State <span class="required">*</span></label><br />
		<select id="state" name="state" data-required="required">
			<option value=""> </option>
			<option value="New South Wales"<?php if(get_field('entry_state', $wp_query->query_vars['id']) == 'New South Wales'): ?> selected="selected"<?php endif; ?>>New South Wales</option>
			<option value="South Australia"<?php if(get_field('entry_state', $wp_query->query_vars['id']) == 'South Australia'): ?> selected="selected"<?php endif; ?>>South Australia</option>
			<option value="Queensland"<?php if(get_field('entry_state', $wp_query->query_vars['id']) == 'Queensland'): ?> selected="selected"<?php endif; ?>>Queensland</option>
			<option value="Victoria"<?php if(get_field('entry_state', $wp_query->query_vars['id']) == 'Victoria'): ?> selected="selected"<?php endif; ?>>Victoria</option>
			<option value="Western Australia"<?php if(get_field('entry_state', $wp_query->query_vars['id']) == 'Western Australia'): ?> selected="selected"<?php endif; ?>>Western Australia</option>
		</select>
	</p>
<?php else: ?>
	<?php $member = wp_get_current_user(); ?>
	<p> 
		<label for="state">State <span class="required">*</span></label><br />
		<select id="state" name="state" data-required="required">
			<option value=""> </option>
			<option value="New South Wales"<?php if(get_user_meta($member->ID, 'member_state_awards', true) == 'New South Wales'): ?> selected="selected"<?php endif; ?>>New South Wales</option>
			<option value="South Australia"<?php if(get_user_meta($member->ID, 'member_state_awards', true) == 'South Australia'): ?> selected="selected"<?php endif; ?>>South Australia</option>
			<option value="Queensland"<?php if(get_user_meta($member->ID, 'member_state_awards', true) == 'Queensland'): ?> selected="selected"<?php endif; ?>>Queensland</option>
			<option value="Victoria"<?php if(get_user_meta($member->ID, 'member_state_awards', true) == 'Victoria'): ?> selected="selected"<?php endif; ?>>Victoria</option>
			<option value="Western Australia"<?php if(get_user_meta($member->ID, 'member_state_awards', true) == 'Western Australia'): ?> selected="selected"<?php endif; ?>>Western Australia</option>
		</select>
	</p>
<?php endif; ?>
