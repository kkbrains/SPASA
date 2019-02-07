<form id="score" class="judge-score">
	<div class="update-score">
		<?php
			$current_score = '';
			$current_count = 0;
			$judge_has_scored = 'false';
			$judge_score = '';
			$judge_count = '';
			if(have_rows('entry_scores', $wp_query->post->ID)):
				while(have_rows('entry_scores', $wp_query->post->ID)):
				the_row();
					$current_score += intval(get_sub_field('score'));
					$current_count++;
					if(get_sub_field('judge_id') == get_current_user_id()) {
						$judge_has_scored = 'true';
						$judge_score = get_sub_field('score');
						$judge_count = $current_count;
					}
				endwhile;
			endif;
		 ?>
		 <div class="score-details">
			<h3>
				Your Score 
				<span class="stars"><span class="score" style="width: <?php if($judge_has_scored == 'true'): echo $judge_score; else: echo '0'; endif; ?>%;"></span></span>
			</h3>
			<p class="number"><?php if($judge_has_scored == 'true'): echo $judge_score; else: echo '0'; endif; ?></p>
			<ul>
				<li>0-20: Unacceptable</li>
				<li>30-40: Adequate</li>
				<li>50-60: Good</li>
				<li>70-80: Very Good</li>
				<li>90-100: Excellent</li>
			</ul>
		 </div>
		<div class="score-bar">
			<span class="range">
				<input type="range" name="new_score" min="0" max="100" value="<?php if($judge_has_scored == 'true'): echo $judge_score; else: echo '0'; endif; ?>" />
				<span class="value" style="width: <?php if($judge_has_scored == 'true'): echo $judge_score; else: echo '0'; endif; ?>%;">
					<span class="shadow"></span>	
				</span>
			</span>
		</div>
		<div class="updated">
			<input type="hidden" name="entry_id" value="<?php echo get_queried_object()->ID; ?>" />
			<input type="hidden" name="current_score" value="<?php echo $current_score; ?>" />
			<input type="hidden" name="current_count" value="<?php echo $current_count; ?>"  />
			<input type="hidden" name="judge_has_scored" value="<?php echo $judge_has_scored; ?>"  />
			<input type="hidden" name="judge_score" value="<?php echo $judge_score; ?>"  />
			<input type="hidden" name="judge_count" value="<?php echo $judge_count; ?>"  />
		</div>
	</div>
	<a href="<?php echo esc_url(home_url()); ?>/wp-content/uploads/Judging-Criteria.pdf" target="_blank" class="banner">
		<span class="title">Judging Criteria</span>
		<span class="action">Download</span>
	</a>
	<div class="ajax-loader" style="display: none;"></div>
</form>
<?php if(get_field('judging_criteria_details_'.intval(str_replace('award-', '', $post->name)), 'options') != ''): ?>
	<div class="score-list criteria">
		Judging Criteria: 
		<?php
			$i = 0;
			$t = count(get_field('judging_criteria_details_'.intval(str_replace('award-', '', $post->name)), 'options'));
			while(have_rows('judging_criteria_details_'.intval(str_replace('award-', '', $post->name)), 'options')) {
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
	</div>
	<p class="score-set success-message">Thank you for scoring this entry - Please <a href="<?php echo esc_url(home_url()); ?>/dashboard/">return to your account</a> to view other entries</p>
	<div id="judging-criteria" class="lightbox-container">
		<div class="lightbox">
			<div class="lightbox-center">
				<div class="judging-criteria">
					<table>
						<?php
							while(have_rows('judging_criteria_details_'.intval(str_replace('award-', '', $post->name)), 'options')):
							the_row();
						?>
							<tr>
								<th><?php the_sub_field('criterion'); ?></th>
								<td><?php the_sub_field('explanation'); ?></td>
							</tr>
						<?php endwhile ?>
					</table>
				</div>
				<span class="close">&nbsp;</span>
			</div>
		</div>
	</div>
	<br /><br />
<?php else: ?>
	<br /><br /><br /><br />
<?php endif; ?>