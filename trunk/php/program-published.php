<?php

	require_once('auth.php');
	
// make a note of the current working directory relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the location of the upload handler
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';

// set a max file size for the html upload form
$max_file_size = 3000000; // size in bytes
	if(isset($_SESSION['SESS_MEMBER_ID'])) 
	{
		if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
		{
				include "header-org.php";
				include "navigation.php";
		}
		else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
		{
					include 'header-vol.php';
					include 'navigation-vol.php';
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['ORG_NAME'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/collection.js"></script>
  <script src="../js/popup.js" type="text/javascript"></script>
  <SCRIPT LANGUAGE="JavaScript" SRC="../js/date.js"></SCRIPT>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
	

</head>
<body>

<div id="wrap">
<nav id="mainnavuser">
<br>
<div class="clear"></div>

<h3>
<div class="publishProgram"  style="text-align:center;">
Quick Tasks: <a href="edit-program.php"><img src="../images/editProgram.png" alt="edit program"  width="55" height="55"><a href="edit-volunteers.php"><img src="../images/editVolunteers.png" alt="edit program"  width="55" height="55"></a><a href="message-center-org-email.php"><img src="../images/emailProgram.png" width="55" height="55"></a><a href="message-center-org-voicemail.php"><img src="../images/voicemail.png" width="55" height="55"></a><a href="message-center-org-textmsg.php"><img src="../images/textmsg.png" width="55" height="55"></a><a href="message-center-org-programmsg.php"><img src="../images/programmsg.png" width="55" height="55"></a>
</div>
<div class="clear"></div>
<div class="programNameTitle">
<?php echo $_SESSION['PROGRAM_NAME'];?>

</div>
<div class="clear"></div>
<div class="orgAddress">
<?php 
	$dateSaved = 'PROGRAM_DATE';
	$dateSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$timeStartSaved = 'PROGRAM_START_TIME';
	$timeStartSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$endTimeSaved = 'PROGRAM_END_TIME';
	$endTimeSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$endDateSaved = 'PROGRAM_END_DATE';
	$endDateSaved .= $_SESSION['PROGRAMS_CREATED'];


	echo date('l, F jS Y',strtotime($_SESSION[$dateSaved])); echo ' at ';echo date(' h:i A',strtotime($_SESSION[$timeStartSaved]));
	if($_SESSION[$dateSaved] == $_SESSION[$endDateSaved]) //If its the same day show end time
	{
		echo ' to '; echo date(' h:i A',strtotime($_SESSION[$endTimeSaved]));
	}
	else if($_SESSION[$endDateSaved] == '')
	{
		echo ' to '; echo date(' h:i A',strtotime($_SESSION[$endTimeSaved]));
	}
	else
	{
		echo ' to ';
		echo date('l, F jS Y',strtotime($_SESSION[$endDateSaved])); echo ' at ';echo date(' h:i A',strtotime($_SESSION[$endTimeSaved]));
	}
?> 
<div class="clear"></div>
<?php 
		$programCitySaved = 'PROGRAM_CITY';
		$programCitySaved .= $_SESSION['PROGRAMS_CREATED'];
		
		$programStateSaved = 'PROGRAM_STATE';
		$programStateSaved .= $_SESSION['PROGRAMS_CREATED'];
		
		$programAddressSaved = 'PROGRAM_ADDRESS';
		$programAddressSaved .= $_SESSION['PROGRAMS_CREATED'];
		
		$programZipSaved = 'PROGRAM_ZIP';
		$programZipSaved .= $_SESSION['PROGRAMS_CREATED'];

		echo $_SESSION[$programAddressSaved]; echo ', '; echo $_SESSION[$programCitySaved]; echo ', '; echo $_SESSION[$programStateSaved]; echo ' '; echo $_SESSION[$programZipSaved];
		
?>
		
</div>
</h3>
<div class="clear"></div>
<div class="thumbnailOrg">
	<?php
	if(($_SESSION['PROGRAM_IMAGE']) == true) {
	
		echo '<div id="login"><img src="uploaded_files/',$_SESSION['PROGRAM_IMAGE_PATH'],'" alt="Program Picture" width="320" height="240"></div>';
	}
	?>
<br>
</div>



<!--This is used for the upcoming vollys box-->
<div class="boxFormat">
<div class="TextBox1">
<div class="leftText" style="float: left;">
 Summary
</div>
<div class="rightText"  style="float: right;">        
<a href="create-program-part1.php">Edit Program Info</a>
</div>
</div>
</div>

<div class="boxFormat2">
<div class="nextProgramsPublished">
<center>
<?php 
	$dateSaved = 'PROGRAM_DATE';
	$dateSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$timeStartSaved = 'PROGRAM_START_TIME';
	$timeStartSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$endTimeSaved = 'PROGRAM_END_TIME';
	$endTimeSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$endDateSaved = 'PROGRAM_END_DATE';
	$endDateSaved .= $_SESSION['PROGRAMS_CREATED'];


	echo date('D, M jS Y',strtotime($_SESSION[$dateSaved])); echo ' at ';echo date(' h:i A',strtotime($_SESSION[$timeStartSaved]));
	if($_SESSION[$dateSaved] == $_SESSION[$endDateSaved]) //If its the same day show end time
	{
		echo ' to '; echo date(' h:i A',strtotime($_SESSION[$endTimeSaved]));
	}
	else if($_SESSION[$endDateSaved] == '')
	{
		echo ' to '; echo date(' h:i A',strtotime($_SESSION[$endTimeSaved]));
	}
	else
	{
		echo ' to ';
		echo date('D, M jS Y',strtotime($_SESSION[$endDateSaved])); echo ' at ';echo date(' h:i A',strtotime($_SESSION[$endTimeSaved]));
	}
?> <div class="clear"></div><b>
<?php echo $_SESSION['PROGRAM_NAME'];?></b><br>
<?php 
		$programCitySaved = 'PROGRAM_CITY';
		$programCitySaved .= $_SESSION['PROGRAMS_CREATED'];
		
		$programStateSaved = 'PROGRAM_STATE';
		$programStateSaved .= $_SESSION['PROGRAMS_CREATED'];
		
		$programAddressSaved = 'PROGRAM_ADDRESS';
		$programAddressSaved .= $_SESSION['PROGRAMS_CREATED'];
		
		$programZipSaved = 'PROGRAM_ZIP';
		$programZipSaved .= $_SESSION['PROGRAMS_CREATED'];

		echo $_SESSION[$programCitySaved]; echo ', '; echo $_SESSION[$programStateSaved];
		
?><br>
<br>
<?php echo $_SESSION['PROGRAM_DESCRIPTION'];?> 
</center>
</div>
</div>
<div class="boxFormat2">
<div class="box1">
<br>
</div>
</div>
<div class="publishedProgramPageVols">
<div class="box9">
People Volunteering for This Program
</div>
</div>
<div class="clear"></div>
<br><br>
<!-- MovingBoxes Slider -->
<ul id="slider">
<?php
	for($i = 1; $i <= $_SESSION['PROGRAM_VOLUNTEERS']; $i++)
	{
		echo '<li>';
		echo '<a href="volunteer-profile.php?volname=',$_SESSION['VOLUNTEER_NAME'],'<img src=""uploaded_files/',$_SESSION['VOLUNTEER_IMAGE'],'" alt="Vol Picture">';	
		echo '<p>',$_SESSION['VOLUNTEER_NAME'],'</p>';
		echo '</li>';		
	}
?>
</ul> <!-- end Slider #1 -->

<br><br>

<!--This is used for the Program Coordinators box-->
<div class="programCoords">
<div class="box3">
<div class="leftText" style="float: left;">
   Program Coordinators
</div>
<div class="rightText"  style="float: right;">        
<a href="create-program-part1.php">Edit Program Coordinators</a>
</div>

</div>
</div>




<!--This is used for the  open positions box-->
<div class="openPositions">
<div class="TextBox1">
<div class="leftText" style="float:left; font:bold 1.0em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 0px 0px 80px;">
<?php echo $_SESSION['POSITIONS_CREATED'];?>  Open Positions
</div>
<div class="rightText"  style="float: right;">        
<a href="create-program-part3.php">add positions</a>
</div>
</div>
</div>


<!--This is used for the Program Coordinators box part 2-->
<div class="programCoordsBox2">
<div class="snapShotBox">

</div>
</div>


<!--This is used for the  open positions box part 2-->
<div class="boxFormat2">
<div class="openPositionsAvail">
<div id="positionsToFill">
<div id="positionProgramHead">
Open Position
</div>
<div id="positionsOpenProgram">
Need
</div>
<div id="positionsClosedProgram">
Filled  
</div>
<div id="actionsProgram">
      
</div>
</div>
<div class="clear"></div>

<?php

	for($i = 1; $i <= $_SESSION['POSITIONS_CREATED']; $i++)
	{
		$posName = 'POSITION_NAME';
		$posName .= $i;
	
		$numOpen = 'NUM_OPEN';
		$numOpen .= $i;
		
		$numClosed = 'NUM_FILLED';
		$numClosed .= $i;
		
		$remove = 'REMOVE';
		$remove .= $i;
		if( isset($_SESSION[$posName]) && isset($_SESSION[$numOpen])) {
		echo '<div id="positionProgram">';
		echo $_SESSION[$posName];
		echo '</div>';
		echo '<div id="positionsOpenProgram">';
		echo $_SESSION[$numOpen];
		echo '</div>';
		echo '<div id="positionsbox">';
		echo '<div id="positionsClosedProgram">';
		echo $_SESSION[$numClosed];
		echo '</div>';
		echo '</div>';
		echo '<div id="actionsProgram">';
		echo '<input type="image" name="Submit" value="',$remove,'"  src="../images/edit.png" height="20" width="50"/>';
		echo '</div>';		
		
		echo '<div class="clear"></div>';
		
		
		}
	}
?>
</div>
</div>
<div class="clear"></div>
<!--This is used for the Program Coordinators box part 3-->
<div class="programCoordsBox2">
<div class="box3">
<br>
</div>
</div>



<!--This is used for the  open positions  box part 3-->
<div class="connections3Box">
<div class="box1">
<br>
</div>
</div>




<!--This is used for the  program msgs box-->
<div class="programMsgs">
<div class="box3">
<div class="leftText" style="float: left;">
 Program Messages...
</div>
<div class="rightText"  style="float: right;">        
<a href="program-message.php">Add New Messages</a>
</div>
</div>
</div>
<div class="clear"></div>

<!--This is used for the  program msgs box part 2-->
<div class="programMsgBox2">
<div class="programMessages">
	<?php
	if(($_SESSION['PROGRAM_MSG']) == true) {
	
		echo '';
	}
	else
	{
		echo '<center>No Posted Messages <br> <br><a href="program-message.php"><img src="../images/programmsg.jpg"></a></center>';
	}
	?>
</div>
</div>

<div class="clear"></div>
<!--This is used for the program msgs box part 3-->
<div class="programCoordsBox2">
<div class="box3">
<br>
</div>
</div>

<div class="clear"></div>

<!--This is used for the  programs box-->
<div class="programMsgs">
<div class="box3">
<div class="leftText" style="float: left;">
More Programs at <?php echo $_SESSION['ORG_NAME'];?>!
</div>
<div class="rightText"  style="float: right;">        
<a href="view-all-programs.php">View all programs</a>
</div>
</div>
</div>

<div class="clear"></div>
<!--This is used for the  programs part 2-->
<div class="programMsgBox2">
<div class="programMessages">
	<?php
	if(($_SESSION['PROGRAMS']) == true) {
	
		echo '';
	}
	else
	{
		echo '<center>You Have No Upcoming Programs! <br> <br><a href="create-org-programs.php"><img src="../images/createprograms.jpg"></a></center>';
	}
	?>
</div>
</div>

<div class="clear"></div>
<!--This is used for the programs part 3-->
<div class="programCoordsBox2">
<div class="box3">
<br>
</div>
</div>



<br>
<div class="clear"></div>
<br>


</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>





