<div class="content center">
	<ul class="tabs">
		<li><a href="#awaiting-score" class="active">Entries Awaiting Your Score</a></li>
		<li><a href="#have-scored">Entries You Have Scored</a></li>
	</ul>
	<div class="tabs-info judge-dashboard active" id="awaiting-score">
		<?php
			$awaiting_score = false;
			$args = array(
			   'public'   => true,
			   '_builtin' => false
			);
			$output = 'names';
			$operator = 'and';
			$post_types = get_post_types($args,$output,$operator);
			function my_posts_where($where) {
				global $wpdb;
				$where = str_replace(
					'meta_key = \'entry_scores_%', 
					'meta_key LIKE \'entry_scores_%',
					$wpdb->remove_placeholder_escape($where)
				);
				return $where;
			}
			add_filter('posts_where', 'my_posts_where');
			if($post_types):
				foreach($post_types as $post_type):
					$excluded_post = array();
					$args = array(
						'post_type' => $post_type,
						'order' => 'ASC',
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'entry_scores_%_judge_id',
								'value' => get_current_user_id(),
							),
							array(
								'key' => 'entry_status',
								'value' => 'Completed',
							),
						),
						'posts_per_page' => -1
					);
					$the_query = new WP_Query($args);
					if($the_query->have_posts()):
						while($the_query->have_posts()):
							$the_query->the_post();
							$excluded_post[] = get_the_ID();
						endwhile;
					endif;
					$args = array(
						'post_type' => $post_type,
						'post__not_in' => $excluded_post,
						'orderby' => 'title',
						'order' => 'ASC',
						'meta_query' => array(
							array(
								'key' => 'entry_status',
								'value' => 'Completed',
							),
						),
						'posts_per_page' => -1
					);
					$the_query = new WP_Query($args);
					if($the_query->have_posts()):
						$awaiting_score = true;
			?>
				<h3><?php echo get_post_type_object($post_type)->label; ?></h3>
				<table class="judge-entry-table">
					<tr>
						<th class="member">Member</th>
						<th class="score">Your Score</th>
						<th class="action">Action</th>
					</tr>
					<?php
						while($the_query->have_posts()):
							$the_query->the_post();
					?>
						<tr>
							<td class="member"><?php echo get_field('entry_member_business', get_the_ID()); ?></td>
							<td class="score">
								<span class="stars"></span> 
								<span class="info">Not yet scored</span>
							</td>
							<td class="action">
								<?php if(get_field('site_status', options) == '3'): ?>
									<a href="<?php the_permalink(); ?>">View and score</a>
								<?php else: ?>
									<a href="<?php the_permalink(); ?>">View</a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endwhile; ?>
				</table>
			<?php
					endif;
				endforeach;
				wp_reset_postdata();
			endif;
			if($awaiting_score == false):
		?>
			<p>There are no entries awaiting your score.</p>
		<?php endif; ?>
	</div>
	<div class="tabs-info judge-dashboard" id="have-scored">
		<?php
			$have_scored = false;
			$args = array(
			   'public'   => true,
			   '_builtin' => false
			);
			$output = 'names';
			$operator = 'and';
			$post_types = get_post_types($args,$output,$operator);
			if($post_types):
				foreach($post_types as $post_type):
					$args = array(
						'post_type' => $post_type,
						'orderby' => 'title',
						'order' => 'ASC',
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'entry_scores_%_judge_id',
								'value' => get_current_user_id(),
							),
							array(
								'key' => 'entry_status',
								'value' => 'Completed',
							),
						),
						'posts_per_page' => -1
					);
					$the_query = new WP_Query($args);
					if($the_query->have_posts()):
						$have_scored = true;
			?>
				<h3><?php echo get_post_type_object($post_type)->label; ?></h3>
				<table class="judge-entry-table">
					<tr>
						<th class="member">Member</th>
						<th class="score">Your Score</th>
						<th class="action">Action</th>
					</tr>
					<?php
						while($the_query->have_posts()):
							$the_query->the_post();
					?>
						<tr>
							<td class="member"><?php echo get_field('entry_member_business', get_the_ID()); ?></td>
							<td class="score">
								<?php
									while(have_rows('entry_scores')):
									the_row();
										if(get_sub_field('judge_id') == get_current_user_id()):
								?>
									<span class="stars"><span class="score" style="width: <?php the_sub_field('score'); ?>%;"></span></span> 
									<span class="info"><?php the_sub_field('score'); ?>/100</span>
								<?php
										endif;
									endwhile;
								 ?>
							</td>
							<td class="action">
								<?php if(get_field('site_status', options) == '3'): ?>
									<a href="<?php the_permalink(); ?>#score">Edit score</a>
								<?php else: ?>
									<a href="<?php the_permalink(); ?>">View</a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endwhile; ?>
				</table>
			<?php
					endif;
				endforeach;
				wp_reset_postdata();
			endif;
			if($have_scored == false):
		?>
			<p>You have not scored any entries.</p>
		<?php endif; ?>
	</div>
</div>
