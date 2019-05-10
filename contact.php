<?php

$webmaster_email = "metalic2010@mail.ru";

$feedback_page = "index.html";
$error_page = "error_message.html";
$thankyou_page = "thank_you.html";

$email = $_REQUEST['email'] ;
$message = $_REQUEST['message'] ;
$phone = $_REQUEST['phone'] ;
$msg = 
"Phone: " . $phone . "\r\n" . 
"Email: " . $email . "\r\n" . 
"message: " . $message ;


function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}

if (!isset($_REQUEST['email'])) {
header( "Location: $feedback_page" );
}

elseif (empty($phone) || empty($email)) {
header( "Location: $error_page" );
}

elseif ( isInjected($email) || isInjected($phone)  || isInjected($message) ) {
header( "Location: $error_page" );
}

else {

	mail( "$webmaster_email", "Feedback Form Results", $msg );

	header( "Location: $thankyou_page" );
}
?>