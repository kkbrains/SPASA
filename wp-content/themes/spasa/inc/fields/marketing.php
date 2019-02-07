<?php
	if($wp_query->query_vars['id']):
		$value = str_ireplace(array('<br />','<br>','<br/>'), '', get_field('entry_marketing', $wp_query->query_vars['id']));
	endif;
?>
<p> 
	<label for="marketing">Marketing <span class="required">*</span></label><br />
	<textarea id="marketing" name="marketing" data-required="required"><?php echo $value; ?></textarea>
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