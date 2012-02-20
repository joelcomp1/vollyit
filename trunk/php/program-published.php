<?php

	require_once('auth.php');
	
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

	

</head>
<body>
	<?php
	$dateSaved = 'PROGRAM_DATE';
	$dateSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$timeStartSaved = 'PROGRAM_START_TIME';
	$timeStartSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$endTimeSaved = 'PROGRAM_END_TIME';
	$endTimeSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$endDateSaved = 'PROGRAM_END_DATE';
	$endDateSaved .= $_SESSION['PROGRAMS_CREATED'];

	$programCitySaved = 'PROGRAM_CITY';
	$programCitySaved .= $_SESSION['PROGRAMS_CREATED'];
		
	$programStateSaved = 'PROGRAM_STATE';
	$programStateSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$programAddressSaved = 'PROGRAM_ADDRESS';
	$programAddressSaved .= $_SESSION['PROGRAMS_CREATED'];
		
	$programZipSaved = 'PROGRAM_ZIP';
	$programZipSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	if(true) {
		echo '<a href="#?w=350" rel="popup5" class="poplight"></a>';	
	}
	?>
<div id="wrap">
<nav id="mainnavuser">
<br>
<div class="clear"></div>

<h3>
<div class="publishProgram"  style="text-align:center;">
Quick Tasks: <a href="create-program-part1.php?name=<?php echo $_SESSION['PROGRAM_NAME']; ?>&image=<?php echo $_SESSION['PROGRAM_IMAGE_PATH']; ?>&address=<?php echo $_SESSION[$programAddressSaved]; ?>&state=<?php echo $_SESSION[$programStateSaved]; ?>&city=<?php echo $_SESSION[$programCitySaved]; ?>&zip=<?php echo $_SESSION[$programZipSaved]; ?>&descrip=<?php echo $_SESSION['PROGRAM_DESCRIPTION']; ?>&startDate=<?php echo $_SESSION[$dateSaved]; ?>&enddate=<?php echo $_SESSION[$endDateSaved]; ?>&startTime=<?php echo $_SESSION[$timeStartSaved]; ?>&endtime=<?php echo $_SESSION[$endTimeSaved]; ?>"><img src="../images/editProgram.png" alt="edit program"  width="55" height="55"><a href="edit-volunteers.php"><img src="../images/editVolunteers.png" alt="edit program"  width="55" height="55"></a><a href="message-center-org-email.php"><img src="../images/emailProgram.png" width="55" height="55"></a><a href="message-center-org-voicemail.php"><img src="../images/voicemail.png" width="55" height="55"></a><a href="message-center-org-textmsg.php"><img src="../images/textmsg.png" width="55" height="55"></a><a href="#"  onclick="popup(350, 'popup6');" rel="popup6" class="poplight"><img src="../images/programmsg.png" width="55" height="55"></a><a href="#"><img src="../images/print.png" width="55" height="55"></a>
</div>
<div class="clear"></div>
<div class="programNameTitle">
<?php echo $_SESSION['PROGRAM_NAME'];?>

</div>
<div class="clear"></div>
<div class="orgAddress">
<?php 

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

<?php 
	$dateSaved = 'PROGRAM_DATE';
	$dateSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$timeStartSaved = 'PROGRAM_START_TIME';
	$timeStartSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$endTimeSaved = 'PROGRAM_END_TIME';
	$endTimeSaved .= $_SESSION['PROGRAMS_CREATED'];
	
	$endDateSaved = 'PROGRAM_END_DATE';
	$endDateSaved .= $_SESSION['PROGRAMS_CREATED'];
	
?>

<!--This is used for the upcoming vollys box-->
<div class="boxFormat">
<div class="TextBox1">
<div class="leftText" style="float: left;">
 Summary
</div>
<div class="rightText"  style="float: right;">        
<a href="create-program-part1.php?name=<?php echo $_SESSION['PROGRAM_NAME']; ?>&image=<?php echo $_SESSION['PROGRAM_IMAGE_PATH']; ?>&address=<?php echo $_SESSION[$programAddressSaved]; ?>&state=<?php echo $_SESSION[$programStateSaved]; ?>&city=<?php echo $_SESSION[$programCitySaved]; ?>&zip=<?php echo $_SESSION[$programZipSaved]; ?>&descrip=<?php echo $_SESSION['PROGRAM_DESCRIPTION']; ?>&startDate=<?php echo $_SESSION[$dateSaved]; ?>&enddate=<?php echo $_SESSION[$endDateSaved]; ?>&startTime=<?php echo $_SESSION[$timeStartSaved]; ?>&endtime=<?php echo $_SESSION[$endTimeSaved]; ?>">Edit Program Info</a>

