<?php if(get_field('entry_portfolio') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Portfolio</h3>
		</div>
		<div class="value">
			<?php $portfolio = get_field('entry_portfolio'); ?>
			<p><a href="<?php echo $portfolio[url]; ?>" target="_blank"><?php echo $portfolio[filename]; ?></a></p>
		</div>
	</div>
<?php endif; ?>
