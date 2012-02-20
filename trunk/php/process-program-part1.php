<?php
	//Start session
	
	session_start();
	//Include database connection details
	require_once('config.php');
	require_once('upsaddress.php');
	
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
	$programCoord1 = clean($_POST['progCoord1']);
	$programCoord2 = clean($_POST['progCoord2']);
	$programCoord3 = clean($_POST['progCoord3']);
	$programCoord4 = clean($_POST['progCoord4']);
	$programCoord5 = clean($_POST['progCoord5']);
	$programCoord6 = clean($_POST['progCoord6']);
	$programCoord7 = clean($_POST['progCoord7']);
	$programCoord8 = clean($_POST['progCoord8']);
	$programCoord9 = clean($_POST['progCoord9']);
	$programCoord10 = clean($_POST['progCoord10']);


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
		
		$qry = "select * from programs where programname='$programName' and orgname<>'$orgName'";
		$result = @mysql_query($qry);
	    $numOfRows = mysql_num_rows($result);
		if($numOfRows != 0)
		{
			$errmsg_arr[] = 'Program already exists with same name!';
			$errflag = true;
		}
		
		if(($programCity != '') && ($programState != '') && ($programZip != ''))
		{
			$ups = new upsaddress("CC90B3C39836BC10", "joelcomp1", "Coolenungames!2");
			$ups->setCity($programCity);
			$ups->setState($programState);
			$ups->setZip($programZip);
			$response = $ups->getResponse();
			if($response->list[0]->quality == 1.0)
			{
				//We have a good address!
			}
			else
			{
				//We didn't have a exact match...
				if((ucwords(strtolower($response->list[0]->city == $programCity))) &&  ($response->list[0]->state == $programState) && ($response->list[0]->zipLow <= $programZip)
					&& ($response->list[0]->zipHigh <= $programZip))
				{//if this all matches we are still OK

				}
				else if((ucwords(strtolower($response->list[1]->city == $programCity))) &&  ($response->list[1]->state == $programState) && ($response->list[1]->zipLow <= $programZip)
					&& ($response->list[1]->zipHigh <= $programZip))
				{//if this all matches we are still OK

				}
				else
				{
					$errmsg_arr[] = "We couldn't confirm your Address are you sure its correct?";
					$errflag = true;
				}
			}
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
		//see if this already exits
		$qry = "select * from programs where orgname='$orgName' and programname='$programName'";
		$result = @mysql_query($qry);

		if(mysql_num_rows($result) == 0)
		{
		
			//Create INSERT query	
		/*	if(isset($_SESSION['TEMP_PROGRAM_IMAGE']))
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
			{*/
				$qry = "INSERT INTO programs(orgname, programimage, programdescrip, collaborative, parentprogram, childprogram, date, starttime, endtime, recurring, enddate, draft, programname, programnumber, address, city, state, zipcode, tag) 
							VALUES('$orgName','$programPhoto','$programDiscription','','','','','','','','','$draft','$programName', '','$programAddress','$programCity','$programState','$programZip','$tags')";
				$result = @mysql_query($qry);
			//}
		
			$qry = "INSERT INTO programcoords(programname, coord1, coord2, coord3, coord4, coord5, coord6, coord7, coord8, coord9, coord10, orgname) 
	    				VALUES('$programName','$programCoord1','$programCoord2','$programCoord3','$programCoord4','$programCoord5','$programCoord6','$programCoord7','$programCoord8','$programCoord9','$programCoord10','$orgName')";
			$result = @mysql_query($qry);
			
	
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
		else
		{
		  //need to update instead
			/*if(isset($_SESSION['TEMP_PROGRAM_IMAGE']))
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
			{*/
				//programimage='$programPhoto', programdescrip='$programDiscription',address='$programAddress', city='$programCity', state='$programState', zipcode='$programZip', tag='$tags'
				$qry = "update programs set programimage='$programPhoto', programdescrip='$programDiscription',address='$programAddress', city='$programCity', state='$programState', zipcode='$programZip', tag='$tags' where orgname='$orgName' and programname='$programName'";
	
				$result = @mysql_query($qry);
						
			//}
//			$result = @mysql_query($qry);
			//if(mysql_num_rows($result) == 0)
			//{
			
			//clear out all the people we had before and just re-add what is still there.
				$qry = "delete from programcoords where programname='$programName' and orgname='$orgName'";
				
				$result = @mysql_query($qry);
			
			if($programCoord1 != '')
			{
				$qry = "INSERT INTO programcoords(programname, coord1, orgname) 
	    				VALUES('$programName','$programCoord1', '$orgName')";
				$result = @mysql_query($qry);
			}
			if($programCoord2 != '')
			{
				$qry = "INSERT INTO programcoords(programname, coord1, orgname) 
	    				VALUES('$programName','$programCoord2', '$orgName')";
				$result = @mysql_query($qry);
			}
			if($programCoord3 != '')
			{
				$qry = "INSERT INTO programcoords(programname, coord1, orgname) 
	    				VALUES('$programName','$programCoord3', '$orgName')";
				$result = @mysql_query($qry);
			}
			if($programCoord4 != '')
			{
				$qry = "INSERT INTO programcoords(programname, coord1, orgname) 
	    				VALUES('$programName','$programCoord4', '$orgName')";
				$result = @mysql_query($qry);
			}
			if($programCoord5 != '')
			{
				$qry = "INSERT INTO programcoords(programname, coord1, orgname) 
	    				VALUES('$programName','$programCoord5', '$orgName')";
				$result = @mysql_query($qry);
			}
			if($programCoord6 != '')
			{
				$qry = "INSERT INTO programcoords(programname, coord1, orgname) 
	    				VALUES('$programName','$programCoord6', '$orgName')";
				$result = @mysql_query($qry);
			}
			if($programCoord7 != '')
			{
				$qry = "INSERT INTO programcoords(programname, coord1, orgname) 
	    				VALUES('$programName','$programCoord7', '$orgName')";
				$result = @mysql_query($qry);
			}
			if($programCoord8 != '')
			{
				$qry = "INSERT INTO programcoords(programname, coord1, orgname) 
	    				VALUES('$programName','$programCoord8', '$orgName')";
				$result = @mysql_query($qry);
			}
			if($programCoord9 != '')
			{
				$qry = "INSERT INTO programcoords(programname, coord1, orgname) 
	    				VALUES('$programName','$programCoord9', '$orgName')";
				$result = @mysql_query($qry);
			}
			if($programCoord10 != '')
			{
				$qry = "INSERT INTO programcoords(programname, coord1, orgname) 
	    				VALUES('$programName','$programCoord10', '$orgName')";
				$result = @mysql_query($qry);
			}
			//}
			//else
			//{
			//	$qry = "update programcoords set coord1='$programCoord1', coord2='$programCoord2', coord3='$programCoord3', coord4='$programCoord4', coord5='$programCoord5', coord6='$programCoord6', coord7='$programCoord7', 
			//	coord8='$programCoord8', coord9='$programCoord9', coord10='$programCoord10' where programname='$programName' and orgname='$orgName'"; 
			//	$result = @mysql_query($qry);
			//}
			
	
			$qry = "select programnumber from programs where programname='$programName' and orgname='$orgName'";
	   	    $rows = @mysql_query($qry);
	    	
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
	if($result) {
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
				$header .= '&name=';
				$header .= $programName;
				$header .= '&image=';
				$header .= $programPhoto;
				$header .= '&address=';
				$header .= $programAddress;
				$header .= '&state=';
				$header .= $programState;
				$header .= '&city=';
				$header .= $programCity;
				$header .= '&zip=';
				$header .= $programZip;
				$header .= '&descrip=';
				$header .= $programDiscription; 
				header($header);		
				
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
	
	mysql_close($link);
?>