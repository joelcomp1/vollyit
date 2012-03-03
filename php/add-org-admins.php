 <?php	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	require_once('upsaddress.php');
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
	
	$orgName = clean($_SESSION['ORG_NAME']);	
	$login = clean($_SESSION['SESS_MEMBER_ID']);	
	$orgid = clean($_SESSION['ORG_ID']);	
	//first check for entry in additional admins
	$qry = 'select * from additadmins where orgname='.$orgName.'';
	$result = @mysql_query($qry);
	if(mysql_num_rows($result) == 0)
	{
		$qry = 'select * from vols where login='.$login.'';
		$result = @mysql_query($qry);
		$vol = mysql_fetch_assoc($result);
		$email = $vol['email'];
		$adminPhoto = $vol['userimage'];
	}
	else
	{
		$qry = 'select * from additadmins where orgname='.$orgName.'';
		$result = @mysql_query($qry);
		$adminInfo = mysql_fetch_assoc($result);
		$email = $adminInfo['primaryadmin'];
		$adminPhoto = $adminInfo['adminimage'];
	}
	
	$counter = 1;
	do
	{
				
		$adminFirstName = "Field261a";
		$adminFirstName .= $counter;
		$newAdminFirstName = clean($_POST[$adminFirstName]); 
				
		$adminLastName = "Field262a";
		$adminLastName .= $counter;
		$newAdminLastName = clean($_POST[$adminLastName]); 
				
		$adminemail = "Field260a";
		$adminemail .= $counter;
		$newAdminemail = clean($_POST[$adminemail]); 
				
		
		if($adminFirstName != '')
		{			
			$qry = "INSERT INTO additadmins(primaryadmin, adminimage, orgname, additfirstname, additlastname, additemail) 
			VALUES('$email','$adminPhoto', '$orgName', '$newAdminFirstName', '$newAdminLastName', '$newAdminemail')";
			$result = @mysql_query($qry);
		
		}
			$counter = $counter + 1;
			$adminFirstName = "Field261a1";
			$adminFirstName .= $counter;
			$volLogin = clean($_POST[$adminFirstName]);
		}while($_POST[$adminFirstName] != '');
	
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
		$qry = "select * from additadmins where orgname='$orgName'";
		$result = @mysql_query($qry);

		while ($adminsToEmail = mysql_fetch_object($result))
		{
			$tempEmail = $adminsToEmail->additemail;
			$qry = "select * from members where email='$tempEmail'";
			$result2 = @mysql_query($qry);
			$memberInfo = mysql_fetch_object($result2);
			if(mysql_num_rows($result2) == 0)
			{
				$message = "<html><head><style type='text/css'></style></head><body><p>Hi ";
				$message .= $adminsToEmail->additfirstname;
				$message .= ' '; 
				$message .= $adminsToEmail->additlastname;
				$message .= "! You just got added as a admin for the ";
				$message .= $orgName;
				$message .= " Organization <br>Click the link below to create your volly.it account.</p>";
				$message .= "<a href='joelcomp1.no-ip.org/index.php?userid=";
				$message .= $memberInfo['userid'];
				$message .= '&createaccount=yes';
				$message .= '&orgid=';
				$message .= $orgid;
				$message .="'>Join Volly.it!</a></p>";
				$message .= "</body></html>";
				$name = $adminsToEmail->additfirstname;
				$name .= ' ';
				$name .= $adminsToEmail->additlastname;
				
				$emailAddressArray[] = $adminsToEmail->additemail;
				$emailAddressArrayOfNames[] = $name;
				
				if(count(emailAddressArray) > 0)
				{
					$success = smtpmailer($emailAddressArray, $emailAddressArrayOfNames, 'info@volly.it', 'Volly.it', 'Volly.It - Help change the world! ', $message);
				}
			}
			else
			{
				$message = "<html><head><style type='text/css'></style></head><body><p>Hi ";
				$message .= $adminsToEmail->additfirstname;
				$message .= ' '; 
				$message .= $adminsToEmail->additlastname;
				$message .= "! You just got added as a admin for the ";
				$message .= $orgName;
				$message .= " Organization <br>Click the link below to link your exisitng volly.it account.</p>";
				$message .= "<a href='joelcomp1.no-ip.org/index.php?userid=";
				$message .= $memberInfo['userid'];
				$message .= '&createaccount=no';
				$message .= '&orgid=';
				$message .= $orgid;
				$message .="'>Join Volly.it!</a></p>";
				$message .= "</body></html>";
				$name = $adminsToEmail->additfirstname;
				$name .= ' ';
				$name .= $adminsToEmail->additlastname;
				
				$emailAddressArray[] = $adminsToEmail->additemail;
				$emailAddressArrayOfNames[] = $name;
				
				if(count(emailAddressArray) > 0)
				{
					$success = smtpmailer($emailAddressArray, $emailAddressArrayOfNames, 'info@volly.it', 'Volly.it', 'Volly.It - Help change the world! ', $message);
				}
			}
		}	
		
		header("location: member-index-org.php");
		
		exit();
	
	?>