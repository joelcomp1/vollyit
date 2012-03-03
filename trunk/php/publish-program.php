<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	require_once('bitly-api.php');
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
	$qry = "select * from programs where orgname='$orgName' and programname='$programName'";
	$result = @mysql_query($qry);
	$progInfo = mysql_fetch_assoc($result);
	
	$shareLink = 'http://joelcomp1.no-ip.org/php/program-manager.php?progid=';
	$shareLink .= $progInfo['progid'];
	$short_url = get_bitly_short_url($shareLink,'joelcomp1','R_b2b6743ff66fe6821031f375af4e7ced');
	$_SESSION['PROGRAM_SHARE_LINK'] = rtrim($short_url);
	$_SESSION['PROGRAM_PUBLISHED'] = 'true';
	$qry = "update programs set draft='Published' where orgname='$orgName' and programname='$programName'";
	$result = @mysql_query($qry);
	
	session_regenerate_id();
	
	session_write_close();
	header("location: program-published.php");
	exit();
	
	mysql_close($link);
?>