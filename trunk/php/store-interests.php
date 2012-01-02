<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false; 
	
	//Connect to mysql server
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
	
	//Sanitize the POST values
	$interestsTextBox = clean($_POST['interestsTextBox']);
	
	$login = clean($_SESSION['SESS_MEMBER_ID']);

	//Create Update query
	$qry = "update vols set interests='$interestsTextBox' where login='$login';";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
	$result=mysql_query($qry);
			//Login Successful
			session_regenerate_id();
			$vols = mysql_fetch_assoc($result);
			$_SESSION['VOL_INTERESTS'] = $interestsTextBox;
			session_write_close();
			header("location: member-index-vol.php");
			exit();
	}
	else {
		die("Query failed");
	}
?>