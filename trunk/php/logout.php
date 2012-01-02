<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
	unset($_SESSION['SESS_CITY']);
	unset($_SESSION['SESS_STATE']);
	unset($_SESSION['VOL_ABOUTME']);
	unset($_SESSION['SESS_ORG_OR_VOL']);
	unset($_SESSION['SESS_FIRST_TIME']);
	unset($_SESSION['ORG_NAME']);
	unset($_SESSION['ORG_DESC']);
	unset($_SESSION['ORG_ADDRESS']);
	unset($_SESSION['ORG_CITY']);
	unset($_SESSION['ORG_ZIPCODE']);
	unset($_SESSION['ORG_STATE']);
	unset($_SESSION['ORG_PHONE']);
	unset($_SESSION['ORG_WEBSITE']);
	unset($_SESSION['LINKEDIN_LINK']);
	unset($_SESSION['TWITTER_LINK']);
	unset($_SESSION['FACEBOOK_LINK']);
	unset($_SESSION['VOL_INTERESTS']);
	unset($_SESSION['VOL_IMAGE']);
	unset($_SESSION['IMAGE_PATH']);
	unset($_SESSION['ORG_IMAGE']);
	unset($_SESSION['ADMIN_IMAGE']);
	unset($_SESSION['ADMIN_IMAGE_PATH']);
	unset($_SESSION['ORG_EMAIL']);
	unset($_SESSION['ORG_LOGO_READY_TO_SET']);
	unset($_SESSION['ADMIN_IMAGE_READY_TO_SET']);
	unset($_SESSION['ORG_WEBSITE']);
	unset($_SESSION['FACEBOOK_LINK']);
	unset($_SESSION['TWITTER_LINK']);
	unset($_SESSION['LINKEDIN_LINK']);
	unset($_SESSION['BLOG_LINK']);
	unset($_SESSION['YOUTUBE_LINK']);
	unset($_SESSION['VOL_STATE']);

	for($i = 1; $i <= $_SESSION['POSITIONS_CREATED']; $i++)
	{
		$posName = 'POSITION_NAME';
		$posName .= $i;
	
		$numOpen = 'NUM_OPEN';
		$numOpen .= $i;
		
		if( isset($_SESSION[$posName]) && isset($_SESSION[$numOpen])) {
		unset($_SESSION[$posName]);
		unset($_SESSION[$numOpen]);
		}
	}
	unset($_SESSION['POSITIONS_CREATED']);
	unset($_SESSION['PROGRAM_NAME']);
	unset($_SESSION['PROGRAM_LOCATION']);
	unset($_SESSION['PROGRAM_IMAGE']);
	unset($_SESSION['PROGRAM_IMAGE_PATH']);
	unset($_SESSION['PROGRAM_DESCRIPTION']);
	unset($_SESSION['VOL_LAST_NAME']);
	unset($_SESSION['VOL_EMAIL']);
	unset($_SESSION['VOL_FIRST_NAME']);
	unset($_SESSION['VOL_STATE']);
	unset($_SESSION['VOL_CITY']);
	unset($_SESSION['VOL_PHONE_PART_1']);
	unset($_SESSION['VOL_PHONE_PART_2']);
	unset($_SESSION['VOL_PHONE_PART_3']);
	unset($_SESSION['ORG_PHONE_PART_1']);
	unset($_SESSION['ORG_PHONE_PART_2']);
	unset($_SESSION['ORG_PHONE_PART_3']);
	unset($_SESSION['ORG_TYPE_PRIMARY']);
	unset($_SESSION['ORG_TYPE_SECONDARY']);
	unset($_SESSION['ORG_PLAN_TYPE']);
	unset($_SESSION['TEMP_PROGRAM_IMAGE']);
	unset($_SESSION['TEMP_PROGRAM_NAME']);
	unset($_SESSION['TEMP_PROGRAM_PARENT_NAME']);
	unset($_SESSION['TEMP_PROGRAM_PARENT_IMAGE']);
	unset($_SESSION['TEMP_ORG_IMAGE']);
	unset($_SESSION['TEMP_ORG_PRGORAM_NAME']);
	unset($_SESSION['TEMP_ORG_PROGRAM_CITY']);
	unset($_SESSION['TEMP_ORG_PROGRAM_STATE']);
	unset($_SESSION['PROGRAM_VIEW_STATE']);
	
	for($i = 1; $i <= $_SESSION['PROGRAMS_CREATED']; $i++)
	{
		$programName = 'PROGRAM_NAME';
		$programName .= $i;
	
		$programImage = 'PROGRAM_IMAGE_PATH';
		$programImage .= $i;
		
		$date = 'PROGRAM_DATE';
		$date .= $i;
	
		$timeStart = 'PROGRAM_START_TIME';
		$timeStart .= $i;
	
		$endTime = 'PROGRAM_END_TIME';
		$endTime .= $i;
	
		$endDate = 'PROGRAM_END_DATE';
		$endDate .= $i;
		
	    $programState = 'PROGRAM_STATE';
		$programState .= $i;
	    
		$totalPositionsAvailable = 'POSITIONS_AVAIL';
		$totalPositionsAvailable .= $i;
	
		unset($_SESSION[$programName]);
		unset($_SESSION[$programImage]);
		unset($_SESSION[$date]);
		unset($_SESSION[$timeStart]);
		unset($_SESSION[$endTime]);
		unset($_SESSION[$endDate]);
		unset($_SESSION[$programState]);
		unset($_SESSION[$totalPositionsAvailable]);
	}
	
	
	$_SESSION['SESS_LOGOUT'] = 'true';
	session_write_close();
	header("location: ../index.php");
?>