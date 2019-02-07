<?php if($wp_query->query_vars['id']): ?>
	<?php if(get_field('judging_criteria_details_'.intval(str_replace('award-', '', get_post_type($wp_query->query_vars['id']))), 'options') != ''): ?>
		<div id="judging-criteria" class="lightbox-container">
			<div class="lightbox">
				<div class="lightbox-center">
					<div class="judging-criteria">
						<table>
							<?php
								while(have_rows('judging_criteria_details_'.intval(str_replace('award-', '', get_post_type($wp_query->query_vars['id']))), 'options')):
								the_row();
							?>
								<tr>
									<th><?php the_sub_field('criterion'); ?></th>
									<td><?php the_sub_field('explanation'); ?></td>
								</tr>
							<?php endwhile; ?>
						</table>
					</div>
					<span class="close">&nbsp;</span>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php else: ?>
	<?php if(get_field('judging_criteria_details_'.$wp_query->query_vars['award_category'], 'options') != ''): ?>
		<div id="judging-criteria" class="lightbox-container">
			<div class="lightbox">
				<div class="lightbox-center">
					<div class="judging-criteria">
						<table>
							<?php
								while(have_rows('judging_criteria_details_'.$wp_query->query_vars['award_category'], 'options')):
								the_row();
							?>
								<tr>
									<th><?php the_sub_field('criterion'); ?></th>
									<td><?php the_sub_field('explanation'); ?></td>
								</tr>
							<?php endwhile; ?>
						</table>
					</div>
					<span class="close">&nbsp;</span>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>