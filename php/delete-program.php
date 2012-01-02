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
	
	$qry = "delete from programs where orgname='$orgName' and programname='$programName'";
	$result2 = @mysql_query($qry);

	$qry = "delete from programpositions where orgname='$orgName' and programname='$programName'";
	$result3 = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result && $result2 && $result3) {
	//Login Successful
			session_regenerate_id();

			$programName = 'PROGRAM_NAME';
			$programName .= $program['programnumber'];
	
			$programImage = 'PROGRAM_IMAGE_PATH';
			$programImage .= $program['programnumber'];
		
			$date = 'PROGRAM_DATE';
			$date .= $program['programnumber'];
	
			$timeStart = 'PROGRAM_START_TIME';
			$timeStart .= $program['programnumber'];
	
			$endTime = 'PROGRAM_END_TIME';
			$endTime .= $program['programnumber'];
	
			$endDate = 'PROGRAM_END_DATE';
			$endDate .= $program['programnumber'];
	    
			$programStatus = 'PROGRAM_STATUS';
			$programStatus .= $program['programnumber'];
			
			$programDesc = 'PROGRAM_DESC';
			$programDesc .= $program['programnumber'];
			
			$programCity = 'PROGRAM_CITY';
			$programCity .= $program['programnumber'];
			
			$programState = 'PROGRAM_STATE';
			$programState .= $program['programnumber'];
			
			unset($_SESSION[$programName]);
			unset($_SESSION[$programImage]);
			unset($_SESSION[$date]);
			unset($_SESSION[$timeStart]);
			unset($_SESSION[$endTime]);
			unset($_SESSION[$endDate]);
			unset($_SESSION[$programDesc]);
			unset($_SESSION[$programStatus]);
			unset($_SESSION[$programCity]);
			unset($_SESSION[$programState]);
			
			$_SESSION['PROGRAMS_CREATED'] -= 1;
				
			$totalPositionsAvailable = 'POSITIONS_AVAIL';
			$totalPositionsAvailable .= $program['programnumber'];
			unset($_SESSION[$totalPositionsAvailable]);	
			header("location: program-management-org.php");	
			session_write_close();
	}
	else {
		die("Query failed");
	}

?>