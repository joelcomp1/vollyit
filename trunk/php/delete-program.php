<?php
	$programName = $_GET['programname'];

	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
		
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
	$login = clean($_SESSION['SESS_MEMBER_ID']);
	$orgName = clean($_SESSION['ORG_NAME']);
	
	
	$qry = "select * from programs where orgname='$orgName' and programname='$programName'";
	$result = @mysql_query($qry);
	$program = mysql_fetch_assoc($result);
	
	$tempNumber = $program['programnumber'];
	$qry = "select * from programs where programnumber > $tempNumber";
	$result4 = @mysql_query($qry);
	
	while($alterNum = mysql_fetch_assoc($result4))
	{
		$orgToAlter = $alterNum['orgname'];
		$progToAlter = $alterNum['programname'];
		$qry = "update programs set programnumber='$tempNumber' where orgname='$orgToAlter' and programname='$progToAlter'";
		$result5 = @mysql_query($qry);
		$tempNumber += 1;
	}

	
	$qry = "delete from programs where orgname='$orgName' and programname='$programName'";
	$result2 = @mysql_query($qry);

	$qry = "delete from programpositions where orgname='$orgName' and programname='$programName'";
	$result3 = @mysql_query($qry);
	
	
	//Check whether the query was successful or not
	if($result && $result2 && $result3) {
	//Login Successful

			header("location: program-management-org.php");	
	}
	else {
		die("Query failed");
	}
	mysql_close($link);
?>