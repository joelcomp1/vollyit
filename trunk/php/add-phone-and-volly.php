<?php

	//Start session
	session_start();
	require_once('../phpmailer/class.phpmailer.php');
	//Include database connection details
	include('config.php');
	
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
	$orgName = clean($_SESSION['ORG_NAME']);
	$programName = clean($_SESSION['PROGRAM_NAME']);
	$login = clean($_SESSION['SESS_MEMBER_ID']);
	$areacode = clean($_POST['phone1']);
	$part2 = clean($_POST['phone2']);
	$part3 = clean($_POST['phone3']);
	$positionName = clean($_POST['positionSelected']);

	
	//if we are already volunteering for this position on this program, ignore
	$qry = "select * from programvol where orgname='$orgName' and programname='$programName' and positionname='$positionName' and vollogin='$login'"; //get the position info
	$result2 = @mysql_query($qry);

	if(mysql_num_rows($result2) == 0)
	{

		$qry = "INSERT INTO programvol(vollogin, orgname, programname, positionname) 
							VALUES('$login','$orgName','$programName','$positionName')"; //Add the volunteer to database as a volutneer for this program and position
		$result1 = @mysql_query($qry);
		
		$qry = "select * from programpositions where orgname='$orgName' and programname='$programName' and positionname='$positionName'"; //get the position info
		$result2 = @mysql_query($qry);
		$posInfo = mysql_fetch_assoc($result2);
		$numtaken = $posInfo['numtaken'];
		$numtaken = $numtaken + 1;
		$qry = "update programpositions set numtaken='$numtaken' where orgname='$orgName' and programname='$programName' and positionname='$positionName'"; //get the position info
		$result3 = @mysql_query($qry);
		
		$emailAddressArray = array();
		$emailAddressArrayOfNames = array();
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
		$qry = "select * from vols where login='$login'"; //get the position info
		$result2 = @mysql_query($qry);
		$volInfo = mysql_fetch_assoc($result2);
		
		$qry = "select * from programs where programname='$programName' and orgname='$orgName'"; //get the position info
		$result2 = @mysql_query($qry);
		$programInfo = mysql_fetch_assoc($result2);
		
		$qry = "select * from orgs where orgname='$orgName'"; //get the position info
		$result2 = @mysql_query($qry);
		$orgInfo = mysql_fetch_assoc($result2);
		
		$message = "<html><head><style type='text/css'></style></head><body><p>";
		$message .= $volInfo['firstname'];
		$message .= ' '; 
		$message .= $volInfo['lastname'];
		$message .= ", <br> You just volunteered for ";
		$message .= $programName;
		$message .= " put on by ";
		$message .= $orgName;
		$message .= "</p>";
		$message .= "<a href='joelcomp1.no-ip.org/index.php?progid=";
		$message .= $programInfo['progid'];
		$message .= "'>View Program</a><br>Thanks for Making a Difference!</p>";
		$message .= "</body></html>";
		$name = $volInfo['firstname'];
		$name .= ' ';
		$name .= $volInfo['lastname'];
					
		$success = smtpmailer($volInfo['email'], $name, $orgInfo['orgemail'], $orgName, 'Volly.It - Help change the world! ', $message);	

		
		//Check whether the query was successful or not
		if($result1 && $result2 && $result3) {

		//added volunteer successfully
				session_regenerate_id();
				$string = "location: program-manager.php?programname=";
				$string .= $programName;
				$string .= '&orgname=';
				$string .= $orgName;
				$string .= '';
				$_SESSION['VOLLYING_FOR_PROGRAM'] = 'true';
				$_SESSION['VOLLY_JUST_ADDED'] = 'true';
				header($string);
				
				session_write_close();
				exit();
		}else {
			die("Query failed");
		}
	}
	
	$string = "location: program-manager.php?programname=";
	$string .= $programName;
	$string .= '&orgname=';
	$string .= $orgName;
	$string .= '';
	header($string);

?>