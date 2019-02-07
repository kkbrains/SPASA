<?php
$error = false;
$success = false;
if(isset($_POST['card_number'])) {
	// Payment transaction code
	define('PAYMENT_API_DIR', ABSPATH.'wp-content/themes/spasa/inc/payway-api/');
	include_once(PAYMENT_API_DIR.'Qvalent_PayWayAPI.php');
	// Make new unique order number
	$lastOrderNumber = get_field('westpac_order_number', 'options') ? get_field('westpac_order_number', 'options') : 0;
    $lastOrderNumber++;
    update_field('westpac_order_number', $lastOrderNumber, 'options');
    $orderNumber = sprintf('%08d', $lastOrderNumber);
	$initParams = 'certificateFile='.PAYMENT_API_DIR.'ccapi.pem&caFile='.PAYMENT_API_DIR.'cacerts.crt';
    $paywayAPI = new Qvalent_PayWayAPI();
    $paywayAPI->initialise($initParams);
    $orderECI = 'SSL';
    $orderType = 'capture';
    $cardNumber = $_POST['card_number'];
    $cardVerificationNumber = $_POST['card_verification'];
    $cardExpiryYear = $_POST['card_expiry_year'];
    $cardExpiryMonth = $_POST['card_expiry_month'];
    $cardCurrency = 'AUD';
    $orderAmountCents = number_format((float)$_POST['total'] * 100, 0, '.', '');
    $customerUsername = 'Q23513';
    $customerPassword = 'Ackq7h7i6';
    $customerMerchant = get_field('westpac_payment_status', 'options') != 'Test' ? '25408303' : 'TEST';
    $requestParameters = array();
    $requestParameters['order.type'] = $orderType;
    $requestParameters['customer.username'] = $customerUsername;
    $requestParameters['customer.password'] = $customerPassword;
    $requestParameters['customer.merchant'] = $customerMerchant;
    $requestParameters['customer.orderNumber'] = $orderNumber;
    $requestParameters['customer.originalOrderNumber'] = $orderNumber;
    $requestParameters['card.PAN'] = $cardNumber;
    $requestParameters['card.CVN'] = $cardVerificationNumber;
    $requestParameters['card.expiryYear'] = $cardExpiryYear;
    $requestParameters['card.expiryMonth'] = $cardExpiryMonth;
    $requestParameters['card.currency'] = $cardCurrency;
    $requestParameters['order.amount'] = $orderAmountCents;
    $requestParameters['order.ECI'] = $orderECI;
    $requestText = $paywayAPI->formatRequestParameters($requestParameters);
    $responseText = $paywayAPI->processCreditCard($requestText);
    $responseParameters = $paywayAPI->parseResponseParameters($responseText);
    $responseCode = $responseParameters['response.responseCode'];
    $receiptNo = $responseParameters['response.receiptNo'];
    if($responseCode != '08') {
    	$error = true;
    } else {
    	$success = true;
    }
}
?>
<?php if($success): ?>
	<?php
		$entry = explode(',',$_POST['entry_id']);
		// Update entry payment status
		foreach ($entry as $entry_id) {
			update_field('entry_paid', 'Yes', $entry_id);
			update_field('entry_order_number', $orderNumber, $entry_id);
			update_field('entry_order_date', date('d/m/Y'), $entry_id);
		}
		// Prepare emails
		$entry_list = '';
		foreach ($entry as $entry_id) {
			$entry_list .= str_replace('&#8211;', '-', get_the_title($entry_id))."\n";
		}
		$user = $_POST['user_id'];
		if(get_user_meta($user, 'member_address_line_2', true)) {
			$address = get_user_meta($user, 'member_address_line_1', true)."\n"
				.get_user_meta($user, 'member_address_line_2', true)."\n"
				.get_user_meta($user, 'member_city', true)."\n"
				.get_user_meta($user, 'member_state', true)."\n"
				.get_user_meta($user, 'member_country', true)."\n"
				.get_user_meta($user, 'member_postcode', true);
		} else {
			$address = get_user_meta($user, 'member_address_line_1', true)."\n"
				.get_user_meta($user, 'member_city', true)."\n"
				.get_user_meta($user, 'member_state', true)."\n"
				.get_user_meta($user, 'member_country', true)."\n"
				.get_user_meta($user, 'member_postcode', true);
		}
		// Send confirmation email to user
		$member_to = get_userdata($user)->user_email;
		$member_subject = 'Payment Success - SPASA Awards';
		$member_message = 'Thank you.'."\n\n".'Your payment of $'.$_POST['total'].' has been successfully processed.'."\n\n".'Order Number: '.$orderNumber."\n".'Receipt Number: '.$receiptNo."\n\n".'The following entries are now eligible for judging: '."\n\n".$entry_list."\n".'Your Details: '."\n\n".'Name: '.get_userdata($user)->first_name.' '.get_userdata($user)->last_name."\n".'Business: '.get_user_meta($user, 'member_business', true)."\n".'Address: '.$address."\n\n".'Good luck!';
		wp_mail($member_to, $member_subject, $member_message);
		// Send confirmation email to admin
		$admin_to = get_option('admin_email');
		$admin_subject = 'New Payment - SPASA Awards';
		$admin_message = 'Payment received.'."\n\n".'A payment of $'.$_POST['total'].' has been successfully processed.'."\n\n".'Order Number: '.$orderNumber."\n".'Receipt Number: '.$receiptNo."\n\n".'The following entries are now eligible for judging: '."\n\n".$entry_list."\n".'Member Details: '."\n\n".'Name: '.get_userdata($user)->first_name.' '.get_userdata($user)->last_name."\n".'Business: '.get_user_meta($user, 'member_business', true)."\n".'Address: '.$address;
		wp_mail($admin_to, $admin_subject, $admin_message);
		// Redirect to success page
		$_SESSION['success_total'] = $_POST['total'];
		$_SESSION['success_order_number'] = $orderNumber;
		$_SESSION['success_receipt_number'] = $receiptNo;
		header('Location: '.get_bloginfo('url').'/payment-success/');
		exit();
	?>
