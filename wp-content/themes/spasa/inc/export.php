<?php
	$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
	require_once($parse_uri[0].'wp-load.php');
	if(is_user_logged_in()) {
		$user = wp_get_current_user();
		$role = (array) $user->roles;
		if(in_array('administrator', $role)) {
			$args = array(
			   'public'   => true,
			   '_builtin' => false
			);
			$output = 'names';
			$operator = 'and';
			$post_types = get_post_types($args,$output,$operator);
			if($post_types) {
				header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="SPASA Awards Entries.csv"');
				header('Pragma: no-cache');
				header('Expires: 0');
				$file = fopen('php://output', 'w');
				fputcsv(
					$file, array(
					'Category', 
					'State', 
					'ID', 
					'Status', 
					'Member name', 
					'Member business', 
					'Member address', 
					'Member email', 
					'Member telephone', 
					'Member website', 
					'Paid/unpaid', 
					'Order number', 
					'Order date', 
					'Average score', 
					'Achievements', 
					'Architect / designer / home builder', 
					'Background', 
					'Before photo', 
					'Business name', 
					'Chlorinator', 
					'Client testimonials', 
					'Communication skills', 
					'Company logo', 
					'Compliance', 
					'Coping materials', 
					'Customer service', 
					'Date of campaign commencement', 
					'Date of release', 
					'Description', 
					'Display centre specifics', 
					'Education training qualifications', 
					'Filter', 
					'Heating system', 
					'Innovation specifics', 
					'Internal finish', 
					'Length', 
					'Main photo', 
					'Marketing', 
					'Marketing material', 
					'Other equipment accessories', 
					'Personal presentation', 
					'Personal presentation (photo)', 
					'Photographer', 
					'Portfolio', 
					'Presentation service fleet', 
					'Presentation service fleet (photo)', 
					'Presentation staff', 
					'Presentation staff (photo)', 
					'Presentation store', 
					'Presentation store (photo)', 
					'Price', 
					'Primary image', 
					'Problem solving', 
					'Product data sheet', 
					'Project 1 - Project name', 
					'Project 1 - Project date', 
					'Project 1 - Architect / designer / home builder', 
					'Project 1 - Resident / owner declaration', 
					'Project 1 - Main photo', 
					'Project 1 - Overview / Description of works', 
					'Project 1 - Promotional blurb', 
					'Project 2 - Project name', 
					'Project 2 - Project date', 
					'Project 2 - Architect / designer / home builder', 
					'Project 2 - Resident / owner declaration', 
					'Project 2 - Main photo', 
					'Project 2 - Overview / Description of works', 
					'Project 2 - Promotional blurb', 
					'Project 3 - Project name', 
					'Project 3 - Project date', 
					'Project 3 - Architect / designer / home builder', 
					'Project 3 - Resident / owner declaration', 
					'Project 3 - Main photo', 
					'Project 3 - Overview / Description of works', 
					'Project 3 - Promotional blurb', 
					'Project 4 - Project name', 
					'Project 4 - Project date', 
					'Project 4 - Architect / designer / home builder', 
					'Project 4 - Resident / owner declaration', 
					'Project 4 - Main photo', 
					'Project 4 - Overview / Description of works', 
					'Project 4 - Promotional blurb', 
					'Project 5 - Project name', 
					'Project 5 - Project date', 
					'Project 5 - Architect / designer / home builder', 
					'Project 5 - Resident / owner declaration', 
					'Project 5 - Main photo', 
					'Project 5 - Overview / Description of works', 
					'Project 5 - Promotional blurb', 
					'Project date', 
					'Project name', 
					'Promotional blurb', 
					'Pump', 
					'Range of products / services', 
					'Resident / owner declaration', 
					'Safety barrier specifics', 
					'Sanitation', 
					'Service vehicle', 
					'Service vehicle (photo)', 
					'Shape', 
					'Standards & regulations knowledge', 
					'Supporting photo 1', 
					'Supporting photo 2', 
					'Supporting photo 3', 
					'Supporting photo 4', 
					'Supporting photo 5', 
					'Sustainability specifics', 
					'Type of cleaner', 
					'Width'
					)
				);
				$data = array();
				foreach($post_types as $post_type) {
					$args = array(
						'post_type' => $post_type,
						'orderby' => 'title',
						'order' => 'ASC',
						'posts_per_page' => -1
					);
					$the_query = new WP_Query($args);
					if($the_query->have_posts()) {
						while($the_query->have_posts()) {
							$the_query->the_post();
							$category = get_post_type_object($post_type)->label;
							$state = get_field('entry_state');
							$entry_id = get_field('entry_id');
							$status = get_field('entry_status');
							$member_name = get_field('entry_member_name');
							$member_business = get_field('entry_member_business');
							$member_address = get_field('entry_member_address');
							$member_email = get_field('entry_member_email');
							$member_telephone = get_field('entry_member_telephone');
							$member_website = get_field('entry_member_website');
							$payment_status = 'Unpaid';
							if(get_field('entry_paid') == 'Yes') {
								$payment_status = 'Paid';
							}
							$order_number = get_field('entry_order_number');
							$order_date = get_field('entry_order_date');
							$average_score = '';
							if(get_field('entry_average_score') != '') {
								$average_score = number_format((float)get_field('entry_average_score'), 2, '.', '').'%';
							}
							$achievements = '';
							if(get_field('entry_achievements') != '') {
								$achievements = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_achievements'));
							}
							$architect_designer_home_builder = get_field('entry_architect_designer_home_builder');
							$background = '';
							if(get_field('entry_background') != '') {
								$background = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_background'));
							}
							$before_photo = '';
							if(get_field('entry_before_photo') != '') {
								$id = get_field('entry_before_photo');
								$src = wp_get_attachment_image_src($id[ID], full);
								$before_photo = $src[0];
							}
							$business = get_field('entry_business');
							$chlorinator = get_field('entry_chlorinator');
							$client_testimonials = '';
							if(get_field('entry_client_testimonials') != '') {
								$id = get_field('entry_client_testimonials');
								$client_testimonials = $id[url];
							}
							$communication_skills = '';
							if(get_field('entry_communication_skills') != '') {
								$communication_skills = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_communication_skills'));
							}
							$company_logo = '';
							if(get_field('entry_company_logo') != '') {
								$id = get_field('entry_company_logo');
								$src = wp_get_attachment_image_src($id[ID], full);
								$company_logo = $src[0];
							}
							$compliance = '';
							if(get_field('entry_compliance') != '') {
								$compliance = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_compliance'));
							}
							$coping_materials = get_field('entry_coping_materials');
							$customer_service = '';
							if(get_field('entry_customer_service') != '') {
								$customer_service = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_customer_service'));
							}
							$date_of_campaign_commencement = get_field('entry_date_of_campaign_commencement');
							$date_of_releas = get_field('entry_date_of_release');
							$description = '';
							if(get_field('entry_description') != '') {
								$description = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_description'));
							}
							$display_centre_specifics = '';
							if(get_field('entry_display_centre_specifics') != '') {
								$display_centre_specifics = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_display_centre_specifics'));
							}
							$education_training_qualifications = '';
							if(get_field('entry_education_training_qualifications') != '') {
								$education_training_qualifications = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_education_training_qualifications'));
							}
							$filter = get_field('entry_filter');
							$heating_system = get_field('entry_heating_system');
							$innovation_specifics = '';
							if(get_field('entry_innovation_specifics') != '') {
								$innovation_specifics = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_innovation_specifics'));
							}
							$internal_finish = get_field('entry_internal_finish');
							$length = get_field('entry_length');
							$main_photo = '';
							if(get_field('entry_main_photo') != '') {
								$id = get_field('entry_main_photo');
								$src = wp_get_attachment_image_src($id[ID], full);
								$main_photo = $src[0];
							}
							$entry_marketing = '';
							if(get_field('entry_marketing') != '') {
								$marketing = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_marketing'));
							}
							$marketing_material = '';
							if(get_field('entry_marketing_material') != '') {
								$id = get_field('entry_marketing_material');
								$marketing_material = $id[url];
							}
							$other_equipment_accessories = get_field('entry_other_equipment_accessories');
							$personal_presentation = '';
							if(get_field('entry_personal_presentation') != '') {
								$personal_presentation = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_personal_presentation'));
							}
							$personal_presentation_photo = '';
							if(get_field('entry_personal_presentation_photo') != '') {
								$id = get_field('entry_personal_presentation_photo');
								$src = wp_get_attachment_image_src($id[ID], full);
								$personal_presentation_photo = $src[0];
							}
							$photographer = get_field('entry_photographer');
							$portfolio = '';
							if(get_field('entry_portfolio') != '') {
								$id = get_field('entry_portfolio');
								$portfolio = $id[url];
							}
							$presentation_service_fleet = '';
							if(get_field('entry_presentation_service_fleet') != '') {
								$presentation_service_fleet = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_presentation_service_fleet'));
							}
							$presentation_service_fleet_photo = '';
							if(get_field('entry_presentation_service_fleet_photo') != '') {
								$id = get_field('entry_presentation_service_fleet_photo');
								$src = wp_get_attachment_image_src($id[ID], full);
								$presentation_service_fleet_photo = $src[0];
							}
							$presentation_staff = '';
							if(get_field('entry_presentation_staff') != '') {
								$presentation_staff = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_presentation_staff'));
							}
							$presentation_staff_photo = '';
							if(get_field('entry_presentation_staff_photo') != '') {
								$id = get_field('entry_presentation_staff_photo');
								$src = wp_get_attachment_image_src($id[ID], full);
								$presentation_staff_photo = $src[0];
							}
							$presentation_store = '';
							if(get_field('entry_presentation_store') != '') {
								$presentation_store = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_presentation_store'));
							}
							$presentation_store_photo = '';
							if(get_field('entry_presentation_store_photo') != '') {
								$id = get_field('entry_presentation_store_photo');
								$src = wp_get_attachment_image_src($id[ID], full);
								$presentation_store_photo = $src[0];
							}
							$price = get_field('entry_price');
							$primary_image = '';
							if(get_field('entry_primary_image') != '') {
								$id = get_field('entry_primary_image');
								$src = wp_get_attachment_image_src($id[ID], full);
								$primary_image = $src[0];
							}
							$problem_solving = '';
							if(get_field('entry_problem_solving') != '') {
								$problem_solving = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_problem_solving'));
							}
							$product_data_sheet = '';
							if(get_field('entry_product_data_sheet') != '') {
								$id = get_field('entry_product_data_sheet');
								$product_data_sheet = $id[url];
							}
							$project = get_field('entry_projects');
							$project_name_1 = $project['entry_project_name_1'];
							$project_date_1 = $project['entry_project_date_1'];
							$architect_designer_home_builder_1 = $project['entry_architect_designer_home_builder_1'];
							$resident_owner_declaration_1 = $project['entry_resident_owner_declaration_1'];
							$main_photo_1 = '';
							if($project['entry_main_photo_1'] != '') {
								$id = $project['entry_main_photo_1'];
								$src = wp_get_attachment_image_src($id[ID], full);
								$main_photo_1 = $src[0];
							}
							$overview_description_1 = '';
							if($project['entry_overview_description_1'] != '') {
								$overview_description_1 = preg_replace('/<br(\s+)?\/?>/i', "\n", $project['entry_overview_description_1']);
							}
							$promotional_blurb_1 = '';
							if($project['entry_promotional_blurb_1'] != '') {
								$promotional_blurb_1 = preg_replace('/<br(\s+)?\/?>/i', "\n", $project['entry_promotional_blurb_1']);
							}
							$project_name_2 = $project['entry_project_name_2'];
							$project_date_2 = $project['entry_project_date_2'];
							$architect_designer_home_builder_2 = $project['entry_architect_designer_home_builder_2'];
							$resident_owner_declaration_2 = $project['entry_resident_owner_declaration_2'];
							$main_photo_2 = '';
							if($project['entry_main_photo_2'] != '') {
								$id = $project['entry_main_photo_2'];
								$src = wp_get_attachment_image_src($id[ID], full);
								$main_photo_2 = $src[0];
							}
							$overview_description_2 = '';
							if($project['entry_overview_description_2'] != '') {
								$overview_description_2 = preg_replace('/<br(\s+)?\/?>/i', "\n", $project['entry_overview_description_2']);
							}
							$promotional_blurb_2 = '';
							if($project['entry_promotional_blurb_2'] != '') {
								$promotional_blurb_2 = preg_replace('/<br(\s+)?\/?>/i', "\n", $project['entry_promotional_blurb_2']);
							}
							$project_name_3 = $project['entry_project_name_3'];
							$project_date_3 = $project['entry_project_date_3'];
							$architect_designer_home_builder_3 = $project['entry_architect_designer_home_builder_3'];
							$resident_owner_declaration_3 = $project['entry_resident_owner_declaration_3'];
							$main_photo_3 = '';
							if($project['entry_main_photo_3'] != '') {
								$id = $project['entry_main_photo_3'];
								$src = wp_get_attachment_image_src($id[ID], full);
								$main_photo_3 = $src[0];
							}
							$overview_description_3 = '';
							if($project['entry_overview_description_3'] != '') {
								$overview_description_3 = preg_replace('/<br(\s+)?\/?>/i', "\n", $project['entry_overview_description_3']);
							}
							$promotional_blurb_3 = '';
							if($project['entry_promotional_blurb_3'] != '') {
								$promotional_blurb_3 = preg_replace('/<br(\s+)?\/?>/i', "\n", $project['entry_promotional_blurb_3']);
							}
							$project_name_4 = $project['entry_project_name_4'];
							$project_date_4 = $project['entry_project_date_4'];
							$architect_designer_home_builder_4 = $project['entry_architect_designer_home_builder_4'];
							$resident_owner_declaration_4 = $project['entry_resident_owner_declaration_4'];
							$main_photo_4 = '';
							if($project['entry_main_photo_4'] != '') {
								$id = $project['entry_main_photo_4'];
								$src = wp_get_attachment_image_src($id[ID], full);
								$main_photo_4 = $src[0];
							}
							$overview_description_4 = '';
							if($project['entry_overview_description_4'] != '') {
								$overview_description_4 = preg_replace('/<br(\s+)?\/?>/i', "\n", $project['entry_overview_description_4']);
							}
							$promotional_blurb_4 = '';
							if($project['entry_promotional_blurb_4'] != '') {
								$promotional_blurb_4 = preg_replace('/<br(\s+)?\/?>/i', "\n", $project['entry_promotional_blurb_4']);
							}
							$project_name_5 = $project['entry_project_name_5'];
							$project_date_5 = $project['entry_project_date_5'];
							$architect_designer_home_builder_5 = $project['entry_architect_designer_home_builder_5'];
							$resident_owner_declaration_5 = $project['entry_resident_owner_declaration_5'];
							$main_photo_5 = '';
							if($project['entry_main_photo_5'] != '') {
								$id = $project['entry_main_photo_5'];
								$src = wp_get_attachment_image_src($id[ID], full);
								$main_photo_5 = $src[0];
							}
							$overview_description_5 = '';
							if($project['entry_overview_description_5'] != '') {
								$overview_description_5 = preg_replace('/<br(\s+)?\/?>/i', "\n", $project['entry_overview_description_5']);
							}
							$promotional_blurb_5 = '';
							if($project['entry_promotional_blurb_5'] != '') {
								$promotional_blurb_5 = preg_replace('/<br(\s+)?\/?>/i', "\n", $project['entry_promotional_blurb_5']);
							}
							$project_date = get_field('entry_project_date');
							$project_name = get_field('entry_project_name');
							$promotional_blurb = '';
							if(get_field('entry_promotional_blurb') != '') {
								$promotional_blurb = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_promotional_blurb'));
							}
							$pump = get_field('entry_pump');
							$range_products_services = '';
							if(get_field('entry_range_products_services') != '') {
								$range_products_services = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_range_products_services'));
							}
							$resident_owner_declaration = get_field('entry_resident_owner_declaration');
							$safety_barrier_specifics = '';
							if(get_field('entry_safety_barrier_specifics') != '') {
								$safety_barrier_specifics = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_safety_barrier_specifics'));
							}
							$sanitation = get_field('entry_sanitation');
							$service_vehicle = '';
							if(get_field('entry_service_vehicle') != '') {
								$service_vehicle = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_service_vehicle'));
							}
							$service_vehicle_photo = '';
							if(get_field('entry_service_vehicle_photo') != '') {
								$id = get_field('entry_service_vehicle_photo');
								$src = wp_get_attachment_image_src($id[ID], full);
								$service_vehicle_photo = $src[0];
							}
							$shape = get_field('entry_shape');
							$standards_regulations_knowledge = '';
							if(get_field('entry_standards_regulations_knowledge') != '') {
								$standards_regulations_knowledge = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_standards_regulations_knowledge'));
							}
							$supporting_photos_1 = '';
							if(get_field('entry_supporting_photos_1') != '') {
								$id = get_field('entry_supporting_photos_1');
								$src = wp_get_attachment_image_src($id[ID], full);
								$supporting_photos_1 = $src[0];
							}
							$supporting_photos_2 = '';
							if(get_field('entry_supporting_photos_2') != '') {
								$id = get_field('entry_supporting_photos_2');
								$src = wp_get_attachment_image_src($id[ID], full);
								$supporting_photos_2 = $src[0];
							}
							$supporting_photos_3 = '';
							if(get_field('entry_supporting_photos_3') != '') {
								$id = get_field('entry_supporting_photos_3');
								$src = wp_get_attachment_image_src($id[ID], full);
								$supporting_photos_3 = $src[0];
							}
							$supporting_photos_4 = '';
							if(get_field('entry_supporting_photos_4') != '') {
								$id = get_field('entry_supporting_photos_4');
								$src = wp_get_attachment_image_src($id[ID], full);
								$supporting_photos_4 = $src[0];
							}
							$supporting_photos_5 = '';
							if(get_field('entry_supporting_photos_5') != '') {
								$id = get_field('entry_supporting_photos_5');
								$src = wp_get_attachment_image_src($id[ID], full);
								$supporting_photos_5 = $src[0];
							}
							$sustainability_specifics = '';
							if(get_field('entry_sustainability_specifics') != '') {
								$sustainability_specifics = preg_replace('/<br(\s+)?\/?>/i', "\n", get_field('entry_sustainability_specifics'));
							}
							$type_cleaner = get_field('entry_type_cleaner');
							$width = get_field('entry_width');
							$data[] = array(
								$category,
								$state, 
								$entry_id, 
								$status, 
								$member_name, 
								$member_business, 
								$member_address, 
								$member_email,
								$member_telephone,
								$member_website,
								$payment_status, 
								$order_number, 
								$order_date, 
								$average_score, 
								$achievements, 
								$architect_designer_home_builder, 
								$background, 
								$before_photo, 
								$business, 
								$chlorinator, 
								$client_testimonials, 
								$communication_skills, 
								$company_logo, 
								$compliance, 
								$coping_materials, 
								$customer_service, 
								$date_of_campaign_commencement, 
								$date_of_release, 
								$description, 
								$display_centre_specifics, 
								$education_training_qualifications, 
								$filter, 
								$heating_system, 
								$innovation_specifics, 
								$internal_finish, 
								$length, 
								$main_photo, 
								$marketing, 
								$marketing_material, 
								$other_equipment_accessories, 
								$personal_presentation, 
								$personal_presentation_photo, 
								$photographer, 
								$portfolio, 
								$presentation_service_fleet, 
								$presentation_service_fleet_photo,
								$presentation_staff, 
								$presentation_staff_photo, 
								$presentation_store, 
								$presentation_store_photo, 
								$price, 
								$primary_image, 
								$problem_solving, 
								$product_data_sheet, 
								$project_name_1, 
								$project_date_1, 
								$architect_designer_home_builder_1, 
								$resident_owner_declaration_1, 
								$main_photo_1, 
								$overview_description_1, 
								$promotional_blurb_1, 
								$project_name_2, 
								$project_date_2, 
								$architect_designer_home_builder_2, 
								$resident_owner_declaration_2, 
								$main_photo_2, 
								$overview_description_2, 
								$promotional_blurb_2, 
								$project_name_3, 
								$project_date_3, 
								$architect_designer_home_builder_3, 
								$resident_owner_declaration_3, 
								$main_photo_3, 
								$overview_description_3, 
								$promotional_blurb_3, 
								$project_name_4, 
								$project_date_4, 
								$architect_designer_home_builder_4, 
								$resident_owner_declaration_4, 
								$main_photo_4, 
								$overview_description_4, 
								$promotional_blurb_4, 
								$project_name_5, 
								$project_date_5, 
								$architect_designer_home_builder_5, 
								$resident_owner_declaration_5, 
								$main_photo_5, 
								$overview_description_5, 
								$promotional_blurb_5, 
								$project_date, 
								$project_name, 
								$promotional_blurb, 
								$pump, 
								$range_products_services, 
								$resident_owner_declaration, 
								$safety_barrier_specifics, 
								$sanitation, 
								$service_vehicle, 
								$service_vehicle_photo, 
								$shape, 
								$standards_regulations_knowledge, 
								$supporting_photos_1, 
								$supporting_photos_2, 
								$supporting_photos_3, 
								$supporting_photos_4, 
								$supporting_photos_5, 
								$sustainability_specifics, 
								$type_cleaner, 
								$width
							);
						}
					}
				}		 
				foreach($data as $row) {
					fputcsv($file, $row);
				}
				exit();
			}
		} else {
			header('Location: '.get_bloginfo('url'));
			exit();
		}
	} else {
		header('Location: '.get_bloginfo('url'));
		exit();
	}
?>