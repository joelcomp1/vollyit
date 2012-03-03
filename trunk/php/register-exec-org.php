<?php

	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	require_once('bitly-api.php');
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
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	$email = clean($_POST['email']);
	
	$plan = $_GET['plan'];

	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if($email == '') {
		$errmsg_arr[] = 'E-mail missing';
		$errflag = true;
	}
	if($email != '')
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		} else {
			$errmsg_arr[] = 'E-mail Invalid';
			$errflag = true;
		}
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	else
	{
		if(strlen($password) <= 6)
		{
			$errmsg_arr[] = 'Password is too short!';
			$errflag = true;
		}
	}
	
	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM members WHERE login='$login' ";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Login ID already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}

	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			unset($_SESSION['ORG_EMAIL_TEMP']);
			unset($_SESSION['ORG_LOGIN_TEMP']);
			unset($_SESSION['ORG_PLAN_TEMP']);
			$_SESSION['ORG_PLAN_TEMP'] = $plan;
			$header = "location: ../index.php?orgerror=true&plan=";
			$header .= $plan;
			$_SESSION['ORG_EMAIL_TEMP'] = $email;
	
			if($loginInvalid != 'true')
			{
				$_SESSION['ORG_LOGIN_TEMP'] = 	$login;	
			}
		session_write_close();
		header($header);
		exit();
	}
	
			
	if($plan == '')
	{
		$orgpaid = 'YES';
	}
	else
	{
		$orgpaid = 'NO';
	}
	

	$found = false;
	while(!$found) {
	$uid = mt_rand(1,32000); // find random number betwen minimum and maximum
	$qry = "SELECT * FROM orgs WHERE orgid='$uid'";
	$result = mysql_query($qry);
	if(mysql_num_rows($result) == 0) {
			$orgid = $uid;
			if($plan == 'free')
			{
				$messages = '0';
			}
			else if($plan == 'pro')
			{
				$messages = '1000';
			}
			else
			{
				$messages = 'UNLIMATED';	
			}
			$todaysDate = date("m/d/Y h:i:s A");
			
				$qry = "insert into orgs(orgid, login, plan, paid, messages, renewdate, suspend) VALUES('$uid' , '$login', '$plan', '$orgpaid', '$messages', '$todaysDate', 'false')";
				$result = @mysql_query($qry);
				$found = true;
			}
	}

	//Create INSERT query
	$qry = "INSERT INTO members(login, passwd, orgorvol, email) 
	VALUES('$login','".md5($_POST['password'])."', 'ORG', '$email')";
	$result = @mysql_query($qry);
	
	$found = false;
    while(!$found) {
      $uid = mt_rand(1,32000); // find random number betwen minimum and maximum
	  $qry = "SELECT * FROM members WHERE userid='$uid'";
	  $result = mysql_query($qry);
	  if(mysql_num_rows($result) == 0) {
		$qry = "update members set userid='$uid' where login='$login'";
		$result = @mysql_query($qry);
		$found = true;
	  }
	}
	
	//Check whether the query was successful or not
	if($result) {
    $qry="SELECT * FROM members WHERE login='$login' AND passwd='".md5($_POST['password'])."'";
	$result=mysql_query($qry);
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['login'];
			$_SESSION['SESS_ORG_OR_VOL'] = $member['orgorvol'];
			$_SESSION['ORG_PLAN'] = $plan;
			$shareLink = 'http://joelcomp1.no-ip.org/php/org-manager.php?orgid=';
			$shareLink .= $orgid;
			$short_url = get_bitly_short_url($shareLink,'joelcomp1','R_b2b6743ff66fe6821031f375af4e7ced');
			$_SESSION['ORG_INVITE_LINK'] = rtrim($short_url);
			$_SESSION['ORG_MESSAGES'] = $messages;
			$_SESSION['ORG_FINISHED'] = 'false';
			//see if the org also bought messages
			$result3 = mysql_query('SELECT * FROM payasyougo WHERE orgname="'.$orgName.'"');
			$payasyougo = mysql_fetch_assoc($result3);				
			$_SESSION['ORG_MESSAGES'] += $payasyougo['messages'];
			
			
			$_SESSION['ORG_ID'] = $orgid;
			if($plan == '')
			{
				$_SESSION['ORG_PAID'] = 'YES';
			}
			else
			{
				$_SESSION['ORG_PAID'] = 'NO';
			}
			
			session_write_close();
			header("location: member-reg-org.php");	
			

			
			

			exit();
		}else {
			//Login failed
			$_SESSION['LOGIN_FAILED'] = 'true';

			session_write_close();
			header("location: ../index.php");
			exit();
		}
	}
	else {
		die("Query failed");
	}
	

?>