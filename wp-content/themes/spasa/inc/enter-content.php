<?php
	include(ABSPATH.'wp-content/themes/spasa/inc/category/'.sprintf('%02d', $wp_query->query_vars['award_category']).'.php');
	if($_POST):
		set_time_limit(0);
		$uid = str_pad(mt_rand(0,99999999),8,'0',STR_PAD_LEFT);
		$titles = get_post_types(array('name' => 'award-'.sprintf('%02d', $wp_query->query_vars['award_category'])), 'objects');
		foreach ($titles as $title) {
		   $title = str_replace('&', 'and', $title->label);
		}
		$title .= ' - '.$_REQUEST['member_business'].' ('.$uid.')';
		$my_entry = array(
			'post_title' => $title,
			'post_status' => 'publish',
			'post_type' => 'award-'.sprintf('%02d', $wp_query->query_vars['award_category']),
		);
		// Fix arrays		
		function fix_file_array(&$files) {
			$names = array(
				'name' => 1,
				'type' => 1,
				'tmp_name' => 1,
				'error' => 1,
				'size' => 1
			);
			foreach ($files as $key => $part) {
				$key = (string) $key;
				if (isset($names[$key]) && is_array($part)) {
					foreach ($part as $position => $value) {
						$files[$position][$key] = $value;
					}
					unset($files[$key]);
				}
			}
		}
		// Entry info
		$entry_id = wp_insert_post($my_entry);
		update_field('entry_id', $uid, $entry_id);
		foreach($fields as $field => $type) {
			if($type == 'file') {
				if($_REQUEST['existing_'.str_replace('-', '_', $field)]) {
					update_field('entry_'.str_replace('-', '_', $field), $_REQUEST['existing_'.str_replace('-', '_', $field)], $entry_id);
				} elseif($_FILES[str_replace('-', '_', $field)]['size'] != 0) {
					require_once(ABSPATH.'wp-admin/includes/image.php');
					require_once(ABSPATH.'wp-admin/includes/file.php');
					require_once(ABSPATH.'wp-admin/includes/media.php');
					$attachment_id = media_handle_upload(str_replace('-', '_', $field), 0);
					if(!is_wp_error($attachment_id)) {
						update_field('entry_'.str_replace('-', '_', $field), $attachment_id, $entry_id);
					}
				} else {
					update_field('entry_'.str_replace('-', '_', $field), '', $entry_id);
				}
			} elseif($type == 'multifile') {
				if($_REQUEST['existing_'.str_replace('-', '_', $field).'_1']) {
					update_field('entry_'.str_replace('-', '_', $field).'_1', $_REQUEST['existing_'.str_replace('-', '_', $field).'_1'], $entry_id);
					update_field('entry_'.str_replace('-', '_', $field).'_2', $_REQUEST['existing_'.str_replace('-', '_', $field).'_2'], $entry_id);
					update_field('entry_'.str_replace('-', '_', $field).'_3', $_REQUEST['existing_'.str_replace('-', '_', $field).'_3'], $entry_id);
					update_field('entry_'.str_replace('-', '_', $field).'_4', $_REQUEST['existing_'.str_replace('-', '_', $field).'_4'], $entry_id);
					update_field('entry_'.str_replace('-', '_', $field).'_5', $_REQUEST['existing_'.str_replace('-', '_', $field).'_5'], $entry_id);
				} elseif($_FILES[str_replace('-', '_', $field)]['size'][0] != 0) {
					require_once(ABSPATH.'wp-admin/includes/image.php');
					require_once(ABSPATH.'wp-admin/includes/file.php');
					require_once(ABSPATH.'wp-admin/includes/media.php');
					fix_file_array($_FILES[str_replace('-', '_', $field)]);
					$i = 0;
					foreach($_FILES[str_replace('-', '_', $field)] as $file => $fileitem) {
						$i++;
						$attachment_id = media_handle_sideload($fileitem, 0);
						update_field('entry_'.str_replace('-', '_', $field).'_'.$i, $attachment_id, $entry_id);
					}
				}
			} elseif($type == 'checkbox') {
				if($_REQUEST[str_replace('-', '_', $field)] == 'yes') {
					update_field('entry_'.str_replace('-', '_', $field), 'yes', $entry_id);
				} else {
					update_field('entry_'.str_replace('-', '_', $field), 'no', $entry_id);
				}
			} elseif($type == 'project') {
				// Get number
				$num = str_replace('project-', '', $field);
				// Create variables
				$project_name = $_REQUEST['project_name_'.$num];
				$project_date = $_REQUEST['project_date_'.$num];
				$architect_designer_home_builder = $_REQUEST['architect_designer_home_builder_'.$num];
				if($_REQUEST['resident_owner_declaration_'.$num] == 'yes') {
					$resident_owner_declaration = 'yes';
				} else {
					$resident_owner_declaration = 'no';
				}
				if($_REQUEST['existing_main_photo_'.$num]) {
					$main_photo = $_REQUEST['existing_main_photo_'.$num];
				} elseif($_FILES['main_photo_'.$num]['size'] != 0) {
					require_once(ABSPATH.'wp-admin/includes/image.php');
					require_once(ABSPATH.'wp-admin/includes/file.php');
					require_once(ABSPATH.'wp-admin/includes/media.php');
					$attachment_id = media_handle_upload('main_photo_'.$num, 0);
					if(!is_wp_error($attachment_id)) {
						$main_photo = $attachment_id;
					} else {
						$main_photo = '';
					}
				} else {
					$main_photo = '';
				}
				$overview_description = $_REQUEST['overview_description_'.$num];
				$promotional_blurb = $_REQUEST['promotional_blurb_'.$num];
				// Create array from variables
				$project = array(
					'entry_project_name_'.$num => "$project_name",
					'entry_project_date_'.$num => "$project_date",
					'entry_architect_designer_home_builder_'.$num => "$architect_designer_home_builder",
					'entry_resident_owner_declaration_'.$num => "$resident_owner_declaration",
					'entry_main_photo_'.$num => "$main_photo",
					'entry_overview_description_'.$num => "$overview_description",
					'entry_promotional_blurb_'.$num => "$promotional_blurb"
				);
				update_field('entry_projects', $project, $entry_id);
			} else {
				update_field('entry_'.str_replace('-', '_', $field), $_REQUEST[str_replace('-', '_', $field)], $entry_id);
			}
		}
		// Member info
		update_field('entry_member_id', $_REQUEST['member_id'], $entry_id);
		update_field('entry_member_name', $_REQUEST['member_name'], $entry_id);
		update_field('entry_member_business', $_REQUEST['member_business'], $entry_id);
		update_field('entry_member_address', $_REQUEST['member_address'], $entry_id);
		update_field('entry_member_email', $_REQUEST['member_email'], $entry_id);
		update_field('entry_member_telephone', $_REQUEST['member_telephone'], $entry_id);
		update_field('entry_member_website', $_REQUEST['member_website'], $entry_id);
		// Payment info
		update_field('entry_first_cost', get_field('first_entry_cost_'.$wp_query->query_vars['award_category'], 'options'), $entry_id);
		update_field('entry_further_cost', get_field('further_entry_cost_'.$wp_query->query_vars['award_category'], 'options'), $entry_id);
		// Entry status
		update_field('entry_status', $_REQUEST['entry_status'], $entry_id);
		update_field('entry_paid', 'No', $entry_id);
		// Redirect
		header('Location: '.get_bloginfo('url').'/dashboard/');
		exit();
	else:
?>
	<div class="content center">
		<div class="main narrow">
			<?php get_template_part('inc/lightbox-select-entry'); ?>
			<form action="" method="post" enctype="multipart/form-data" class="entry-form">
				<?php
					get_template_part('inc/fields/member-details');
					foreach($fields as $field => $type) {
						if($field != 'id') {
							get_template_part('inc/fields/'.$field);
						}
					}
					get_template_part('inc/fields/entry-status');
				?>
			</form>
		</div>
		<div class="sidebar">
			<?php get_template_part('inc/banners-side'); ?>
		</div>
	</div>
<?php endif; ?>