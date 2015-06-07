<?php

include 'lib/phpmailer/phpmailer.php';
include 'lib/phpmailer/smtp.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Location: http://www.salonorchardnyc.com/contact.html');
ini_set('memory_limit', '-1');
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

error_reporting(E_ERROR);

if ($_POST) {

	$email = $_POST['email'];
	$reason = $_POST['reason'];
	$content = $_POST['message'];
	$copy = $_POST['copy'];

	$recipient = 'sunlee.newyork@gmail.com';
	if ($copy) {
		$recipient .= ', ' . $email;
	}

	$subject  = "Inquiry from SalonOrchardNYC.com: " . ucfirst($reason);

	$headers .= "From: " .$email. "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$message  = "<html><head></head><body>";
	$message .= "<h2>" .ucfirst($reason). "</h2>";
	$message .= "<p>" .$content. "</p>";
	$message .= "</body></html>";

	if (!mail($recipient, $subject, $message, $headers)) {
		die("Email failed to send.");
	}

}

?>