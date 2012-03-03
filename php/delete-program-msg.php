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
	$subject = $_GET['subject'];


	$qry = "delete from programmsgs where orgname='$orgName' and programname='$programName' and subject='$subject'";
	$result = @mysql_query($qry);


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