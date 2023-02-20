<?php
	require_once 'vendor/autoload.php';
	// Import PHPMailer classes into the global namespace 
	use PHPMailer\PHPMailer\PHPMailer; 
	use PHPMailer\PHPMailer\SMTP; 
	use PHPMailer\PHPMailer\Exception; 
	 
	// Include library files 
	require 'vendor/phpmailer/phpmailer/src/Exception.php'; 
	require 'vendor/phpmailer/phpmailer/src/PHPMailer.php'; 
	require 'vendor/phpmailer/phpmailer/src/SMTP.php'; 
	 
	// Create an instance; Pass `true` to enable exceptions 
	$mail = new PHPMailer; 
	 
	// Server settings 
	// $mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
	$mail->isSMTP();                            // Set mailer to use SMTP 
	$mail->Host = 'smtp.gmail.com';           // Specify main and backup SMTP servers 
	$mail->SMTPAuth = true;                     // Enable SMTP authentication 
	$mail->Username = 'agungw1310@gmail.com';       // SMTP username 
	$mail->Password = 'vxvqfvlezrcprlah';         // SMTP password 
	$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted 
	$mail->Port = 465;                          // TCP port to connect to 
	 
	// Sender info 
	$mail->setFrom('sender@example.com', 'Agung'); 
	$mail->addReplyTo('reply@example.com', 'Agung'); 
	 
	// Add a recipient 
	$mail->addAddress('c14190074@john.petra.ac.id'); 
	 
	//$mail->addCC('cc@example.com'); 
	//$mail->addBCC('bcc@example.com'); 
	 
	// Set email format to HTML 
	$mail->isHTML(true); 
	 
	// Mail subject 
	$mail->Subject = 'DMS Email Verification'; 
	 
	// Mail body content 
	$bodyContent = Snl::app()->getVerificationEmailTemplate('#'); 
	$mail->Body    = $bodyContent; 
	 
	// Send email 
	if(!$mail->send()) { 
	    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
	} else { 
	    echo 'Message has been sent.'; 
	}