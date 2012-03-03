<?php
	
	require_once('auth.php');
	
	session_start();
	$successPayment = $_GET['success'];
	$_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
	
	include "header-org.php";
	include "navigation.php";
	

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['ORG_NAME'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link href="../css/movingboxes.css" media="screen" rel="stylesheet">
<link rel='stylesheet' type='text/css' href="../css/fullcalendar.css" />
<link rel='stylesheet' type='text/css' href="../css/fullcalendar.print.css" media='print' />

</head>
<body>

<div id="wrap">
<div id="mainnavuser">
<?php
	if($successPayment == 'true')
	{
		echo '<b>Payment Successful</b>';
		$successPayment = '';
	}
	else if($successPayment == 'false')
	{
		echo '<b>Payment Failed</b>';
		$successPayment = '';
	}
	?>


<div class="clear"></div>
<h3>
<div class="publishProgram"  style="text-align:center;">
Quick Tasks: <a href="add-volunteers-org.php"><img src="../images/addVolunteers.png" alt="Add Your Volunteers"  width="93" height="105"><a href="create-program-part1.php?reset=true"><img src="../images/createNewProgram.png" alt="Create New Program"  width="93" height="105"></a><a href="org-volunteer-mgmt.php"><img src="../images/volMgmt.png" width="93" height="105"></a><a href="program-management-org.php"><img src="../images/programMgmt.png" width="93" height="105"></a>
</div>
<div class="clear"></div>
<?php echo $_SESSION['ORG_NAME'];?>

<div class="clear"></div>
<div class="orgAddress">
<?php echo $_SESSION['ORG_ADDRESS'];?> - 
<?php echo $_SESSION['ORG_CITY'];?>, 
<?php echo $_SESSION['ORG_STATE'];?> 
<?php echo $_SESSION['ORG_ZIPCODE'];?> 
</div>
</h3>


<div id="popupContact8">
	<a id="popupContactClose8">x</a>
<form id="updateConnectionsForm" name="updateConnectionsForm" method="post" action="update-org-connections.php">
<div style="float:left;">
Organizations E-mail
</div>
<div style="float:left; padding: 0px 0px 0px 20px;">
<input id="orgemail" name="orgemail" type="email" spellcheck="false" class="field text medium" value="<?php echo $_SESSION['ORG_EMAIL']; ?>" maxlength="255" tabindex="1" /> 
</div>
<div class="clear"></div>
<div style="float:left;">
WebSite
</div>
<div style="float:left; padding: 0px 0px 0px 99px;">
<input id="orgwebsite" name="orgwebsite" type="text" spellcheck="false" class="field text medium" value="<?php echo $_SESSION['ORG_WEBSITE'];?>" maxlength="255" tabindex="2"  /> 
</div>
<div class="clear"></div>
<div style="float:left;">
Facebook
</div>
<div style="float:left; padding: 0px 0px 0px 91px;">
<input id="orgfacebook" name="orgfacebook" type="text" spellcheck="false" class="field text medium" value="<?php echo $_SESSION['FACEBOOK_LINK'];?>" maxlength="255" tabindex="3"  /> 
</div>
<div class="clear"></div>
<div style="float:left;">
Twitter
</div>
<div style="float:left; padding: 0px 0px 0px 106px;">
<input id="orgtwitter" name="orgtwitter" type="text" spellcheck="false" class="field text medium" value="<?php echo $_SESSION['TWITTER_LINK'];?>" maxlength="255" tabindex="4"  /> 
</div>
<div class="clear"></div>
<div style="float:left;">
LinkedIn
</div>
<div style="float:left; padding: 0px 0px 0px 100px;">
<input id="orglinkedin" name="orglinkedin" type="text" spellcheck="false" class="field text medium" value="<?php echo $_SESSION['LINKEDIN_LINK'];?>" maxlength="255" tabindex="5"  /> 
</div>
<div class="clear"></div>
 <div style="float:left;">
Blog
</div>
<div style="float:left; padding: 0px 0px 0px 127px;">
<input id="orgblog" name="orgblog" type="text" spellcheck="false" class="field text medium" value="<?php echo $_SESSION['BLOG_LINK'];?>" maxlength="255" tabindex="6"  /> 
</div>
<div class="clear"></div>
 <div style="float:left;">
YouTube
</div>
<div style="float:left; padding: 0px 0px 0px 96px;">
<input id="orgyoutube" name="orgyoutube" type="text" spellcheck="false" class="field text medium" value="<?php echo $_SESSION['YOUTUBE_LINK'];?>" maxlength="255" tabindex="7"  /> 
</div>
<div class="clear"></div>
 <div style="float:left;">
Phone Number
</div>
<div style="float:left; padding: 0px 0px 0px 60px;">
<span>
<input type="tel" id="phone1" name="phone1" 
    size=4 onKeyup="autotab(this, document.updateConnectionsForm.phone2)" class="field text" size="3" tabindex="8"  maxlength=3 value="<?php echo $_SESSION['ORG_PHONE_PART_1']; ?>" >
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone2" name="phone2" 
    size=4 onKeyup="autotab(this, document.updateConnectionsForm.phone3)" class="field text" size="3"  tabindex="9" maxlength=3 value="<?php echo $_SESSION['ORG_PHONE_PART_2']; ?>"> 
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone3" name="phone3" size=4 maxlength=4 class="field text" tabindex="10" value="<?php echo $_SESSION['ORG_PHONE_PART_3']; ?>" >
</span>
</div>
<div class="clear"></div>
     &nbsp;
	 <div style="text-align:center">
      <input type="submit" name="Submit" tabindex="6" value="Update Connections" />
</div>

</form>
	</div>
	<div id="backgroundPopup8"></div>
<div class="thumbnailOrg">
	<?php
	if(($_SESSION['ORG_IMAGE']) == true) {
	
		echo '<div id="login"><img src="uploaded_files/',$_SESSION['IMAGE_PATH'],'" alt="Organization Picture" width="320" height="240"></div>';
	}
	else
	{//This name is decieving, i am using the login pop up for the image upload.....
		echo '<div id="login">
<img src="../images/noorglogo.png" width="320" height="240" alt="header image2""> 
</div>';
	}
	?>
<br><br><br>

	
<div id="popupContact2">
	<a id="popupContactClose2">x</a>
	<center>
	<p id="contactArea">

<form id="Upload" action="upload.processor.php" enctype="multipart/form-data" method="post">
		<p>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">

		<center>
			<label for="file">Upload a Picture!</label>
			<br>
			<br>
			<input id="file" type="file" name="file">
				<br>
			<input id="submit" type="submit" name="submit" value="Upload Organization Image!">
<br>
				</center>
		</p>
	</form></center>
		</p>
	
	</div>
	<div id="backgroundPopup2"></div>
	</div>



<!--This is used for the upcoming vollys box-->
<div class="boxFormat">
<div class="TextBox1">
<div class="leftText" style="float: left;">
 Upcoming Program...
</div>
</div>
</div>

<div class="boxFormat2">
<div class="nextPrograms">
<div id='results'>
</div>
</div>
</div>
<div class="clear"></div>

<!--This is used for the  snapshot box-->
<div class="boxFormat3">
<div class="box1">
   Snapshot
</div>
</div>

<!--This is used for the  snapshot  box part 2-->
<div class="boxFormat2">
<div class="snapShotBox">
<div class="volunteersSnapshot" style="float: left; font:bold 0.6em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 7px; text-align:center;">
<a href="org-volunteer-mgmt.php?state=All"><img src="../images/emptyIcon.jpg" width="30" height="40" ></a>
<br>
Volunteers
</div>
<div class="upcomingSnapshot" style="float: left; font:bold 0.6em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 9px; text-align:center;">

<a href="program-management-display.php?state=UpcomingPrograms"><img src="../images/emptyIcon.jpg" width="30" height="40" ></a>
<br>
Upcoming Programs

</div>
<div class="pastProgramsSnapshot" style="float: left; font:bold 0.6em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 9px; text-align:center;">
<a href="program-management-display.php?state=PastPrograms"><img src="../images/emptyIcon.jpg" width="30" height="40" ></a>
<br>
Past Programs
</div>
<!--div class="collabSnapshot" style="float: left; font:bold 0.6em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 9px; text-align:center;">
<a href="collaborations-org.php"><img src="../images/emptyIcon.jpg" width="30" height="40" ></a>
<br>
Collaborations
</div-->
</div>
</div>


<!--This is used for the About Us box-->
<div class="aboutUsBox">
<div class="box3">
   About Us
</div>
</div>


<!--This is used for the  snapshot  box part 3-->
<div class="connections3Box">
<div class="box1">
<br>
</div>
</div>

<!--This is used for the About Us  box part 2-->
<div class="boxFormat5">
<div class="box5">
<form id="aboutMeForm" name="aboutMeForm" method="post" action="store-about-me.php">
<div>
<textarea id="aboutMeTextBox" 
name="aboutMeTextBox" 
style="resize: none;"
spellcheck="true" 
rows="5" cols="37" 
 >
 <?php
	if(isset($_SESSION['ORG_DESC'])) {
		echo $_SESSION['ORG_DESC'];
	}
	else
	{
		echo 'Click here to edit'; 
	}
	?></textarea>
	<center>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Save About Us" /></td>
	</center>
</div>
</form>
</div>
</div>


<!--This is used for the  your staff box-->
<div class="yourStaffBox">
<div class="box1">
<div class="leftText" style="float: left;">
 Your Staff
</div>
<div class="rightText"  style="float: right;">        
<a href="#" onclick="popup(550, 'popup5');" class="poplight">Manage</a>
</div>
</div>
</div>




<!--This is used for the  your staff  box part 2-->
<div class="yourStaffBox2">
<div class="yourStaffboxContent" style="overflow-y: scroll;">
<div id='results9'>
</div>
</div>
</div>

<!--This is used for the  your staff box 3-->
<div class="yourStaffBox2">
<div class="box1">
<br>
</div>
</div>

<!--This is used for the  connections box-->
<div class="yourStaffBox">
<div class="box1">
<div class="leftText" style="float: left;">
 Connections
</div>
<div class="rightText"  style="float: right;" id="phoneAccountSettings">   
<a href="#">Edit<a/>   
</div>
</div>
</div>

<!--This is used for the  connections box part 2-->
<div class="yourStaffBox2">
<div class="snapShotBox">
<center>
<?php
	if(isset($_SESSION['ORG_WEBSITE'])) 
	{
		if(substr($_SESSION['ORG_WEBSITE'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['ORG_WEBSITE'],'">',$_SESSION['ORG_WEBSITE'],'</a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['ORG_WEBSITE'],'">',$_SESSION['ORG_WEBSITE'],'</a>';	
		}

	}?>
<br>
<?php echo $_SESSION['ORG_PHONE'];?>
<br>
<?php
	if(isset($_SESSION['ORG_EMAIL'])) 
	{
		echo '<a href="mailto:',$_SESSION['ORG_EMAIL'],'"><img src="../images/email.png" width="20" height="20" alt="E-mail" /></a>';
	}

	if(isset($_SESSION['FACEBOOK_LINK'])) 
	{
		if(substr($_SESSION['FACEBOOK_LINK'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['FACEBOOK_LINK'],'"><img src="../images/fbook.png" width="20" height="20" alt="Facebook" /></a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['FACEBOOK_LINK'],'"><img src="../images/fbook.png" width="20" height="20" alt="Facebook" /></a>';	
		}
	}

	if(isset($_SESSION['TWITTER_LINK'])) 
	{
		if(substr($_SESSION['TWITTER_LINK'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['TWITTER_LINK'],'"><img src="../images/twitter.png" width="20" height="20" alt="Twitter" /></a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['TWITTER_LINK'],'"><img src="../images/twitter.png" width="20" height="20" alt="Twitter" /></a>';	
		}
		
	}

	if(isset($_SESSION['LINKEDIN_LINK'])) 
	{
		if(substr($_SESSION['LINKEDIN_LINK'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['LINKEDIN_LINK'],'"><img src="../images/linkedin.png" width="20" height="20" alt="Linked In" /></a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['LINKEDIN_LINK'],'"><img src="../images/linkedin.png" width="20" height="20" alt="Linked In" /></a>';	
		}

	}

	if(isset($_SESSION['BLOG_LINK'])) 
	{
		if(substr($_SESSION['BLOG_LINK'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['BLOG_LINK'],'"><img src="../images/blogger.png" width="20" height="20" alt="Blog" /></a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['BLOG_LINK'],'"><img src="../images/blogger.png" width="20" height="20" alt="Blog" /></a>';	
		}
	}

	if(isset($_SESSION['YOUTUBE_LINK'])) 
	{
		if(substr($_SESSION['YOUTUBE_LINK'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['YOUTUBE_LINK'],'"><img src="../images/youTube.png" width="20" height="20" alt="You Tube" /></a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['YOUTUBE_LINK'],'"><img src="../images/youTube.png" width="20" height="20" alt="You Tube" /></a>';	
		}
	}
?>

</center>
</div>
</div>

<!--This is used for the About Us box part 3-->
<div class="boxFormat5">
<div class="box3">
<br>
</div>
</div>

<!--This is used for the connections box 3-->
<div class="yourStaffBox2">
<div class="box1">
<br>
</div>
</div>




<div class="boxFormat11">
<div class="box9">
The Most Awesomest Volunteers
</div>
<div class="rightText"  style="float: left; padding: 0px 0px 0px 80px;">        
<a href="org-volunteer-mgmt.php?state=All">View All</a> |  <a href="invite-volunteers.php">Invite Volunteers</a>
</div>

<div class="slidersizing">
<ul id="slider">
</ul> <!-- end Slider #1 -->
</div>
</div>


<div class="boxFormat11">
<div class="box9">
Upcoming Programs
</div>
<div class="rightText"  style="float: right; padding: 0px 0px 0px 10px;">      

<a href="program-management-display.php?state=All">View all</a> | <a href="#" class="listViewShowHide" onclick="$('.calendar').fullCalendar('destroy');">List View</a> | <a href="#" onclick="makeCalendar();" class="calendarViewShowHide">Calendar View</a>


</div>
</div>

<div class="boxFormat17">
<div class="box15">
<div class="listView">
<div id='results2'>
</div>
</div>
<div class="calendarView">
<?php 
if(isset($_SESSION['SHOW_CALENDAR']))
{
		echo '<script>$(".listView").hide();</script>';
}

?>
<div class="calendar" style="width: 625px;">
</div>
</div>
</div>
</div>
<div id="popup5" class="popup_block">
<form id="addAdmins" name="addAdmins" method="post" action="add-org-admins.php">
<div id='results10' style="overflow-y: scroll;">
</div>
      <input type="submit" name="Submit" tabindex="6" value="Add Staff" />
</form>
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
</div>

</div>

</div>

<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script src="../js/popup.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script src="../js/jquery.movingboxes.js"></script>
<script type="text/javascript" src="../js/orgProgAndImages.js"></script>
<script type='text/javascript' src="../js/populateCalendar.js"></script>
<script type='text/javascript' src="../js/fullcalendar.min.js"></script>
<script type="text/javascript" src="../js/customPopupBox.js"></script>
<script src="../js/programMgmt.js" type="text/javascript" charset="utf-8"></script>


