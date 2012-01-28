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
  
// Your Twilio Number or an Outgoing Caller ID you have previously validated with Twilio 
$from= '3194233896';
 
// Number you wish to call 
$to= '6128013833';
  
// Instantiate a new Twilio Rest Client
$client = new Services_Twilio($AccountSid, $AuthToken);

$url = 'play.php?url=' . $_REQUEST['RecordingUrl'];
//if(!isset($_SESSION['RECORDING']))
//{
//		$errmsg_arr[] = 'Error: No Message Recorded';
//		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
//		 header("location: message-center-org-voicemail.php");   
//}
//else
//{

			session_regenerate_id();
			$_SESSION['VOL_VIEW_STATE'] = 'All';
			session_write_close();

	foreach($client->account->recordings as $recording) {
  		$recordingUrl = 'https://api.twilio.com/2010-04-01/Accounts/';
		$recordingUrl .= $AccountSid;
		$recordingUrl .= '/Recordings/';
		$recordingUrl .= $recording->sid;
		$recordingUrl .= '.mp3';
		break;
	}

// make Twilio REST request to initiate outgoing call 
$url = 'http://joelcomp1.no-ip.org/php/play.php?url=';
$url .= $recordingUrl;

	$call = $client->account->calls->create($from, $to, $url);
 
// redirect back to the main page with CallSid 
	$msg = urlencode("Connecting... ".$call->sid);
		$errmsg_arr[] = $msg;
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		 header("location: message-center-org-voicemail.php");   
//}
?>