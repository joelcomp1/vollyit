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
		
		$login = clean($_SESSION['SESS_MEMBER_ID']);
		//$qry = "select * from orgs where orgname='";
		
		//$qry .= $orgName;
		//$qry .= "' and zipcode='$zipcode'";
	
		$result=mysql_query('SELECT * FROM orgs WHERE orgname="'.$orgName.'"');
		$orgInfo = mysql_fetch_assoc($result);
		
		$qry2 = "select * from volConn where id_request='$orgName' and id_inviter='$login'";
		$result2 = @mysql_query($qry2);
		$requestInfo = mysql_fetch_assoc($result2);
			
					$_SESSION['ORG_NAME_VIEW'] = $orgInfo['orgname'];
					$_SESSION['ORG_DESC_VIEW'] = $orgInfo['orgdescrip'];
					$_SESSION['ORG_ADDRESS_VIEW'] = $orgInfo['address'];
					$_SESSION['ORG_CITY_VIEW'] = $orgInfo['city'];
					$_SESSION['ORG_STATE_VIEW'] = $orgInfo['state'];
					$_SESSION['ORG_ZIPCODE_VIEW'] = $orgInfo['zipcode'];
					$_SESSION['ORG_PHONE_VIEW'] = $orgInfo['phonenumber'];
					$_SESSION['ORG_EMAIL_VIEW'] = $orgInfo['orgemail'];
					$_SESSION['ORG_PHONE_PART_1_VIEW'] = substr($orgInfo['phonenumber'],0, 3);
					$_SESSION['ORG_PHONE_PART_2_VIEW'] = substr($orgInfo['phonenumber'],3, 3);
					$_SESSION['ORG_PHONE_PART_3_VIEW'] = substr($orgInfo['phonenumber'],6, 4);
					$_SESSION['ORG_TYPE_PRIMARY_VIEW'] = $orgInfo['primaryorgtype'];
					$_SESSION['ORG_TYPE_SECONDARY_VIEW'] = $orgInfo['secondaryorgtype'];
					$_SESSION['ORG_PLAN_TYPE_VIEW'] = $orgInfo['pricing'];
					$orgName = $orgInfo['orgname'];
					unset($_SESSION['ORG_WEBSITE_VIEW']);
					unset($_SESSION['TWITTER_LINK_VIEW']);
					unset($_SESSION['FACEBOOK_LINK_VIEW']);
					unset($_SESSION['LINKEDIN_LINK_VIEW']);
					unset($_SESSION['YOUTUBE_LINK_VIEW']);
					unset($_SESSION['BLOG_LINK_VIEW']);

				
					if($requestInfo['status'] != '')
					{
						$_SESSION['ORG_FRIEND_STATUS_VIEW'] = $requestInfo['status'];
					}
					else 
					{
						$_SESSION['ORG_FRIEND_STATUS_VIEW'] = '';
					}
				
				
					$result3 = mysql_query('SELECT * FROM websitelink WHERE orgname="'.$orgName.'"');

					$website = mysql_fetch_assoc($result3);
					
					for($i = 1; $i <= 5; $i++)
					{	
						$link = 'link';
						$link .= $i;
						
						if($website[$link] != '')
						{
							
							$_SESSION['ORG_WEBSITE_VIEW'] = $website[$link];
						}
					}

					$result4 =mysql_query('SELECT * FROM facebooklink WHERE orgname="'.$orgName.'"');
				    $fbook = mysql_fetch_assoc($result4);
					for($i = 1; $i <= 5; $i++)
					{	
						$link = 'link';
						$link .= $i;
						
						if($fbook[$link] != '')
						{
							$_SESSION['FACEBOOK_LINK_VIEW'] = $fbook[$link];
						}
					}
				
					$result5 =mysql_query('SELECT * FROM twitterlink WHERE orgname="'.$orgName.'"');

				    $twitter = mysql_fetch_assoc($result5);
					for($i = 1; $i <= 5; $i++)
					{	
						$link = 'link';
						$link .= $i;
						if($twitter[$link] != '')
						{
							$_SESSION['TWITTER_LINK_VIEW'] = $twitter[$link];
						}
					}
					
					
					$result6 =mysql_query('SELECT * FROM linkedinlink WHERE orgname="'.$orgName.'"');

				    $linkedin = mysql_fetch_assoc($result6);
					for($i = 1; $i <= 5; $i++)
					{	
						$link = 'link';
						$link .= $i;
						if($linkedin[$link] != '')
						{
							$_SESSION['LINKEDIN_LINK_VIEW'] = $linkedin[$link];
						}
					}

				    $result7 = mysql_query('SELECT * FROM blogLink WHERE orgname="'.$orgName.'"');

				    $blog = mysql_fetch_assoc($result7);
					for($i = 1; $i <= 5; $i++)
					{	
						$link = 'link';
						$link .= $i;
						if($blog[$link] != '')
						{
							$_SESSION['BLOG_LINK_VIEW'] = $blog[$link];
						}
					}
				
				    $result8 = mysql_query('SELECT * FROM youTubeLink WHERE orgname="'.$orgName.'"');

				    $youTube = mysql_fetch_assoc($result8);
					
					for($i = 1; $i <= 5; $i++)
					{	
						$link = 'link';
						$link .= $i;
						
						if($youTube[$link] != '')
						{
							$_SESSION['YOUTUBE_LINK_VIEW'] = $youTube[$link];
						}
					}
				    
				    $_SESSION['IMAGE_PATH_ORG_VIEW'] = $orgInfo['orgimage'];
				    if($_SESSION['IMAGE_PATH_ORG_VIEW'] != '')
				    {
				    	$_SESSION['ORG_IMAGE_VIEW'] = 'true';
				    }
					else
					{
						$_SESSION['ORG_IMAGE_VIEW'] = 'false';
					}
				    
				    session_write_close();
					if($orgInfo['privacy'] == 'Public')
					{
						header("location: org-public.php");		
					}
					else if($orgInfo['privacy'] == 'Private')
					{
						header("location: org-private.php");		
					}
		
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
		$qry3 = "select * from friends where id_inviter='$vol' and id_request='$login'";
		$result2 = @mysql_query($qry2);
		$result3 = @mysql_query($qry3);
		$volInfo = mysql_fetch_assoc($result);
		$requestInfo = mysql_fetch_assoc($result2);
		$requestInfo2 = mysql_fetch_assoc($result3);
		
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
			if($requestInfo['status'] != '')
			{
				$_SESSION['VOL_FRIEND_STATUS'] = $requestInfo['status'];
			}
			else if($requestInfo2['status'] != '')
			{
				$_SESSION['VOL_FRIEND_STATUS'] = $requestInfo2['status'];
			}
			else 
			{
				$_SESSION['VOL_FRIEND_STATUS'] = '';
			}

			
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
			if($requestInfo['status'] != '')
			{
				$_SESSION['VOL_FRIEND_STATUS'] = $requestInfo['status'];
			}
			else if($requestInfo2['status'] != '')
			{
				$_SESSION['VOL_FRIEND_STATUS'] = $requestInfo2['status'];
			}
			else 
			{
				$_SESSION['VOL_FRIEND_STATUS'] = '';
			}
			
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