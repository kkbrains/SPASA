<div class="content center">
	<h2>Thank You</h2>	
	<p class="success-message">Your payment of $<?php echo $_SESSION['success_total']; $_SESSION['success_total'] = '' ?> has been successfully processed.</p>
	<p>
		Order Number: <?php echo $_SESSION['success_order_number']; $_SESSION['success_order_number'] = '' ?><br />
		Receipt Number: <?php echo $_SESSION['success_receipt_number']; $_SESSION['success_receipt_number'] = '' ?><br />
	</p>
	<p><a href="<?php echo esc_url(home_url()); ?>/dashboard/">Click here</a> to return to your account.</p>
</div>