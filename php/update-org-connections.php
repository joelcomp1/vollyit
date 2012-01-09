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
	$orgemail = clean($_POST['orgemail']);
	$website = clean($_POST['orgwebsite']);
	$facebook = clean($_POST['orgfacebook']);
	$twitter = clean($_POST['orgtwitter']);
	$linkedin = clean($_POST['orglinkedin']);	
	$blog = clean($_POST['orgblog']);
	$youtube = clean($_POST['orgyoutube']);
	$phone1 = clean($_POST['phone1']);
	$phone2 = clean($_POST['phone2']);
	$phone3 = clean($_POST['phone3']);
	$login = clean($_SESSION['SESS_MEMBER_ID']);
	$orgName = clean($_SESSION['ORG_NAME']);

	
	//Concatenate Phone number
	$entirePhone = $phone1;
	$entirePhone .= $phone2;
	$entirePhone .= $phone3;
	
	//update phone and email into the org database
	$qry = "update orgs set phonenumber='$entirePhone', orgemail='$orgemail' where login='$login' and orgname='$orgName'";
	$result = @mysql_query($qry);
	
	//see if we have a website already listed
	$qry = "select * from websitelink where orgname='$orgName'";
	$result = @mysql_query($qry);
	if (mysql_num_rows($result) == 0) { 
		$qry = "INSERT INTO websitelink(orgname, link1, link2, link3, link4, link5) 
		VALUES('$orgName','$website', '', '', '', '')";
		$result = @mysql_query($qry);
	}
	else
	{
		$websiteLinksSet = mysql_fetch_assoc($result);
		$link = 'link';
		for($i = 1; $i <= 5; $i++)
		{	
			$link .= $i;	
			if($websiteLinksSet[$link] != '')
			{
				$qry = "update websitelink set $link='$website' where orgname='$orgName'";
				$result = @mysql_query($qry);
				$inserted = 'true';
				break;
			}
			$link  = 'link';
		}
		if($inserted != 'true')
		{
				$qry = "update websitelink set link1='$website' where orgname='$orgName'";
				$result = @mysql_query($qry);
		}
		$inserted = '';
	}
	
	//see if we have a facebook site already listed
	$qry = "select * from facebookLink where orgname='$orgName'";
	$result = @mysql_query($qry);
	if (mysql_num_rows($result) == 0) { 
		$qry = "INSERT INTO facebookLink(orgname, link1, link2, link3, link4, link5) 
		VALUES('$orgName','$facebook', '', '', '', '')";
		$result = @mysql_query($qry);
	}
	else
	{
		$facebookLinksSet = mysql_fetch_assoc($result);
		$link = 'link';
		for($i = 1; $i <= 5; $i++)
		{	
			$link .= $i;	
			if($facebookLinksSet[$link] != '')
			{
				$qry = "update facebookLink set $link='$facebook' where orgname='$orgName'";
				$result = @mysql_query($qry);
				$inserted = 'true';
				break;
			}
			$link  = 'link';
		}
		if($inserted != 'true')
		{
				$qry = "update facebookLink set link1='$facebook' where orgname='$orgName'";
				$result = @mysql_query($qry);
		}
		$inserted = '';
	}
	
		

	//see if we have a twitter site already listed
	$qry = "select * from twitterLink where orgname='$orgName'";
	$result = @mysql_query($qry);
	if (mysql_num_rows($result) == 0) { 
		$qry = "INSERT INTO twitterLink(orgname, link1, link2, link3, link4, link5) 
		VALUES('$orgName','$twitter', '', '', '', '')";
		$result = @mysql_query($qry);
	}
	else
	{
		$twitterLinksSet = mysql_fetch_assoc($result);
		$link = 'link';
		for($i = 1; $i <= 5; $i++)
		{	
			$link .= $i;	
			if($twitterLinksSet[$link] != '')
			{
				$qry = "update twitterLink set $link='$twitter' where orgname='$orgName'";
				$result = @mysql_query($qry);
				$inserted = 'true';
				break;
			}
			$link  = 'link';
		}
		if($inserted != 'true')
		{
				$qry = "update twitterLink set link1='$twitter' where orgname='$orgName'";
				$result = @mysql_query($qry);
		}
		$inserted = '';
	}
		
	//see if we have a linkedin site already listed
	$qry = "select * from linkedInLink where orgname='$orgName'";
	$result = @mysql_query($qry);
	if (mysql_num_rows($result) == 0) { 
		$qry = "INSERT INTO linkedInLink(orgname, link1, link2, link3, link4, link5) 
		VALUES('$orgName','$linkedin', '', '', '', '')";
		$result = @mysql_query($qry);
	}
	else
	{
		$linkedinLinksSet = mysql_fetch_assoc($result);
		$link = 'link';
		for($i = 1; $i <= 5; $i++)
		{	
			$link .= $i;	
			if($linkedinLinksSet[$link] != '')
			{
				$qry = "update linkedInLink set $link='$linkedin' where orgname='$orgName'";
				$result = @mysql_query($qry);
				$inserted = 'true';
				break;
			}
			$link  = 'link';
		}
		if($inserted != 'true')
		{
			$qry = "update linkedInLink set link1='$linkedin' where orgname='$orgName'";
			$result = @mysql_query($qry);
		}
		$inserted = '';
	}
		
	//see if we have a blog site already listed
	$qry = "select * from blogLink where orgname='$orgName'";
	$result = @mysql_query($qry);
	if (mysql_num_rows($result) == 0) { 
		$qry = "INSERT INTO blogLink(orgname, link1, link2, link3, link4, link5) 
		VALUES('$orgName','$blog', '', '', '', '')";
		$result = @mysql_query($qry);
	}
	else
	{
		$blogLinksSet = mysql_fetch_assoc($result);
		$link = 'link';
		for($i = 1; $i <= 5; $i++)
		{	
			$link .= $i;	
			if($blogLinksSet[$link] != '')
			{
				$qry = "update blogLink set $link='$blog' where orgname='$orgName'";
				$result = @mysql_query($qry);
				$inserted = 'true';
				break;
			}
			$link  = 'link';
		}
		if($inserted != 'true')
		{
				$qry = "update blogLink set link1='$blog' where orgname='$orgName'";
				$result = @mysql_query($qry);
		}
		$inserted = '';
	}
		
	//see if we have a youtube site already listed
	$qry = "select * from youTubeLink where orgname='$orgName'";
	$result = @mysql_query($qry);
	if (mysql_num_rows($result) == 0) { 
		$qry = "INSERT INTO youTubeLink(orgname, link1, link2, link3, link4, link5) 
		VALUES('$orgName','$youtube', '', '', '', '')";
		$result = @mysql_query($qry);
	}
	else
	{
		$youtubeLinksSet = mysql_fetch_assoc($result);
		$link = 'link';
		for($i = 1; $i <= 5; $i++)
		{	
			$link .= $i;	
			if($youtubeLinksSet[$link] != '')
			{
				$qry = "update youTubeLink set $link='$youtube' where orgname='$orgName'";
				$result = @mysql_query($qry);
				$inserted = 'true';
				break;
			}
			$link  = 'link';
		}
		if($inserted != 'true')
		{
				$qry = "update youTubeLink set link1='$youtube' where orgname='$orgName'";
				$result = @mysql_query($qry);
		}
		$inserted = '';
	}
		
	mysql_close($link);
	//Check whether the query was successful or not
	if($result) {
			//Login Successful
			session_regenerate_id();
			if($website != '')
			{
				$_SESSION['ORG_WEBSITE'] = $website;
			}
			if($facebook != '')
			{
				$_SESSION['FACEBOOK_LINK'] = $facebook;
			}
			if($twitter != '')
			{
				$_SESSION['TWITTER_LINK'] = $twitter;
			}
			if($linkedin != '')
			{
				$_SESSION['LINKEDIN_LINK'] = $linkedin;
			}
			if($blog != '')
			{
				$_SESSION['BLOG_LINK'] = $blog;
			}
			if($youtube != '')
			{
				$_SESSION['YOUTUBE_LINK'] = $youtube;
			}
			$_SESSION['ORG_PHONE'] = $entirePhone;;
			$_SESSION['ORG_PHONE_PART_1'] = $phone1;
			$_SESSION['ORG_PHONE_PART_2'] = $phone2;
			$_SESSION['ORG_PHONE_PART_3'] = $phone3;
			$_SESSION['ORG_EMAIL'] = $orgemail;

			session_write_close();
			header("location: member-index-org.php");

			exit();
	}else {
		die("Query failed");
	}
?>