<?php
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
	
	
	$qry = "select * from programs where orgname='$orgName'";
	$result = @mysql_query($qry);

	//Check whether the query was successful or not
	if($result) {
	//Login Successful
			session_regenerate_id();
			$_SESSION['PROGRAMS_CREATED'] = 0;
			$index = 1;
			$programNumber = array();
			while($program = mysql_fetch_assoc($result))
			{
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
				
				$programNumber[$index] = $program['programnumber'];
				$index += 1;
				
				$_SESSION['CREATED_PROGRAM_INDEX'] = $programNumber;
				$_SESSION[$programName] = $program['programname'];
				$_SESSION[$programImage] = $program['programimage'];
				$_SESSION[$date] = $program['date'];
				$_SESSION[$timeStart] = $program['starttime'];
				$_SESSION[$endTime] = $program['endtime'];
				$_SESSION[$endDate] = $program['enddate'];
				$_SESSION[$programStatus] = $program['draft'];
				$_SESSION[$programDesc] = $program['programdescrip'];
				$_SESSION[$programCity] = $program['city'];
				$_SESSION[$programState] = $program['state'];
				
				$_SESSION['PROGRAMS_CREATED'] += 1;
				
				$totalPositionsAvailable = 'POSITIONS_AVAIL';
				$totalPositionsAvailable .= $program['programnumber'];
				
			
				$programNameInDatabase = $program['programname'];
				$qry2 = "select * from programpositions where orgname='$orgName' and programname='$programNameInDatabase'";
				$result2 = @mysql_query($qry2);
				$rows = mysql_num_rows($result2);
				$_SESSION[$totalPositionsAvailable] = 0;
				while($position = mysql_fetch_assoc($result2))
				{
					$_SESSION[$totalPositionsAvailable] += ($position['numavail'] - $position['numtaken']);
				}
			}	

			session_write_close();
	}
	else {
		die("Query failed");
	}

?>