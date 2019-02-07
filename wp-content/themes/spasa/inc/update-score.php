<?php
	define('WP_USE_THEMES', false);	
	$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
	require_once($parse_uri[0].'wp-load.php');
	$current_count = 0;
	$total_score = 0;
	if($_GET['judge_has_scored'] == 'false') {
		if(have_rows('entry_scores', $_GET['entry_id'])):
			while(have_rows('entry_scores', $_GET['entry_id'])):
			the_row();
				$current_count++;
				$total_score += get_sub_field('score');
			endwhile;
		endif;
		add_row('entry_scores', array('judge_id' => get_current_user_id(), 'score' => $_GET['new_score']), $_GET['entry_id']);
		$current_count++;
		$total_score += $_GET['new_score'];
		update_field('entry_average_score', $total_score/$current_count, $_GET['entry_id']);
	} elseif($_GET['judge_has_scored'] == 'true') {
		if(have_rows('entry_scores', $_GET['entry_id'])):
			while(have_rows('entry_scores', $_GET['entry_id'])):
			the_row();
				$current_count++;
				if(get_sub_field('judge_id') == get_current_user_id()) {
					update_row('entry_scores', $current_count, array('score' => $_GET['new_score']), $_GET['entry_id']);
					$total_score += $_GET['new_score'];
				} else {
					$total_score += get_sub_field('score');
				}
			endwhile;
		endif;
		update_field('entry_average_score', $total_score/$current_count, $_GET['entry_id']);
	}
?>
<input type="hidden" name="entry_id" value="<?php echo $_GET['entry_id']; ?>" />
<input type="hidden" name="current_score" value="<?php echo $_GET['current_score']; ?>" />
<input type="hidden" name="current_count" value="<?php echo $_GET['current_count']; ?>"  />
<input type="hidden" name="judge_has_scored" value="true"  />
<input type="hidden" name="judge_score" value="<?php echo $_GET['judge_score']; ?>"  />
<input type="hidden" name="judge_count" value="<?php echo $_GET['judge_count']; ?>"  />
