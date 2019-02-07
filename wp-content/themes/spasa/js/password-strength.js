jQuery(document).ready(
	function() {
		jQuery('body').on('keyup keydown change', 'input[name=password], input[name=confirm]',
			function(event) {
				checkPasswordStrength(
					jQuery('input[name=password]'),
					jQuery('input[name=confirm]'),
					jQuery('.password-strength'),
					jQuery('button[type=submit]'),
					['spasa']
				);
			}
		);
	}
);

function checkPasswordStrength(jQuerypass1,jQuerypass2,jQuerystrengthResult,jQuerysubmitButton,blacklistArray) {
	var pass1 = jQuerypass1.val();
	var pass2 = jQuerypass2.val();
	jQuerysubmitButton.attr('disabled', 'disabled');
	jQuerystrengthResult.removeClass('poor average good unmatched');
	blacklistArray = blacklistArray.concat(wp.passwordStrength.userInputBlacklist());
	var strength = wp.passwordStrength.meter(pass1, blacklistArray, pass2);
	if(jQuerypass1.val().length > 0) {
		jQuerystrengthResult.addClass('poor').html('Password strength is poor');
	} else {
		jQuerystrengthResult.removeClass('poor average good unmatched').html('Must contain a mix of letters (a-z) and numbers');
	}
	switch (strength) {
		case 2:
			jQuerystrengthResult.addClass('poor').html('Password strength is poor');
			break;
		case 3:
			jQuerystrengthResult.addClass('average').html('Password strength is average');
			break;
		case 4:
			jQuerystrengthResult.addClass('good').html('Password strength is good');
			break;
		case 5:
			jQuerystrengthResult.addClass('unmatched').html('Passwords do not match');
			break;
		default:
			//jQuerystrengthResult.html('Must contain a mix of letters (a-z) and numbers');
	}
	if(strength === (3 || 4) && '' !== pass2.trim()) {
		jQuerysubmitButton.removeAttr('disabled');
	}
	return strength;
}