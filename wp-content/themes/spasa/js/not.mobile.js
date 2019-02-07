jQuery(document).ready(

	function() {
		
		/* Page intro */
		
		if(jQuery('.home-hero').length) {
			jQuery(window).on('load scroll', 
				function() {
					jQuery('.home-hero .background').css('margin-top', jQuery(document).scrollTop() / 2 + 'px');
				}
			)
		};
		
		if(jQuery('.page-intro').length) {
			jQuery(window).on('load scroll', 
				function() {
					jQuery('.page-intro .background').css('margin-top', jQuery(document).scrollTop() / 2 + 'px');
				}
			)
		};
		
	}
);