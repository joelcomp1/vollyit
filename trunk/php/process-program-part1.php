<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
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
		return  mysql_escape_string($str);
	}
	
	//Sanitize the POST values
	$programPhoto = clean($_SESSION['PROGRAM_IMAGE_PATH']);
	$programPhotoSet = clean($_SESSION['PROGRAM_IMAGE']);
	$programName = clean($_POST['Field1']);
	$programAddress = clean($_POST['Field126']);
	$programCity = clean($_POST['Field128']);
	$programState = clean($_POST['Field129']);
	$programZip = clean($_POST['Field130']);
	$programDiscription = clean($_POST['Field3']);
	$orgName = clean($_SESSION['ORG_NAME']);
	$tags = clean($_POST['inputString']);
	$parentProgram= clean($_POST['inputString2']);
	$childProgram= clean($_POST['inputString4']);
	$collab = clean($_POST['inputString3']);
	$draft= clean($_POST['Submit']);
	$programsCreated = clean($_SESSION['PROGRAMS_CREATED']);

	//Input Validations

			
	if($draft == 'Submit')
	{
		if($programName == '') {
			$errmsg_arr[] = 'Program Name Missing';
			$errflag = true;
		}
		if($programAddress == '') {
			$errmsg_arr[] = 'Program Address Missing';
			$errflag = true;
		}
		if($programCity == '') {
			$errmsg_arr[] = 'Program City Missing';
			$errflag = true;
		}
		if($programState == '') {
			$errmsg_arr[] = 'Program State Missing';
			$errflag = true;
		}
		if($programZip == '') {
			$errmsg_arr[] = 'Program Zip Missing';
			$errflag = true;
		}
		if($programDiscription == '') {
			$errmsg_arr[] = 'Program Description Missing';
			$errflag = true;
		}
		//If there are input validations, redirect back to the login form
		if($errflag) {
		    //Save to help user if a fail, reset below
		$_SESSION['PROGRAM_NAME_TEMP'] = $programName;
		$_SESSION['PROGRAM_ADDRESS_TEMP'] = $programAddress;
		$_SESSION['PROGRAM_CITY_TEMP'] = $programCity;
		$_SESSION['PROGRAM_STATE_TEMP'] = $programState;
		$_SESSION['PROGRAM_ZIP_TEMP'] = $programZip;
	    $_SESSION['TEMP_PROGRAM_DESCRIPTION'] = $programDiscription;
		$_SESSION['TEMP_PROGRAM_TAGS'] = $tags;

		
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			header("location: create-program-part1.php");
			exit();
		}
	}
	else if($draft == 'Draft')
    {
		if($programName == '') {
			$errmsg_arr[] = 'Need Program Name to Save Draft!';
			$errflag = true;
		}
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: create-program-part1.php");
		exit();
	}
   }
   else if($draft == 'Add Child Program')
   {
		if(($childProgram == '') || ($childProgram == 'Type Program Name')){
			$errmsg_arr[] = 'Need Child Program Name to link with';
			$errflag = true;
		}
	if($errflag) {
		$_SESSION['PROGRAM_NAME_TEMP'] = $programName;
		$_SESSION['PROGRAM_ADDRESS_TEMP'] = $programAddress;
		$_SESSION['PROGRAM_CITY_TEMP'] = $programCity;
		$_SESSION['PROGRAM_STATE_TEMP'] = $programState;
		$_SESSION['PROGRAM_ZIP_TEMP'] = $programZip;
	    $_SESSION['TEMP_PROGRAM_DESCRIPTION'] = $programDiscription;
		$_SESSION['TEMP_PROGRAM_TAGS'] = $tags;
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: create-program-part1.php");
		exit();
	}
   
   }
   else if($draft == 'Add Parent Program')
   {
		if(($parentProgram == '') || ($parentProgram == 'Type Program Name')){
			$errmsg_arr[] = 'Need Parent Program Name to link with';
			$errflag = true;
		}
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		$_SESSION['PROGRAM_NAME_TEMP'] = $programName;
		$_SESSION['PROGRAM_ADDRESS_TEMP'] = $programAddress;
		$_SESSION['PROGRAM_CITY_TEMP'] = $programCity;
		$_SESSION['PROGRAM_STATE_TEMP'] = $programState;
		$_SESSION['PROGRAM_ZIP_TEMP'] = $programZip;
	    $_SESSION['TEMP_PROGRAM_DESCRIPTION'] = $programDiscription;
		$_SESSION['TEMP_PROGRAM_TAGS'] = $tags;
		header("location: create-program-part1.php");
		exit();
	}
   
   }
   else if($draft == 'Add Collaborative Program')
   {
		if(($collab == '') || ($collab == 'Type Organization Name')){
			$errmsg_arr[] = 'Need Collaborative Program Name to link with';
			$errflag = true;
		}
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		$_SESSION['PROGRAM_NAME_TEMP'] = $programName;
		$_SESSION['PROGRAM_ADDRESS_TEMP'] = $programAddress;
		$_SESSION['PROGRAM_CITY_TEMP'] = $programCity;
		$_SESSION['PROGRAM_STATE_TEMP'] = $programState;
		$_SESSION['PROGRAM_ZIP_TEMP'] = $programZip;
	    $_SESSION['TEMP_PROGRAM_DESCRIPTION'] = $programDiscription;
		$_SESSION['TEMP_PROGRAM_TAGS'] = $tags;
		header("location: create-program-part1.php");
		exit();
	}
   
   }
   
    if(($draft == 'Draft') || ($draft == 'Submit'))
	{
	    //Create INSERT query	
		if(isset($_SESSION['TEMP_PROGRAM_IMAGE']))
		{
			$childProgram =  clean($_SESSION['TEMP_PROGRAM_NAME']);
			$qry = "INSERT INTO programs(orgname, programimage, programdescrip, collaborative, parentprogram, childprogram, date, starttime, endtime, recurring, enddate, draft, programname, programnumber, address, city, state, zipcode, tag) 
	    				VALUES('$orgName','$programPhoto','$programDiscription','','','$childProgram','','','','','','$draft','$programName','','$programAddress','$programCity','$programState','$programZip','$tags')";
			$result = @mysql_query($qry);
	    }
		else if(isset($_SESSION['TEMP_PROGRAM_PARENT_IMAGE']))
		{
			$parentProgram =  clean($_SESSION['TEMP_PROGRAM_PARENT_NAME']);
			$qry = "INSERT INTO programs(orgname, programimage, programdescrip, collaborative, parentprogram, childprogram, date, starttime, endtime, recurring, enddate, draft, programname, programnumber, address, city, state, zipcode, tag) 
	    				VALUES('$orgName','$programPhoto','$programDiscription','','$parentProgram','','','','','','','$draft','$programName', '','$programAddress','$programCity','$programState','$programZip','$tags')";
			$result = @mysql_query($qry);
	    }
		else if(isset($_SESSION['TEMP_ORG_IMAGE']))
		{
			$collab =  clean($_SESSION['TEMP_ORG_PRGORAM_NAME']);
			$qry = "INSERT INTO programs(orgname, programimage, programdescrip, collaborative, parentprogram, childprogram, date, starttime, endtime, recurring, enddate, draft, programname, programnumber, address, city, state, zipcode, tag) 
	    				VALUES('$orgName','$programPhoto','$programDiscription','$collab','','','','','','','','$draft','$programName', '','$programAddress','$programCity','$programState','$programZip','$tags')";
			$result = @mysql_query($qry);
	    }
		else
		{
			$qry = "INSERT INTO programs(orgname, programimage, programdescrip, collaborative, parentprogram, childprogram, date, starttime, endtime, recurring, enddate, draft, programname, programnumber, address, city, state, zipcode, tag) 
	    				VALUES('$orgName','$programPhoto','$programDiscription','','','','','','','','','$draft','$programName', '','$programAddress','$programCity','$programState','$programZip','$tags')";
			$result = @mysql_query($qry);
	    }
	
		$howManyRows = "select * from programs where orgname='$orgName'";
	    
	    $newqry = @mysql_query($howManyRows);
	    $rows = mysql_num_rows($newqry);
	    
	    
	    $qry = "update programs set programNumber='$rows' where programname='$programName' and orgname='$orgName'";
	    $result2 = @mysql_query($qry);
	    	
	    $programNameSaved = 'PROGRAM_NAME';
	    $programNameSaved .= $rows;
	    
	    $programImageSaved = 'PROGRAM_IMAGE_PATH';
	    $programImageSaved .= $rows;
	    
	    $programImageValid = 'PROGRAM_IMAGE';
	    $programImageValid .= $rows;
	   	    
	    $programDescriptionSaved = 'PROGRAM_DESCRIPTION';
	    $programDescriptionSaved .= $rows;
		
	    $programStatusSaved = 'PROGRAM_STATUS';
	    $programStatusSaved .= $rows;
		
		$programCitySaved = 'PROGRAM_CITY';
		$programCitySaved .=  $rows;
		
		$programStateSaved = 'PROGRAM_STATE';
		$programStateSaved .= $rows;
		
		$programAddressSaved = 'PROGRAM_ADDRESS';
		$programAddressSaved .=  $rows;
		
		$programZipSaved = 'PROGRAM_ZIP';
		$programZipSaved .=  $rows;
		
		
	}
	else if($draft == 'Add Child Program'){
			$qry = "select * from programs where programname='$childProgram'";
			$newqry2 = @mysql_query($qry);
			$childProgramToRef = mysql_fetch_assoc($newqry2);
			session_regenerate_id();
			$_SESSION['TEMP_PROGRAM_IMAGE'] = $childProgramToRef['programimage'];
			$_SESSION['TEMP_PROGRAM_NAME'] = $childProgramToRef['programname'];
			$_SESSION['PROGRAM_NAME_TEMP'] = $programName;
			$_SESSION['PROGRAM_ADDRESS_TEMP'] = $programAddress;
			$_SESSION['PROGRAM_CITY_TEMP'] = $programCity;
			$_SESSION['PROGRAM_STATE_TEMP'] = $programState;
			$_SESSION['PROGRAM_ZIP_TEMP'] = $programZip;
			$_SESSION['TEMP_PROGRAM_DESCRIPTION'] = $programDiscription;
			$_SESSION['TEMP_PROGRAM_TAGS'] = $tags;
			session_write_close();
			header("location: create-program-part1.php");
			
			
	
	}
	else if($draft == 'Add Parent Program')
	{
			$qry = "select * from programs where programname='$parentProgram'";
			$newqry2 = @mysql_query($qry);
			$parentProgramToRef = mysql_fetch_assoc($newqry2);
			session_regenerate_id();
			$_SESSION['TEMP_PROGRAM_PARENT_IMAGE'] = $parentProgramToRef['programimage'];
			$_SESSION['TEMP_PROGRAM_PARENT_NAME'] = $parentProgramToRef['programname'];
			$_SESSION['PROGRAM_NAME_TEMP'] = $programName;
			$_SESSION['PROGRAM_ADDRESS_TEMP'] = $programAddress;
			$_SESSION['PROGRAM_CITY_TEMP'] = $programCity;
			$_SESSION['PROGRAM_STATE_TEMP'] = $programState;
			$_SESSION['PROGRAM_ZIP_TEMP'] = $programZip;
			$_SESSION['TEMP_PROGRAM_DESCRIPTION'] = $programDiscription;
			$_SESSION['TEMP_PROGRAM_TAGS'] = $tags;
			session_write_close();
			header("location: create-program-part1.php");

	}
    else if($draft == 'Add Collaborative Program')
	{
			$qry = "select * from orgs where orgname='$collab'";
			$newqry2 = @mysql_query($qry);
			$orgProgramRef = mysql_fetch_assoc($newqry2);
			session_regenerate_id();
			$_SESSION['TEMP_ORG_IMAGE'] = $orgProgramRef['orgimage'];
			$_SESSION['TEMP_ORG_PRGORAM_NAME'] = $orgProgramRef['orgname'];
			$_SESSION['TEMP_ORG_PROGRAM_CITY'] = $orgProgramRef['city'];
			$_SESSION['TEMP_ORG_PROGRAM_STATE'] = $orgProgramRef['state'];
			$_SESSION['PROGRAM_NAME_TEMP'] = $programName;
			$_SESSION['PROGRAM_ADDRESS_TEMP'] = $programAddress;
			$_SESSION['PROGRAM_CITY_TEMP'] = $programCity;
			$_SESSION['PROGRAM_STATE_TEMP'] = $programState;
			$_SESSION['PROGRAM_ZIP_TEMP'] = $programZip;
			$_SESSION['TEMP_PROGRAM_DESCRIPTION'] = $programDiscription;
			$_SESSION['TEMP_PROGRAM_TAGS'] = $tags;
			session_write_close();
			header("location: create-program-part1.php");

	}
	//Check whether the query was successful or not
	if($result && $result2) {
			//create program part 1 Successful
			session_regenerate_id();
			$_SESSION[$programNameSaved] = $programName;
			$_SESSION[$programImageSaved] = $programPhoto;
			$_SESSION[$programImageValid] = $programPhotoSet;
			$_SESSION[$programDescriptionSaved] = $programDiscription;
			$_SESSION[$programStatusSaved] = $draft;
			$_SESSION[$programCitySaved] = $programCity;
			$_SESSION[$programStateSaved] = $programState;
			$_SESSION[$programAddressSaved] = $programAddress;
			$_SESSION[$programZipSaved] = $programZip;
			$_SESSION['PROGRAMS_CREATED'] = $rows;
			//These were used for error detection, clear them here
	        unset($_SESSION['PROGRAM_NAME_TEMP']);
	        unset($_SESSION['PROGRAM_ADDRESS_TEMP']);
			unset($_SESSION['PROGRAM_CITY_TEMP']);
			unset($_SESSION['PROGRAM_STATE_TEMP']);
			unset($_SESSION['PROGRAM_ZIP_TEMP']);
	        unset($_SESSION['TEMP_PROGRAM_DESCRIPTION']);
			unset($_SESSION['TEMP_PROGRAM_IMAGE']);
			unset($_SESSION['TEMP_PROGRAM_NAME']);
			unset($_SESSION['TEMP_PROGRAM_PARENT_NAME']);
			unset($_SESSION['TEMP_PROGRAM_PARENT_IMAGE']);
			unset($_SESSION['TEMP_ORG_IMAGE']);
			unset($_SESSION['TEMP_ORG_PRGORAM_NAME']);
			unset($_SESSION['TEMP_ORG_PROGRAM_CITY']);
			unset($_SESSION['TEMP_ORG_PROGRAM_STATE']);		
			unset($_SESSION['TEMP_PROGRAM_TAGS']);				

			if($draft == 'Submit')
			{
				$_SESSION['PROGRAM_IMAGE'] = 'false';
				$_SESSION['PROGRAM_IMAGE_PATH'] = '';
				header("location: create-program-part2.php");
			}
			else if($draft == 'Draft')
			{
				$_SESSION['PROGRAM_IMAGE'] = 'false';
				$_SESSION['PROGRAM_IMAGE_PATH'] = '';
				header("location: program-management-org.php");
			}
			session_write_close();
			exit();
	}else {
		die("Query failed");
	}
?>