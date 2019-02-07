jQuery(document).ready(

	function() {
		
		// Replace SVG images
		
		jQuery('img.svg').each(
			function(){
				var jQueryimg = jQuery(this);
				var imgID = jQueryimg.attr('id');
				var imgClass = jQueryimg.attr('class');
				var imgURL = jQueryimg.attr('src');
				jQuery.get(imgURL, function(data) {
					var jQuerysvg = jQuery(data).find('svg');
					if(typeof imgID !== 'undefined') {
						jQuerysvg = jQuerysvg.attr('id', imgID);
					}
					if(typeof imgClass !== 'undefined') {
						jQuerysvg = jQuerysvg.attr('class', imgClass+' replaced-svg');
					}
					jQuerysvg = jQuerysvg.removeAttr('xmlns:a');
					jQueryimg.replaceWith(jQuerysvg);
				}, 'xml');
			}
		);
		
		/* Home hero */
		
		jQuery('.home-hero a.scroll').click(
			function(e){
				e.preventDefault();
				jQuery(this).blur();
				jQuery('html, body').animate({
					scrollTop: Math.round(jQuery(window).innerHeight() - jQuery('.header').outerHeight())
				}, 500);
			}
		);
		
		/* Page scrolled */
		
		if(!jQuery('.home-slide').length) {
			jQuery(document).on('load resize scroll',
				function(){
					jQuery(document).scrollTop() > 10 ? jQuery('body').addClass('scrolled') : jQuery('body').removeClass('scrolled');
				}
			)
		};
		
		/* FAQs */
		
		jQuery('.faqs .faq .question a').click(
			function(e){
				e.preventDefault();
				if(jQuery(this).closest('.faq').hasClass('active')) {
					jQuery(this).closest('.faq').removeClass('active');
					jQuery(this).closest('.faq').find('.answer').slideUp();
				} else {
					jQuery('.faq.active').find('.answer').slideUp();
					jQuery('.faq.active').removeClass('active');
					jQuery(this).closest('.faq').addClass('active');
					jQuery(this).closest('.faq').find('.answer').slideDown();
				}
			}
		);
		
		/* Tabs */
		
		jQuery('.tabs a').click(
			function(e){
				e.preventDefault();
				if(!jQuery(this).hasClass('active')) {
					jQuery('.tabs a.active').removeClass('active');
					jQuery('.tabs-info.active').removeClass('active');
					jQuery(this).addClass('active');
					jQuery('.tabs-info' + jQuery(this).attr('href')).addClass('active');
				}
			}
		);
		
		/* Member dashboard */
		
		jQuery('a[href="#delete"]').click(
			function(e){
				e.preventDefault();
				if(confirm('Are you sure to want to delete this entry?')) {					
					window.location.href = jQuery(this).attr('data-redirect');
				}
			}
		);
		
		/* Entry form */
		
		jQuery('.entry-form').submit(
			function(e){
				jQuery(this).find('.ajax-loader').show();
			}
		);
		
		jQuery('.entry-form').on('keyup keydown change', 'input, select, textarea',
			function(){
				if(jQuery('.entry-form input:radio[name=entry_status]:checked').val() === 'Draft') {
					jQuery('.entry-form').find('.submit-message').css('display', 'none');
					jQuery('.entry-form').find('button').removeAttr('disabled');
				} else {
					jQuery('.entry-form').find('.submit-message').css('display', 'block');
					var valid = 'yes';
					jQuery('.entry-form input, .entry-form select, .entry-form textarea').each(
						function() {
							if((jQuery(this).attr('data-required') == 'required') && (!jQuery(this).val())) {
								temp_valid = 'no';
								if(jQuery('#existing-'+jQuery(this).attr('id')).length) {
									if(jQuery('#existing-'+jQuery(this).attr('id')).val()) {
										temp_valid = 'yes';
									}
								}
								if(temp_valid == 'no') {
									valid = 'no';
								}
							}
							if((jQuery(this).is(':checkbox')) && (!jQuery(this).prop('checked'))) {
								valid = 'no';
							}
						}
					);
					if(valid == 'no') {
						jQuery('.entry-form').find('button').attr('disabled', 'disabled');
					} else {
						jQuery('.entry-form').find('button').removeAttr('disabled');
					}
				}
			}
		);
		
		/* Payment options */
		
		jQuery('.payment-options button').click(
			function(){
				jQuery(this).closest('form').find('input[name="payment_type"]').val(jQuery(this).attr('class'));
				jQuery(this).closest('form').submit();
			}
		);
		
		/* Payment form */
		
		jQuery('.secure-payment-form').submit(
			function(e){
				jQuery(this).find('.ajax-loader').show();
			}
		);
		
		/* Score */
		
		jQuery('.judge-score .score-bar input').on('input', 
			function() {
				jQuery('.judge-score .score-details .number').html(jQuery('.judge-score .score-bar input').val());
				jQuery('.judge-score .score-details .score').css('width', jQuery('.judge-score .score-bar input').val() + '%');
				jQuery('.judge-score .score-bar .range .value').css('width', jQuery('.judge-score .score-bar input').val() + '%');
			}
		);
		
		jQuery('.judge-score .score-bar .range input').change(
			function() {
				jQuery('.judge-score .ajax-loader').show();
				jQuery('.score-set').hide();
				jQuery.ajax({
					url: window.location.protocol + '//' + window.location.host + '/wp-content/themes/spasa/inc/update-score.php?'
						+'new_score='+jQuery('.judge-score .score-bar input[name="new_score"]').val()
						+'&entry_id='+jQuery('.judge-score .updated input[name="entry_id"]').val()
						+'&current_score='+jQuery('.judge-score .updated input[name="current_score"]').val()
						+'&current_count='+jQuery('.judge-score .updated input[name="current_count"]').val()
						+'&judge_has_scored='+jQuery('.judge-score .updated input[name="judge_has_scored"]').val()
						+'&judge_score='+jQuery('.judge-score .updated input[name="judge_score"]').val()
						+'&judge_count='+jQuery('.judge-score .updated input[name="judge_count"]').val(), 
					success: function(result){
						jQuery('.judge-score .updated').html(result);
						jQuery('.judge-score .ajax-loader').hide();
						jQuery('.score-set').show();
						jQuery('html, body').animate({
							scrollTop: Math.round(jQuery('.score-set').offset().top)
						}, 850);
					}
				});
			}
		);
		
		/* Winners */
		
		jQuery('.winners-state select').change(
			function(){
				window.location.href = window.location.protocol + '//' + window.location.host + '/winners/' + jQuery(this).val() + '/';
			}
		);
		
		/* Lightbox */
		
		jQuery('a[href="#judging-criteria"]').click(
			function(e){
				e.preventDefault();
				jQuery('#judging-criteria').css('display', 'flex').hide().fadeIn('fast');
				jQuery(this).blur();
			}
		);
		
		var copy_entry = '';
		
		jQuery('a[href="#copy-list"]').click(
			function(e){
				e.preventDefault();
				copy_entry = jQuery(this).attr('data-entry-id');
				jQuery('#copy-category').css('display', 'flex').hide().fadeIn('fast');
				jQuery(this).blur();
			}
		);
		
		jQuery('.select-category a').click(
			function(e){
				e.preventDefault();
				window.location.href = window.location.protocol + '//' + window.location.host + '/enter/' + jQuery(this).attr('data-category') + '/copy/' + copy_entry + '/';
				jQuery(this).blur();
			}
		);
		
		jQuery('a[href="#copy-entry"]').click(
			function(e){
				e.preventDefault();
				jQuery('#copy-entry').css('display', 'flex').hide().fadeIn('fast');
				jQuery(this).blur();
			}
		);
		
		jQuery('.select-entry a').click(
			function(e){
				e.preventDefault();
				if(confirm('Are you sure to want to copy this entry?')) {	
					jQuery('.ajax-loader').show();				
					jQuery.ajax({
						url: window.location.protocol + '//' + window.location.host + '/wp-content/themes/spasa/inc/copy-fields.php?'
						+'get_entry='+jQuery(this).attr('data-entry-id')
						+'&get_category='+jQuery(this).attr('data-category'), 
						success: function(result){
							jQuery('.copy-entry-fields').html(result);
							jQuery('.ajax-loader').hide();
						}
					});
				}
			}
		);
		
		jQuery('.existing-image a.view, .view-content a.view').click(
			function(e){
				e.preventDefault();
				jQuery('#view-image').height(jQuery(window).innerHeight());
				jQuery('#view-image img').attr('src', jQuery(this).attr('href'));
				var img = jQuery('#view-image img')[0];
				jQuery('<img />').attr('src', jQuery(img).attr('src')).load(
					function() {
						if(this.height > (jQuery('#view-image').height() - 50)) {
							jQuery('#view-image img').css('max-height', (jQuery('#view-image').height() - 50) + 'px');
						} else {
							jQuery('#view-image img').css('max-height', 'auto');
						}
						jQuery('#view-image').css('display', 'flex').hide().fadeIn('fast');
					}
				);
				jQuery(this).blur();
			}
		);
		
		jQuery(window).resize(
			function() {
				jQuery('#view-image').height(jQuery(window).innerHeight());
				clearTimeout(window.resizedFinished);
				window.resizedFinished = setTimeout(function(){
					var img = jQuery('#view-image img')[0];
					jQuery('<img />').attr('src', jQuery(img).attr('src')).load(
						function() {
							if(this.height > jQuery('#view-image img').height()) {
								jQuery('#view-image img').css('max-height', (jQuery('#view-image').height() - 50) + 'px');
							} else if(jQuery('.lightbox-container img').height() > (jQuery('#view-image').height() - 50)) {
								jQuery('#view-image img').css('max-height', (jQuery('#view-image').height() - 50) + 'px');
							} else {
								jQuery('#view-image img').css('max-height', 'auto');
							}
						}
					);
				}, 250);
			}
		);
		
		jQuery('.lightbox-container').click(
			function () {
				jQuery('.lightbox-container').fadeOut('fast');
			}
		).find('table').click(
			function(e) {
				e.stopPropagation();
			}
		);
		
		/* Responsive menu */
		
		jQuery('.header a[href="#menu"]').click(
			function(e){
				e.preventDefault();
				if(!jQuery('body').hasClass('open')) {
					jQuery('body').addClass('open');
				} else {
					jQuery('body').removeClass('open');
				}
			}
		);
		
	}
);