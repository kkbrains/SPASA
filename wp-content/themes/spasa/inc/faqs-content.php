<div class="content center">	
	<?php if(get_field('faqs')): ?>
		<div class="faqs">
			<div class="col-1">
				<?php
					$i = 0;
					while(have_rows('faqs')): 
					the_row();
					if(0 == $i % 2):
				?>
					<div class="faq">
						<h2 class="question"><a href="#answer-<?php echo $i; ?>"><?php the_sub_field('question'); ?></a></h2>
						<div id="answer-<?php echo $i; ?>" class="answer">
							<?php the_sub_field('answer'); ?>
						</div>
					</div>
				<?php
					endif;
					$i++;
					endwhile;
				?>			
			</div>
			<div class="col-2">
				<?php
					$i = 0;
					while(have_rows('faqs')): 
					the_row();
					if(0 != $i % 2):
				?>
					<div class="faq">
						<h2 class="question"><a href="#answer-<?php echo $i; ?>"><?php the_sub_field('question'); ?></a></h2>
						<div id="answer-<?php echo $i; ?>" class="answer">
							<?php the_sub_field('answer'); ?>
						</div>
					</div>
				<?php
					endif;
					$i++;
					endwhile;
				?>			
			</div>
		</div>
	<?php endif; ?>
</div>
