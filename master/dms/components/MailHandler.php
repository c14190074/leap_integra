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

	class MailHandler {
		public $host = 'smtp.gmail.com';
	    public $smtp_auth = true;
	    public $username = 'agungw1310@gmail.com';
	    public $password = 'vxvqfvlezrcprlah';
	    public $smtp_secure = 'ssl';
	    public $port = 465; // 587 or 110
	    public $mail;

	    public function init() {
	    	$this->mail = new PHPMailer; 
		    $this->mail->isSMTP();                            // Set mailer to use SMTP 
			$this->mail->Host = $this->host;           // Specify main and backup SMTP servers 
			$this->mail->SMTPAuth = $this->smtp_auth;                     // Enable SMTP authentication 
			$this->mail->Username = $this->username;       // SMTP username 
			$this->mail->Password = $this->password;         // SMTP password 
			$this->mail->SMTPSecure = $this->smtp_secure;                  // Enable TLS encryption, `ssl` also accepted 
			$this->mail->Port = $this->port;                          // TCP port to connect to 
			 
			// Sender info 
			$this->mail->setFrom($this->username, Config::baseConfig()->site_title); 
			$this->mail->addReplyTo($this->username, Config::baseConfig()->site_title); 
	    }

		public function send($penerima, $subject, $body) {
			$this->mail->addAddress($penerima); 
			 
			// Set email format to HTML 
			$this->mail->isHTML(true); 
			 
			// Mail subject 
			$this->mail->Subject = $subject; 
			 
			// Mail body content 
			$this->mail->Body    = $body; 
			 
			// Send email 
			if(!$this->mail->send()) { 
				return FALSE;
			    // echo 'Message could not be sent. Mailer Error: '.$this->mail->ErrorInfo; 
			} else { 
				return TRUE;
			}
		}		
	}