</div>
</div>
</div>

<div class="boxFormat2">
<div class="nextProgramsPublished">
<center>
<?php 



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
<a href="create-program-part1.php?name=<?php echo $_SESSION['PROGRAM_NAME']; ?>&image=<?php echo $_SESSION['PROGRAM_IMAGE_PATH']; ?>&address=<?php echo $_SESSION[$programAddressSaved]; ?>&state=<?php echo $_SESSION[$programStateSaved]; ?>&city=<?php echo $_SESSION[$programCitySaved]; ?>&zip=<?php echo $_SESSION[$programZipSaved]; ?>&descrip=<?php echo $_SESSION['PROGRAM_DESCRIPTION']; ?>&startDate=<?php echo $_SESSION[$dateSaved]; ?>&enddate=<?php echo $_SESSION[$endDateSaved]; ?>&startTime=<?php echo $_SESSION[$timeStartSaved]; ?>&endtime=<?php echo $_SESSION[$endTimeSaved]; ?>">Edit Program Coordinators</a>
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
<div id='results'>
</div>
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
<a href="program-message.php">Post New Message</a>
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
		echo '<center>No Posted Messages <br> <br><a href="program-message.php"><img src="../images/programmsg.png"></a></center>';
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





<br>
<div class="clear"></div>
<br>
<div id="popup5" class="popup_block">
	<h2 style=" padding:0px 0 0 30px!important; float:none; text-align: center;">Your Program Has Published</h2><br>
	<p id="contactArea" style=" padding:0px 0 0 30px!important; float:none; text-align: center;">
			An e-mail notification will be sent to your volunteers.  You can also:</p>
<a href="https://www.facebook.com/sharer/sharer.php?u=http://volly.it&t=Help Change the World!"><img src="../images/facebook.png" width="62" height="22" alt="Facebook" /></a>


<a href="https://twitter.com/intent/tweet?text=@<?php echo $_SESSION['ORG_NAME'];?> posted a new volunteer opportunity on Volly.it.  Check it out bit.ly">
<img src="../images/twittershare.png" width="62" height="22" alt="Twitter" /></a>



	
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
<!--/div-->

</div>
<div id="popup6" class="popup_block">
	<h2 style=" padding:0px 0 0 30px!important; float:none; text-align: center;">Post Message</h2><br>
	<p id="contactArea" style=" padding:0px 0 0 0px!important; float:none; text-align: center;">
	

Program Name
<div class="clear"></div>


<input id="Field1" name="Field1" type="text" class="field text large" maxlength="255" tabindex="1" value="Subject" onfocus="this.value = this.value=='Subject' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Subject' : this.value; this.value=='Subject' ? this.style.color='#999' : this.style.color='#000'" />
<div class="clear"></div>


Program Description
<div class="clear"></div>
<div style="">
<textarea id="Field3" 
name="Field3" 
class="field textarea medium" 
spellcheck="true" 
rows="10" cols="30" 
tabindex="2" 
style="resize: none;"
 ></textarea>
</div>
<div class="clear"></div>
<div id="emailNot" name="emailNot" style="float:left;">
<input type="checkbox" name="emailNot" value="emailNotification" id="emailNot" tabindex="3"/> Send e-mail notification<br/>
</div>
<div id="postFb" name="postFb" style="float:left;">
<input type="checkbox" name="postFb" value="postToFB" id="postFb" tabindex="4"/> Post To Facebook<br/>
</div>
<div id="postT" name="postT" style="float:left;">
<input type="checkbox" name="postT" value="postToT" id="postT" tabindex="5"/>  Post To Twitter<br/>
</div></p>
<div class="clear"></div>



	
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
<!--/div-->

</div>
</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script type="text/javascript" src="../js/populateProgramCoords.js"></script>
<script type="text/javascript" src="../js/customPopupBox.js"></script>



