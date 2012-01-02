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
	$firstName = clean($_POST['Field1']);
	$lastName = clean($_POST['Field2']);
	$email = clean($_POST['Field116']);
	$posInOrg = clean($_POST['Field114']);
	$orgName = clean($_POST['Field121']);	
	$orgDesc = clean($_POST['Field122']);
	$address = clean($_POST['Field126']);
	$city = clean($_POST['Field128']);
	$state = clean($_POST['Field129']);
	$zip = clean($_POST['Field130']);
	$orgEmail = clean($_POST['Field132']);
    $phoneAreaCode = clean($_POST['phone1']);
	$phonePart2 = clean($_POST['phone2']);	
	$phonePart3 = clean($_POST['phone3']);
	$privacySetting = clean($_POST['Field134']);
	$volInvitAndAppr = clean($_POST['Field135']);
	$link1Type = clean($_POST['Field13351']);//Can repeat
	$link1 = clean($_POST['Field11161']);//Can repeat
	$link2Type = clean($_POST['Field13352']);//Can repeat
	$link2 = clean($_POST['Field11162']);//Can repeat
	$link3Type = clean($_POST['Field13353']);//Can repeat
	$link3 = clean($_POST['Field11163']);//Can repeat
	$link4Type = clean($_POST['Field13354']);//Can repeat
	$link4 = clean($_POST['Field11164']);//Can repeat
	$link5Type = clean($_POST['Field13355']);//Can repeat
	$link5 = clean($_POST['Field11165']);//Can repeat
	$addAdmin = clean($_POST['Field261']); //Can repeat
	$acceptedTerms = clean($_POST['Field13511']);
	$login = clean($_SESSION['SESS_MEMBER_ID']);
	$additionalAdmin2 = clean($_POST['Field262']);
	$additionalAdmin3 = clean($_POST['Field263']);
	$additionalAdmin4 = clean($_POST['Field264']);
	$additionalAdmin5 = clean($_POST['Field265']);
	$additionalAdmin6 = clean($_POST['Field266']);
	$additionalAdmin7 = clean($_POST['Field267']);
	$additionalAdmin8 = clean($_POST['Field268']);
	$additionalAdmin9 = clean($_POST['Field269']);
	$additionalAdmin10 = clean($_POST['Field2610']);
	$adminPhoto = clean($_SESSION['ADMIN_IMAGE_PATH']);
	$orgPhoto = clean($_SESSION['IMAGE_PATH']);
	$pricing = clean($_POST['radioPricing']); 
	$primaryOrgType = clean($_POST['Field159']);
	$secondaryOrgType = clean($_POST['Field160']);
	$tag = clean($_POST['inputString']);
	

	//Input Validations

	if($firstName == '') {
		$errmsg_arr[] = 'First Name Missing';
		$errflag = true;
	}
	if($lastName == '') {
		$errmsg_arr[] = 'Last Name Missing';
		$errflag = true;
	}
	if($email == '') {
		$errmsg_arr[] = 'E-mail Missing';
		$errflag = true;
	}
	if($posInOrg == '') {
		$errmsg_arr[] = 'Position in Organizaation Missing';
		$errflag = true;
	}
	if($orgName == '') {
		$errmsg_arr[] = 'Organization Name Missing';
		$errflag = true;
	}
	if($orgDesc == '') {
		$errmsg_arr[] = 'Organization Description Missing';
		$errflag = true;
	}
	if($address == '') {
		$errmsg_arr[] = 'Organization Address Missing';
		$errflag = true;
	}
	if($city == '') {
		$errmsg_arr[] = 'Organization City Missing';
		$errflag = true;
	}
	if($state == '') {
		$errmsg_arr[] = 'Organization State Missing';
		$errflag = true;
	}
	if($zip == '') {
		$errmsg_arr[] = 'Organization Zipcode Missing';
		$errflag = true;
	}
	if($orgEmail == '') {
		$errmsg_arr[] = 'Organization E-mail Missing';
		$errflag = true;
	}
	if($tag == 'Start Typing Keywords here...') {
		$errmsg_arr[] = 'You Need a Organization Tag';
		$errflag = true;
	}
	if(($phoneAreaCode == '') || ($phonePart2 == '') ||  ($phonePart3 == '')) {
		$errmsg_arr[] = 'Organization Phone Number not complete';
		$errflag = true;
	}
	if($acceptedTerms == '') {
		$errmsg_arr[] = 'You must accept the Terms of Use and Privacy Policy';
		$errflag = true;
	}
	if($login != '') {
		$qry = "SELECT * FROM orgs WHERE orgname='$orgName' and zipcode='$zip'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'A Organization of this name already exists in your Area';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
	
		//These are just to help the user if there is a fail, they will be unset later
		$_SESSION['FIRST_NAME'] = $firstName;
		$_SESSION['LAST_NAME'] = $lastName;
		$_SESSION['CREATOR_EMAIL'] = $email;
		$_SESSION['POSITION_IN_ORG'] = $posInOrg;
		$_SESSION['PHONE_PART_1'] = $phoneAreaCode;
		$_SESSION['PHONE_PART_2'] = $phonePart2;
		$_SESSION['PHONE_PART_3'] = $phonePart3;
		
		//These will be reset again once finished
		$_SESSION['ORG_NAME'] = $orgName;
		$_SESSION['ORG_DESC'] = $orgDesc;
		$_SESSION['ORG_ADDRESS'] = $address;
		$_SESSION['ORG_CITY'] = $city;
		$_SESSION['ORG_STATE'] = $state;
		$_SESSION['ORG_ZIPCODE'] = $zip;
		$_SESSION['ORG_EMAIL'] = $orgEmail;
		$_SESSION['ORG_TYPE_PRIMARY'] = $primaryOrgType;
		$_SESSION['ORG_TYPE_SECONDARY'] = $secondaryOrgType;
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		header("location: member-reg-org.php");
		exit();
	}
	
	//Concatenate Phone number
	$entirePhone = $phoneAreaCode;
	$entirePhone .= $phonePart2;
	$entirePhone .= $phonePart3;
	
	$qry = "select * from tags where tag='$tag'";
	$result2 = @mysql_query($qry);

	if(mysql_num_rows($result2) == 0)
	{
		$qry = "insert into tags(tag) VALUES('$tag')";
		$result2 = @mysql_query($qry);
	}
	

	//Create INSERT query	
	$qry = "INSERT INTO orgs(login, firstname, lastname, position, orgname, orgdescrip, address, city, state, zipcode, phonenumber, orgemail, privacy, volinviteorappr, primarycontemail, orgimage, pricing, primaryorgType, secondaryorgType, tag) 
					VALUES('$login','$firstName','$lastName','$posInOrg','$orgName','$orgDesc','$address','$city','$state','$zip','$entirePhone','$orgEmail','$privacySetting','$volInvitAndAppr', '$email', '$orgPhoto', '$pricing', '$primaryOrgType', '$secondaryOrgType', '$tag')";
	$result = @mysql_query($qry);
	

	
	$qry = "INSERT INTO additadmins(primaryadmin, admin1, admin2, admin3, admin4, admin5, admin6, admin7, admin8, admin9, admin10, adminimage) 
	VALUES('$email','$addAdmin', '$additionalAdmin2', '$additionalAdmin3', '$additionalAdmin4', '$additionalAdmin5', '$additionalAdmin6', '$additionalAdmin7', '$additionalAdmin8', '$additionalAdmin9', '$additionalAdmin10', '$adminPhoto')";
	$result3 = @mysql_query($qry);

	
	//Store any Website links
	if(($link1Type == "Website") || ($link2Type == "Website") || ($link3Type == "Website") || ($link4Type == "Website") || ($link5Type == "Website"))
	{
		$localLink1 = $link1;
		$localLink2 = $link2;		
		$localLink3 = $link3;
		$localLink4 = $link4;
		$localLink5 = $link5;
		
		if($link1Type != "Website")
		{
			$localLink1 = 0;
		}
		if($link2Type != "Website")
		{
			$localLink2 = 0;
		}
		if($link3Type != "Website")
		{
			$localLink3 = 0;
		}
		if($link4Type != "Website")
		{
			$localLink4 = 0;
		}
		if($link5Type != "Website")
		{
			$localLink5 = 0;
		}
		
		$qry = "INSERT INTO websiteLink(orgname, link1, link2, link3, link4, link5) 
		VALUES('$orgName','$localLink1', '$localLink2', '$localLink3', '$localLink4', '$localLink5')";
		$result4 = @mysql_query($qry);
	}
	
	//Store any Facebook links
	if(($link1Type == "Facebook") || ($link2Type == "Facebook") || ($link3Type == "Facebook") || ($link4Type == "Facebook") || ($link5Type == "Facebook"))
	{
		$localLink1 = $link1;
		$localLink2 = $link2;		
		$localLink3 = $link3;
		$localLink4 = $link4;
		$localLink5 = $link5;
		
		if($link1Type != "Facebook")
		{
			$localLink1 = 0;
		}
		if($link2Type != "Facebook")
		{
			$localLink2 = 0;
		}
		if($link3Type != "Facebook")
		{
			$localLink3 = 0;
		}
		if($link4Type != "Facebook")
		{
			$localLink4 = 0;
		}
		if($link5Type != "Facebook")
		{
			$localLink5 = 0;
		}
		
		$qry = "INSERT INTO facebookLink(orgname, link1, link2, link3, link4, link5) 
		VALUES('$orgName','$localLink1', '$localLink2', '$localLink3', '$localLink4', '$localLink5')";
		$result5 = @mysql_query($qry);
	}
	
	//Store any Twitter links
	if(($link1Type == "Twitter") || ($link2Type == "Twitter") || ($link3Type == "Twitter") || ($link4Type == "Twitter") || ($link5Type == "Twitter"))
	{
		$localLink1 = $link1;
		$localLink2 = $link2;		
		$localLink3 = $link3;
		$localLink4 = $link4;
		$localLink5 = $link5;
		
		if($link1Type != "Twitter")
		{
			$localLink1 = 0;
		}
		if($link2Type != "Twitter")
		{
			$localLink2 = 0;
		}
		if($link3Type != "Twitter")
		{
			$localLink3 = 0;
		}
		if($link4Type != "Twitter")
		{
			$localLink4 = 0;
		}
		if($link5Type != "Twitter")
		{
			$localLink5 = 0;
		}
		
		$qry = "INSERT INTO twitterLink(orgname, link1, link2, link3, link4, link5) 
		VALUES('$orgName','$localLink1', '$localLink2', '$localLink3', '$localLink4', '$localLink5')";
		$result5 = @mysql_query($qry);
	}
	
	//Store any LinkedIn links
	if(($link1Type == "LinkedIn") || ($link2Type == "LinkedIn") || ($link3Type == "LinkedIn") || ($link4Type == "LinkedIn") || ($link5Type == "LinkedIn"))
	{
		$localLink1 = $link1;
		$localLink2 = $link2;		
		$localLink3 = $link3;
		$localLink4 = $link4;
		$localLink5 = $link5;
		
		if($link1Type != "LinkedIn")
		{
			$localLink1 = 0;
		}
		if($link2Type != "LinkedIn")
		{
			$localLink2 = 0;
		}
		if($link3Type != "LinkedIn")
		{
			$localLink3 = 0;
		}
		if($link4Type != "LinkedIn")
		{
			$localLink4 = 0;
		}
		if($link5Type != "LinkedIn")
		{
			$localLink5 = 0;
		}
		
		$qry = "INSERT INTO linkedInLink(orgname, link1, link2, link3, link4, link5) 
		VALUES('$orgName','$localLink1', '$localLink2', '$localLink3', '$localLink4', '$localLink5')";
		$result5 = @mysql_query($qry);
	}
	//Store any Blog links
	if(($link1Type == "Blog") || ($link2Type == "Blog") || ($link3Type == "Blog") || ($link4Type == "Blog") || ($link5Type == "Blog"))
	{
		$localLink1 = $link1;
		$localLink2 = $link2;		
		$localLink3 = $link3;
		$localLink4 = $link4;
		$localLink5 = $link5;
		
		if($link1Type != "Blog")
		{
			$localLink1 = 0;
		}
		if($link2Type != "Blog")
		{
			$localLink2 = 0;
		}
		if($link3Type != "Blog")
		{
			$localLink3 = 0;
		}
		if($link4Type != "Blog")
		{
			$localLink4 = 0;
		}
		if($link5Type != "Blog")
		{
			$localLink5 = 0;
		}
		
		$qry = "INSERT INTO blogLink(orgname, link1, link2, link3, link4, link5) 
		VALUES('$orgName','$localLink1', '$localLink2', '$localLink3', '$localLink4', '$localLink5')";
		$result6 = @mysql_query($qry);
	}
	//Store any YouTube links
	if(($link1Type == "YouTube") || ($link2Type == "YouTube") || ($link3Type == "YouTube") || ($link4Type == "YouTube") || ($link5Type == "YouTube"))
	{
		$localLink1 = $link1;
		$localLink2 = $link2;		
		$localLink3 = $link3;
		$localLink4 = $link4;
		$localLink5 = $link5;
		
		if($link1Type != "YouTube")
		{
			$localLink1 = 0;
		}
		if($link2Type != "YouTube")
		{
			$localLink2 = 0;
		}
		if($link3Type != "YouTube")
		{
			$localLink3 = 0;
		}
		if($link4Type != "YouTube")
		{
			$localLink4 = 0;
		}
		if($link5Type != "YouTube")
		{
			$localLink5 = 0;
		}
		
		$qry = "INSERT INTO youTubeLink(orgname, link1, link2, link3, link4, link5) 
		VALUES('$orgName','$localLink1', '$localLink2', '$localLink3', '$localLink4', '$localLink5')";
		$result7 = @mysql_query($qry);
	}
	
	
	//Check whether the query was successful or not
	if($result && $result2 && $result3) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);

				$qry="SELECT * FROM websitelink WHERE orgname='$orgName'";
				$result3 =mysql_query($qry);
				$website = mysql_fetch_assoc($result3);
				foreach($website as $value)
				{
					if($value != '0')
					{
						$_SESSION['ORG_WEBSITE'] = $value;
					}
				}
				
				$qry="SELECT * FROM facebooklink WHERE orgname='$orgName'";
				$result4 =mysql_query($qry);
				$fbook = mysql_fetch_assoc($result4);
				foreach($fbook as $value2)
				{
					if($value2 != '0')
					{
						$_SESSION['FACEBOOK_LINK'] = $value2;
					}
				}
				
				$qry="SELECT * FROM twitterlink WHERE orgname='$orgName'";
				$result5 =mysql_query($qry);
				$twitter = mysql_fetch_assoc($result5);
				foreach($twitter as $value3)
				{
					if($value3 != '0')
					{
						$_SESSION['TWITTER_LINK'] = $value3;
					}
				}
				
				$qry="SELECT * FROM linkedinlink WHERE orgname='$orgName'";
				$result6 =mysql_query($qry);
				$linkedin = mysql_fetch_assoc($result6);
				foreach($linkedin as $value4)
				{
					if($value4 != '0')
					{
						$_SESSION['LINKEDIN_LINK'] = $value4;
					}
				}
				
				$qry="SELECT * FROM blogLink WHERE orgname='$orgName'";
				$result7 =mysql_query($qry);
				$blog = mysql_fetch_assoc($result7);
				foreach($blog as $value5)
				{
					if($value5 != '0')
					{
						$_SESSION['BLOG_LINK'] = $value5;
					}
				}
				
				$qry="SELECT * FROM youTubeLink WHERE orgname='$orgName'";
				$result8 =mysql_query($qry);
				$youTube = mysql_fetch_assoc($result8);
				foreach($youTube as $value6)
				{
					if($value6 != '0')
					{
						$_SESSION['YOUTUBE_LINK'] = $value6;
					}
				}
			
			
			$_SESSION['ORG_NAME'] = $orgName;
			$_SESSION['ORG_DESC'] = $orgDesc;
			$_SESSION['ORG_ADDRESS'] = $address;
			$_SESSION['ORG_CITY'] = $city;
			$_SESSION['ORG_STATE'] = $state;
			$_SESSION['ORG_ZIPCODE'] = $zip;
			$_SESSION['ORG_PHONE'] = $entirePhone;
			$_SESSION['ORG_PHONE_PART_1'] = $phoneAreaCode;
			$_SESSION['ORG_PHONE_PART_2'] = $phonePart2;
			$_SESSION['ORG_PHONE_PART_3'] = $phonePart3;
			$_SESSION['ORG_WEBSITE'] = $website['link1'];
			$_SESSION['ORG_EMAIL'] = $orgEmail;
			$_SESSION['ORG_TYPE_PRIMARY'] = $primaryOrgType;
			$_SESSION['ORG_TYPE_SECONDARY'] = $secondaryOrgType;
			$_SESSION['ORG_PLAN_TYPE'] = $pricing;

			//These were used for error detection, clear them here
	        unset($_SESSION['FIRST_NAME']);
	        unset($_SESSION['LAST_NAME']);
	        unset($_SESSION['CREATOR_EMAIL']);
	        unset($_SESSION['POSITION_IN_ORG']);
	        unset($_SESSION['PHONE_PART_1']);
	        unset($_SESSION['PHONE_PART_2']);
	        unset($_SESSION['PHONE_PART_3']);
			session_write_close();
			header("location: member-index-org.php");

			exit();
	}else {
		die("Query failed");
	}
?>