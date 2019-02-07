<div class="content center">
	<?php if(get_field('events')): ?>
		<ul class="events">
			<?php 
				while(have_rows('events')): 
				the_row();
			?>
				<li>
					<?php if(get_sub_field('start_date')): ?>
						<div class="date">
							<div class="day"><?php echo date('j', strtotime(get_sub_field('start_date'))); ?><span><?php echo date('S', strtotime(get_sub_field('start_date'))); ?></span></div>
							<div class="month"><?php echo date('F', strtotime(get_sub_field('start_date'))); ?></div>
						</div>
					<?php endif; ?>
					<div class="info">
						<strong class="title"><?php the_sub_field('title'); ?></strong>
						<?php if((get_sub_field('start_date') && get_sub_field('end_date')) && (get_sub_field('end_date') > get_sub_field('start_date'))): ?>
							<?php if(date('F', strtotime(get_sub_field('start_date'))) == date('F', strtotime(get_sub_field('end_date')))): ?>
								<?php echo date('F jS', strtotime(get_sub_field('start_date'))); ?> - <?php echo date('jS Y', strtotime(get_sub_field('end_date'))); ?>
							<?php else: ?>
								<?php echo date('F jS', strtotime(get_sub_field('start_date'))); ?> - <?php echo date('F jS Y', strtotime(get_sub_field('end_date'))); ?>
							<?php endif; ?>
						<?php elseif(get_sub_field('start_date')): ?>
							<?php echo date('F jS Y', strtotime(get_sub_field('start_date'))); ?>
						<?php endif; ?>
					</div>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
	<?php the_field('page_content'); ?>
</div>
