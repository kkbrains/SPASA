<?php
	$post_types_array = array();
	$args = array(
	   'public'   => true,
	   '_builtin' => false
	);
	$output = 'names';
	$operator = 'and';
	$post_types = get_post_types($args,$output,$operator );
	if($post_types):
?>
<div id="copy-category" class="lightbox-container">
	<div class="lightbox">
		<div class="lightbox-center">
			<div class="select-category">
				<p>Select a category to copy this entry to</p>
				<ul>
					<?php foreach($post_types  as $post_type): ?>
						<li><a href="/" data-category="<?php echo intval(str_replace('award-', '', $post_type)); ?>"><?php echo intval(str_replace('award-', '', $post_type)); ?>. <?php echo get_post_type_object($post_type)->label; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<span class="close">&nbsp;</span>
		</div>
	</div>
</div>
<?php endif; ?>
