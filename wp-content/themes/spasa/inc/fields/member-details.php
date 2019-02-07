<?php $member = wp_get_current_user(); ?>
<input type="hidden" name="member_name" value="<?php echo $member->display_name; ?>" />
<input type="hidden" name="member_id" value="<?php echo $member->ID; ?>" />
<input type="hidden" name="member_business" value="<?php echo get_user_meta($member->ID, 'member_business', true); ?>" />
<input type="hidden" name="member_address" value="<?php 
	echo get_user_meta($member->ID, 'member_address_line_1', true).', '; 
	if(get_user_meta($member->ID, 'member_address_line_2', true) != '') {
		echo get_user_meta($member->ID, 'member_address_line_2', true).', '; 
	}
	echo get_user_meta($member->ID, 'member_city', true).', '; 
	echo get_user_meta($member->ID, 'member_state', true).', '; 
	echo get_user_meta($member->ID, 'member_country', true).', '; 
	echo get_user_meta($member->ID, 'member_postcode', true); 
?>" />
<input type="hidden" name="member_email" value="<?php echo $member->user_email; ?>" />
<input type="hidden" name="member_telephone" value="<?php echo get_user_meta($member->ID, 'member_telephone', true); ?>" />
<input type="hidden" name="member_website" value="<?php echo get_user_meta($member->ID, 'member_website', true); ?>" />
