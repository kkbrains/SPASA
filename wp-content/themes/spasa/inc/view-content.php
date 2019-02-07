<div class="content center">
	<?php
		include_once(ABSPATH.'wp-content/themes/spasa/inc/category/'.str_replace('award-', '', $post->name).'.php');
		$review_fields = array(
			'main-photo',
			'supporting-photos',
			'primary-image'
		);
		$winner_fields = array(
			'main-photo',
			'supporting-photos',
			'primary-image',
			'company-logo'
		);
		if(is_user_logged_in()) {
			$user = wp_get_current_user();
			$role = (array) $user->roles;
			if(in_array('judge', $role)) {
				// Judge
				get_template_part('inc/view/entry-id');
				foreach($fields as $field => $type) {
					get_template_part('inc/view/'.$field);
				}
				if(get_field('site_status', options) == '3') {
					get_template_part('inc/judge-score');
				}
			} else {
				if(get_field('site_status', options) == '1') {
					if(get_current_user_id() == get_field('entry_member_id')) {
						// Review own
						foreach($fields as $field => $type) {
							get_template_part('inc/view/'.$field);
						}
					} else {
						header('Location: '.get_bloginfo('url'));
						exit();
					}
				} elseif(get_field('site_status', options) == '2') {
					get_template_part('inc/view/entry-id');
					if(get_current_user_id() == get_field('entry_member_id')) {
						// Review own
						foreach($fields as $field => $type) {
							get_template_part('inc/view/'.$field);
						}
					} else {
						// Review other
						foreach($fields as $field => $type) {
							if(in_array($field, $review_fields)) {
								get_template_part('inc/view/'.$field);
							}
						}
					}
				} elseif(get_field('site_status', options) == '4') {
					get_template_part('inc/view/contact-details');
					get_template_part('inc/view/entry-id');
					if(get_current_user_id() == get_field('entry_member_id')) {
						// Winner own
						foreach($fields as $field => $type) {
							get_template_part('inc/view/'.$field);
						}
					} else {
						// Winner other
						foreach($fields as $field => $type) {
							if(in_array($field, $winner_fields)) {
								get_template_part('inc/view/'.$field);
							}
						}
					}
				} else {
					header('Location: '.get_bloginfo('url'));
					exit();
				}
			}
		} else {
			if(get_field('site_status', options) == '2') {
				// Review
				get_template_part('inc/view/entry-id');
				foreach($fields as $field => $type) {
					if(in_array($field, $review_fields)) {
						get_template_part('inc/view/'.$field);
					}
				}
			} elseif(get_field('site_status', options) == '4') {
				// Winner
				get_template_part('inc/view/contact-details');
				get_template_part('inc/view/entry-id');
				foreach($fields as $field => $type) {
					if(in_array($field, $winner_fields)) {
						get_template_part('inc/view/'.$field);
					}
				}
			} else {
				header('Location: '.get_bloginfo('url'));
				exit();
			}
		}
		
	?>
</div>
