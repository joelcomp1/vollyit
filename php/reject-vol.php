<?php
	$pendingReqeuest = $_GET['request_id'];
	//Start session
	session_start();
	
	//Include database connection details
	include('config.php');
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}
	
	//Sanitize the POST values
	$orgname = clean($_SESSION['ORG_NAME']);

	$todaysDate = date("m/d/Y h:i:s A");


	$qry = "update volConn set updated_at='$todaysDate', status='DECLINED' where id_inviter='$pendingReqeuest' and id_request='$orgname'";
	$result = @mysql_query($qry);
	    
	$url = $_SESSION['ref'];
	header( "Location:  $url") ;
?>