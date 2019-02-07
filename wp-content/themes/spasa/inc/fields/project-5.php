<?php
	if($wp_query->query_vars['id']) {
		if(get_field('primary_image_min_'.intval(str_replace('award-', '', get_post_type($wp_query->query_vars['id']))), 'options') == '500KB') {
			$min_label = '500KB';
			$min_value = '500000';
		} else {
			$min_label = '3MB';
			$min_value = '3000000';
		}
		$project = get_field('entry_projects', $wp_query->query_vars['id']);
		$project_name = $project['entry_project_name_5'];
		if($project['entry_project_date_5'] != '') {
			$project_date = date('Y-m-d', strtotime(str_replace('/', '-', $project['entry_project_date_5'])));
		} else {
			$project_date = '';
		}
		$project_architect_designer_home_builder = $project['entry_architect_designer_home_builder_5'];
		$project_resident_owner_declaration = $project['entry_resident_owner_declaration_5'];
		$project_overview_description = str_ireplace(array('<br />','<br>','<br/>'), '', $project['entry_overview_description_5']);
		$project_promotional_blurb = str_ireplace(array('<br />','<br>','<br/>'), '', $project['entry_promotional_blurb_5']);
	} else {
		if(get_field('primary_image_min_'.$wp_query->query_vars['award_category'], 'options') == '500KB') {
			$min_label = '500KB';
			$min_value = '500000';
		} else {
			$min_label = '3MB';
			$min_value = '3000000';	
		}
	}
?>
<hr />
<h2>Project 5</h2>
<p> 
	<label for="project-name-5">Project name <span class="required">*</span></label><br />
	<input type="text" id="project-name-5" name="project_name_5" value="<?php echo $project_name; ?>" data-required="required" />
</p>
<p> 
	<label for="project-date-5">Project date <span class="required">*</span></label><br />
	<input type="date" id="project-date-5" name="project_date_5" value="<?php echo $project_date; ?>" data-required="required" />
</p>
<p> 
	<label for="architect-designer-home-builder-5">Architect / Designer / Home builder  <span class="required">*</span></label><br />
	<input type="text" id="architect-designer-home-builder-5" name="architect_designer_home_builder_5" value="<?php echo $project_architect_designer_home_builder; ?>" data-required="required" />
</p>
<p> 
	<label for="resident-owner-declaration-5" class="checkbox">
		<input type="checkbox" id="resident-owner-declaration-5" name="resident_owner_declaration_5" value="yes" data-required="required" <?php if($project_resident_owner_declaration == 'yes'): ?> checked="checked"<?php endif; ?> >
		Resident / Owner have given permission <span class="required">*</span> <span class="marker"></span>
	</label>
</p>
<div class="file-uploads">
	<p>
		<label for="main-photo-5" <?php if($wp_query->query_vars['id'] && $project['entry_main_photo_5']): ?>style="display: none;"<?php endif; ?>>
			Main photo <span class="info">(1 file)</span> <span class="required">*</span>
			<span class="file"></span>
			<input type="file" id="main-photo-5" name="main_photo_5" accept=".jpg,.jpeg" multiple="false" data-required="required" />
			<span class="smalltext">Accepted file types: jpg (minimum width 2000px and <?php echo $min_label; ?>)</span>
		</label>
		<?php
			if($wp_query->query_vars['id'] && $project['entry_main_photo_5']):
			$main_photo = $project['entry_main_photo_5'];
		?>
			<label for="existing-main-photo-5">
				Main photo <span class="info">(1 file)</span> <span class="required">*</span> 
				<span class="existing-file"><a href="<?php echo $main_photo[url]; ?>" target="_blank" class="view"><?php echo $main_photo[filename]; ?></a> &nbsp;- &nbsp;<a href="#change-main-photo-5" class="change">Change</a></span>
				<input type="hidden" id="existing-main-photo-5" name="existing_main_photo_5" value="<?php echo $main_photo[id]; ?>" />
			</label>
		<?php endif; ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('input[name="main_photo_5"]').on('change', 
				function() {
					$this = jQuery(this);
					jQuery($this).closest('p').find('label .file').html(this.value.replace('C:\\fakepath\\', '') || '');
					if (window.File && window.FileReader && window.FileList && window.Blob) {
						if(this.files[0].size < <?php echo $min_value; ?>){
							alert('File must be at least <?php echo $min_label; ?>');
							this.value = '';
							jQuery($this).closest('p').find('label .file').html('');
						};
					}
				}
			);
			jQuery(document).on('click', 'a[href="#change-main-photo-5"]', 
				function(e) {
					e.preventDefault();
					jQuery(this).closest('p').find('label[for="main-photo-5"]').show();
					jQuery(this).closest('p').find('label[for="existing-main-photo-5"]').remove();
					jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					jQuery(this).blur();
				}
			);
		}
	);
</script>
<p> 
	<label for="overview-description-5">Overview / Description of works <span class="required">*</span></label><br />
	<textarea id="overview-description-5" name="overview_description_5" data-required="required"><?php echo $project_overview_description; ?></textarea>
	<?php if($wp_query->query_vars['id']): ?>
		<?php if(get_field('judging_criteria_details_'.intval(str_replace('award-', '', get_post_type($wp_query->query_vars['id']))), 'options') != ''): ?>
			<span class="smalltext criteria">
				Judging Criteria: 
				<?php
					$i = 0;
					$t = count(get_field('judging_criteria_details_'.intval(str_replace('award-', '', get_post_type($wp_query->query_vars['id']))), 'options'));
					while(have_rows('judging_criteria_details_'.intval(str_replace('award-', '', get_post_type($wp_query->query_vars['id']))), 'options')) {
						$i++;
						the_row();
						if(($i != 1) && ($i != $t)){
							echo trim(get_sub_field('criterion'));
							if($i != ($t - 1)) {
								echo ', ';
							}
						}
					}
				?>
				&nbsp;&hellip;&nbsp;<a href="#judging-criteria" class="criteria">more details</a>
			</span>
		<?php endif; ?>
	<?php else: ?>
		<?php if(get_field('judging_criteria_details_'.$wp_query->query_vars['award_category'], 'options') != ''): ?>
			<span class="smalltext criteria">
				Judging Criteria: 
				<?php
					$i = 0;
					$t = count(get_field('judging_criteria_details_'.$wp_query->query_vars['award_category'], 'options'));
					while(have_rows('judging_criteria_details_'.$wp_query->query_vars['award_category'], 'options')) {
						$i++;
						the_row();
						if(($i != 1) && ($i != $t)){
							echo trim(get_sub_field('criterion'));
							if($i != ($t - 1)) {
								echo ', ';
							}
						}
					}
				?>
				&nbsp;&hellip;&nbsp;<a href="#judging-criteria" class="criteria">more details</a>
			</span>
		<?php endif; ?>
	<?php endif; ?>
</p>
<p> 
	<label for="promotional-blurb-5">Promotional blurb <span class="info">(50 words)</span> <span class="required">*</span></label><br />
	<textarea id="promotional-blurb-5" name="promotional_blurb_5" class="small" maxlength="500" data-required="required"><?php echo $project_promotional_blurb; ?></textarea>
	<span class="smalltext">NB: This blurb will be used in external magazines and for promotional purposes aimed at consumers. Please take this into consideration when composing your blurb</span>
</p>