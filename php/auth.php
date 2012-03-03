<?php
	require_once('bitly-api.php');
	//Start session
	session_start();
			

	if(!isset($_SESSION['SESS_MEMBER_ID']) && (($_COOKIE['session_id'] != '') && ($_COOKIE['passwd'] != ''))) 
	{

		$cookie = 'true';
		$login = $_COOKIE['session_id'];
		$password = $_COOKIE['passwd'];
	
		//Create query
		$qry="SELECT * FROM members WHERE login='$login' AND passwd='$password'";
		$result = mysql_query($qry);
		$member = mysql_fetch_assoc($result);	
		
		//Login Successful
			session_regenerate_id();
	
			$_SESSION['SESS_MEMBER_ID'] = $member['login'];
			$_SESSION['SESS_ORG_OR_VOL'] = $member['orgorvol'];
			
			if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
			{
				$_SESSION['VOLUNTEER_IS_ADMIN']	= 'true';
				$qry="SELECT * FROM orgs WHERE login='$login'";
				$result2 =mysql_query($qry);
				$orgInfo = mysql_fetch_assoc($result2);
				if(mysql_num_rows($result2) == 0) //this must be a additional admin
				{
					$email = $member['email'];

					$result2 = mysql_query("select * from additadmins where additemail='$email'");
					if(mysql_num_rows($result2) == 1)
					{	
					
						$additAdminInfo = mysql_fetch_assoc($result2);
						$orgname = $additAdminInfo['orgname'];
						
						$qry="SELECT * FROM orgs WHERE orgname='$orgname'";
						$result2 =mysql_query($qry);
						$orgInfo = mysql_fetch_assoc($result2);
						
					}
				}
	
				if($orgInfo['orgname'] == '')
				{
						$errmsg_arr[] = 'Sorry, for some reason your registration did not finish!';
						$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
						
						$_SESSION['ORG_PLAN'] = $orgInfo['plan'];
						if($orgInfo['plan'] == 'free')
						{
							$_SESSION['ORG_ID'] = $orgInfo['orgid'];
							$_SESSION['ORG_PAID'] =  $orgInfo['paid'];
						}
						else
						{
							$_SESSION['ORG_ID'] = $orgInfo['orgid'];
							$_SESSION['ORG_PAID'] =  $orgInfo['paid'];
						}
						
						
						if($cookie == 'true')
						{

							header("location: php/member-reg-org.php");
						}
						else
						{
							header("location: member-reg-org.php");
						}
						session_write_close();
						exit();
				}
				else
				{
					$_SESSION['ORG_NAME'] = $orgInfo['orgname'];
					$_SESSION['ORG_DESC'] = $orgInfo['orgdescrip'];
					$_SESSION['ORG_ADDRESS'] = $orgInfo['address'];
					$_SESSION['ORG_CITY'] = $orgInfo['city'];
					$_SESSION['ORG_STATE'] = $orgInfo['state'];
					$_SESSION['ORG_ZIPCODE'] = $orgInfo['zipcode'];
					$_SESSION['ORG_PHONE'] = $orgInfo['phonenumber'];
					$_SESSION['ORG_EMAIL'] = $orgInfo['orgemail'];
					$_SESSION['ORG_PHONE_PART_1'] = substr($orgInfo['phonenumber'],0, 3);
					$_SESSION['ORG_PHONE_PART_2'] = substr($orgInfo['phonenumber'],3, 3);
					$_SESSION['ORG_PHONE_PART_3'] = substr($orgInfo['phonenumber'],6, 4);
					$_SESSION['ORG_TYPE_PRIMARY'] = $orgInfo['primaryorgtype'];
					$_SESSION['ORG_MESSAGES'] = $orgInfo['messages'];
					$_SESSION['ORG_PRIVACY'] = $orgInfo['privacy'];
					$_SESSION['ORG_TAG'] = $orgInfo['tag'];
					$orgName = $orgInfo['orgname'];
					
					//see if the org also bought messages
					$result3 = mysql_query('SELECT * FROM payasyougo WHERE orgname="'.$orgName.'"');
					$payasyougo = mysql_fetch_assoc($result3);				
					$_SESSION['ORG_MESSAGES'] += $payasyougo['messages'];
				
					$result3 = mysql_query('SELECT * FROM websitelink WHERE orgname="'.$orgName.'"');

					$website = mysql_fetch_assoc($result3);
					
					for($i = 1; $i <= 5; $i++)
					{	
						$link = 'link';
						$link .= $i;
						
						if($website[$link] != '')
						{
							
							$_SESSION['ORG_WEBSITE'] = $website[$link];
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
							$_SESSION['FACEBOOK_LINK'] = $fbook[$link];
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
							$_SESSION['TWITTER_LINK'] = $twitter[$link];
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
							$_SESSION['LINKEDIN_LINK'] = $linkedin[$link];
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
							$_SESSION['BLOG_LINK'] = $blog[$link];
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
							$_SESSION['YOUTUBE_LINK'] = $youTube[$link];
						}
					}
					$shareLink = 'http://joelcomp1.no-ip.org/php/org-manager.php?orgid=';
					$shareLink .= $orgInfo['orgid'];
					
					/* get the short url */
					$short_url = get_bitly_short_url($shareLink,'joelcomp1','R_b2b6743ff66fe6821031f375af4e7ced');
					$_SESSION['ORG_INVITE_LINK'] = rtrim($short_url);
					
				    
				    $_SESSION['IMAGE_PATH'] = $orgInfo['orgimage'];
				    if($_SESSION['IMAGE_PATH'] != '')
				    {
				    	$_SESSION['ORG_IMAGE'] = 'true';
				    }
				    
					$_SESSION['ORG_PLAN'] = $orgInfo['plan'];
					if($orgInfo['plan'] == 'free')			
					{
						$_SESSION['ORG_ID'] = $orgInfo['orgid'];
						$_SESSION['ORG_PAID'] =  $orgInfo['paid'];
					}
					else
					{
						$_SESSION['ORG_ID'] = $orgInfo['orgid'];
						$_SESSION['ORG_PAID'] =  $orgInfo['paid'];
					}
					
					$qry="SELECT * FROM vols WHERE login='$login'";
					$result8 =mysql_query($qry);
					$volInfo = mysql_fetch_assoc($result8);
					$shareLink = 'http://joelcomp1.no-ip.org/php/vol-manager.php?userid=';
					$shareLink .= $member['userid'];
					$short_url = get_bitly_short_url($shareLink,'joelcomp1','R_b2b6743ff66fe6821031f375af4e7ced');
					$_SESSION['USER_INVITE_LINK'] = rtrim($short_url);
				
				
					$_SESSION['VOL_IMAGE_PATH'] = $volInfo['userimage'];
					$_SESSION['VOL_CITY'] = $volInfo['city'];
					$_SESSION['VOL_STATE'] = $volInfo['state'];
					$_SESSION['VOL_FIRST_NAME'] = $volInfo['firstname'];
					$_SESSION['VOL_LAST_NAME'] = $volInfo['lastname'];
					$_SESSION['VOL_PHONE_PART_1'] = substr($volInfo['phonenumber'],0, 3);
					$_SESSION['VOL_PHONE_PART_2'] = substr($volInfo['phonenumber'],3, 3);
					$_SESSION['VOL_PHONE_PART_3'] = substr($volInfo['phonenumber'],6, 4);	
					$_SESSION['VOL_EMAIL'] = $volInfo['email'];	
					$_SESSION['VOL_PRIVACY'] = $volInfo['privacy'];
					if($_SESSION['VOL_IMAGE_PATH'] != '')
					{
						$_SESSION['VOL_IMAGE'] = 'true';
					}
						
				    session_write_close();
						if($cookie == 'true')
						{
							if($orgid != '')
							{
								header("location: php/auth.php");
							}
							else
							{
								header("location: php/member-index-org.php");
							}
						}
						else
						{
							header("location: member-index-org.php");
						}
				    
				}
			}
			else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
			{
				$qry="SELECT * FROM vols WHERE login='$login'";
				$result8 =mysql_query($qry);
				$volInfo = mysql_fetch_assoc($result8);
				$shareLink = 'http://joelcomp1.no-ip.org/php/vol-manager.php?userid=';
				$shareLink .= $member['userid'];
				$short_url = get_bitly_short_url($shareLink,'joelcomp1','R_b2b6743ff66fe6821031f375af4e7ced');
				$_SESSION['USER_INVITE_LINK'] = rtrim($short_url);
				
				
				$_SESSION['IMAGE_PATH'] = $volInfo['userimage'];
				$_SESSION['VOL_CITY'] = $volInfo['city'];
				$_SESSION['VOL_STATE'] = $volInfo['state'];
				$_SESSION['VOL_FIRST_NAME'] = $volInfo['firstname'];
				$_SESSION['VOL_LAST_NAME'] = $volInfo['lastname'];
				$_SESSION['VOL_PHONE_PART_1'] = substr($volInfo['phonenumber'],0, 3);
				$_SESSION['VOL_PHONE_PART_2'] = substr($volInfo['phonenumber'],3, 3);
				$_SESSION['VOL_PHONE_PART_3'] = substr($volInfo['phonenumber'],6, 4);	
				$_SESSION['VOL_EMAIL'] = $volInfo['email'];	
				$_SESSION['VOL_PRIVACY'] = $volInfo['privacy'];
				if($_SESSION['IMAGE_PATH'] != '')
				{
					$_SESSION['VOL_IMAGE'] = 'true';
				}
				session_write_close();
						if($cookie == 'true')
						{
							header("location: php/member-index-vol.php");
						}
						else
						{
							header("location: member-index-vol.php");
						}
				
			}
	}

	//Check whether the session variable SESS_MEMBER_ID is present or not
	if((($programName != '') && ($orgName != '')) || $progid != '')
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
		
		if($progid == '')
		{
			$qry = "select * from programs where orgname='$orgName' and programname='$programName'";
			$result = @mysql_query($qry);
			$programInfo = mysql_fetch_assoc($result);
		}
		else
		{	$qry = "select * from programs where progid='$progid'";
			$result = @mysql_query($qry);
			$programInfo = mysql_fetch_assoc($result);
			$programName = $programInfo['programname'];
			$orgName = $programInfo['orgname'];
		}
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
		
		$howManyRows = "select * from programpositions where orgname='$orgName' and programname='$programName'";

		$newqry = @mysql_query($howManyRows);
		
		$numberOfTotalPositions = 0;
		$numberOfTotalTakenPositions = 0;
		$positionLoop = 1;
		if($programInfo['generalprograms'] == 'true')
		{
			$_SESSION['GENERAL_PROGRAM'] = 'true';
		
		}
		else
		{
			$_SESSION['GENERAL_PROGRAM'] = 'false';
		}

		while($posInfo = mysql_fetch_assoc($newqry))
		{	
			
			$displayePosName = 'POSITION_NAME';
			$displayePosName .= $positionLoop;
	
			$displayeNumOpen = 'NUM_OPEN';
			$displayeNumOpen .= $positionLoop;
	
			$displayumClosed = 'NUM_FILLED';
			$displayumClosed .= $positionLoop;
	
		
			$_SESSION[$displayePosName] = $posInfo['positionname'];
			$_SESSION[$displayeNumOpen] = $posInfo['numavail'] - $posInfo['numtaken'];
			$_SESSION[$displayumClosed] = $posInfo['numtaken'];
			$numberOfTotalPositions += $_SESSION[$displayeNumOpen];
			$numberOfTotalTakenPositions += $_SESSION[$displayumClosed];
			$positionLoop += 1;
		}
		$_SESSION['POSITIONS_CREATED'] = $numberOfTotalPositions;
		$_SESSION['TOTAL_VOLUNTEERS'] = $numberOfTotalTakenPositions;

		if($progid == '') //if coming from a external link this is not new nor do they need the share window
		{

		

			$shareLink = 'http://joelcomp1.no-ip.org/php/program-manager.php?progid=';
			$shareLink .= $programInfo['progid'];
			$short_url = get_bitly_short_url($shareLink,'joelcomp1','R_b2b6743ff66fe6821031f375af4e7ced');
			$_SESSION['PROGRAM_SHARE_LINK'] = rtrim($short_url);
		}

		
		if($programInfo['draft'] == 'Published')
		{
			require_once('print-program-summary.php');
			if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
			{
				$vollying = "select * from programvol where orgname='$orgName' and programname='$programName' and vollogin='$login'";
	
				$result = @mysql_query($vollying);
				
				if(mysql_num_rows($result))
				{
					$_SESSION['VOLLYING_FOR_PROGRAM'] = 'true';
				}
				else
				{
					$_SESSION['VOLLYING_FOR_PROGRAM'] = 'false';
				}
				header("location: program-published-nonadmin.php");
			}
			else
			{			
				header("location: program-published.php");
			}
		}
		else
		{
			header("location: program-preview.php");
		}
		session_write_close();
	}
	else if((($orgName != '') && ($zipcode != ''))  || $orgid != '')
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

		if($orgid != '')
		{
			$result=mysql_query('SELECT * FROM orgs WHERE orgid="'.$orgid.'"');
			
			$orgInfo = mysql_fetch_assoc($result);
			$orgName = $orgInfo['orgname'];
		
		}
		else
		{
			$result=mysql_query('SELECT * FROM orgs WHERE orgname="'.$orgName.'"');
			$orgInfo = mysql_fetch_assoc($result);
			
		}


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
	else if($vol != '' || $userid != '')
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
	
		if($vol != '')
		{
			$qry = "select * from vols where login='$vol'";
		}
		else if($userid != '')
		{
			$qry = "select * from members where userid='$userid'";
			$result = @mysql_query($qry);
			$volLink = mysql_fetch_assoc($result);
			$vol = $volLink['login'];
			$qry = "select * from vols where login='$vol'";
			
		}
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

	else if((!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) && ($_COOKIE['session_id'] == '' && $_COOKIE['passwd'] == '')) {
		//Array to store validation errors
		$errmsg_arr = array();
		echo $_COOKIE['passwd'];
		exit();
		//Validation error flag
		$errflag = false;
	
		$errmsg_arr[] = 'Access Denied';
		$errflag = true;
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: ../index.php");
		exit();
	}

		

	
?>