<?php
	if($wp_query->query_vars['id']):
		$value = get_field('entry_status', $wp_query->query_vars['id']);
	endif;
?>
<br />
<p><label>Entry status <span class="required">*</span></label></p>
<ul class="options inline">
	<li>
		<label class="radio">
			<input type="radio" id="entry-status-draft" name="entry_status" value="Draft" checked="checked">
			Draft <span class="marker"></span>
		</label>
	</li>
	<li>
		<label class="radio">
			<input type="radio" id="entry-status-completed" name="entry_status" value="Completed">
			Completed <span class="marker"></span>
		</label>
	</li>
</ul>
<div class="submit-message">
	<h3>Please Note</h3>
	<ol>
		<li>Please try to complete all fields before saving this entry as "Completed"</li>
		<li>If you cannot complete a field just enter &quot;Not applicable&quot;</li>
		<?php if($wp_query->query_vars['id']): ?>
			<?php if(get_field('judging_criteria_details_'.intval(str_replace('award-', '', get_post_type($wp_query->query_vars['id']))), 'options') != ''): ?>
				<li>Make sure that the description satisifies all of the <a href="#judging-criteria" class="criteria">Judging Criteria</a> for this awards category</li>
			<?php endif; ?>
		<?php else: ?>
			<?php if(get_field('judging_criteria_details_'.$wp_query->query_vars['award_category'], 'options') != ''): ?>
				<li>Make sure that the description satisifies all of the <a href="#judging-criteria" class="criteria">Judging Criteria</a> for this awards category</li>
			<?php endif; ?>
		<?php endif; ?>
		<li>Once the entry status has been saved as "Completed" the entry can no longer be edited</li>
		<li>Entries saved as "Completed" will then be required to make payment before they can be judged</li>
	</ol>
</div>
<p><button type="submit">Save</button></p>
<div class="ajax-loader" style="display: none;"></div>
