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
	
	$programViewState = clean($_POST['programView']);
	session_regenerate_id();

	$_SESSION['PROGRAM_VIEW_STATE'] = $programViewState;
	
	session_write_close();
	header("location: program-management-org.php");
	exit();
?>