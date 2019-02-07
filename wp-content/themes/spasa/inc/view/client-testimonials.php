<?php if(get_field('entry_client_testimonials') != ''): ?>
	<div class="view-content">
		<div class="title">
			<h3>Client testimonials</h3>
		</div>
		<div class="value">
			<?php $client_testimonials = get_field('entry_client_testimonials'); ?>
			<p><a href="<?php echo $client_testimonials[url]; ?>" target="_blank"><?php echo $client_testimonials[filename]; ?></a></p>
		</div>
	</div>
<?php endif; ?>
