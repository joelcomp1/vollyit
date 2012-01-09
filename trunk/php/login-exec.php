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
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);

	//Input Validations

	if($login == '') {
		$errmsg_arr[] = 'Email address or Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		$_SESSION['LOGIN_FAILED'] = 'true';
		session_write_close();
		header("location: ../index.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM members WHERE login='$login' AND passwd='".md5($_POST['password'])."'";
	$result=mysql_query($qry);
		
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['login'];
			$_SESSION['SESS_ORG_OR_VOL'] = $member['orgorvol'];
			
			if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
			{
				$qry="SELECT * FROM orgs WHERE login='$login'";
				$result2 =mysql_query($qry);
				$orgInfo = mysql_fetch_assoc($result2);
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
					$_SESSION['ORG_TYPE_SECONDARY'] = $orgInfo['secondaryorgtype'];
					$_SESSION['ORG_PLAN_TYPE'] = $orgInfo['pricing'];
					$orgName = $orgInfo['orgname'];
				
				
					$qry="SELECT * FROM websitelink WHERE orgname='$orgName'";
					$result3 =mysql_query($qry);
					$website = mysql_fetch_assoc($result3);
					$link = 'link';
					for($i = 1; $i <= 5; $i++)
					{	
						$link .= $i;
						if($website[$link] != '')
						{
							$_SESSION['ORG_WEBSITE'] = $website[$link];
						}
					}
				
				    $qry="SELECT * FROM facebooklink WHERE orgname='$orgName'";
				    $result4 =mysql_query($qry);
				    $fbook = mysql_fetch_assoc($result4);
					$link = 'link';
					for($i = 1; $i <= 5; $i++)
					{	
						$link .= $i;
						if($fbook[$link] != '')
						{
							$_SESSION['FACEBOOK_LINK'] = $fbook[$link];
						}
					}
				
				    $qry="SELECT * FROM twitterlink WHERE orgname='$orgName'";
				    $result5 =mysql_query($qry);
				    $twitter = mysql_fetch_assoc($result5);
					$link = 'link';
					for($i = 1; $i <= 5; $i++)
					{	
						$link .= $i;
						if($twitter[$link] != '')
						{
							$_SESSION['TWITTER_LINK'] = $twitter[$link];
						}
					}
					
					
				    $qry="SELECT * FROM linkedinlink WHERE orgname='$orgName'";
				    $result6 =mysql_query($qry);
				    $linkedin = mysql_fetch_assoc($result6);
					$link = 'link';
					for($i = 1; $i <= 5; $i++)
					{	
						$link .= $i;
						if($linkedin[$link] != '')
						{
							$_SESSION['LINKEDIN_LINK'] = $linkedin[$link];
						}
					}

				    
				    $qry="SELECT * FROM blogLink WHERE orgname='$orgName'";
				    $result7 =mysql_query($qry);
				    $blog = mysql_fetch_assoc($result7);
					$link = 'link';
					for($i = 1; $i <= 5; $i++)
					{	
						$link .= $i;
						if($blog[$link] != '')
						{
							$_SESSION['BLOG_LINK'] = $blog[$link];
						}
					}
				
				    $qry="SELECT * FROM youTubeLink WHERE orgname='$orgName'";
				    $result8 =mysql_query($qry);
				    $youTube = mysql_fetch_assoc($result8);
					$link = 'link';
					for($i = 1; $i <= 5; $i++)
					{	
						$link .= $i;
						if($youTube[$link] != '')
						{
							$_SESSION['YOUTUBE_LINK'] = $youTube[$link];
						}
					}
				    
				    $_SESSION['IMAGE_PATH'] = $orgInfo['orgimage'];
				    if($_SESSION['IMAGE_PATH'] != '')
				    {
				    	$_SESSION['ORG_IMAGE'] = 'true';
				    }
				    
				    session_write_close();
				    header("location: member-index-org.php");
				}
			}
			else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
			{
				$qry="SELECT * FROM vols WHERE login='$login'";
				$result8 =mysql_query($qry);
				$volInfo = mysql_fetch_assoc($result8);
				$_SESSION['IMAGE_PATH'] = $volInfo['userimage'];
				$_SESSION['VOL_CITY'] = $volInfo['city'];
				$_SESSION['VOL_STATE'] = $volInfo['state'];
				$_SESSION['VOL_FIRST_NAME'] = $volInfo['firstname'];
				$_SESSION['VOL_LAST_NAME'] = $volInfo['lastname'];
				$_SESSION['VOL_EMAIL'] = $volInfo['email'];	
				$_SESSION['VOL_PRIVACY'] = $volInfo['privacy'];
				if($_SESSION['IMAGE_PATH'] != '')
				{
					$_SESSION['VOL_IMAGE'] = 'true';
				}
				session_write_close();
				header("location: member-index-vol.php");
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