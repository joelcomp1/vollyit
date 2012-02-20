<?php
    require_once('../phpmailer/class.phpmailer.php');

	//Start session
	session_start();
	
	//Array to store validation errors
	$errmsg_arr = array();
	$emailAddressArray = array();
	$emailAddressArrayOfNames = array();
	//Validation error flag
	$errflag = false;
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}
	
	$content = clean($_POST['emailContent']);

	define('GUSER', 'joelcomp1@gmail.com'); // GMail username
	define('GPWD', 'Coolenungames!2'); // GMail password
		  
	function smtpmailer($to, $names, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->IsHTML(true);

	$j = 0;
	foreach($to as $msg) 
	{	
		$mail->AddAddress($msg, $names[$j]);
		$j++;
	}

	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
	}
	

	$message = "<html><head><style type='text/css'></style></head><body><p>";
	$message .= $_SESSION['VOL_FIRST_NAME']; 
	$message .= ' '; 
	$message .= $_SESSION['VOL_LAST_NAME'];
	$message .= " wanted to let you know:</p><p>";
	$message .= $content;
	$message .= "</p>";
	$message .= "<a href='";
	$message .= $_SESSION['USER_INVITE_LINK'];
	$message .="'>Join Volly.it!</a></p>";
	$message .= "</body></html>";
	
	for($i  = 1; $i <= 20; $i++)
	{
		$emailString = 'emailAddress';
		$emailString .= $i;

		if($_POST[$emailString] != '')
		{
			$emailAddressArray[] = $_POST[$emailString];
			$emailAddressArrayOfNames[] = '  ';
		}
	}
	
	$counter = 1;
	do
	{
		$stringToUse = 'contactOpenInviter';
		$stringToUse3 = 'contactNameOpenInviter';
		$stringToUse .= $counter;
		$stringToUse3 .= $counter;
		if($_SESSION[$stringToUse] != '')
		{
			$emailAddressArray[] = $_SESSION[$stringToUse];
			$emailAddressArrayOfNames[] = $_SESSION[$stringToUse3];
		}
		
		$counter++;
	}while($_SESSION[$stringToUse] != '');
	
	if(count(emailAddressArray) > 0)
	{
		smtpmailer($emailAddressArray, $emailAddressArrayOfNames, 'info@volly.it', 'Volly.it', 'Volly.It - Help change the world! ', $message);
	}
	//clear out so we don't resend
	$counter = 1;
	$stringToUse = 'contactOpenInviter';
	$stringToUse .= $counter;
	while($_SESSION[$stringToUse] != '')
	{
		unset($_SESSION[$stringToUse]);
		$counter++;
		$stringToUse = 'contactOpenInviter';
		$stringToUse .= $counter;
	}
   
   
   $_SESSION['ERRMSG_ARR'] = "Successfully sent: ";
   $_SESSION['ERRMSG_ARR'] .= sizeof($emailAddressArray);
   $_SESSION['ERRMSG_ARR'] .= " e-mails";
   session_write_close();
   header("location: vol-invite-friends.php");
 
 
 ?>