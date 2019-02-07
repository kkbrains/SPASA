<?php
	if($_GET['get_entry']) {
		$copy_entry = $_GET['get_entry'];
		$copy_category = sprintf('%02d', $_GET['get_category']);
		define('WP_USE_THEMES', false);	
		$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
		require_once($parse_uri[0].'wp-load.php');
		include(ABSPATH.'wp-content/themes/spasa/inc/category/'.$copy_category.'.php');
	} elseif($wp_query->query_vars['copy_entry']) {
		$copy_entry = $wp_query->query_vars['copy_entry'];
		$copy_category = sprintf('%02d', $wp_query->query_vars['award_category']);
		include(ABSPATH.'wp-content/themes/spasa/inc/category/'.$copy_category.'.php');
	} else {
		exit();
	}
?>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('.content .main .copy-intro').html('Data from entry <?php the_field('entry_id', $copy_entry); ?> has been copied to this form');
			<?php
				foreach($fields as $field => $type):
					if(
						(get_field('entry_'.str_replace('-', '_', $field), $copy_entry)) || 
						(get_field('entry_'.str_replace('-', '_', $field).'_1', $copy_entry)) || 
						(get_field('entry_'.str_replace(array('-1', '-2', '-3', '-4', '-5'), 's', $field), $copy_entry))
					):
					if($type == 'text'):
			?>
				jQuery('.entry-form *[name="<?php echo str_replace('-', '_', $field); ?>"]').val('<?php echo str_replace('\'', '\\\'', get_field('entry_'.str_replace('-', '_', $field), $copy_entry)); ?>');
			<?php elseif($type == 'select'): ?>
				jQuery('.entry-form *[name="<?php echo str_replace('-', '_', $field); ?>"]').val('<?php echo get_field('entry_'.str_replace('-', '_', $field), $copy_entry); ?>');
			<?php elseif($type == 'textarea'): ?>
				jQuery('.entry-form *[name="<?php echo str_replace('-', '_', $field); ?>"]').val('<?php echo str_replace('\'', '\\\'', get_field('entry_'.str_replace('-', '_', $field), $copy_entry)); ?>'.replace(/<br[^>]*>/gi, '\n'));
			<?php elseif($type == 'date'): ?>
				jQuery('.entry-form *[name="<?php echo str_replace('-', '_', $field); ?>"]').val('<?php echo date('Y-m-d', strtotime(str_replace('/', '-', get_field('entry_'.str_replace('-', '_', $field), $copy_entry)))); ?>');
			<?php elseif($type == 'checkbox'): ?>
				<?php if(get_field('entry_'.str_replace('-', '_', $field), $copy_entry) == 'yes'): ?>
					jQuery('.entry-form *[name="<?php echo str_replace('-', '_', $field); ?>"]').prop('checked', true);
				<?php else: ?>
					jQuery('.entry-form *[name="<?php echo str_replace('-', '_', $field); ?>"]').prop('checked', false);
				<?php endif; ?>
			<?php
				elseif($type == 'multifile'):
				$value_1 = get_field('entry_'.str_replace('-', '_', $field).'_1', $copy_entry);
				$value_2 = get_field('entry_'.str_replace('-', '_', $field).'_2', $copy_entry);
				$value_3 = get_field('entry_'.str_replace('-', '_', $field).'_3', $copy_entry);
				$value_4 = get_field('entry_'.str_replace('-', '_', $field).'_4', $copy_entry);
				$value_5 = get_field('entry_'.str_replace('-', '_', $field).'_5', $copy_entry);
				$change = false;
			?>
				jQuery('.entry-form *[name="existing_<?php echo str_replace('-', '_', $field); ?>_1"]').val('<?php echo $value[id]; ?>');
				jQuery('.entry-form *[name="existing_<?php echo str_replace('-', '_', $field); ?>_2"]').val('<?php echo $value[id]; ?>');
				jQuery('.entry-form *[name="existing_<?php echo str_replace('-', '_', $field); ?>_3"]').val('<?php echo $value[id]; ?>');
				jQuery('.entry-form *[name="existing_<?php echo str_replace('-', '_', $field); ?>_4"]').val('<?php echo $value[id]; ?>');
				jQuery('.entry-form *[name="existing_<?php echo str_replace('-', '_', $field); ?>_5"]').val('<?php echo $value[id]; ?>');
				if(jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file').length) {
					if(jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-1').length) {
						jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-1').attr('href', '<?php echo $value_1[url]; ?>');
						jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-1').text('<?php echo $value_1[filename]; ?>');
					}
					if(jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-2').length) {
						jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-2').attr('href', '<?php echo $value_2[url]; ?>');
						jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-2').text('<?php echo $value_2[filename]; ?>');
					}
					if(jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-3').length) {
						jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-3').attr('href', '<?php echo $value_3[url]; ?>');
						jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-3').text('<?php echo $value_3[filename]; ?>');
					}
					if(jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-4').length) {
						jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-4').attr('href', '<?php echo $value_4[url]; ?>');
						jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-4').text('<?php echo $value_4[filename]; ?>');
					}
					if(jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-5').length) {
						jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-5').attr('href', '<?php echo $value_5[url]; ?>');
						jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view-5').text('<?php echo $value_5[filename]; ?>');
					}
				} else {
					var existing_<?php echo str_replace('-', '_', $field); ?> = '';
					existing_<?php echo str_replace('-', '_', $field); ?> += '<label for="existing-<?php echo $field; ?>"><?php echo ucfirst(str_replace('-', ' ', $field)); ?> <span class="info">(up to 5 files)</span> <span class="existing-file">';
					<?php if($value_1 != ''): ?>
						existing_<?php echo str_replace('-', '_', $field); ?> += '<a href="<?php echo $value_1[url]; ?>" target="_blank" class="view view-1"><?php echo $value_1[filename]; ?></a> ';
						<?php
							if($change == false):
							$change = true;
						?>
							existing_<?php echo str_replace('-', '_', $field); ?> += '&nbsp;- &nbsp;<a href="#change-<?php echo $field; ?>" class="change">Change</a>';
						<?php endif; ?>
						existing_<?php echo str_replace('-', '_', $field); ?> += '<br />';
					<?php endif; ?>
					<?php if($value_2 != ''): ?>
						existing_<?php echo str_replace('-', '_', $field); ?> += '<a href="<?php echo $value_2[url]; ?>" target="_blank" class="view view-2"><?php echo $value_2[filename]; ?></a> ';
						<?php
							if($change == false):
							$change = true;
						?>
							existing_<?php echo str_replace('-', '_', $field); ?> += '&nbsp;- &nbsp;<a href="#change-<?php echo $field; ?>" class="change">Change</a>';
						<?php endif; ?>
						existing_<?php echo str_replace('-', '_', $field); ?> += '<br />';
					<?php endif; ?>
					<?php if($value_3 != ''): ?>
						existing_<?php echo str_replace('-', '_', $field); ?> += '<a href="<?php echo $value_3[url]; ?>" target="_blank" class="view view-3"><?php echo $value_3[filename]; ?></a> ';
						<?php
							if($change == false):
							$change = true;
						?>
							existing_<?php echo str_replace('-', '_', $field); ?> += '&nbsp;- &nbsp;<a href="#change-<?php echo $field; ?>" class="change">Change</a>';
						<?php endif; ?>
						existing_<?php echo str_replace('-', '_', $field); ?> += '<br />';
					<?php endif; ?>
					<?php if($value_4 != ''): ?>
						existing_<?php echo str_replace('-', '_', $field); ?> += '<a href="<?php echo $value_4[url]; ?>" target="_blank" class="view view-4"><?php echo $value_4[filename]; ?></a> ';
						<?php
							if($change == false):
							$change = true;
						?>
							existing_<?php echo str_replace('-', '_', $field); ?> += '&nbsp;- &nbsp;<a href="#change-<?php echo $field; ?>" class="change">Change</a>';
						<?php endif; ?>
						existing_<?php echo str_replace('-', '_', $field); ?> += '<br />';
					<?php endif; ?>
					<?php if($value_5 != ''): ?>
						existing_<?php echo str_replace('-', '_', $field); ?> += '<a href="<?php echo $value_5[url]; ?>" target="_blank" class="view view-5"><?php echo $value_5[filename]; ?></a> ';
						<?php
							if($change == false):
							$change = true;
						?>
							existing_<?php echo str_replace('-', '_', $field); ?> += '&nbsp;- &nbsp;<a href="#change-<?php echo $field; ?>" class="change">Change</a>';
						<?php endif; ?>
						existing_<?php echo str_replace('-', '_', $field); ?> += '<br />';
					<?php endif; ?>
					existing_<?php echo str_replace('-', '_', $field); ?> += '</span><input type="hidden" id="existing-<?php echo $field; ?>-1" name="existing_<?php echo str_replace('-', '_', $field); ?>_1" value="<?php echo $value_1[id]; ?>" /><input type="hidden" id="existing-<?php echo $field; ?>-2" name="existing_<?php echo str_replace('-', '_', $field); ?>_2" value="<?php echo $value_2[id]; ?>" /><input type="hidden" id="existing-<?php echo $field; ?>-3" name="existing_<?php echo str_replace('-', '_', $field); ?>_3" value="<?php echo $value_3[id]; ?>" /><input type="hidden" id="existing-<?php echo $field; ?>-4" name="existing_<?php echo str_replace('-', '_', $field); ?>_4" value="<?php echo $value_4[id]; ?>" /><input type="hidden" id="existing-<?php echo $field; ?>-5" name="existing_<?php echo str_replace('-', '_', $field); ?>_5" value="<?php echo $value_5[id]; ?>" /></label>';
					jQuery(existing_<?php echo str_replace('-', '_', $field); ?>).insertAfter('.entry-form label[for="<?php echo $field; ?>"]');
					jQuery('.entry-form label[for="<?php echo $field; ?>"]').hide();
				}
			<?php
				elseif($type == 'file'):
				$value = get_field('entry_'.str_replace('-', '_', $field), $copy_entry);
			?>
				jQuery('.entry-form *[name="existing_<?php echo str_replace('-', '_', $field); ?>"]').val('<?php echo $value[id]; ?>');
				if(jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file').length) {
					jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view').attr('href', '<?php echo $value[url]; ?>');
					jQuery('.entry-form label[for="existing-<?php echo $field; ?>"] .existing-file a.view').text('<?php echo $value[filename]; ?>');
				} else {
					jQuery('<?php echo '<label for="existing-'.$field.'">'.ucfirst(str_replace('-', ' ', $field)).' <span class="info">(1 file)</span> <span class="required">*</span> <span class="existing-file"><a href="'.$value[url].'" target="_blank" class="view">'.$value[filename].'</a> &nbsp;- &nbsp;<a href="#change-'.$field.'" class="change">Change</a></span><input type="hidden" id="existing-'.$field.'" name="existing_'.str_replace('-', '_', $field).'" value="'.$value[id].'" /></label>'; ?>').insertAfter('.entry-form label[for="<?php echo $field; ?>"]');
					jQuery('.entry-form label[for="<?php echo $field; ?>"]').hide();
				}
			<?php
				elseif($type == 'project'):
				$project = get_field('entry_projects', $copy_entry);
				$project_name = str_replace('\'', '\\\'', $project['entry_project_name_'.str_replace('project-', '', $field)]);
				$project_date = date('Y-m-d', strtotime(str_replace('/', '-', $project['entry_project_date_'.str_replace('project-', '', $field)])));
				$project_architect_designer_home_builder = str_replace('\'', '\\\'', $project['entry_architect_designer_home_builder_'.str_replace('project-', '', $field)]);
				$project_resident_owner_declaration = $project['entry_resident_owner_declaration_'.str_replace('project-', '', $field)];
				$project_main_photo = $project['entry_main_photo_'.str_replace('project-', '', $field)];
				$project_overview_description = str_replace('\'', '\\\'', $project['entry_overview_description_'.str_replace('project-', '', $field)]);
				$project_promotional_blurb = str_replace('\'', '\\\'', $project['entry_promotional_blurb_'.str_replace('project-', '', $field)]);
			?>
				jQuery('.entry-form *[name="project_name_<?php echo str_replace('project-', '', $field); ?>"]').val('<?php echo $project_name; ?>');
				jQuery('.entry-form *[name="project_date_<?php echo str_replace('project-', '', $field); ?>"]').val('<?php echo $project_date; ?>');
				jQuery('.entry-form *[name="architect_designer_home_builder_<?php echo str_replace('project-', '', $field); ?>"]').val('<?php echo $project_architect_designer_home_builder; ?>');
				<?php if($project_resident_owner_declaration == 'yes'): ?>
					jQuery('.entry-form *[name="resident_owner_declaration_<?php echo str_replace('project-', '', $field); ?>"]').prop('checked', true);
				<?php endif; ?>
				if(jQuery('.entry-form label[for="existing-main-photo-<?php echo str_replace('project-', '', $field); ?>"] .existing-file').length) {
					jQuery('.entry-form label[for="existing-main-photo-<?php echo str_replace('project-', '', $field); ?>"] .existing-file a.view').attr('href', '<?php echo $project_main_photo[url]; ?>');
					jQuery('.entry-form label[for="existing-main-photo-<?php echo str_replace('project-', '', $field); ?>"] .existing-file a.view').text('<?php echo $project_main_photo[filename]; ?>');
				} else {
					jQuery('<?php echo '<label for="existing-main-photo-'.str_replace('project-', '', $field).'">Main photo <span class="info">(1 file)</span> <span class="required">*</span> <span class="existing-file"><a href="'.$project_main_photo[url].'" target="_blank" class="view">'.$project_main_photo[filename].'</a> &nbsp;- &nbsp;<a href="#change-main-photo-'.str_replace('project-', '', $field).'" class="change">Change</a></span><input type="hidden" id="existing-main-photo-'.str_replace('project-', '', $field).'" name="existing_main_photo_'.str_replace('project-', '', $field).'" value="'.$project_main_photo[id].'" /></label>'; ?>').insertAfter('.entry-form label[for="main-photo-<?php echo str_replace('project-', '', $field); ?>"]');
					jQuery('.entry-form label[for="main-photo-<?php echo str_replace('project-', '', $field); ?>"]').hide();
				}
				jQuery('.entry-form *[name="overview_description_<?php echo str_replace('project-', '', $field); ?>"]').val('<?php echo $project_overview_description; ?>'.replace(/<br[^>]*>/gi, '\n'));
				jQuery('.entry-form *[name="promotional_blurb_<?php echo str_replace('project-', '', $field); ?>"]').val('<?php echo $project_promotional_blurb; ?>'.replace(/<br[^>]*>/gi, '\n'));
			<?php
						endif;
					endif;
				endforeach;
			?>
		}
	);
</script>
