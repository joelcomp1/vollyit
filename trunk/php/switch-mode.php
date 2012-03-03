<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	require_once('bitly-api.php');
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
	//Create query
	$qry="SELECT * FROM members WHERE login='$login'";
	$result = mysql_query($qry);
		
	$orgName = $_SESSION['ORG_NAME'];
	$qry="SELECT * FROM additadmins WHERE orgname='$orgName'";
	$result2=mysql_query($qry);
	//Check whether the query was successful or not
	if($result && $result2) {

		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();

			$member = mysql_fetch_assoc($result);
			$admin = mysql_fetch_assoc($result2);

			if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG') //switch to a volunteer base
			{
				$_SESSION['SESS_ORG_OR_VOL'] = 'VOL';
				$_SESSION['SESS_MEMBER_ID'] = $member['login'];
				
				$qry="SELECT * FROM vols WHERE login='$login'";
				$result8 =mysql_query($qry);
				$volInfo = mysql_fetch_assoc($result8);
				$shareLink = 'http://joelcomp1.no-ip.org/php/vol-manager.php?userid=';
				$shareLink .= $member['userid'];
				$short_url = get_bitly_short_url($shareLink,'joelcomp1','R_b2b6743ff66fe6821031f375af4e7ced');
				$_SESSION['USER_INVITE_LINK'] = rtrim($short_url);
				
				
				$_SESSION['IMAGE_PATH'] = $volInfo['userimage'];

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
				header("location: member-index-vol.php");
			
			
			
			}
			else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
			{
				$_SESSION['SESS_ORG_OR_VOL'] = 'ORG';
				$qry="SELECT * FROM orgs WHERE login='$login'";
				$result3 =mysql_query($qry);
				$orgInfo = mysql_fetch_assoc($result3);
				if(mysql_num_rows($result3) == 0) //this must be a additional admin
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
						session_write_close();
						header("location: member-reg-org.php");
						exit();
				}
				else
				{
					$_SESSION['ORG_PRIVACY'] = $orgInfo['privacy'];
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
					
					
					$shareLink = 'http://joelcomp1.no-ip.org/php/org-manager.php?orgid=';
					$shareLink .= $orgInfo['orgid'];
					$short_url = get_bitly_short_url($shareLink,'joelcomp1','R_b2b6743ff66fe6821031f375af4e7ced');
					$_SESSION['ORG_INVITE_LINK'] = rtrim($short_url);
					
				    $_SESSION['IMAGE_PATH'] = $orgInfo['orgimage'];
				    if($_SESSION['IMAGE_PATH'] != '')
				    {
				    	$_SESSION['ORG_IMAGE'] = 'true';
				    }
				    
				    session_write_close();
				    header("location: member-index-org.php");
				}
			}

			
			exit();
		}else {
			$_SESSION['LOGIN_FAILED'] = 'true';
			session_write_close();
			header("location: ../index.php");
			exit();
		}
	}else {
		die("Query failed");
	}
	
	mysql_close($link);
?>