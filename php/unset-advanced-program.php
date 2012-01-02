<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['TEMP_PROGRAM_IMAGE']);
	unset($_SESSION['TEMP_PROGRAM_NAME']);
	unset($_SESSION['TEMP_PROGRAM_PARENT_NAME']);
	unset($_SESSION['TEMP_PROGRAM_PARENT_IMAGE']);
	unset($_SESSION['TEMP_ORG_IMAGE']);
	unset($_SESSION['TEMP_ORG_PRGORAM_NAME']);
	unset($_SESSION['TEMP_ORG_PROGRAM_CITY']);
	unset($_SESSION['TEMP_ORG_PROGRAM_STATE']);
	
	session_write_close();
	header("location: create-program-part1.php");
?>