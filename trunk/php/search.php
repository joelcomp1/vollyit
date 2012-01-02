<?php
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
		return mysql_escape_string($str);
	}
	
	//Sanitize the POST values
	$orgProgramName = clean($_POST['name']);
	$keywords = clean($_POST['tags']);
	$location = clean($_POST['location']);
	$login = clean($_SESSION['SESS_MEMBER_ID']);
	list($city, $state) = split('[,]', $location);
	
	if(($orgProgramName != '') && ($keywords != '') && ($location != ''))
	{
		$qry = "select * from orgs where orgname='$orgProgramName' and tag='$keywords' and city='$city' and state='$state'";
		$result = @mysql_query($qry);
	}
	else if(($orgProgramName != '') && ($keywords != '') && ($location == ''))
	{
		$qry = "select * from orgs where orgname='$orgProgramName' and tag='$keywords'";
		$result = @mysql_query($qry);
	}
	else if(($orgProgramName != '') && ($keywords == '') && ($location != ''))
	{
		$qry = "select * from orgs where orgname='$orgProgramName' and city='$city' and state='$state'";
		$result = @mysql_query($qry);
	}
	else if(($orgProgramName == '') && ($keywords != '') && ($location != ''))
	{
		$qry = "select * from orgs where tag='$keywords' and city='$city' and state='$state'";
		$result = @mysql_query($qry);
	}
	else if(($orgProgramName == '') && ($keywords == '') && ($location != ''))
	{
		$qry = "select * from orgs where city='$city' and state='$state'";
		$result = @mysql_query($qry);
	}
	else if(($orgProgramName == '') && ($keywords != '') && ($location == ''))
	{
		$qry = "select * from orgs where tag='$keywords'";
		$result = @mysql_query($qry);
	}
	else if(($orgProgramName != '') && ($keywords == '') && ($location == ''))
	{
		$qry = "select * from orgs where orgname='$orgProgramName'";
		$result = @mysql_query($qry);
	}
	else
	{
		$qry = "select * from orgs";
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
			
			exit();
	}else {
		die("Query failed");
	}
?>