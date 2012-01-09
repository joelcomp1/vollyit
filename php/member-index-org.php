<?php
	require_once('auth.php');
	
// make a note of the current working directory relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the location of the upload handler
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';

// set a max file size for the html upload form
$max_file_size = 3000000; // size in bytes

session_start();
	
$_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
	
include "header-org.php";
include "navigation.php";



?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['ORG_NAME'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="../js/collection.js"></script>
   <script type="text/javascript" src="../js/jquery.js"></script>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
  <script src="../js/popup.js" type="text/javascript"></script>
<script src="../js/jquery.ez-pinned-footer.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery-1.5.1.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
$(function(){

		$("#search-text").animate({"width":"229px"});
		$("#results").fadeOut();
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-org-page.php",
			success: function(msg)
				{
				$("#results").html(msg);
				$("#results").fadeIn();
				}
		});
		
		
		$("#search-text").animate({"width":"229px"});
		$("#results2").fadeOut();
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-org-page-bottom.php",
			success: function(msg)
				{
				$("#results2").html(msg);
				$("#results2").fadeIn();
				}
		});
});	


</script>
</head>
<body>
<div id="wrap">
<div id="mainnavuser">
<div class="clear"></div>
<h3>
<?php echo $_SESSION['ORG_NAME'];?>
<div class="createNewProgram"  style="float:right; padding: 5px 5px 0px 0px;">
<a href="create-program-part1.php"><img src="../images/program.png" width="150" height="80"></a>
</div>
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
 Your Next Program...
</div>
<div class="rightText"  style="float: right;">        
<a href="program-management-org.php?state=all">view all</a>
</div>
</div>
</div>

<div class="boxFormat2">
<div class="nextPrograms">
<div id='results'>
</div>
</div>
</div>
<div class="boxFormat2">
<div class="box1">
<br>
</div>
</div>








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
<a href="volunteers-in-org.php"><img src="../images/emptyIcon.jpg" width="30" height="40" ></a>
<br>
Volunteers
</div>
<div class="upcomingSnapshot" style="float: left; font:bold 0.6em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 9px; text-align:center;">

<a href="program-management-org.php?state=upcoming"><img src="../images/emptyIcon.jpg" width="30" height="40" ></a>
<br>
Upcoming Programs

</div>
<div class="pastProgramsSnapshot" style="float: left; font:bold 0.6em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 9px; text-align:center;">
<a href="program-management-org.php?state=past"><img src="../images/emptyIcon.jpg" width="30" height="40" ></a>
<br>
Past Programs
</div>
<div class="collabSnapshot" style="float: left; font:bold 0.6em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 9px; text-align:center;">
<a href="collaborations-org.php"><img src="../images/emptyIcon.jpg" width="30" height="40" ></a>
<br>
Collaborations
</div>
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
<a href="view-all-org-staff.php">View All</a> |  <a href="add-admins.php">Add Admins</a>
</div>
</div>
</div>


<!--This is used for the  your staff  box part 2-->
<div class="yourStaffBox2">
<div class="yourStaffboxContent">
<br>
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
<a href="#">Edit Connections<a/>   
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
		echo '<a href="http://',$_SESSION['ORG_WEBSITE'],'">',$_SESSION['ORG_WEBSITE'],'</a>';
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
		echo '<a href="http://',$_SESSION['FACEBOOK_LINK'],'"><img src="../images/fbook.png" width="20" height="20" alt="Facebook" /></a>';
	}

	if(isset($_SESSION['TWITTER_LINK'])) 
	{
		echo '<a href="http://',$_SESSION['TWITTER_LINK'],'"><img src="../images/twitter.png" width="20" height="20" alt="Twitter" /></a>';
	}

	if(isset($_SESSION['LINKEDIN_LINK'])) 
	{
		echo '<a href="http://',$_SESSION['LINKEDIN_LINK'],'"><img src="../images/linkedin.png" width="20" height="20" alt="Linked In" /></a>';
	}

	if(isset($_SESSION['BLOG_LINK'])) 
	{
		echo '<a href="http://',$_SESSION['LINKEDIN_LINK'],'"><img src="../images/blogger.png" width="20" height="20" alt="Blog" /></a>';
	}

	if(isset($_SESSION['YOUTUBE_LINK'])) 
	{
		echo '<a href="http://',$_SESSION['YOUTUBE_LINK'],'"><img src="../images/youTube.png" width="20" height="20" alt="You Tube" /></a>';
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
<div class="rightText"  style="float: right; padding: 0px 0px 0px 50px;">        
<a href="view-all-volunteers-org.php">View All</a> |  <a href="invite-volunteers.php">Invite Volunteers</a>
</div>
</div>


<div class="boxFormat11">
<div class="box9">
Upcoming Programs
</div>
<div class="rightText"  style="float: right; padding: 0px 0px 0px 65px;">        
<a href="program-management-org.php?state=all">View all</a> |  <a href="program-management-org.php?state=calendar">Calendar View</a>
</div>
</div>

<div class="boxFormat17">
<div class="box15">
<div id='results2'>
</div>

</div>
</div>


</div>

</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>





