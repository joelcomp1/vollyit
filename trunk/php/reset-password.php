<?php
    require_once('../phpmailer/class.phpmailer.php');

	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to pg server
	$link = mysql_connect("localhost:3306", "root", "coolguy1");
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	else
	{
		$db_select = mysql_select_db("volly", $link);
		
		if(!$db_select)
		{
			die('Failed to connect to database: ' . mysql_error());
		}
	}

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}
	
	$email = clean($_POST['email']);
	
	
		define('GUSER', 'info@volly.it'); // GMail username
		define('GPWD', 'VollyIt920470'); // GMail password
		  
	function smtpmailer($to, $from, $from_name, $subject, $body) { 
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
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}
	$qry = "select * from vols where email='$email'";
	$result = @mysql_query($qry); 
	$volResult = mysql_fetch_assoc($result);

	//If this doesn't exist, check the organization admin
	if(mysql_num_rows($result) == 0)
	{
		echo 'why are we in here';
		exit();
		$qry = "select * from orgs where primarycontemail='$email'";
		$orgresult = @mysql_query($qry); 
		
		if(mysql_num_rows($orgresult) == 0)
		{
			$errmsg_arr[] = 'E-mail does not exist in database';
			header("location: ../index.php");
			exit();
		}
	}
	else
	{
		$login = $volResult['login'];
		$qry = "select * from members where login='$login'";
		$result2 = @mysql_query($qry); 
		$member = mysql_fetch_assoc($result2);
	
		$uid = $member['userid']; // find random number betwen minimum and maximum used to identify link on password reset
		$message = "<html><head><style type='text/css'></style></head><body><p>";
		$message .= $volResult['firstname'];
		$message .= ":</p><p>You requested to have your Volly.it password reset.  <br><br>Click on the below link to reset your password:<br></p>";
		$message .= "<a href='http://joelcomp1.no-ip.org?login=";
		$message .= $volResult['login'];
		$message .= "&reset=";
		$message .= $uid;
		$message .="'>Reset Your Password</a></p>";
		$message .= "<p>If you think you received this message in error, please disregard.</p><p></p></body></html>";

	}
	

   mysql_close($link);
   smtpmailer($email, 'info@volly.it', 'Volly.it', 'Volly.It - Reset Password Request', $message);
   
   
   header("location: ../index.php");
 
 
 ?>