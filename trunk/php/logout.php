<?php
	//Start session
	session_start();
	
	$_SESSION['SESS_LOGOUT'] = 'true';

	setcookie("session_id",'' ,time() - 4200, '/');	
	setcookie("passwd", '',time() - 4200, '/');

	$_COOKIE['session_id'] = '';
	$_COOKIE['passwd'] = '';
	session_destroy ();
	

	header("location: ../index.php");
?>