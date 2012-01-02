<?php
	require_once('auth.php');
	
	include "populate-programs.php";
	
// make a note of the current working directory relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the location of the upload handler
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';

// set a max file size for the html upload form
$max_file_size = 3000000; // size in bytes

session_start();
	
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
	<?php
	
	
		$todaysDate = date("m/d/Y");
		$today = strtotime($todaysDate);
		$closestDate = '';
		$indexClosest = 0;
		for($i = 1; $i <= $_SESSION['PROGRAMS_CREATED']; $i++)
		{ //need to find what program is next
			$date = 'PROGRAM_DATE';
			$date .= $i;
			
			$programStatus = 'PROGRAM_STATUS';
			$programStatus .= $i;
			
			$programStartDate = strtotime($_SESSION[$date]);
			if(($programStartDate >= $today) && ($programStartDate != '') && ($_SESSION[$programStatus] == 'Published'))
			{
				if(($programStartDate < $closestDate) || ($closestDate == ''))
				{
					$closestDate = $programStartDate;
					$indexClosest = $i;
				}
			}
		}
		$programStatus = 'PROGRAM_STATUS';
		$programStatus .= $indexClosest;
	if(($_SESSION['PROGRAMS_CREATED']) >= 1 && ($_SESSION[$programStatus] == 'Published')) {
	
		$programName = 'PROGRAM_NAME';
		$programName .= $indexClosest;
			
		$date = 'PROGRAM_DATE';
		$date .= $indexClosest;
	
		$timeStart = 'PROGRAM_START_TIME';
		$timeStart .= $indexClosest;
		    
		$totalPositionsAvailable = 'POSITIONS_AVAIL';
		$totalPositionsAvailable .= $indexClosest;
				
		$programCity = 'PROGRAM_CITY';
		$programCity .= $indexClosest;
				
		$programState = 'PROGRAM_STATE';
		$programState .= $indexClosest;

			echo '<div id="orgHomeProgram">';
			echo $_SESSION[$programName];
			echo '</div>';	
			echo '<div id="programdateOrgHome">';	
			echo date('D, M jS',strtotime($_SESSION[$date])); echo date(' h:i A',strtotime($_SESSION[$timeStart]));
			echo '</div>';
			echo $_SESSION[$programCity]; echo ', '; echo  $_SESSION[$programState];
			echo '<br><br>';
			echo '<div id="programlinks" style="float:none!important; background-color:green; color:#000!important;">';	
			if($_SESSION[$totalPositionsAvailable] != '')
			{
				echo $_SESSION[$totalPositionsAvailable];
				echo ' More Volunteers Needed!';
			}
			echo '</div>';
			echo '<br>';
			echo '<div id="viewProgramLink" style="float:none">';	
			echo '<a href="program-manager.php?programname=',$_SESSION[$programName],'&orgname=',$_SESSION['ORG_NAME'],'"><img src="../images/viewprogram.png"  width="90" height="40"></a>';
			echo '</div>';
			echo '<br><br>';
			echo '<br>';
			echo '<div id="programopen">';	

			echo '</div><br>';	
		
	}
	else
	{
		echo '<center>You Have No Upcoming Programs! <br> <br><a href="create-program-part1.php"><img src="../images/createprograms.jpg"></a></center>';
	}
	?>
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
<a href="upcoming-programs-org.php">View All</a> |  <a href="calendar-view-programs.php">Calendar View</a>
</div>
</div>

<div class="boxFormat17">
<div class="box15">
<?php
	$displayedPrograms = 0;
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
		
	    $programStatus = 'PROGRAM_STATUS';
		$programStatus .= $i;
	    
		$totalPositionsAvailable = 'POSITIONS_AVAIL';
		$totalPositionsAvailable .= $i;
		
		$programDesc = 'PROGRAM_DESC';
		$programDesc .= $i;
				
		$programCity = 'PROGRAM_CITY';
		$programCity .= $i;
				
		$programState = 'PROGRAM_STATE';
		$programState .= $i;
		
		$todaysDate = date("m/d/Y");
		$today = strtotime($todaysDate);
		$programStartDate = strtotime($_SESSION[$date]);
		if(isset($_SESSION[$programName]) && ($displayedPrograms < 3) && ($programStartDate >= $today) && ($_SESSION[$programStatus] == 'Published')) 
		{
			$displayedPrograms += 1;
			echo '<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/',$_SESSION[$programImage],'" alt="Program Picture" width="180" height="120"></div>';
			echo '<div id="positionOrganizatonPage">';
			echo $_SESSION[$programName]; 
			echo '<div style="float:right; padding: 0px 10px 0px 10px; font:0.7em!important;"> ';
			echo '( '; echo $_SESSION[$programCity]; echo ', '; echo  $_SESSION[$programState]; echo ' )'; 
			echo '</div>';
			
			echo '</div>';
			echo '<br><br><br>';	
			echo '<div id="programdate">';	
			echo $_SESSION[$programDesc];
			echo '</div>';
			echo '<div id="programlinks" style="background-color:green; color:#000!important;">';	
			if($_SESSION[$totalPositionsAvailable] != '')
			{
				echo $_SESSION[$totalPositionsAvailable];
				echo ' More Needed!';
			}
			echo '</div>';
			echo '<br>';
			echo '<div id="viewProgramLink">';	
			echo '<a href="program-manager.php?programname=',$_SESSION[$programName],'&orgname=',$_SESSION['ORG_NAME'],'"><img src="../images/viewprogram.png"  width="90" height="40"></a>';
			echo '</div>';
			echo '<br><br>';
			echo '<div id="viewProgramLink">';	
			echo date('D, M jS',strtotime($_SESSION[$date])); echo date(' h:i A',strtotime($_SESSION[$timeStart]));
			echo '</div>';
			echo '<br>';
			echo '<div id="programopen">';	

			echo '</div><br>';	
			echo '<div class="clear"></div>';
			echo '<div class="boxFormat16">';
			echo '<div class="box17">';
			echo '</div>';
			echo '</div>';
		}
		$totalOpenPositions = 0;
	}
?>
</div>
</div>


</div>

</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>





