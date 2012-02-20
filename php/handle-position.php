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


	$generalOnly = clean($_POST['Field6']);
	$nextState= clean($_POST['Submit']);
	$orgName = clean($_SESSION['ORG_NAME']);
	
	if($_SESSION['PROGRAM_NAME_TEMP'] != '')
	{
		$programName = clean($_SESSION['PROGRAM_NAME_TEMP']);
	}
	if($_SESSION['PROGRAM_NAME'] != '')
	{
		$programName = clean($_SESSION['PROGRAM_NAME']);
	}
	
	//Input Validations

	if($nextState == 'Submit')
	{	
		if($generalOnly != 'General')
		{
			
			$qry = "delete from programpositions where programname='$programName' and orgname='$orgName'";
				
			$result = @mysql_query($qry);
			
			$counter = 1;
			//First we need to handle the position it self
			do
			{
			
			$positionNameGive = "positionNameGiven";
			$positionNameGive .= $counter;
			$positionName = clean($_POST[$positionNameGive]);
			
			$numPosGiven = "numPosGiven"; //note that this will be a number of the total - people already added so we need to add this back later
			$numPosGiven .= $counter;
			$numberOfPositions = clean($_POST[$numPosGiven]);
			
			$positionDescrip = "positionDescrip";
			$positionDescrip .= $counter;
			$programDescription = clean($_POST[$positionDescrip]);



			if($positionName != '')
			{
				
				$qry = "INSERT INTO programPositions(orgname, programname, positionname, posdescrip, numavail, numtaken) 
				VALUES('$orgName','$programName', '$positionName', '$programDescription', '$numberOfPositions', '0')";
				$result = @mysql_query($qry);
			
			}
			$counter = $counter + 1;
			$positionNameGive = "positionNameGiven";
			$positionNameGive .= $counter;
			$positionName = clean($_POST[$positionNameGive]);
			}while($_POST[$positionNameGive] != '');
			
			
			$counter = 1;
			//Now we need to handle assigning people to a position
			do
			{
			
			$positionVolunteer = "positionTaken";
			$positionVolunteer .= $counter;
			$volLogin = clean($_POST[$positionVolunteer]); //This is a first and last name, we need to split it to search on it
			
			$positionNameGive = "positionName";
			$positionNameGive .= $counter;
			$positionName = clean($_POST[$positionNameGive]);
			
	
			if($volLogin != '')
			{			
				$qry = "INSERT INTO programvol(orgname, programname, vollogin, positionname) 
				VALUES('$orgName','$programName', '$volLogin', '$positionName')";
				$result = @mysql_query($qry);
				
				//Find the program first so we can update the position count
				$qry = "select * from programPositions where orgname='$orgName' and programname='$programName' and positionname='$positionName'";
				$result = @mysql_query($qry);
				$position = mysql_fetch_assoc($result);
				
				$currentCount = $position['numavail'];
				$currentTaken = $position['numtaken'];
				$currentTaken++;
				$currentCount++; //This is to offset the fact that when we inserted we didn't have the full count
				$qry = "update programPositions set , where orgname='$orgName' and programname='$programName' and positionname='$positionName'";

				$result = @mysql_query($qry);
			
			}
			$counter = $counter + 1;
			$positionVolunteer = "positionTaken";
			$positionVolunteer .= $counter;
			$volLogin = clean($_POST[$positionVolunteer]);
			}while($_POST[$positionVolunteer] != '' && $counter < 10);
			
			echo $positionName;
			exit();
			//clear the general programs in case it was set
			//Set the program to be general positions only
			$qry = "update programs set generalprograms='false' where programname='$programName' and orgname='$orgName'";
			$result = @mysql_query($qry);
		}
		else
		{
			//Set the program to be general positions only
			$qry = "update programs set generalprograms='true' where programname='$programName' and orgname='$orgName'";
			$result = @mysql_query($qry);
			
			//delete the programs if we had any
			$qry = "delete from programpositions where programname='$programName' and orgname='$orgName'";
			$result = @mysql_query($qry);
			
		}
	
			//create program part 1 Successful
			session_regenerate_id();
			if($generalOnly == 'General')
			{	
				$_SESSION['PROGRAM_GENERAL_POSITIONS'] = 'true';
			}

			session_write_close();
			
			
			header("location: program-manager.php?programname=$programName&orgname=$orgName");
			exit();

	}
	else if($nextState == 'Draft')
	{
		header("location: program-management-org.php");

			
	}
	else if($nextState == 'Previous')
	{
				$header = "location: create-program-part2.php?startDate=";
				$header .= $_SESSION['PROGRAM_DATE_TEMP'];
				$header .= '&enddate=';
				$header .= $_SESSION['PROGRAM_END_DATE_TEMP'];
				$header .= '&startTime=';
				$header .= $_SESSION['PROGRAM_START_TIME_TEMP'];
				$header .= '&endtime=';
				$header .= $_SESSION['PROGRAM_END_TIME_TEMP'];
				$header .= '&recurring=';
				$header .= $_SESSION['PROGRAM_RECURRING_TEMP']; 
				$header .= '&repeats=';
				$header .= $_SESSION['PROGRAM_REPEATS_TEMP']; 
				$header .= '&sunday=';
				$header .= $_SESSION['PROGRAM_DATE_SUNDAY_TEMP']; 
				$header .= '&monday=';
				$header .= $_SESSION['PROGRAM_DATE_MONDAY_TEMP']; 
				$header .= '&tuesday=';
				$header .= $_SESSION['PROGRAM_DATE_TUESDAY_TEMP']; 
				$header .= '&wednesday=';
				$header .= $_SESSION['PROGRAM_DATE_WEDNESDAY_TEMP']; 
				$header .= '&thursday=';
				$header .= $_SESSION['PROGRAM_DATE_THURSDAY_TEMP']; 
				$header .= '&friday=';
				$header .= $_SESSION['PROGRAM_DATE_FRIDAY_TEMP']; 
				$header .= '&saturday=';
				$header .= $_SESSION['PROGRAM_DATE_SATURDAY_TEMP']; 
				$header .= '&noend=';
				$header .= $_SESSION['PROGRAM_NO_END_TEMP']; 	
				header($header);
	}
	
	mysql_close($link);
?>