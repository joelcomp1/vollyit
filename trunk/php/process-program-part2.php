<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;	

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}
	
	//Sanitize the POST values

	$statrtDate = clean($_POST['Field1']);
	$startTime = clean($_POST['timepicker_start']);
	$endTime = clean($_POST['timepicker_end']);
	$recurring = clean($_POST['Field6']);
	$repeats = clean($_POST['Field106']);
	$sunday = clean($_POST['Sunday']);
	$monday = clean($_POST['Monday']);
	$tuesday = clean($_POST['Tuesday']);
	$wednesday = clean($_POST['Wednesday']);
	$thursday = clean($_POST['Thursday']);
	$friday = clean($_POST['Friday']);
	$saturday = clean($_POST['Saturday']);
	$nextState= clean($_POST['Submit']);
	$endDate = clean($_POST['endDate']);
	$noEnd = clean($_POST['Field16']);
	$orgName = clean($_SESSION['ORG_NAME']);
	$programName = clean($_SESSION['PROGRAM_NAME_TEMP']);
	
	
	//Input Validations
	$todaysDate = date("m/d/Y");
	$today = strtotime($todaysDate);
	$programStartDate = strtotime($statrtDate);
	$programEndDate = strtotime($endDate);
	if($nextState == 'Submit')
	{
		if($statrtDate == '') {
			$errmsg_arr[] = 'Need to have a Program Start Date';
			$errflag = true;
		}
		if(($programStartDate < $today) && ($statrtDate != ''))
		{
			$errmsg_arr[] = 'You cannot have a program take place in the past';
			$errflag = true;
		
		}
		if($startTime == '') {
			$errmsg_arr[] = 'Start Time Missing';
			$errflag = true;
		}
		if($endTime == '') {
			$errmsg_arr[] = 'End Time Missing';
			$errflag = true;
		}
		if(($recurring != '') && ($endDate == '') && ($noEnd == '')) {
			$errmsg_arr[] = 'End Date Missing';
			$errflag = true;
		}
		if(($recurring != '') && ($programEndDate < $today) && ($endDate != ''))
		{
			$errmsg_arr[] = 'You cannot have a program end in the past';
			$errflag = true;
		
		}
		if(($recurring != '') && ($noEnd == '') && ($programEndDate < $programStartDate))
		{
			$errmsg_arr[] = 'You cannot have a end date before your start date ';
			$errflag = true;
		
		}
		//If there are input validations, redirect back to the login form
		if($errflag) {
		    //Save to help user if a fail, reset below
		    $_SESSION['PROGRAM_DATE_TEMP'] = $statrtDate;
		    $_SESSION['PROGRAM_START_TIME_TEMP'] = $startTime;
		    $_SESSION['PROGRAM_END_TIME_TEMP'] = $endTime;
			$_SESSION['PROGRAM_END_DATE_TEMP'] = $endDate;
			$_SESSION['PROGRAM_RECURRING_TEMP'] = $recurring;
			$_SESSION['PROGRAM_REPEATS_TEMP'] = $repeats;
			$_SESSION['PROGRAM_DATE_SUNDAY_TEMP'] = $sunday;
			$_SESSION['PROGRAM_DATE_MONDAY_TEMP'] = $monday;
			$_SESSION['PROGRAM_DATE_TUESDAY_TEMP'] = $tuesday;
			$_SESSION['PROGRAM_DATE_WEDNESDAY_TEMP'] = $wednesday;
			$_SESSION['PROGRAM_DATE_THURSDAY_TEMP'] = $thursday;
			$_SESSION['PROGRAM_DATE_FRIDAY_TEMP'] = $friday;
			$_SESSION['PROGRAM_DATE_SATURDAY_TEMP'] = $saturday;
			$_SESSION['PROGRAM_NO_END_TEMP'] = $noEnd;

		
			
			
			
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			header("location: create-program-part2.php");
			exit();
		}
	}
	
	//Create INSERT query	
	//nextState don't save if previous 
	if($nextState != 'Previous')
	{
		$qry = "update programs set date='$statrtDate', starttime='$startTime', endtime='$endTime', recurring='$recurring', enddate='$endDate', draft='$nextState', noend='$noEnd' where programname='$programName';";
		$result = @mysql_query($qry);
	}
	else
	{
		$qry = "update programs set date='$statrtDate', starttime='$startTime', endtime='$endTime', recurring='$recurring', enddate='$endDate', noend='$noEnd' where programname='$programName';";
		$result = @mysql_query($qry);
	}
	
	if($recurring == 'Recurring')
	{
	$qry = "SELECT * FROM programrepeats WHERE programname='$programName' and orgname='$orgName'";  
	$result = @mysql_query($qry);
	if (mysql_num_rows($result) > 0) { 
		$qry = "update programrepeats set repeats='$repeats', everysun='$sunday', everymon='$monday', everytues='$tuesday', everywed='$wednesday', everythurs='$thursday', everyfri='$friday', everysat='$saturday' where programname='$programName';";
		$result2 = @mysql_query($qry);
	} else { 
		$qry = "INSERT INTO programrepeats(programname, repeats, everysun, everymon, everytues, everywed, everythurs, everyfri, everysat, orgname) 
					VALUES('$programName','$repeats','$sunday','$monday','$tuesday','$wednesday','$thursday','$friday','$saturday', '$orgName')";
		$result2 = @mysql_query($qry);
	} 	
	
	
	
	}
	else
	{
		$result2 = 'true';
	}
	
	$qry = "SELECT * FROM programs where programname='$programName' and orgname='$orgName'";  
	$result3 = mysql_query($qry);

	$program = mysql_fetch_assoc($result3);
	
	
	$dateSaved = 'PROGRAM_DATE';
	$dateSaved .= $program['programnumber'];
	
	$timeStartSaved = 'PROGRAM_START_TIME';
	$timeStartSaved .= $program['programnumber'];
	
	$endTimeSaved = 'PROGRAM_END_TIME';
	$endTimeSaved .= $program['programnumber'];
	
	$endDateSaved = 'PROGRAM_END_DATE';
	$endDateSaved .= $program['programnumber'];
				
	$programStateSaved = 'PROGRAM_STATE';
	$programStateSaved .= $program['programnumber'];
	
	$programRecurringSaved = 'PROGRAM_RECURRING';
	$programRecurringSaved .= $program['programnumber'];
	
	$programRepeatsSaved = 'PROGRAM_REPEATS';
	$programRepeatsSaved .= $program['programnumber'];
	
	$programSundaySaved = 'PROGRAM_DATE_SUNDAY';
	$programSundaySaved .= $program['programnumber'];

	$programMondaySaved = 'PROGRAM_DATE_MONDAY';
	$programMondaySaved .= $program['programnumber'];
	
	$programTuesdaySaved = 'PROGRAM_DATE_TUESDAY';
	$programTuesdaySaved .= $program['programnumber'];
	
	$programWednesdaySaved = 'PROGRAM_DATE_WEDNESDAY';
	$programWednesdaySaved .= $program['programnumber'];
	
	$programThursdaySaved = 'PROGRAM_DATE_THURSDAY';
	$programThursdaySaved .= $program['programnumber'];
	
	$programFridaySaved = 'PROGRAM_DATE_FRIDAY';
	$programFridaySaved .= $program['programnumber'];
	
	$programSaturdaySaved = 'PROGRAM_DATE_SATURDAY';
	$programSaturdaySaved .= $program['programnumber'];
	
	$programNoEndSaved = 'PROGRAM_NO_END';
	$programNoEndSaved .= $program['programnumber'];
	//Check whether the query was successful or not
	if($result && result2 && $result3) {
			//create program part 1 Successful
			session_regenerate_id();
			$_SESSION[$dateSaved] = $statrtDate;	
			$_SESSION[$timeStartSaved] = $startTime;	
			$_SESSION[$endTimeSaved] = $endTime;
			$_SESSION[$endDateSaved] = $endDate;
			$_SESSION[$programStateSaved] = $nextState;
			$_SESSION[$programRecurringSaved] = $recurring;
			$_SESSION[$programRepeatsSaved] = $repeats;
			$_SESSION[$programSundaySaved] = $sunday;
			$_SESSION[$programMondaySaved] = $monday;
			$_SESSION[$programTuesdaySaved] = $tuesday;
			$_SESSION[$programWednesdaySaved] = $wednesday;
			$_SESSION[$programThursdaySaved] = $thursday;
			$_SESSION[$programFridaySaved] = $friday;
			$_SESSION[$programSaturdaySaved] = $saturday;
			$_SESSION[$programNoEndSaved] = $noEnd;
			
			
	        unset($_SESSION['PROGRAM_DATE_TEMP']);
	        unset($_SESSION['PROGRAM_START_TIME_TEMP']);
			unset($_SESSION['PROGRAM_END_TIME_TEMP']);
			unset($_SESSION['PROGRAM_END_DATE_TEMP']);
			unset($_SESSION['PROGRAM_RECURRING_TEMP']);
	        unset($_SESSION['PROGRAM_DATE_SUNDAY_TEMP']);
			unset($_SESSION['PROGRAM_DATE_MONDAY_TEMP']);
			unset($_SESSION['PROGRAM_DATE_TUESDAY_TEMP']);
			unset($_SESSION['PROGRAM_DATE_WEDNESDAY_TEMP']);
			unset($_SESSION['PROGRAM_DATE_THURSDAY_TEMP']);
			unset($_SESSION['PROGRAM_DATE_FRIDAY_TEMP']);
			unset($_SESSION['PROGRAM_DATE_SATURDAY_TEMP']);
			unset($_SESSION['PROGRAM_NO_END_TEMP']);
			
			if($program['programimage'] != '')
			{
				$_SESSION['PROGRAM_IMAGE'] = 'true';
			}
			session_write_close();
						
			
			if($nextState == 'Submit')
			{
				$header = "location: create-program-part3.php?startDate=";
				$header .= $statrtDate;
				$header .= '&enddate=';
				$header .= $endDate;
				$header .= '&startTime=';
				$header .= $startTime;
				$header .= '&endtime=';
				$header .= $endTime;
				$header .= '&name=';
				$header .= $programName;
				$header .= '&image=';
				$header .= $program['programimage'];
				$header .= '&address=';
				$header .= $program['address'];
				$header .= '&state=';
				$header .= $program['state'];
				$header .= '&city=';
				$header .= $program['city'];
				$header .= '&zip=';
				$header .= $program['zipcode'];
				$header .= '&descrip=';
				$header .= $program['programdescrip']; 
				$header .= '&recurring=';
				$header .= $recurring; 
				$header .= '&repeats=';
				$header .= $repeats; 
				$header .= '&sunday=';
				$header .= $sunday; 
				$header .= '&monday=';
				$header .= $monday; 
				$header .= '&tuesday=';
				$header .= $tuesday; 
				$header .= '&wednesday=';
				$header .= $wednesday; 
				$header .= '&thursday=';
				$header .= $thursday; 
				$header .= '&friday=';
				$header .= $friday; 
				$header .= '&saturday=';
				$header .= $saturday; 
				$header .= '&noend=';
				$header .= $noEnd; 				
				
				header($header);
			}
			else if($nextState == 'Draft')
			{
				
				header("location: program-management-org.php");
			}
			else if($nextState == 'Previous')
			{
				$header = "location: create-program-part1.php?startDate=";
				$header .= $statrtDate;
				$header .= '&enddate=';
				$header .= $endDate;
				$header .= '&startTime=';
				$header .= $startTime;
				$header .= '&endtime=';
				$header .= $endTime;
				$header .= '&name=';
				$header .= $programName;
				$header .= '&image=';
				$header .= $program['programimage'];
				$header .= '&address=';
				$header .= $program['address'];
				$header .= '&state=';
				$header .= $program['state'];
				$header .= '&city=';
				$header .= $program['city'];
				$header .= '&zip=';
				$header .= $program['zipcode'];
				$header .= '&descrip=';
				$header .= $program['programdescrip']; 
				$header .= '&recurring=';
				$header .= $recurring; 
				$header .= '&repeats=';
				$header .= $repeats; 
				$header .= '&sunday=';
				$header .= $sunday; 
				$header .= '&monday=';
				$header .= $monday; 
				$header .= '&tuesday=';
				$header .= $tuesday; 
				$header .= '&wednesday=';
				$header .= $wednesday; 
				$header .= '&thursday=';
				$header .= $thursday; 
				$header .= '&friday=';
				$header .= $friday; 
				$header .= '&saturday=';
				$header .= $saturday; 
				$header .= '&noend=';
				$header .= $noEnd; 				
				
				header($header);
			}
			

			exit();
	}else {
		echo $result;
		echo $result2;
		echo $result3;
		die("Query failed");
	}
	
	mysql_close($link);
?>