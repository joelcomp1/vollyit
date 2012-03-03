<?php
	//Start session
	session_start();
	
	//Include database connection details
	include('config.php');
		require_once('../phpmailer/class.phpmailer.php');
	//Array to store validation errors
	$errmsg_arr = array();
	
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
	
	//Sanitize the POST values
	$login = clean($_SESSION['SESS_MEMBER_ID']);
	$orgName  = clean($_SESSION['ORG_NAME']);
	$programName = clean($_SESSION['PROGRAM_NAME']);
	$subject = $_POST['Field1'];
	$content = $_POST['Field3'];
	$emailnotifiy = $_POST['emailNot'];
	$fbpost = $_POST['postFb'];
	$twitterPost = $_POST['postT'];
	
	$todaysDate = date("m/d/Y h:i:s A");


	$qry = "INSERT INTO programmsgs(orgname, programname, subject, content, date) 
	    				VALUES('$orgName','$programName','$subject','$content','$todaysDate')";
	$result = @mysql_query($qry);
	    
	if($fbpost == 'postToFB')
	{

	//	<a href="https://www.facebook.com/sharer/sharer.php?u=http://volly.it&t=Help Change the World!"><img src="../images/facebook.png" width="62" height="22" alt="Facebook" /></a>

	}
	
	if($twitterPost == 'postToT')
	{
	//<a href="https://twitter.com/intent/tweet?text=I think you should help me change the world! I am on Volly.it and you should be to!  Hop onto Volly.it today and start Volunteering!">

	
	}
	
	
	if($emailnotifiy == 'emailNotification')
	{

		

		define('GUSER', 'info@volly.it'); // GMail username
		define('GPWD', 'VollyIt920470'); // GMail password
		  
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
		$mail->AddAddress($to, $names);
	

		if(!$mail->Send()) {
			$error = 'Mail error: '.$mail->ErrorInfo; 
			return false;
		} else {
			$error = 'Message sent!';
			return true;
		}
		}
		$qry = "select * from programvol where orgname='$orgName' and programname='$programName'"; 
		$result = @mysql_query($qry);
		
		while ($volsToEmail = mysql_fetch_object($result))
		{



				$message = "<html><head><style type='text/css'></style></head><body><p>";
				$message .= $orgName;
				$message .= ' has posted a new message on <a href="joelcomp1.no-ip.org/php/program-manager.php?orgname='.$orgName.'&programname='.$programName.'">';
				$message .= $programName;
				$message .= '</a> program page. <br><br>'.substr($content,0,50).'</p><a href="joelcomp1.no-ip.org/php/program-manager.php?orgname='.$orgName.'&programname='.$programName.'">View Full Message</a>';
				$message .= "</body></html>";

				$qry = "select * from vols where login='";

				$qry .= $volsToEmail->vollogin; 

				$qry .= "'";
				$result2 = @mysql_query($qry);
				$volinfo = mysql_fetch_object($result2);
					
				$name = $volinfo->firstname;
								
				$name .= ' ';
				$name .= $volinfo->lastname;
							

				$success = smtpmailer($volinfo->email, $name, 'info@volly.it', 'Volly.it', 'Volly.It - Help change the world! ', $message);
			
			
				
		}	
		
		
	
	}
	//Check whether the query was successful or not
	if($result) {
			//create program part 1 Successful
			session_regenerate_id();
		
			header("location: program-manager.php?orgname=$orgName&programname=$programName");
			
			session_write_close();
			exit();
	}else {
		die("Query failed");
	}
	
	mysql_close($link);
?>