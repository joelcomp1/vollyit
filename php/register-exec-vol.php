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
	
	//Connect to mysql server
		
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}
	function checkEmail($emailPass)
	{
	
		if (!preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/" , $emailPass))
		{
			return false;
		}
		return true;
	}		

	

	//Sanitize the POST values
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	$email = clean($_POST['email']);

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
				$loginInvalid = 'true';
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
			unset($_SESSION['VOL_EMAIL_TEMP']);
			unset($_SESSION['VOL_LOGIN_TEMP']);
			$header = "location: ../index.php?volerror=true";
			$_SESSION['VOL_EMAIL_TEMP'] = $email;
	
			if($loginInvalid != 'true')
			{
				$_SESSION['VOL_LOGIN_TEMP'] = 	$login;	
			}
				session_write_close();
			header($header);

		exit();
	}
	
	//Create INSERT query
		$qry = "INSERT INTO members(login, passwd, orgorvol, email) 
	VALUES('$login','".md5($_POST['password'])."', 'VOL', '$email')";
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
			unset($_SESSION['VOL_EMAIL_TEMP']);
			unset($_SESSION['VOL_LOGIN_TEMP']);
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['login'];
			$_SESSION['SESS_ORG_OR_VOL'] = $member['orgorvol'];
			$_SESSION['SESS_FIRST_TIME'] = 'true';
			$shareLink = 'http://joelcomp1.no-ip.org/php/vol-manager.php?userid=';
			$shareLink .= $member['userid'];
			$short_url = get_bitly_short_url($shareLink,'joelcomp1','R_b2b6743ff66fe6821031f375af4e7ced');
			$_SESSION['USER_INVITE_LINK'] = rtrim($short_url);
			session_write_close();
			header("location: member-index-vol.php");
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
	
	mysql_close($link);
?>