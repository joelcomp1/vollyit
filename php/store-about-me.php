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
	$aboutMeTextBox = clean($_POST['aboutMeTextBox']);
	
	$login = clean($_SESSION['SESS_MEMBER_ID']);

	//Create Update query
if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
{
	$qry = "update orgs set orgdescrip='$aboutMeTextBox' where login='$login';";
	$result = @mysql_query($qry);

}
else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
{
	$qry = "update vols set aboutme='$aboutMeTextBox' where login='$login';";
	$result = @mysql_query($qry);
}
	
	//Check whether the query was successful or not
	if($result) {
	$result=mysql_query($qry);
			//Login Successful
			session_regenerate_id();
			$vols = mysql_fetch_assoc($result);
			
			if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
			{
				$_SESSION['ORG_DESC'] = $aboutMeTextBox;
				session_write_close();
				header("location: member-index-org.php");
			}
			else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
			{
				$_SESSION['VOL_ABOUTME'] = $aboutMeTextBox;
				session_write_close();
				header("location: member-index-vol.php");
			}

			exit();
	}
	else {
		die("Query failed");
	}
?>