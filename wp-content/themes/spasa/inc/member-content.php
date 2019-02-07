<div class="content center">
	<div class="dashboard-header">
		<h2>Your Entries</h2>
		<?php if(get_field('site_status', options) == '1'): ?>
			<a href="<?php echo esc_url(home_url()); ?>/select-category/">Submit New Entry</a>
		<?php endif; ?>
	</div>
	<?php
		$category_exceptions = array('46','47','49','50','51','52','53','54','55','56','57');
		$post_types_array = array();
		$post_types_not_excluded_array = array();
		$args = array(
		   'public'   => true,
		   '_builtin' => false
		);
		$output = 'names';
		$operator = 'and';
		$post_types = get_post_types($args,$output,$operator);
		if($post_types) {
			foreach($post_types as $post_type) {
				$post_types_array[] = $post_type;
				if(!in_array(str_replace('award-', '' , $post_type), $category_exceptions)) {
					$post_types_not_excluded_array[] = $post_type;
				}
			}
		}
		$the_query = new WP_Query(
			array(
				'post_type' => $post_types_array,
				'orderby' => 'post_type',
				'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'entry_member_id',
						'value' => get_current_user_id()
					)
				),
				'posts_per_page' => -1
			)
		);
		if($the_query->have_posts()):
			$show_payment = false;
	?>
		<table class="member-entry-table">
			<tr>
				<th>ID</th>
				<th>Category</th>
				<th>State</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			<?php
				while($the_query->have_posts()):
					$the_query->the_post();
			?>
				<tr>
					<td class="id"><?php the_field('entry_id'); ?></td>
					<td class="type"><?php echo get_post_type_object($post->post_type)->label; ?> <span class="category">Category <?php echo intval(str_replace('award-', '', get_post_type_object($post->post_type)->name)); ?></span></td>
					<td class="state"><?php the_field('entry_state'); ?></td>
					<td class="status">
						<?php
							if(get_field('entry_status') == 'Completed') {
								echo 'Complete ';
								if(get_field('entry_paid') == 'Yes'):
									echo '<span class="paid">Paid</span>';
								else:
									echo '<span class="unpaid">Unpaid</span>';
									$show_payment = true;
								endif;
							} else {
								echo 'Draft ';
							}
						?>
					</td>
					<td class="action">
						<?php if((get_field('entry_status') != 'Completed') && (get_field('site_status', options) == '1')): ?>
							<a href="#delete" data-redirect="<?php echo esc_url(home_url()).'/?delete='.get_field('entry_id'); ?>">Delete</a>
							<a href="<?php echo esc_url(home_url()).'/edit/'.get_the_ID(); ?>">Edit</a>
						<?php endif; ?>
						<a href="<?php the_permalink(); ?>">View</a>
						<?php if(get_field('site_status', options) == '1'): ?>
							<a href="#copy-list" data-entry-id="<?php echo get_the_ID(); ?>">Copy</a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endwhile; ?>
			<?php if(($show_payment == true) && (get_field('site_status', options) == '1')): ?>
				<tr>
					<td colspan="5" class="payment-intro">Payment of the following entries must be made before the nomination deadline in order for them to be eligible for judging.</td>
				</tr>
				<?php
					$payment_query = new WP_Query(
						array(
							'post_type' => $post_types_array,
							'orderby' => 'post_type',
							'order' => 'ASC',
							'meta_query' => array(
								array(
									'key' => 'entry_member_id',
									'value' => get_current_user_id()
								), 
								array(
									'key' => 'entry_status',
									'value' => 'Completed'
								), 
								array(
									'key' => 'entry_paid',
									'value' => 'No'
								)
							),
							'posts_per_page' => -1
						)
					);
					if($payment_query->have_posts()):
						$total = '';
						$reduced_query = new WP_Query(
							array(
								'post_type' => $post_types_not_excluded_array,
								'meta_query' => array(
									array(
										'key' => 'entry_member_id',
										'value' => get_current_user_id()
									), 
									array(
										'key' => 'entry_paid',
										'value' => 'Yes'
									)
								),
								'posts_per_page' => -1
							)
						);
						if($reduced_query->have_posts()) {
							$initial_reduced = 1;
							$reduced = true;
						} else {
							$initial_reduced = 0;
							$reduced = false;
						}
						$entry_id = array();
						while($payment_query->have_posts()):
							$payment_query->the_post();		
				?>
					<tr>
						<td class="payment-pending"><?php the_field('entry_id'); $entry_id[] = $post->ID; ?></td>
						<td colspan="3" class="payment-pending"><?php echo get_post_type_object($post->post_type)->label; ?></td>
						<td class="payment-pending">
						<?php
							if($reduced == false) {
								echo '$'.get_field('entry_first_cost');
								$total = intval($total) + intval(get_field('entry_first_cost'));
								if(!in_array(get_post_type_object($post->post_type)->label, $category_exceptions)) {
									$reduced = true;
								}
							} else {
								echo '$'.get_field('entry_further_cost');
								$total = intval($total) + intval(get_field('entry_further_cost'));
							}
						?>
						</td>
					</tr>
				<?php
						endwhile;
					endif;
				?>
			<?php endif; ?>
		</table>
		<?php if(($show_payment == true) && (get_field('site_status', options) == '1')): ?>
			<p class="payment-total">
				<strong>Total: <span>$<?php echo $total; ?></span></strong><br />
				<span class="gst">All prices include GST</span>
			</p>
			<form action="<?php echo esc_url(home_url()).'/payment/'; ?>" method="post" class="payment-options">
				<div class="options">
					<button type="button" class="offline">Pay Offline</button> 
					<span class="separator">or</span> 
					<button type="button" class="online">Pay Online<span> Now</span></button>
					<img src="<?php bloginfo('template_url'); ?>/images/payment-cards.png" alt="Payment cards" />
					<input type="hidden" name="payment_type" value="" />
					<input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>" />
					<input type="hidden" name="entry_id" value="<?php echo implode(',', $entry_id); ?>" />
					<input type="hidden" name="total" value="<?php echo $total; ?>" />
				</div>
				<div class="westpac">
					<img src="<?php bloginfo('template_url'); ?>/images/westpac.png" alt="Westpac" /><br />
					Secure online payments are processed by Westpac Banking Corporation<br />
					ABN 33 007 457 141<br />
				</div>
			</form>
		<?php else: ?>
			<br /><br />
		<?php endif; ?>		
	<?php else: ?>
		<p>To submit your first entry please <a href="<?php echo esc_url(home_url()); ?>/select-category/">click here</a> and select a category.</p>
	<?php endif; ?>
</div>
