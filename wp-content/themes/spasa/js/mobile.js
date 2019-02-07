jQuery(document).ready(

	function() {
		
		// Set home hero height
		
		if(jQuery('.home-hero').length) {
			jQuery('.home-hero').css('min-height', jQuery(window).innerHeight());
			//jQuery('.home-hero').css('height', jQuery(window).innerHeight());
		}
		
	}
);