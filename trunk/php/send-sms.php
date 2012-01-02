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


    // Include the PHP TwilioRest library
    require "../twilio/Services/Twilio.php";
     
    // Set our AccountSid and AuthToken
    $AccountSid = "ACb4cf0dce3f5a4c0d9ad5c79ecd7f235d";
    $AuthToken = "0b8fc311f10d662e472baa8bc7e32154";
 
 	$messageTo = clean($_POST['phoneNumber']);
	$body = clean($_POST['textMsg']);

    // Instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);
 
    // Your Twilio Number or Outgoing Caller ID 
    $from= '3194233896';
 
    // make an associative array of server admins
 
        $client->account->sms_messages->create($from, $messageTo, $body);
        header("location: message-center-org.php");    
?>