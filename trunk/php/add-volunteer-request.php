<?php
	//Start session
	session_start();
	
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
	$login = clean($_SESSION['SESS_MEMBER_ID']);
	$loginRequest = clean($_SESSION['ORG_NAME']);
	$zip = clean($_SESSION['ORG_ZIPCODE']);
	
	$todaysDate = date("m/d/Y h:i:s A");

	$qry = "select * from volConn where id_request='$loginRequest' and id_inviter='$login'";
	$result = @mysql_query($qry);
	$exists = mysql_num_rows($result);
	
	if($exists == 0)
	{
		$qry = "INSERT INTO volConn(id_inviter, id_request, status, updated_at, created_at) 
	    				VALUES('$login','$loginRequest','REQUEST_SENT','$todaysDate','$todaysDate')";
		$result = @mysql_query($qry);
	}
	else
	{
		$qry = "update volConn set updated_at='$todaysDate', status='REQUEST_SENT' where id_request='$loginRequest' and id_inviter='$login'";

		$result = @mysql_query($qry);
	
	}
	
	//Check whether the query was successful or not
	if($result) {
			//create program part 1 Successful
			session_regenerate_id();
		
			header("location: org-manager.php?orgname=$loginRequest&zipcode=$zip");
			
			session_write_close();
			exit();
	}else {
		die("Query failed");
	}
	
	mysql_close($link);
?>