<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(($programName != '') && ($orgName != ''))
	{
	
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
	
		$qry = "select * from programs where orgname='$orgName' and programname='$programName'";
		$result = @mysql_query($qry);
		$programInfo = mysql_fetch_assoc($result);
		
		$rows = $programInfo['programNumber'];
	
		$programNameSaved = 'PROGRAM_NAME';
		$programNameSaved .= $rows;
	
		$programImageSaved = 'PROGRAM_IMAGE_PATH';
		$programImageSaved .= $rows;
	
		$programImageValid = 'PROGRAM_IMAGE';
		$programImageValid .= $rows;
	
		$programCitySaved = 'PROGRAM_CITY';
		$programCitySaved .= $rows;
		
		$programStateSaved = 'PROGRAM_STATE';
		$programStateSaved .= $rows;
		
		$programAddressSaved = 'PROGRAM_ADDRESS';
		$programAddressSaved .= $rows;
		
		$programZipSaved = 'PROGRAM_ZIP';
		$programZipSaved .= $rows;
	
		$programDescriptionSaved = 'PROGRAM_DESCRIPTION';
		$programDescriptionSaved .= $rows;
	
		$dateSaved = 'PROGRAM_DATE';
		$dateSaved .= $programInfo['programNumber'];
	
		$timeStartSaved = 'PROGRAM_START_TIME';
		$timeStartSaved .= $rows;
	
		$endTimeSaved = 'PROGRAM_END_TIME';
		$endTimeSaved .= $rows;
	
		$endDateSaved = 'PROGRAM_END_DATE';
		$endDateSaved .= $rows;
		
		$programStatus = 'PROGRAM_STATUS';
		$programStatus .= $rows;
	
		$howManyRows = "select * from programPositions where orgname='$orgName' and programname='$programName'";
	
		$newqry = @mysql_query($howManyRows);
		$rows2 = mysql_num_rows($newqry);
	
	
	
		session_regenerate_id();
		$_SESSION[$programNameSaved] = $programInfo['programname'];
		$_SESSION[$programImageSaved] = $programInfo['programimage'];
		$_SESSION[$programImageValid] =  isset($programInfo['programimage']);
		$_SESSION[$programCitySaved] =  $programInfo['city'];
		$_SESSION[$programStateSaved] =  $programInfo['state'];
		$_SESSION[$programAddressSaved] =  $programInfo['address'];
		$_SESSION[$programStatus] =  $programInfo['draft'];
		$_SESSION[$programZipSaved] =  $programInfo['zipcode'];	
		$_SESSION[$programDescriptionSaved] = $programInfo['programdescrip'];
		$_SESSION['ORG_NAME'] = $orgName;
		$_SESSION['PROGRAMS_CREATED'] = $rows;
		$_SESSION[$dateSaved] = $programInfo['date'];
		$_SESSION[$timeStartSaved] = $programInfo['starttime'];
		$_SESSION[$endTimeSaved] = $programInfo['endtime'];
		$_SESSION[$endDateSaved] = $programInfo['enddate'];
		
		$positionLoop = 1;
		while($posInfo = mysql_fetch_assoc($newqry))
		{
			$displayePosName = 'POSITION_NAME';
			$displayePosName .= $positionLoop;
	
			$displayeNumOpen = 'NUM_OPEN';
			$displayeNumOpen .= $positionLoop;
	
			$displayumClosed = 'NUM_FILLED';
			$displayumClosed .= $positionLoop;
		
			$_SESSION[$displayePosName] = $posInfo['positionname'];
			$_SESSION[$displayeNumOpen] = $posInfo['numavail'];
			$_SESSION[$displayumClosed] = $posInfo['numtaken'];
			
			$positionLoop += 1;
		}
		$_SESSION['POSITIONS_CREATED'] = $rows2;
		session_write_close();
		if($programInfo['draft'] == 'Published')
		{
			header("location: program-published.php");
		}
		else
		{
			header("location: program-preview.php");
		}
	}
	else if(($orgName != '') && ($zipcode != ''))
	{
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
	
		$qry = "select * from orgs where orgname='$orgName' and zipcode='$zipcode'";
		$result = @mysql_query($qry);
		$orgInfo = mysql_fetch_assoc($result);

	}
	else if($vol != '')
	{	
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
		$login = clean($_SESSION['SESS_MEMBER_ID']);
	
		$qry = "select * from vols where login='$vol'";
		
		$result = @mysql_query($qry);
		
		$qry2 = "select * from friends where id_request='$vol' and id_inviter='$login'";
		
		$result2 = @mysql_query($qry2);
		$volInfo = mysql_fetch_assoc($result);
		$requestInfo = mysql_fetch_assoc($result2);
		
		if($volInfo['privacy'] == 'Public')
		{
			$_SESSION['VOL_USER_CITY'] = $volInfo['city'];
			$_SESSION['VOL_USER_STATE'] = $volInfo['state'];
			$_SESSION['VOL_USER_PRIVACY'] = $volInfo['privacy'];
			$_SESSION['VOL_USER_FIRST_NAME'] = $volInfo['firstname'];
			$_SESSION['VOL_USER_LAST_NAME'] = $volInfo['lastname'];	
			$_SESSION['VOL_USER_EMAIL'] = $volInfo['email'];		
			$_SESSION['VOL_USER_PHONE_PART_1'] = substr($volInfo['phonenumber'],0, 3);
			$_SESSION['VOL_USER_PHONE_PART_2'] = substr($volInfo['phonenumber'],3, 3);
			$_SESSION['VOL_USER_PHONE_PART_3'] = substr($volInfo['phonenumber'],6, 4);
			$_SESSION['VOL_USER_ABOUTME'] = $volInfo['aboutme'];	
			$_SESSION['IMAGE_USER_PATH'] = $volInfo['userimage'];	
			$_SESSION['VOL_LOGIN'] = $volInfo['login'];	
			$_SESSION['VOL_FRIEND_STATUS'] = $requestInfo['status'];
			
			if($_SESSION['IMAGE_USER_PATH'] != '')
			{
				$_SESSION['VOL_USER_IMAGE'] = 'true';
			}
			
			header("location: vol-public.php");
		}
		
		else if($volInfo['privacy'] == 'Private')
		{
			$_SESSION['VOL_USER_PRIVACY'] = $volInfo['privacy'];
			$_SESSION['VOL_USER_FIRST_NAME'] = $volInfo['firstname'];
			$_SESSION['VOL_USER_LAST_NAME'] = $volInfo['lastname'];	
			$_SESSION['VOL_USER_ABOUTME'] = $volInfo['aboutme'];	
			$_SESSION['IMAGE_USER_PATH'] = $volInfo['userimage'];	
			$_SESSION['VOL_LOGIN'] = $volInfo['login'];	
			$_SESSION['VOL_FRIEND_STATUS'] = $requestInfo['status'];
			if($_SESSION['IMAGE_USER_PATH'] != '')
			{
				$_SESSION['VOL_USER_IMAGE'] = 'true';
			}
			header("location: vol-private.php");
		}
		else if($volInfo['privacy'] == 'Hidden')
		{
			//Array to store validation errors
			$errmsg_arr = array();
	
			//Validation error flag
			$errflag = false;
	
			$errmsg_arr[] = 'Access Denied';
			$errflag = true;
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			header("location: ../index.php");
			exit();
		}	
	}
	else if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		//Array to store validation errors
		$errmsg_arr = array();
	
		//Validation error flag
		$errflag = false;
	
		$errmsg_arr[] = 'Access Denied';
		$errflag = true;
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../index.php");
		exit();
	}

		
		
		mysql_close($link);
	
?>