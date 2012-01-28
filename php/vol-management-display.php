<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}
	
	$orgView = clean($_POST['volView']);
	$orgSort = clean($_POST['volSort']);
	session_regenerate_id();

	$_SESSION['VOL_VIEW_STATE'] = $orgView;
	$_SESSION['VOL_SORT_STATE'] = $orgSort;
	
	session_write_close();
	header("location: org-volunteer-mgmt.php");
	exit();
?>