<div class="content center">
	<ul class="tabs">
		<li><a href="#build-installation" class="active">Build &amp; Installation</a></li>
		<li><a href="#company-business">Company / Business</a></li>
		<li><a href="#individual-employee">Individual / Employee</a></li>
		<li><a href="#industry-product">Industry &amp; Product</a></li>
	</ul>
	<div class="tabs-info review active" id="build-installation">
		<?php
			$empty = 'true';
			$categories = array(8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42);
			foreach($categories as $category):
				$args = array(
					'post_type' => 'award-'.sprintf('%02d', $category),
					'orderby' => 'date',
					'order' => 'ASC',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => 'entry_status',
							'value' => 'Completed',
						),
						array(
							'key' => 'entry_paid',
							'value' => 'Yes',
						)
					),
					'posts_per_page' => -1
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
						while($the_query->have_posts()):
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
										$image_src = '<img src="'.get_template_directory_uri().'/images/review-placeholder.png" alt="'.get_the_title().'" />';
									}
							?>
								<a href="<?php the_permalink(); ?>" class="image">
									<span><?php echo $image_src; ?></span>
									<span class="border"></span>
								</a>
							<?php endif; ?>
							<strong>Entry ID <?php the_field('entry_id'); ?></strong><br />
							<a href="<?php the_permalink(); ?>">View details</a>
						</li>
					<?php endwhile; ?>		
				</ol>
			</div>
		<?php			
				endif;	
			endforeach;
			if($empty == 'true'):
		?>
			<div class="category">
				<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
					<p>There are currently no &quot;Build &amp; Installation&quot; entries.</p>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="tabs-info review" id="company-business">
		<?php
			$empty = 'true';
			$categories = array(43,44,45,46,47,48);
			foreach($categories as $category):
				$args = array(
					'post_type' => 'award-'.sprintf('%02d', $category),
					'orderby' => 'date',
					'order' => 'ASC',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => 'entry_status',
							'value' => 'Completed',
						),
						array(
							'key' => 'entry_paid',
							'value' => 'Yes',
						)
					),
					'posts_per_page' => -1
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
						while($the_query->have_posts()):
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
										$image_src = '<img src="'.get_template_directory_uri().'/images/review-placeholder.png" alt="'.get_the_title().'" />';
									}
							?>
								<a href="<?php the_permalink(); ?>" class="image">
									<span><?php echo $image_src; ?></span>
									<span class="border"></span>
								</a>
							<?php endif; ?>
							<strong>Entry ID <?php the_field('entry_id'); ?></strong><br />
							<a href="<?php the_permalink(); ?>">View details</a>
						</li>
					<?php endwhile; ?>		
				</ol>
			</div>
		<?php			
				endif;	
			endforeach;
			if($empty == 'true'):
		?>
			<div class="category">
				<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
					<p>There are currently no &quot;Company / Business&quot; entries.</p>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="tabs-info review" id="individual-employee">
		<?php
			$empty = 'true';
			$categories = array(49,50,51,52,53,54,55,56,57);
			foreach($categories as $category):
				$args = array(
					'post_type' => 'award-'.sprintf('%02d', $category),
					'orderby' => 'date',
					'order' => 'ASC',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => 'entry_status',
							'value' => 'Completed',
						),
						array(
							'key' => 'entry_paid',
							'value' => 'Yes',
						)
					),
					'posts_per_page' => -1
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
						while($the_query->have_posts()):
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
										$image_src = '<img src="'.get_template_directory_uri().'/images/review-placeholder.png" alt="'.get_the_title().'" />';
									}
							?>
								<a href="<?php the_permalink(); ?>" class="image">
									<span><?php echo $image_src; ?></span>
									<span class="border"></span>
								</a>
							<?php endif; ?>
							<strong>Entry ID <?php the_field('entry_id'); ?></strong><br />
							<a href="<?php the_permalink(); ?>">View details</a>
						</li>
					<?php endwhile; ?>		
				</ol>
			</div>
		<?php			
				endif;	
			endforeach;
			if($empty == 'true'):
		?>
			<div class="category">
				<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
					<p>There are currently no &quot;Individual / Employee&quot; entries.</p>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="tabs-info review" id="industry-product">
		<?php
			$empty = 'true';
			$categories = array(1,2,3,4,5,6,7);
			foreach($categories as $category):
				$args = array(
					'post_type' => 'award-'.sprintf('%02d', $category),
					'orderby' => 'date',
					'order' => 'ASC',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => 'entry_status',
							'value' => 'Completed',
						),
						array(
							'key' => 'entry_paid',
							'value' => 'Yes',
						)
					),
					'posts_per_page' => -1
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
						while($the_query->have_posts()):
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
										$image_src = '<img src="'.get_template_directory_uri().'/images/review-placeholder.png" alt="'.get_the_title().'" />';
									}
							?>
								<a href="<?php the_permalink(); ?>" class="image">
									<span><?php echo $image_src; ?></span>
									<span class="border"></span>
								</a>
							<?php endif; ?>
							<strong>Entry ID <?php the_field('entry_id'); ?></strong><br />
							<a href="<?php the_permalink(); ?>">View details</a>
						</li>
					<?php endwhile; ?>		
				</ol>
			</div>
		<?php			
				endif;	
			endforeach;
			if($empty == 'true'):
		?>
			<div class="category">
				<div class="intro<?php if(get_field('sponsor_logo_'.$category, options) != '' && get_field('sponsor_name_'.$category, options) != ''): ?> sponsored<?php endif; ?>">
					<p>There are currently no &quot;Industry &amp; Product&quot; entries.</p>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
