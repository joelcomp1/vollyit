<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');

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
	
	$orgName = clean($_SESSION['ORG_NAME']);
	$positionsCreated = clean($_SESSION['POSITIONS_CREATED']);
	$programName = 'PROGRAM_NAME';
	$programsCreated = clean($_SESSION['PROGRAMS_CREATED']);
	$programName .= $programsCreated;
	$programName = clean($_SESSION[$programName]);
	
	$qry = "update programs set draft='Published' where orgname='$orgName' and programname='$programName'";
	$result = @mysql_query($qry);
	
	session_regenerate_id();
	
	session_write_close();
	header("location: program-published.php");
	exit();
?>