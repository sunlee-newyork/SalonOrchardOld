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

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'a2plcpnl0201.prod.iad2.secureserver.net';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'info@salonorchard.com';                 // SMTP username
	$mail->Password = 'orchard189';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to

	$mail->From = $email;
	if ($copy) {
		$mail->addCC($copy);
	}

	$mail->Subject = "Inquiry from SalonOrchardNYC.com: " . ucfirst($reason);
	$mail->Body    = "<html><head></head><body>";
	$mail->Body    .= "<h2>" .ucfirst($reason). "</h2>";
	$mail->Body    .= "<p>" .$content. "</p>";
	$mail->Body    .= "</body></html>";

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo 'Message has been sent';
	}

}

?>