<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	require_once('upsaddress.php');
	
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
	$firstName = clean($_POST['firstName']);
	$lastName = clean($_POST['lastName']);
	$email = clean($_POST['email']);
	$city = clean($_POST['city']);
	$state = clean($_POST['state']);
	$login = clean($_SESSION['SESS_MEMBER_ID']);
	$privacySetting = clean($_POST['Field134']);
	$submit= clean($_POST['Submit']);
	$newpassword = clean($_POST['newpassword']);
	$oldpassword = clean($_POST['oldpassword']);
	$cpassword = clean($_POST['cpassword']);
    $phoneAreaCode = clean($_POST['phone1']);
	$phonePart2 = clean($_POST['phone2']);	
	$phonePart3 = clean($_POST['phone3']);

	//Input Validations
	if($submit == 'Finish')
	{
	    if(($firstName == '') || ($firstName == 'First Name')) {
	    	$errmsg_arr[] = 'First Name Missing';
	    	$errflag = true;
	    }
	    if(($lastName == '') || ($lastName == 'Last Name')) {
	    	$errmsg_arr[] = 'Last Name Missing';
	    	$errflag = true;
	    }
	    if(($city == '') || ($city == 'City')) {
	    	$errmsg_arr[] = 'City Missing';
	    	$errflag = true;
	    }
	    if($state == '') {
	    	$errmsg_arr[] = 'State Missing';
	    	$errflag = true;
	    }	
	    
		if(($city != '') && ($state != ''))
		{
			$ups = new upsaddress("CC90B3C39836BC10", "joelcomp1", "Coolenungames!2");
			$ups->setCity($city);
			$ups->setState($state);
			$response = $ups->getResponse();
			
			
			if($response->list[0]->quality == 1.0)
			{
				//We have a good address!
			}
			else
			{
				//We didn't have a exact match...
				if((ucwords(strtolower($response->list[0]->city)) == $city) &&  ($response->list[0]->state == $state))
				{//if this all matches we are still OK

				}
				else if((ucwords(strtolower($response->list[1]->city == $city))) &&  ($response->list[1]->state == $state))
				{//if this all matches we are still OK

				}
				else
				{
					$errmsg_arr[] = "We couldn't confirm your Address are you sure its correct?";
					$errflag = true;
				}
			}
		}
		
	    //If there are input validations, redirect back to the login form
	    if($errflag) {
	    	//These will be reset later
	    	$_SESSION['VOL_CITY'] = $city;
	    	$_SESSION['VOL_FIRST_NAME'] = $firstName;
	    	$_SESSION['VOL_LAST_NAME'] = $lastName;	
			$_SESSION['VOL_STATE'] = $state;
			$_SESSION['VOL_PRIVACY'] = $privacySetting;
	    	
	    	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	    	$_SESSION['SESS_FIRST_TIME'] = true;
			session_write_close();
	    	header("location: member-index-vol.php");
	    	exit();
	    }
	}
	if($submit == 'Save Changes' || $submit == 'Save Changes from Org')
	{
		if( strcmp($newpassword, $cpassword) != 0 ) 
		{
			$errmsg_arr[] = md5($oldpassword);
			$errflag = true;
		}
	    //If there are input validations, redirect back to the login form
	    if($errflag) {
	    	//These will be reset later
	    	$_SESSION['VOL_FIRST_NAME'] = $firstName;
	    	$_SESSION['VOL_LAST_NAME'] = $lastName;	
	    	$_SESSION['VOL_EMAIL'] = $email;	
			$_SESSION['VOL_STATE'] = $state;
			$_SESSION['VOL_PHONE_PART_1'] = $phoneAreaCode;	
			$_SESSION['VOL_PHONE_PART_2'] = $phonePart2;	
			$_SESSION['VOL_PHONE_PART_3'] = $phonePart3;	
			$_SESSION['VOL_PRIVACY'] = $privacySetting;
	    	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			session_write_close();
	    	header("location: account-settings-vol.php");
	    	exit();
	    }
	}
	

	if($submit == 'Finish')
	{ 	
		//we need to get the login
		$qry = "select * from members where login='$login'";
		$result = @mysql_query($qry);
		$memberInfo = mysql_fetch_assoc($result);
		$email = $memberInfo['email'];
		//Create INSERT query
		$qry = "INSERT INTO vols(login, firstname, lastname, city, state, aboutme, email, interests, userimage, privacy, phonenumber) 
						VALUES('$login','$firstName','$lastName', '$city', '$state', ' ', '$email', '','', '$privacySetting' ,'')";
					
		$result = @mysql_query($qry);
		

	}
	if($submit == 'Save Changes' || $submit == 'Save Changes from Org')
	{
		//Concatenate Phone number
		$entirePhone = $phoneAreaCode;
		$entirePhone .= $phonePart2;
		$entirePhone .= $phonePart3;
	    if( (strcmp($newpassword, $cpassword) == 0 ) && (($newpassword != '') || ($cpassword != '')))
		{
			    $qry="SELECT * FROM members WHERE login='$login' AND passwd='".md5($oldpassword)."'";
				$result = mysql_query($qry);
		
				if(mysql_num_rows($result) == 1)
				{
					$qry = "update members set passwd='".md5($_POST['newpassword'])."' where login='$login';";
					$result = @mysql_query($qry);
				}
				else
				{
					$_SESSION['VOL_FIRST_NAME'] = $firstName;
					$_SESSION['VOL_LAST_NAME'] = $lastName;	
					$_SESSION['VOL_EMAIL'] = $email;	
					$_SESSION['VOL_PHONE_PART_1'] = $phoneAreaCode;	
					$_SESSION['VOL_PHONE_PART_2'] = $phonePart2;	
					$_SESSION['VOL_PHONE_PART_3'] = $phonePart3;	
					$_SESSION['VOL_PRIVACY'] = $privacySetting;
					$errmsg_arr[] = 'Old Password Wrong!';
					$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
					session_write_close();
					header("location: account-settings-vol.php");
				}
	    }
		$qry = "update vols set firstname='$firstName', email='$email', phonenumber='$entirePhone', privacy='$privacySetting', lastname='$lastName'  where login='$login'";
		$result = @mysql_query($qry);
	}

		
	//Check whether the query was successful or not
	if($result) {
			//Login Successful
			session_regenerate_id();
			if($submit == 'Finish')
			{
				$_SESSION['VOL_CITY'] = $city;
				$_SESSION['VOL_STATE'] = $state;
			}
			$_SESSION['VOL_PRIVACY'] = $privacySetting;
			$_SESSION['VOL_FIRST_NAME'] = $firstName;
			$_SESSION['VOL_LAST_NAME'] = $lastName;	
			$_SESSION['VOL_EMAIL'] = $email;	
			$_SESSION['VOL_PHONE_PART_1'] = $phoneAreaCode;	
			$_SESSION['VOL_PHONE_PART_2'] = $phonePart2;	
			$_SESSION['VOL_PHONE_PART_3'] = $phonePart3;	
			$_SESSION['SESS_FIRST_TIME'] = false;

		
			session_write_close();
			if($submit == 'Finish')
			{
				header("location: member-index-vol.php");
			}
			else if($submit == 'Save Changes')
			{
				header("location: account-settings-vol.php");
			}
			else if($submit == 'Save Changes from Org')
			{
			
				header("location: account-settings-org.php?state=vol");
			}
			
			exit();
	}else {
		die('firstName');
	}
	
	mysql_close($link);
?>