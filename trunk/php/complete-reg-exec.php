<?php
	
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	require_once('upsaddress.php');
	require_once('../phpmailer/class.phpmailer.php');
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
	
	//Sanitize the POST values
	$firstName = clean($_POST['Field1']);
	$lastName = clean($_POST['Field2']);
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
	$submit= clean($_POST['Submit']);
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
	$adminPhoto = clean($_SESSION['ADMIN_IMAGE_PATH']);
	$orgPhoto = clean($_SESSION['IMAGE_PATH']);
	$primaryOrgType = clean($_POST['Field159']);
	$website = clean($_POST['orgwebsite']);
	$facebook = clean($_POST['orgfacebook']);
	$twitter = clean($_POST['orgtwitter']);
	$linkedin = clean($_POST['orglinkedin']);	
	$blog = clean($_POST['orgblog']);
	$youtube = clean($_POST['orgyoutube']);

	$tag = clean($_POST['inputString']);
	$orgid = $_SESSION['ORG_ID'];
	
	//Input Validations
	if($submit != "Save Changes")
	{
		if($firstName == '') {
			$errmsg_arr[] = 'First Name Missing';
			$errflag = true;
		}
		if($lastName == '') {
			$errmsg_arr[] = 'Last Name Missing';
			$errflag = true;
		}
		if($posInOrg == '') {
			$errmsg_arr[] = 'Position in Organizaation Missing';
			$errflag = true;
		}
		if($orgDesc == '') {
			$errmsg_arr[] = 'Organization Description Missing';
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
	}
	if($orgName == '') {
		$errmsg_arr[] = 'Organization Name Missing';
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
	if($orgEmail != '')
	{
		if (filter_var($orgEmail, FILTER_VALIDATE_EMAIL)) {
		} else {
			$errmsg_arr[] = 'Organization E-mail Invalid';
			$errflag = true;
		}
	}
	if($tag == 'Start Typing Keywords here...') {
		$errmsg_arr[] = 'You Need a Organization Tag';
		$errflag = true;
	}
	if(($phoneAreaCode == '') || ($phonePart2 == '') ||  ($phonePart3 == '')) {
		$errmsg_arr[] = 'Organization Phone Number not complete';
		$errflag = true;
	}
	else
	{
		$fullNumber = $phoneAreaCode;
		$fullNumber .= '-';
		$fullNumber .= $phonePart2;
		$fullNumber .= '-';
		$fullNumber .= $phonePart3;

		if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $fullNumber)) {
			$errmsg_arr[] = 'Organization Phone Number is invalid';
			$errflag = true;
		}	
	}
	

		if(($city != '') && ($state != '') && ($zip != ''))
		{
			$ups = new upsaddress("CC90B3C39836BC10", "joelcomp1", "Coolenungames!2");
			$ups->setCity($city);
			$ups->setState($state);
			$ups->setZip($zip);
			$response = $ups->getResponse();
			if($response->list[0]->quality == 1.0)
			{
				//We have a good address!
			}
			else
			{
				//We didn't have a exact match...
				if((ucwords(strtolower($response->list[0]->city == $city))) &&  ($response->list[0]->state == $state) && ($response->list[0]->zipLow <= $zip)
					&& ($response->list[0]->zipHigh <= $zip))
				{//if this all matches we are still OK

				}
				else if((ucwords(strtolower($response->list[1]->city == $city))) &&  ($response->list[1]->state == $state) && ($response->list[1]->zipLow <= $zip)
					&& ($response->list[1]->zipHigh <= $zip))
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
	
		//These are just to help the user if there is a fail, they will be unset later
		$_SESSION['FIRST_NAME'] = $firstName;
		$_SESSION['LAST_NAME'] = $lastName;
		$_SESSION['POSITION_IN_ORG'] = $posInOrg;
		$_SESSION['PHONE_PART_1'] = $phoneAreaCode;
		$_SESSION['PHONE_PART_2'] = $phonePart2;
		$_SESSION['PHONE_PART_3'] = $phonePart3;
		if($tag != 'Start Typing Keywords here...') 
		{
			$_SESSION['ORG_TAG'] = $tag;
		}
		//These will be reset again once finished
		$_SESSION['ORG_NAME'] = $orgName;
		$_SESSION['ORG_DESC'] = $orgDesc;
		$_SESSION['ORG_ADDRESS'] = $address;
		$_SESSION['ORG_CITY'] = $city;
		$_SESSION['ORG_STATE'] = $state;
		$_SESSION['ORG_ZIPCODE'] = $zip;
		$_SESSION['ORG_EMAIL'] = $orgEmail;
		$_SESSION['ORG_TYPE_PRIMARY'] = $primaryOrgType;
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		if($submit != "Save Changes")
		{
			header("location: member-reg-org.php");
		}
		else 
		{
			header("location: account-settings-org.php");
		}
		
		exit();
	}

	
	$qry = "select * from members where login='$login'";
	$result2 = @mysql_query($qry);
	$memberInfo = mysql_fetch_assoc($result2);
	$email = $memberInfo['email'];
	
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
	//
	if($submit != "Save Changes") //This is the registration page then
	{
		$qry = "update orgs set firstname='$firstName', lastname='$lastName', position='$posInOrg', orgname='$orgName', orgdescrip='$orgDesc', address='$address', city='$city', state='$state', zipcode='$zip', phonenumber='$entirePhone', orgemail='$orgEmail', privacy='$privacySetting', primarycontemail='$email', orgimage='$orgPhoto', primaryorgType='$primaryOrgType', tag='$tag' where orgid='$orgid';";
	}
	else
	{ 

		$qry = "update orgs set orgname='$orgName', address='$address', city='$city', state='$state', privacy='$privacySetting', phonenumber='$entirePhone', orgemail='$orgEmail', primaryorgType='$primaryOrgType', zipcode='$zip', tag='$tag' where orgid='$orgid';";

	}
	$result = @mysql_query($qry);
	
	if($submit != "Save Changes") //This is the registration page then
	{
		$counter = 1;
		do
		{
				
			$adminFirstName = "Field261a";
			$adminFirstName .= $counter;
			$newAdminFirstName = clean($_POST[$adminFirstName]); 
				
			$adminLastName = "Field262a";
			$adminLastName .= $counter;
			$newAdminLastName = clean($_POST[$adminLastName]); 
				
			$adminemail = "Field260a";
			$adminemail .= $counter;
			$newAdminemail = clean($_POST[$adminemail]); 
				
		
			if($adminFirstName != '')
			{			
				$qry = "INSERT INTO additadmins(primaryadmin, adminimage, orgname, additfirstname, additlastname, additemail) 
				VALUES('$email','$adminPhoto', '$orgName', '$newAdminFirstName', '$newAdminLastName', '$newAdminemail')";
				$result = @mysql_query($qry);
		
			}
			$counter = $counter + 1;
			$adminFirstName = "Field261a1";
			$adminFirstName .= $counter;
			$volLogin = clean($_POST[$adminFirstName]);
		}while($_POST[$adminFirstName] != '');
		
	
		//create a volunteer account for the creating admin
		$qry = "INSERT INTO vols(login, firstname, lastname, city, state, aboutme, email, interests, userimage, privacy, phonenumber) 
						VALUES('$login','$firstName','$lastName', '$city', '$state', ' ', '$email', '','$adminPhoto', 'Private' ,'')";
						
		$result = @mysql_query($qry);
		
		$todaysDate = date("m/d/Y h:i:s A");
		$qry = "INSERT INTO volConn(id_inviter, id_request, status, updated_at, created_at) 
						VALUES('$login','$orgName','ACCEPTED','$todaysDate','$todaysDate')";
		$result = @mysql_query($qry);
	}
	
	if($submit != "Save Changes") //This is the registration page then
	{
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
				$localLink1 = '';
			}
			if($link2Type != "Website")
			{
				$localLink2 = '';
			}
			if($link3Type != "Website")
			{
				$localLink3 = '';
			}
			if($link4Type != "Website")
			{
				$localLink4 = '';
			}
			if($link5Type != "Website")
			{
				$localLink5 = '';
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
				$localLink1 = '';
			}
			if($link2Type != "Facebook")
			{
				$localLink2 = '';
			}
			if($link3Type != "Facebook")
			{
				$localLink3 = '';
			}
			if($link4Type != "Facebook")
			{
				$localLink4 = '';
			}
			if($link5Type != "Facebook")
			{
				$localLink5 = '';
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
				$localLink1 = '';
			}
			if($link2Type != "Twitter")
			{
				$localLink2 = '';
			}
			if($link3Type != "Twitter")
			{
				$localLink3 = '';
			}
			if($link4Type != "Twitter")
			{
				$localLink4 = '';
			}
			if($link5Type != "Twitter")
			{
				$localLink5 = '';
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
				$localLink1 = '';
			}
			if($link2Type != "LinkedIn")
			{
				$localLink2 = '';
			}
			if($link3Type != "LinkedIn")
			{
				$localLink3 = '';
			}
			if($link4Type != "LinkedIn")
			{
				$localLink4 = '';
			}
			if($link5Type != "LinkedIn")
			{
				$localLink5 = '';
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
				$localLink1 = '';
			}
			if($link2Type != "Blog")
			{
				$localLink2 = '';
			}
			if($link3Type != "Blog")
			{
				$localLink3 = '';
			}
			if($link4Type != "Blog")
			{
				$localLink4 = '';
			}
			if($link5Type != "Blog")
			{
				$localLink5 = '';
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
				$localLink1 = '';
			}
			if($link2Type != "YouTube")
			{
				$localLink2 = '';
			}
			if($link3Type != "YouTube")
			{
				$localLink3 = '';
			}
			if($link4Type != "YouTube")
			{
				$localLink4 = '';
			}
			if($link5Type != "YouTube")
			{
				$localLink5 = '';
			}
			
			$qry = "INSERT INTO youTubeLink(orgname, link1, link2, link3, link4, link5) 
			VALUES('$orgName','$localLink1', '$localLink2', '$localLink3', '$localLink4', '$localLink5')";
			$result7 = @mysql_query($qry);
		}
	}
	else
	{
	
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
	
	}

	
	//Check whether the query was successful or not
	if($result && $result2) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);

				if($submit != "Save Changes") //This is the registration page then
				{
					$qry="SELECT * FROM websitelink WHERE orgname='$orgName'";
					$result3 =mysql_query($qry);
					$website = mysql_fetch_assoc($result3);
					foreach($website as $value)
					{
						if($value != '')
						{
							$_SESSION['ORG_WEBSITE'] = $value;
						}
					}
					
					$qry="SELECT * FROM facebooklink WHERE orgname='$orgName'";
					$result4 =mysql_query($qry);
					$fbook = mysql_fetch_assoc($result4);
					foreach($fbook as $value2)
					{
						if($value2 != '')
						{
							$_SESSION['FACEBOOK_LINK'] = $value2;
						}
					}
					
					$qry="SELECT * FROM twitterlink WHERE orgname='$orgName'";
					$result5 =mysql_query($qry);
					$twitter = mysql_fetch_assoc($result5);
					foreach($twitter as $value3)
					{
						if($value3 != '')
						{
							$_SESSION['TWITTER_LINK'] = $value3;
						}
					}
					
					$qry="SELECT * FROM linkedinlink WHERE orgname='$orgName'";
					$result6 =mysql_query($qry);
					$linkedin = mysql_fetch_assoc($result6);
					foreach($linkedin as $value4)
					{
						if($value4 != '')
						{
							$_SESSION['LINKEDIN_LINK'] = $value4;
						}
					}
					
					$qry="SELECT * FROM blogLink WHERE orgname='$orgName'";
					$result7 =mysql_query($qry);
					$blog = mysql_fetch_assoc($result7);
					foreach($blog as $value5)
					{
						if($value5 != '')
						{
							$_SESSION['BLOG_LINK'] = $value5;
						}
					}
					
					$qry="SELECT * FROM youTubeLink WHERE orgname='$orgName'";
					$result8 =mysql_query($qry);
					$youTube = mysql_fetch_assoc($result8);
					foreach($youTube as $value6)
					{
						if($value6 != '')
						{
							$_SESSION['YOUTUBE_LINK'] = $value6;
						}
					}
				}
				else
				{
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
			$_SESSION['VOLUNTEER_IS_ADMIN']	= 'true';	
			$_SESSION['ORG_PRIVACY'] = $privacySetting;
			$_SESSION['ORG_TAG'] = $tag;
			
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
			$_SESSION['ORG_FINISHED'] = 'true';
			$_SESSION['VOL_PRIVACY'] = $volInfo['privacy'];
			if($_SESSION['VOL_IMAGE_PATH'] != '')
			{
				$_SESSION['VOL_IMAGE'] = 'true';
			}

		$emailAddressArray = array();
		$emailAddressArrayOfNames = array();
		define('GUSER', 'info@volly.it'); // GMail username
		define('GPWD', 'VollyIt920470'); // GMail password
		  
		function smtpmailer($to, $names, $from, $from_name, $subject, $body) { 
		global $error;
		$mail = new PHPMailer();  // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true;  // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465; 
		$mail->Username = GUSER;  
		$mail->Password = GPWD;           
		$mail->SetFrom($from, $from_name);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->IsHTML(true);

		$j = 0;
		foreach($to as $msg) 
		{	
			$mail->AddAddress($msg, $names[$j]);
			$j++;
		}

		if(!$mail->Send()) {
			$error = 'Mail error: '.$mail->ErrorInfo; 
			return false;
		} else {
			$error = 'Message sent!';
			return true;
		}
		}
		$qry = "select * from additadmins where orgname='$orgName'";
		$result = @mysql_query($qry);
		if($submit != "Save Changes") //This is the registration page then
		{
			while ($adminsToEmail = mysql_fetch_object($result))
			{
				$tempEmail = $adminsToEmail->additemail;
				$qry = "select * from members where email='$tempEmail'";
				$result2 = @mysql_query($qry);
				if(mysql_num_rows($result2) == 0)
				{
					$message = "<html><head><style type='text/css'></style></head><body><p>Hi ";
					$message .= $adminsToEmail->additfirstname;
					$message .= ' '; 
					$message .= $adminsToEmail->additlastname;
					$message .= "! You just got added as a admin for the ";
					$message .= $orgName;
					$message .= " Organization <br>Click the link below to create your volly.it account.</p>";
					$message .= "<a href='joelcomp1.no-ip.org/index.php?userid=";
					$message .= $memberInfo['userid'];
					$message .= '&createaccount=yes';
					$message .= '&orgid=';
					$message .= $orgid;
					$message .="'>Join Volly.it!</a></p>";
					$message .= "</body></html>";
					$name = $adminsToEmail->additfirstname;
					$name .= ' ';
					$name .= $adminsToEmail->additlastname;
					
					$emailAddressArray[] = $adminsToEmail->additemail;
					$emailAddressArrayOfNames[] = $name;
					
					if(count(emailAddressArray) > 0)
					{
						$success = smtpmailer($emailAddressArray, $emailAddressArrayOfNames, 'info@volly.it', 'Volly.it', 'Volly.It - Help change the world! ', $message);
					}
				}
				else
				{
					$message = "<html><head><style type='text/css'></style></head><body><p>Hi ";
					$message .= $adminsToEmail->additfirstname;
					$message .= ' '; 
					$message .= $adminsToEmail->additlastname;
					$message .= "! You just got added as a admin for the ";
					$message .= $orgName;
					$message .= " Organization <br>Click the link below to link your exisitng volly.it account.</p>";
					$message .= "<a href='joelcomp1.no-ip.org/index.php?userid=";
					$message .= $memberInfo['userid'];
					$message .= '&createaccount=no';
					$message .= '&orgid=';
					$message .= $orgid;
					$message .="'>Join Volly.it!</a></p>";
					$message .= "</body></html>";
					$name = $adminsToEmail->additfirstname;
					$name .= ' ';
					$name .= $adminsToEmail->additlastname;
					
					$emailAddressArray[] = $adminsToEmail->additemail;
					$emailAddressArrayOfNames[] = $name;
					
					if(count(emailAddressArray) > 0)
					{
						$success = smtpmailer($emailAddressArray, $emailAddressArrayOfNames, 'info@volly.it', 'Volly.it', 'Volly.It - Help change the world! ', $message);
					}
				}
			}	
		}
				
			//These were used for error detection, clear them here
	        unset($_SESSION['FIRST_NAME']);
	        unset($_SESSION['LAST_NAME']);
	        unset($_SESSION['CREATOR_EMAIL']);
	        unset($_SESSION['POSITION_IN_ORG']);
	        unset($_SESSION['PHONE_PART_1']);
	        unset($_SESSION['PHONE_PART_2']);
	        unset($_SESSION['PHONE_PART_3']);
			session_write_close();
			
			if($submit != "Save Changes") //This is the registration page then
			{
				header("location: member-index-org.php");
			}
			else
			{
				header("location: account-settings-org.php");
			}
			exit();
	}else {
		die("Query failed");
	}
	mysql_close($link);
?>