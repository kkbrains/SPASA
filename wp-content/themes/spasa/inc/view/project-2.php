<?php
	$project = get_field('entry_projects');
	if(
		($project['entry_project_name_2'] != '') || 
		($project['entry_project_date_2'] != '') || 
		($project['entry_architect_designer_home_builder_2'] != '') || 
		($project['entry_resident_owner_declaration_2'] != '') || 
		($project['entry_main_photo_2'] != '') || 
		($project['entry_overview_description_2'] != '') || 
		($project['entry_promotional_blurb_2'] != '')
	):
	$add_subtitle = true;
?>
	<?php if($project['entry_project_name_2'] != ''): ?>
		<div class="view-content">
			<div class="title">
				<h3><?php if($add_subtitle == true): $add_subtitle = false; ?>Project 2 <?php endif; ?><span>Name</span></h3>
			</div>
			<div class="value">
				<p><?php echo $project['entry_project_name_2']; ?></p>
			</div>
		</div>
	<?php endif; ?>
	<?php if($project['entry_project_date_2'] != ''): ?>
		<div class="view-content">
			<div class="title">
				<h3><?php if($add_subtitle == true): $add_subtitle = false; ?>Project 2 <?php endif; ?><span>Date</span></h3>
			</div>
			<div class="value">
				<p><?php echo $project['entry_project_date_2']; ?></p>
			</div>
		</div>
	<?php endif; ?>
	<?php if($project['entry_architect_designer_home_builder_2'] != ''): ?>
		<div class="view-content">
			<div class="title">
				<h3><?php if($add_subtitle == true): $add_subtitle = false; ?>Project 2 <?php endif; ?><span>Architect / Designer / Home builder</span></h3>
			</div>
			<div class="value">
				<p><?php echo $project['entry_architect_designer_home_builder_2']; ?></p>
			</div>
		</div>
	<?php endif; ?>
	<?php if($project['entry_resident_owner_declaration_2'] != ''): ?>
		<div class="view-content">
			<div class="title">
				<h3><?php if($add_subtitle == true): $add_subtitle = false; ?>Project 2 <?php endif; ?><span>Resident / Owner</span></h3>
			</div>
			<div class="value">
				<?php if($project['entry_resident_owner_declaration_2'] == 'yes'): ?>
					<p>Permission has been given</p>
				<?php else: ?>
					<p>Permission has not been given</p>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if($project['entry_main_photo_2'] != ''): ?>
		<div class="view-content">
			<div class="title">
				<h3><?php if($add_subtitle == true): $add_subtitle = false; ?>Project 2 <?php endif; ?><span>Main photo</span></h3>
			</div>
			<div class="value">
				<?php
					$image = $project['entry_main_photo_2'];
					$image_url = wp_get_attachment_image_src($image[ID], large);
				 ?>
				<a href="<?php echo $image_url[0]; ?>" class="view">
					<?php echo fly_get_attachment_image($image[id], array(780, 850), false, array('alt' => '', 'class' => '')); ?>
					<span></span>
				</a>
			</div>
		</div>
	<?php endif; ?>
	<?php if($project['entry_overview_description_2'] != ''): ?>
		<div class="view-content">
			<div class="title">
				<h3><?php if($add_subtitle == true): $add_subtitle = false; ?>Project 2 <?php endif; ?><span>Overview / Description of works</span></h3>
			</div>
			<div class="value">
				<p><?php echo $project['entry_overview_description_2']; ?></p>
			</div>
		</div>
	<?php endif; ?>
	<?php if($project['entry_promotional_blurb_2'] != ''): ?>
		<div class="view-content">
			<div class="title">
				<h3><?php if($add_subtitle == true): $add_subtitle = false; ?>Project 2 <?php endif; ?><span>Promotional blurb</span></h3>
			</div>
			<div class="value">
				<p><?php echo $project['entry_promotional_blurb_2']; ?></p>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>
