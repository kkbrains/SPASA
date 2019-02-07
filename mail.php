<?php
	$sender = 'ben.cox@brainsdesign.com';
	$recipient = 'ben.cox@brainsdesign.com';
	$subject = 'PHP Test Message';
	$message = 'PHP Test Message';
	$headers = 'From:' . $sender;
	if (mail($recipient, $subject, $message, $headers)) {
		echo 'Success: Message accepted';
	}
	else {
		echo 'Error: Message not accepted';
	}
?>