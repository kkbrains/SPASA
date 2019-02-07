<?php
	$visible_awards = get_field('visible_awards', options);
	if($state == 'new-south-wales') {
		$state = 'New South Wales';
	} elseif($state == 'south-australia') {
		$state = 'South Australia';
	} elseif($state == 'queensland') {
		$state = 'Queensland';
	} elseif($state == 'victoria') {
		$state = 'Victoria';
	} elseif($state == 'western-australia') {
		$state = 'Western Australia';
	} elseif($state == 'national') {
		$state = 'National';
	} else {
		$state = 'Queensland';
	}
?>
<div class="content center">
	<form class="winners-state">
		<div class="columns-3">
			<h2>Select State or Region &hellip;</h2>
			<p><select id="state" name="state">
				<?php if(in_array('new-south-wales', $visible_awards)): ?>
					<option value="new-south-wales"<?php if($state == 'New South Wales'): ?> selected="selected"<?php endif; ?>>New South Wales</option>
				<?php endif; ?>
				<?php if(in_array('south-australia', $visible_awards)): ?>
					<option value="south-australia"<?php if($state == 'South Australia'): ?> selected="selected"<?php endif; ?>>South Australia</option>
				<?php endif; ?>
				<?php if(in_array('queensland', $visible_awards)): ?>
					<option value="queensland"<?php if($state == 'Queensland'): ?> selected="selected"<?php endif; ?>>Queensland</option>
				<?php endif; ?>
				<?php if(in_array('victoria', $visible_awards)): ?>
					<option value="victoria"<?php if($state == 'Victoria'): ?> selected="selected"<?php endif; ?>>Victoria</option>
				<?php endif; ?>
				<?php if(in_array('western-australia', $visible_awards)): ?>
					<option value="western-australia"<?php if($state == 'Western Australia'): ?> selected="selected"<?php endif; ?>>Western Australia</option>
				<?php endif; ?>
				<?php if(in_array('national', $visible_awards)): ?>
					<option value="national"<?php if($state == 'National'): ?> selected="selected"<?php endif; ?>>National - Judges Awards</option>
				<?php endif; ?>
			</select></p>
		</div>
	</form>
	<?php if($state != 'National'): ?>
		<ul class="tabs">
			<li><a href="#build-installation" class="active">Build &amp; Installation</a></li>
			<li><a href="#company-business">Company / Business</a></li>
			<li><a href="#individual-employee">Individual / Employee</a></li>
			<li><a href="#industry-product">Industry &amp; Product</a></li>
		</ul>
		<div class="tabs-info winners active" id="build-installation">
			<?php
				$empty = 'true';
				$categories = array(8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42);
				foreach($categories as $category):
					if(get_field('winner_selection_'.$category, options) != 'Manual'):
					$args = array(
						'post_type' => 'award-'.sprintf('%02d', $category),
						'meta_key' => 'entry_average_score',
						'orderby' => 'meta_value',
						'order' => 'DESC',
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'entry_state',
								'value' => $state,
							),
							array(
								'key' => 'entry_status',
								'value' => 'Completed',
							),
							array(
								'key' => 'entry_paid',
								'value' => 'Yes',
							)
						),
						'posts_per_page' => 3
					);
					$the_query = new WP_Query($args);
					if($the_query->have_posts()):
						$empty = 'false';
			?>
				<div class="category">
					<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
						<h2><?php echo get_post_type_object('award-'.sprintf('%02d', $category))->label; ?></h2>
						<?php
							if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''):
							$sponsor_logo = get_field('sponsor_logo_'.$category, options);
						?>
							<p class="sponsored-by"><strong>Sponsored by <?php the_field('sponsor_name_'.$category, options); ?></strong></p>
							<div class="sponsor">
								<span><?php echo fly_get_attachment_image($sponsor_logo, array(400, 300), false, array('alt' => get_field('sponsor_name_'.$category, options), 'class' => '')); ?></span>
							</div>
						<?php endif; ?>
						<?php if(get_field('category_intro_'.$category, options) != ''): ?>
							<p><?php the_field('category_intro_'.$category, options); ?></p>
						<?php endif; ?>
					</div>
					<ol>
						<?php
							$count = 0;
							while($the_query->have_posts()):
							$count++;
							$the_query->the_post();
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image') != '') {
											$image = get_field('entry_primary_image');
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo');
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink(); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo') != '') {
											$logo = get_field('entry_company_logo');
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink(); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business'); ?></strong><br />
									Entry ID <?php the_field('entry_id'); ?><br />
									<a href="<?php the_permalink(); ?>">View details</a>
									<span class="award award-<?php echo $count; ?>"></span>
								</div>
							</li>
						<?php endwhile; ?>		
					</ol>
				</div>
			<?php
				endif;
				else:
				$empty = 'false';
			?>
				<div class="category">
					<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
						<h2><?php echo get_post_type_object('award-'.sprintf('%02d', $category))->label; ?></h2>
						<?php
							if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''):
							$sponsor_logo = get_field('sponsor_logo_'.$category, options);
						?>
							<p class="sponsored-by"><strong>Sponsored by <?php the_field('sponsor_name_'.$category, options); ?></strong></p>
							<div class="sponsor">
								<span><?php echo fly_get_attachment_image($sponsor_logo, array(400, 300), false, array('alt' => get_field('sponsor_name_'.$category, options), 'class' => '')); ?></span>
							</div>
						<?php endif; ?>
						<?php if(get_field('category_intro_'.$category, options) != ''): ?>
							<p><?php the_field('category_intro_'.$category, options); ?></p>
						<?php endif; ?>
					</div>
					<?php
						$winners =  get_field('winners_'.strtolower(str_replace(' ', '_', $state)).'_'.$category, options);
						$gold = $winners['winner_'.strtolower(str_replace(' ', '_', $state)).'_gold_'.$category];
						$highly_recommended_1 = $winners['winner_'.strtolower(str_replace(' ', '_', $state)).'_highly_recommended_1_'.$category];
						$highly_recommended_2 = $winners['winner_'.strtolower(str_replace(' ', '_', $state)).'_highly_recommended_2_'.$category];
					?>
					<ol>
						<?php
							if($gold != ''):
								if((get_field('entry_status', $gold) == 'Completed') && (get_field('entry_paid', $gold) == 'Yes')):
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image', $gold) != '') {
											$image = get_field('entry_primary_image', $gold);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo', $gold);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($gold); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo', $gold) != '') {
											$logo = get_field('entry_company_logo', $gold);
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($gold); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business', $gold); ?></strong><br />
									Entry ID <?php the_field('entry_id', $gold); ?><br />
									<a href="<?php the_permalink($gold); ?>">View details</a>
									<span class="award award-1"></span>
								</div>
							</li>
						<?php
								endif;
							endif;
							if($highly_recommended_1 != ''):
								if((get_field('entry_status', $highly_recommended_1) == 'Completed') && (get_field('entry_paid', $highly_recommended_1) == 'Yes')):
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image', $highly_recommended_1) != '') {
											$image = get_field('entry_primary_image', $highly_recommended_1);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo', $highly_recommended_1);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_1); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo', $highly_recommended_1) != '') {
											$logo = get_field('entry_company_logo', $highly_recommended_1);
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_1); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business', $highly_recommended_1); ?></strong><br />
									Entry ID <?php the_field('entry_id', $highly_recommended_1); ?><br />
									<a href="<?php the_permalink($highly_recommended_1); ?>">View details</a>
									<span class="award award-2"></span>
								</div>
							</li>
						<?php
								endif;
							endif;
							if($highly_recommended_2 != ''):
								if((get_field('entry_status', $highly_recommended_2) == 'Completed') && (get_field('entry_paid', $highly_recommended_2) == 'Yes')):
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image', $highly_recommended_2) != '') {
											$image = get_field('entry_primary_image', $highly_recommended_2);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo', $highly_recommended_2);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_2); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo', $highly_recommended_2) != '') {
											$logo = get_field('entry_company_logo', $highly_recommended_2);
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_2); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business', $highly_recommended_2); ?></strong><br />
									Entry ID <?php the_field('entry_id', $highly_recommended_2); ?><br />
									<a href="<?php the_permalink($highly_recommended_2); ?>">View details</a>
									<span class="award award-3"></span>
								</div>
							</li>
						<?php
								endif;
							endif;
						?>
					</ol>
				</div>
			<?php
					endif;
				endforeach;
				if($empty == 'true'):
			?>
				<div class="category">
					<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
						<p>The winners have not been selected yet.</p>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="tabs-info winners" id="company-business">
			<?php
				$empty = 'true';
				$categories = array(43,44,45,46,47,48);
				foreach($categories as $category):
					if(get_field('winner_selection_'.$category, options) != 'Manual'):
					$args = array(
						'post_type' => 'award-'.sprintf('%02d', $category),
						'meta_key' => 'entry_average_score',
						'orderby' => 'meta_value',
						'order' => 'DESC',
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'entry_state',
								'value' => $state,
							),
							array(
								'key' => 'entry_status',
								'value' => 'Completed',
							),
							array(
								'key' => 'entry_paid',
								'value' => 'Yes',
							)
						),
						'posts_per_page' => 3
					);
					$the_query = new WP_Query($args);
					if($the_query->have_posts()):
						$empty = 'false';
			?>
				<div class="category">
					<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
						<h2><?php echo get_post_type_object('award-'.sprintf('%02d', $category))->label; ?></h2>
						<?php
							if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''):
							$sponsor_logo = get_field('sponsor_logo_'.$category, options);
						?>
							<p class="sponsored-by"><strong>Sponsored by <?php the_field('sponsor_name_'.$category, options); ?></strong></p>
							<div class="sponsor">
								<span><?php echo fly_get_attachment_image($sponsor_logo, array(400, 300), false, array('alt' => get_field('sponsor_name_'.$category, options), 'class' => '')); ?></span>
							</div>
						<?php endif; ?>
						<?php if(get_field('category_intro_'.$category, options) != ''): ?>
							<p><?php the_field('category_intro_'.$category, options); ?></p>
						<?php endif; ?>
					</div>
					<ol>
						<?php
							$count = 0;
							while($the_query->have_posts()):
							$count++;
							$the_query->the_post();
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image') != '') {
											$image = get_field('entry_primary_image');
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo');
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink(); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo') != '') {
											$logo = get_field('entry_company_logo');
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink(); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business'); ?></strong><br />
									Entry ID <?php the_field('entry_id'); ?><br />
									<a href="<?php the_permalink(); ?>">View details</a>
									<span class="award award-<?php echo $count; ?>"></span>
								</div>
							</li>
						<?php endwhile; ?>		
					</ol>
				</div>
			<?php
				endif;
				else:
				$empty = 'false';
			?>
				<div class="category">
					<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
						<h2><?php echo get_post_type_object('award-'.sprintf('%02d', $category))->label; ?></h2>
						<?php
							if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''):
							$sponsor_logo = get_field('sponsor_logo_'.$category, options);
						?>
							<p class="sponsored-by"><strong>Sponsored by <?php the_field('sponsor_name_'.$category, options); ?></strong></p>
							<div class="sponsor">
								<span><?php echo fly_get_attachment_image($sponsor_logo, array(400, 300), false, array('alt' => get_field('sponsor_name_'.$category, options), 'class' => '')); ?></span>
							</div>
						<?php endif; ?>
						<?php if(get_field('category_intro_'.$category, options) != ''): ?>
							<p><?php the_field('category_intro_'.$category, options); ?></p>
						<?php endif; ?>
					</div>
					<?php
						$winners =  get_field('winners_'.strtolower(str_replace(' ', '_', $state)).'_'.$category, options);
						$gold = $winners['winner_'.strtolower(str_replace(' ', '_', $state)).'_gold_'.$category];
						$highly_recommended_1 = $winners['winner_'.strtolower(str_replace(' ', '_', $state)).'_highly_recommended_1_'.$category];
						$highly_recommended_2 = $winners['winner_'.strtolower(str_replace(' ', '_', $state)).'_highly_recommended_2_'.$category];
					?>
					<ol>
						<?php
							if($gold != ''):
								if((get_field('entry_status', $gold) == 'Completed') && (get_field('entry_paid', $gold) == 'Yes')):
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image', $gold) != '') {
											$image = get_field('entry_primary_image', $gold);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo', $gold);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($gold); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo', $gold) != '') {
											$logo = get_field('entry_company_logo', $gold);
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($gold); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business', $gold); ?></strong><br />
									Entry ID <?php the_field('entry_id', $gold); ?><br />
									<a href="<?php the_permalink($gold); ?>">View details</a>
									<span class="award award-1"></span>
								</div>
							</li>
						<?php
								endif;
							endif;
							if($highly_recommended_1 != ''):
								if((get_field('entry_status', $highly_recommended_1) == 'Completed') && (get_field('entry_paid', $highly_recommended_1) == 'Yes')):
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image', $highly_recommended_1) != '') {
											$image = get_field('entry_primary_image', $highly_recommended_1);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo', $highly_recommended_1);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_1); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo', $highly_recommended_1) != '') {
											$logo = get_field('entry_company_logo', $highly_recommended_1);
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_1); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business', $highly_recommended_1); ?></strong><br />
									Entry ID <?php the_field('entry_id', $highly_recommended_1); ?><br />
									<a href="<?php the_permalink($highly_recommended_1); ?>">View details</a>
									<span class="award award-2"></span>
								</div>
							</li>
						<?php
								endif;
							endif;
							if($highly_recommended_2 != ''):
								if((get_field('entry_status', $highly_recommended_2) == 'Completed') && (get_field('entry_paid', $highly_recommended_2) == 'Yes')):
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image', $highly_recommended_2) != '') {
											$image = get_field('entry_primary_image', $highly_recommended_2);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo', $highly_recommended_2);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_2); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo', $highly_recommended_2) != '') {
											$logo = get_field('entry_company_logo', $highly_recommended_2);
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_2); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business', $highly_recommended_2); ?></strong><br />
									Entry ID <?php the_field('entry_id', $highly_recommended_2); ?><br />
									<a href="<?php the_permalink($highly_recommended_2); ?>">View details</a>
									<span class="award award-3"></span>
								</div>
							</li>
						<?php
								endif;
							endif;
						?>
					</ol>
				</div>
			<?php
					endif;
				endforeach;
				if($empty == 'true'):
			?>
				<div class="category">
					<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
						<p>The winners have not been selected yet.</p>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="tabs-info winners" id="individual-employee">
			<?php
				$empty = 'true';
				$categories = array(49,50,51,52,53,54,55,56,57);
				foreach($categories as $category):
					if(get_field('winner_selection_'.$category, options) != 'Manual'):
					$args = array(
						'post_type' => 'award-'.sprintf('%02d', $category),
						'meta_key' => 'entry_average_score',
						'orderby' => 'meta_value',
						'order' => 'DESC',
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'entry_state',
								'value' => $state,
							),
							array(
								'key' => 'entry_status',
								'value' => 'Completed',
							),
							array(
								'key' => 'entry_paid',
								'value' => 'Yes',
							)
						),
						'posts_per_page' => 3
					);
					$the_query = new WP_Query($args);
					if($the_query->have_posts()):
						$empty = 'false';
			?>
				<div class="category">
					<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
						<h2><?php echo get_post_type_object('award-'.sprintf('%02d', $category))->label; ?></h2>
						<?php
							if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''):
							$sponsor_logo = get_field('sponsor_logo_'.$category, options);
						?>
							<p class="sponsored-by"><strong>Sponsored by <?php the_field('sponsor_name_'.$category, options); ?></strong></p>
							<div class="sponsor">
								<span><?php echo fly_get_attachment_image($sponsor_logo, array(400, 300), false, array('alt' => get_field('sponsor_name_'.$category, options), 'class' => '')); ?></span>
							</div>
						<?php endif; ?>
						<?php if(get_field('category_intro_'.$category, options) != ''): ?>
							<p><?php the_field('category_intro_'.$category, options); ?></p>
						<?php endif; ?>
					</div>
					<ol>
						<?php
							$count = 0;
							while($the_query->have_posts()):
							$count++;
							$the_query->the_post();
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image') != '') {
											$image = get_field('entry_primary_image');
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo');
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink(); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo') != '') {
											$logo = get_field('entry_company_logo');
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink(); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business'); ?></strong><br />
									Entry ID <?php the_field('entry_id'); ?><br />
									<a href="<?php the_permalink(); ?>">View details</a>
									<span class="award award-<?php echo $count; ?>"></span>
								</div>
							</li>
						<?php endwhile; ?>		
					</ol>
				</div>
			<?php
				endif;
				else:
				$empty = 'false';
			?>
				<div class="category">
					<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
						<h2><?php echo get_post_type_object('award-'.sprintf('%02d', $category))->label; ?></h2>
						<?php
							if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''):
							$sponsor_logo = get_field('sponsor_logo_'.$category, options);
						?>
							<p class="sponsored-by"><strong>Sponsored by <?php the_field('sponsor_name_'.$category, options); ?></strong></p>
							<div class="sponsor">
								<span><?php echo fly_get_attachment_image($sponsor_logo, array(400, 300), false, array('alt' => get_field('sponsor_name_'.$category, options), 'class' => '')); ?></span>
							</div>
						<?php endif; ?>
						<?php if(get_field('category_intro_'.$category, options) != ''): ?>
							<p><?php the_field('category_intro_'.$category, options); ?></p>
						<?php endif; ?>
					</div>
					<?php
						$winners =  get_field('winners_'.strtolower(str_replace(' ', '_', $state)).'_'.$category, options);
						$gold = $winners['winner_'.strtolower(str_replace(' ', '_', $state)).'_gold_'.$category];
						$highly_recommended_1 = $winners['winner_'.strtolower(str_replace(' ', '_', $state)).'_highly_recommended_1_'.$category];
						$highly_recommended_2 = $winners['winner_'.strtolower(str_replace(' ', '_', $state)).'_highly_recommended_2_'.$category];
					?>
					<ol>
						<?php
							if($gold != ''):
								if((get_field('entry_status', $gold) == 'Completed') && (get_field('entry_paid', $gold) == 'Yes')):
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image', $gold) != '') {
											$image = get_field('entry_primary_image', $gold);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo', $gold);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($gold); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo', $gold) != '') {
											$logo = get_field('entry_company_logo', $gold);
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($gold); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business', $gold); ?></strong><br />
									Entry ID <?php the_field('entry_id', $gold); ?><br />
									<a href="<?php the_permalink($gold); ?>">View details</a>
									<span class="award award-1"></span>
								</div>
							</li>
						<?php
								endif;
							endif;
							if($highly_recommended_1 != ''):
								if((get_field('entry_status', $highly_recommended_1) == 'Completed') && (get_field('entry_paid', $highly_recommended_1) == 'Yes')):
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image', $highly_recommended_1) != '') {
											$image = get_field('entry_primary_image', $highly_recommended_1);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo', $highly_recommended_1);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_1); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo', $highly_recommended_1) != '') {
											$logo = get_field('entry_company_logo', $highly_recommended_1);
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_1); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business', $highly_recommended_1); ?></strong><br />
									Entry ID <?php the_field('entry_id', $highly_recommended_1); ?><br />
									<a href="<?php the_permalink($highly_recommended_1); ?>">View details</a>
									<span class="award award-2"></span>
								</div>
							</li>
						<?php
								endif;
							endif;
							if($highly_recommended_2 != ''):
								if((get_field('entry_status', $highly_recommended_2) == 'Completed') && (get_field('entry_paid', $highly_recommended_2) == 'Yes')):
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image', $highly_recommended_2) != '') {
											$image = get_field('entry_primary_image', $highly_recommended_2);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo', $highly_recommended_2);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_2); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo', $highly_recommended_2) != '') {
											$logo = get_field('entry_company_logo', $highly_recommended_2);
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_2); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business', $highly_recommended_2); ?></strong><br />
									Entry ID <?php the_field('entry_id', $highly_recommended_2); ?><br />
									<a href="<?php the_permalink($highly_recommended_2); ?>">View details</a>
									<span class="award award-3"></span>
								</div>
							</li>
						<?php
								endif;
							endif;
						?>
					</ol>
				</div>
			<?php
					endif;
				endforeach;
				if($empty == 'true'):
			?>
				<div class="category">
					<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
						<p>The winners have not been selected yet.</p>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="tabs-info winners" id="industry-product">
			<?php
				$empty = 'true';
				$categories = array(1,2,3,4,5,6,7);
				foreach($categories as $category):
					if(get_field('winner_selection_'.$category, options) != 'Manual'):
					$args = array(
						'post_type' => 'award-'.sprintf('%02d', $category),
						'meta_key' => 'entry_average_score',
						'orderby' => 'meta_value',
						'order' => 'DESC',
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'entry_state',
								'value' => $state,
							),
							array(
								'key' => 'entry_status',
								'value' => 'Completed',
							),
							array(
								'key' => 'entry_paid',
								'value' => 'Yes',
							)
						),
						'posts_per_page' => 3
					);
					$the_query = new WP_Query($args);
					if($the_query->have_posts()):
						$empty = 'false';
			?>
				<div class="category">
					<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
						<h2><?php echo get_post_type_object('award-'.sprintf('%02d', $category))->label; ?></h2>
						<?php
							if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''):
							$sponsor_logo = get_field('sponsor_logo_'.$category, options);
						?>
							<p class="sponsored-by"><strong>Sponsored by <?php the_field('sponsor_name_'.$category, options); ?></strong></p>
							<div class="sponsor">
								<span><?php echo fly_get_attachment_image($sponsor_logo, array(400, 300), false, array('alt' => get_field('sponsor_name_'.$category, options), 'class' => '')); ?></span>
							</div>
						<?php endif; ?>
						<?php if(get_field('category_intro_'.$category, options) != ''): ?>
							<p><?php the_field('category_intro_'.$category, options); ?></p>
						<?php endif; ?>
					</div>
					<ol>
						<?php
							$count = 0;
							while($the_query->have_posts()):
							$count++;
							$the_query->the_post();
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image') != '') {
											$image = get_field('entry_primary_image');
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo');
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink(); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo') != '') {
											$logo = get_field('entry_company_logo');
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink(); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business'); ?></strong><br />
									Entry ID <?php the_field('entry_id'); ?><br />
									<a href="<?php the_permalink(); ?>">View details</a>
									<span class="award award-<?php echo $count; ?>"></span>
								</div>
							</li>
						<?php endwhile; ?>		
					</ol>
				</div>
			<?php
				endif;
				else:
				$empty = 'false';
			?>
				<div class="category">
					<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
						<h2><?php echo get_post_type_object('award-'.sprintf('%02d', $category))->label; ?></h2>
						<?php
							if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''):
							$sponsor_logo = get_field('sponsor_logo_'.$category, options);
						?>
							<p class="sponsored-by"><strong>Sponsored by <?php the_field('sponsor_name_'.$category, options); ?></strong></p>
							<div class="sponsor">
								<span><?php echo fly_get_attachment_image($sponsor_logo, array(400, 300), false, array('alt' => get_field('sponsor_name_'.$category, options), 'class' => '')); ?></span>
							</div>
						<?php endif; ?>
						<?php if(get_field('category_intro_'.$category, options) != ''): ?>
							<p><?php the_field('category_intro_'.$category, options); ?></p>
						<?php endif; ?>
					</div>
					<?php
						$winners =  get_field('winners_'.strtolower(str_replace(' ', '_', $state)).'_'.$category, options);
						$gold = $winners['winner_'.strtolower(str_replace(' ', '_', $state)).'_gold_'.$category];
						$highly_recommended_1 = $winners['winner_'.strtolower(str_replace(' ', '_', $state)).'_highly_recommended_1_'.$category];
						$highly_recommended_2 = $winners['winner_'.strtolower(str_replace(' ', '_', $state)).'_highly_recommended_2_'.$category];
					?>
					<ol>
						<?php
							if($gold != ''):
								if((get_field('entry_status', $gold) == 'Completed') && (get_field('entry_paid', $gold) == 'Yes')):
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image', $gold) != '') {
											$image = get_field('entry_primary_image', $gold);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo', $gold);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($gold); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo', $gold) != '') {
											$logo = get_field('entry_company_logo', $gold);
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($gold); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business', $gold); ?></strong><br />
									Entry ID <?php the_field('entry_id', $gold); ?><br />
									<a href="<?php the_permalink($gold); ?>">View details</a>
									<span class="award award-1"></span>
								</div>
							</li>
						<?php
								endif;
							endif;
							if($highly_recommended_1 != ''):
								if((get_field('entry_status', $highly_recommended_1) == 'Completed') && (get_field('entry_paid', $highly_recommended_1) == 'Yes')):
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image', $highly_recommended_1) != '') {
											$image = get_field('entry_primary_image', $highly_recommended_1);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo', $highly_recommended_1);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_1); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo', $highly_recommended_1) != '') {
											$logo = get_field('entry_company_logo', $highly_recommended_1);
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_1); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business', $highly_recommended_1); ?></strong><br />
									Entry ID <?php the_field('entry_id', $highly_recommended_1); ?><br />
									<a href="<?php the_permalink($highly_recommended_1); ?>">View details</a>
									<span class="award award-2"></span>
								</div>
							</li>
						<?php
								endif;
							endif;
							if($highly_recommended_2 != ''):
								if((get_field('entry_status', $highly_recommended_2) == 'Completed') && (get_field('entry_paid', $highly_recommended_2) == 'Yes')):
						?>
							<li>
								<?php
									if((get_field('list_display_'.$category, options) == 'Primary Image') || (get_field('list_display_'.$category, options) == 'Main Photo')):
										if(get_field('entry_primary_image', $highly_recommended_2) != '') {
											$image = get_field('entry_primary_image', $highly_recommended_2);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} elseif(get_field('entry_main_photo') != '') {
											$image = get_field('entry_main_photo', $highly_recommended_2);
											$image_src = fly_get_attachment_image($image[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$image_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_2); ?>" class="image">
										<span><?php echo $image_src; ?></span>
										<span class="border"></span>
									</a>
								<?php
									elseif(get_field('list_display_'.$category, options) == 'Company Logo'):
										if(get_field('entry_company_logo', $highly_recommended_2) != '') {
											$logo = get_field('entry_company_logo', $highly_recommended_2);
											$logo_src = fly_get_attachment_image($logo[id], array(360, 240), false, array('alt' => get_the_title(), 'class' => ''));
										} else {
											$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
										}
								?>
									<a href="<?php the_permalink($highly_recommended_2); ?>" class="logo">
										<span><?php echo $logo_src; ?></span>
										<span class="border"></span>
									</a>
								<?php endif; ?>
								<div class="title">
									<strong><?php the_field('entry_member_business', $highly_recommended_2); ?></strong><br />
									Entry ID <?php the_field('entry_id', $highly_recommended_2); ?><br />
									<a href="<?php the_permalink($highly_recommended_2); ?>">View details</a>
									<span class="award award-3"></span>
								</div>
							</li>
						<?php
								endif;
							endif;
						?>
					</ol>
				</div>
			<?php
					endif;
				endforeach;
				if($empty == 'true'):
			?>
				<div class="category">
					<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
						<p>The winners have not been selected yet.</p>
					</div>
				</div>
			<?php endif; ?>
		</div>
	<?php else: ?>
		<div class="tabs-info winners active" id="judges-awards">
			<div class="category">
				<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
					<h2>Pool of the Year</h2>
					<?php if(!get_field('pool_of_the_year_winner', options)): ?>
						<p>The winner has not been selected yet.</p>
					<?php endif; ?>
				</div>
				<?php if(get_field('pool_of_the_year_winner', options)): ?>
					<ol>
						<li>
							<?php
								if(get_field('pool_of_the_year_layout', options) == 'Primary Image'):
									if(get_field('entry_primary_image', get_field('pool_of_the_year_winner', options)) != '') {
										$image = get_field('entry_primary_image', get_field('pool_of_the_year_winner', options));
										$image_url = wp_get_attachment_image_src($image[ID], 'review-image');
										$image_src = $image_url[0];
									} elseif(get_field('entry_main_photo', get_field('pool_of_the_year_winner', options)) != '') {
										$image = get_field('entry_main_photo', get_field('pool_of_the_year_winner', options));
										$image_url = wp_get_attachment_image_src($image[ID], 'review-image');
										$image_src = $image_url[0];
									} else {
										$image_src = get_template_directory_uri().'/images/review-placeholder.png';
									}
							?>
								<a href="<?php the_permalink(get_field('pool_of_the_year_winner', options)); ?>" class="image">
									<span><img src="<?php echo $image_src; ?>" alt="<?php the_title(get_field('pool_of_the_year_winner', options)); ?>" /></span>
									<span class="border"></span>
								</a>
							<?php
								elseif(get_field('pool_of_the_year_layout', options) == 'Company Logo'):
									if(get_field('entry_company_logo', get_field('pool_of_the_year_winner', options)) != '') {
										$logo = get_field('entry_company_logo', get_field('pool_of_the_year_winner', options));
										$logo_url = wp_get_attachment_image_src($logo[ID], 'business-logo');
										$logo_src = $logo_url[0];
									} else {
										$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
									}
							?>
								<a href="<?php the_permalink(get_field('pool_of_the_year_winner', options)); ?>" class="logo">
									<span><img src="<?php echo $logo_src; ?>" alt="<?php the_title(get_field('pool_of_the_year_winner', options)); ?>" /></span>
									<span class="border"></span>
								</a>
							<?php endif; ?>
							<div class="title">
								<strong><?php the_field('entry_member_business', get_field('pool_of_the_year_winner', options)); ?></strong><br />
								Entry ID <?php the_field('entry_id', get_field('pool_of_the_year_winner', options)); ?><br />
								<a href="<?php the_permalink(get_field('pool_of_the_year_winner', options)); ?>">View details</a>
								<span class="award award-1"></span>
							</div>
						</li>
					</ol>
				<?php endif; ?>
			</div>
			<div class="category">
				<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
					<h2>Spa of the Year</h2>
					<?php if(!get_field('spa_of_the_year_winner', options)): ?>
						<p>The winner has not been selected yet.</p>
					<?php endif; ?>
				</div>
				<?php if(get_field('spa_of_the_year_winner', options)): ?>
					<ol>
						<li>
							<?php
								if(get_field('spa_of_the_year_layout', options) == 'Primary Image'):
									if(get_field('entry_primary_image', get_field('spa_of_the_year_winner', options)) != '') {
										$image = get_field('entry_primary_image', get_field('spa_of_the_year_winner', options));
										$image_url = wp_get_attachment_image_src($image[ID], 'review-image');
										$image_src = $image_url[0];
									} elseif(get_field('entry_main_photo', get_field('spa_of_the_year_winner', options)) != '') {
										$image = get_field('entry_main_photo', get_field('spa_of_the_year_winner', options));
										$image_url = wp_get_attachment_image_src($image[ID], 'review-image');
										$image_src = $image_url[0];
									} else {
										$image_src = get_template_directory_uri().'/images/review-placeholder.png';
									}
							?>
								<a href="<?php the_permalink(get_field('spa_of_the_year_winner', options)); ?>" class="image">
									<span><img src="<?php echo $image_src; ?>" alt="<?php the_title(get_field('spa_of_the_year_winner', options)); ?>" /></span>
									<span class="border"></span>
								</a>
							<?php
								elseif(get_field('spa_of_the_year_layout', options) == 'Company Logo'):
									if(get_field('entry_company_logo', get_field('spa_of_the_year_winner', options)) != '') {
										$logo = get_field('entry_company_logo', get_field('spa_of_the_year_winner', options));
										$logo_url = wp_get_attachment_image_src($logo[ID], 'business-logo');
										$logo_src = $logo_url[0];
									} else {
										$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
									}
							?>
								<a href="<?php the_permalink(get_field('spa_of_the_year_winner', options)); ?>" class="logo">
									<span><img src="<?php echo $logo_src; ?>" alt="<?php the_title(get_field('spa_of_the_year_winner', options)); ?>" /></span>
									<span class="border"></span>
								</a>
							<?php endif; ?>
							<div class="title">
								<strong><?php the_field('entry_member_business', get_field('spa_of_the_year_winner', options)); ?></strong><br />
								Entry ID <?php the_field('entry_id', get_field('spa_of_the_year_winner', options)); ?><br />
								<a href="<?php the_permalink(get_field('spa_of_the_year_winner', options)); ?>">View details</a>
								<span class="award award-1"></span>
							</div>
						</li>
					</ol>
				<?php endif; ?>
			</div>
			<div class="category">
				<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
					<h2>Commercial Project of the Year</h2>
					<?php if(!get_field('commercial_project_of_the_year_winner', options)): ?>
						<p>The winner has not been selected yet.</p>
					<?php endif; ?>
				</div>
				<?php if(get_field('commercial_project_of_the_year_winner', options)): ?>
					<ol>
						<li>
							<?php
								if(get_field('commercial_project_of_the_year_layout', options) == 'Primary Image'):
									if(get_field('entry_primary_image', get_field('commercial_project_of_the_year_winner', options)) != '') {
										$image = get_field('entry_primary_image', get_field('commercial_project_of_the_year_winner', options));
										$image_url = wp_get_attachment_image_src($image[ID], 'review-image');
										$image_src = $image_url[0];
									} elseif(get_field('entry_main_photo', get_field('commercial_project_of_the_year_winner', options)) != '') {
										$image = get_field('entry_main_photo', get_field('commercial_project_of_the_year_winner', options));
										$image_url = wp_get_attachment_image_src($image[ID], 'review-image');
										$image_src = $image_url[0];
									} else {
										$image_src = get_template_directory_uri().'/images/review-placeholder.png';
									}
							?>
								<a href="<?php the_permalink(get_field('commercial_project_of_the_year_winner', options)); ?>" class="image">
									<span><img src="<?php echo $image_src; ?>" alt="<?php the_title(get_field('commercial_project_of_the_year_winner', options)); ?>" /></span>
									<span class="border"></span>
								</a>
							<?php
								elseif(get_field('commercial_project_of_the_year_layout', options) == 'Company Logo'):
									if(get_field('entry_company_logo', get_field('commercial_project_of_the_year_winner', options)) != '') {
										$logo = get_field('entry_company_logo', get_field('commercial_project_of_the_year_winner', options));
										$logo_url = wp_get_attachment_image_src($logo[ID], 'business-logo');
										$logo_src = $logo_url[0];
									} else {
										$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
									}
							?>
								<a href="<?php the_permalink(get_field('commercial_project_of_the_year_winner', options)); ?>" class="logo">
									<span><img src="<?php echo $logo_src; ?>" alt="<?php the_title(get_field('commercial_project_of_the_year_winner', options)); ?>" /></span>
									<span class="border"></span>
								</a>
							<?php endif; ?>
							<div class="title">
								<strong><?php the_field('entry_member_business', get_field('commercial_project_of_the_year_winner', options)); ?></strong><br />
								Entry ID <?php the_field('entry_id', get_field('commercial_project_of_the_year_winner', options)); ?><br />
								<a href="<?php the_permalink(get_field('commercial_project_of_the_year_winner', options)); ?>">View details</a>
								<span class="award award-1"></span>
							</div>
						</li>
					</ol>
				<?php endif; ?>
			</div>
			<div class="category">
				<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
					<h2>Retailer of the Year</h2>
					<?php if(!get_field('retailer_of_the_year_winner', options)): ?>
						<p>The winner has not been selected yet.</p>
					<?php endif; ?>
				</div>
				<?php if(get_field('retailer_of_the_year_winner', options)): ?>
					<ol>
						<li>
							<?php
								if(get_field('retailer_of_the_year_layout', options) == 'Primary Image'):
									if(get_field('entry_primary_image', get_field('retailer_of_the_year_winner', options)) != '') {
										$image = get_field('entry_primary_image', get_field('retailer_of_the_year_winner', options));
										$image_url = wp_get_attachment_image_src($image[ID], 'review-image');
										$image_src = $image_url[0];
									} elseif(get_field('entry_main_photo', get_field('retailer_of_the_year_winner', options)) != '') {
										$image = get_field('entry_main_photo', get_field('retailer_of_the_year_winner', options));
										$image_url = wp_get_attachment_image_src($image[ID], 'review-image');
										$image_src = $image_url[0];
									} else {
										$image_src = get_template_directory_uri().'/images/review-placeholder.png';
									}
							?>
								<a href="<?php the_permalink(get_field('retailer_of_the_year_winner', options)); ?>" class="image">
									<span><img src="<?php echo $image_src; ?>" alt="<?php the_title(get_field('retailer_of_the_year_winner', options)); ?>" /></span>
									<span class="border"></span>
								</a>
							<?php
								elseif(get_field('retailer_of_the_year_layout', options) == 'Company Logo'):
									if(get_field('entry_company_logo', get_field('retailer_of_the_year_winner', options)) != '') {
										$logo = get_field('entry_company_logo', get_field('retailer_of_the_year_winner', options));
										$logo_url = wp_get_attachment_image_src($logo[ID], 'business-logo');
										$logo_src = $logo_url[0];
									} else {
										$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
									}
							?>
								<a href="<?php the_permalink(get_field('retailer_of_the_year_winner', options)); ?>" class="logo">
									<span><img src="<?php echo $logo_src; ?>" alt="<?php the_title(get_field('retailer_of_the_year_winner', options)); ?>" /></span>
									<span class="border"></span>
								</a>
							<?php endif; ?>
							<div class="title">
								<strong><?php the_field('entry_member_business', get_field('retailer_of_the_year_winner', options)); ?></strong><br />
								Entry ID <?php the_field('entry_id', get_field('retailer_of_the_year_winner', options)); ?><br />
								<a href="<?php the_permalink(get_field('retailer_of_the_year_winner', options)); ?>">View details</a>
								<span class="award award-1"></span>
							</div>
						</li>
					</ol>
				<?php endif; ?>
			</div>
			<div class="category">
				<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
					<h2>Employee of the Year</h2>
					<?php if(!get_field('employee_of_the_year_winner', options)): ?>
						<p>The winner has not been selected yet.</p>
					<?php endif; ?>
				</div>
				<?php if(get_field('employee_of_the_year_winner', options)): ?>
					<ol>
						<li>
							<?php
								if(get_field('employee_of_the_year_layout', options) == 'Primary Image'):
									if(get_field('entry_primary_image', get_field('employee_of_the_year_winner', options)) != '') {
										$image = get_field('entry_primary_image', get_field('employee_of_the_year_winner', options));
										$image_url = wp_get_attachment_image_src($image[ID], 'review-image');
										$image_src = $image_url[0];
									} elseif(get_field('entry_main_photo', get_field('employee_of_the_year_winner', options)) != '') {
										$image = get_field('entry_main_photo', get_field('employee_of_the_year_winner', options));
										$image_url = wp_get_attachment_image_src($image[ID], 'review-image');
										$image_src = $image_url[0];
									} else {
										$image_src = get_template_directory_uri().'/images/review-placeholder.png';
									}
							?>
								<a href="<?php the_permalink(get_field('employee_of_the_year_winner', options)); ?>" class="image">
									<span><img src="<?php echo $image_src; ?>" alt="<?php the_title(get_field('employee_of_the_year_winner', options)); ?>" /></span>
									<span class="border"></span>
								</a>
							<?php
								elseif(get_field('employee_of_the_year_layout', options) == 'Company Logo'):
									if(get_field('entry_company_logo', get_field('employee_of_the_year_winner', options)) != '') {
										$logo = get_field('entry_company_logo', get_field('employee_of_the_year_winner', options));
										$logo_url = wp_get_attachment_image_src($logo[ID], 'business-logo');
										$logo_src = $logo_url[0];
									} else {
										$logo_src = get_template_directory_uri().'/images/review-placeholder.png';
									}
							?>
								<a href="<?php the_permalink(get_field('employee_of_the_year_winner', options)); ?>" class="logo">
									<span><img src="<?php echo $logo_src; ?>" alt="<?php the_title(get_field('employee_of_the_year_winner', options)); ?>" /></span>
									<span class="border"></span>
								</a>
							<?php endif; ?>
							<div class="title">
								<strong><?php the_field('entry_member_business', get_field('employee_of_the_year_winner', options)); ?></strong><br />
								Entry ID <?php the_field('entry_id', get_field('employee_of_the_year_winner', options)); ?><br />
								<a href="<?php the_permalink(get_field('employee_of_the_year_winner', options)); ?>">View details</a>
								<span class="award award-1"></span>
							</div>
						</li>
					</ol>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