<?php else: ?>
	<?php if($_POST['payment_type'] == 'offline'): ?>
		<?php get_template_part('inc/page-intro'); ?>
		<div class="content center">
			<div class="main">
				<?php echo do_shortcode('[contact-form-7 title="Pay Offline"]'); ?>
			</div>
			<div class="sidebar">
				<?php
					$entry = explode(',',$_POST['entry_id']);
					$entry_list = '';
					foreach ($entry as $entry_id) {
						$entry_list .= '<li>'.str_replace('&#8211;', '-', get_the_title($entry_id)).'</li>';
					}
				?>
				<div class="payment-details">
					<p>
						<strong>Total: <span>$<?php echo $_POST['total']; ?></span></strong><br />
						<span class="gst">All prices include GST</span>
					</p>
					<ul>
						<?php echo $entry_list; ?>
					</ul>
				</div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(
					function() {
						jQuery('input[name="payment-entries"]').val('<?php echo str_replace(array('<li>', '</li>'), array('', '\n'), $entry_list); ?>');
						jQuery('input[name="payment-total"]').val('$<?php echo $_POST['total']; ?>');
					}
				);
			</script>
		</div>
	<?php else: ?>
		<div class="content center payment-form">
			<form method="post" class="secure-payment-form">
				<h2>Secure Card Payment</h2>
				<?php if($error): ?>
					<p class="error-message">
						Your payment was declined - please try again 
						<!--<?php // echo $responseText; ?>-->
					</p>
				<?php endif; ?>
				<p>
					<label for="card_number">Card Number <span class="required">*</span></label><br />
					<input type="text" id="card_number" name="card_number" value="" maxlength="16" required="required" />
					<span class="smalltext">Do not include spaces or dashes (NB: we do not accept Amex or Diners)</span>
				</p>
				<div class="columns-2">
					<p>
						<label for="card_expiry_month">Expiry Month <span class="required">*</span></label><br />
						<select id="card_expiry_month" name="card_expiry_month" required="required">
							<option value=""></option>
							<?php for($i=1; $i<=12; $i++): ?>
								<option value="<?php echo sprintf( '%02d',$i)?>">
									<?php 
										$dt = DateTime::createFromFormat('!m', $i);
										echo sprintf('%02d',$i).' - '.$dt = $dt->format('F');
									?>
								</option>
							<?php endfor; ?>
						</select>
					</p>
					<p>
						<label for="card_expiry_year">Expiry Year <span class="required">*</span></label><br />
						<select id="card_expiry_year" name="card_expiry_year" required="required">
							<option value=""></option>
							<?php for($i=date('y'); $i<=date('y')+10; $i++): ?>
								<option value="<?php echo $i; ?>">20<?php echo $i; ?></option>
							<?php endfor; ?>
						</select>
					</p>
				</div>
				<p>
					<label for="card_verification">Verification Number <span class="required">*</span></label><br />
					<span class="cvv"><input type="text" id="card_verification" value="" maxlength="4" required="required" /></span>
					<span class="smalltext">Last 3 digits on back of card</span>
				</p>
				<p>
					<button type="submit">Complete<span> Payment</span></button>
					<input type="hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>" />
					<input type="hidden" name="entry_id" value="<?php echo $_POST['entry_id']; ?>" />
					<input type="hidden" name="total" value="<?php echo $_POST['total']; ?>" />
					<input type="hidden" name="payment_type" value="card" />
				</p>
				<p class="westpac">
					<img src="<?php bloginfo('template_url'); ?>/images/westpac.png" alt="Westpac" />
					Secure online payments are processed by Westpac Banking Corporation<br />
					ABN 33 007 457 141<br />
				</p>
				<div class="ajax-loader" style="display: none;"></div>
			</form>
		</div>
	<?php endif; ?>
<?php endif;?>
