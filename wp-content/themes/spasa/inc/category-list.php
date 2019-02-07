<?php
	$category_table = '<table class="category-list">';
	foreach ($categories as $category) {
		$category_table .= '<tr>';
		$category_table .= '<td class="number">'.$category.'.</td>';
		$cats = get_post_types(array('name' => 'award-'.sprintf('%02d', $category)), 'objects');
		foreach ($cats as $cat) {
		   $category_table .= '<td class="title">'.$cat->label.'</td>';
		}
		$category_table .= '<td class="enter"><a href="'.esc_url(home_url()).'/enter/'.$category.'/"><span>Click to </span>enter</a></td>';
		$category_table .= '</tr>';
	}
	$category_table .= '</table>';
?>
