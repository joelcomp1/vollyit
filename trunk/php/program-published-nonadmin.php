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
<title>Volly.it: <?php echo $_SESSION['PROGRAM_NAME'];?> Program</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<!-- used for the form vaidation -->
<link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="../css/template.css" type="text/css"/>

<!-- Moving Box CSS/JS -->
<link href="../css/movingboxes.css" media="screen" rel="stylesheet">
  <script type="text/javascript">
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-program-vol-images.php",
			success: function(msg)
			{
				$("#slider").html(msg);
				$('#slider').movingBoxes({
				startPanel   : 1,      // start with this panel
				wrap         : true,   // if true, the panel will "wrap" (it really rewinds/fast forwards) at the ends
				buildNav     : true,   // if true, navigation links will be added
				navFormatter : function(){ return "&#9679;"; } // function which returns the navigation text for each panel
				});
			}
		});
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "posted-program-messages.php",
			success: function(msg)
				{
				$("#results2").html(msg);
	
				}
		});



	function addHidden(positionName, divName)
	{
		positionSelected.value = positionName;
  
	}
 
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine

			jQuery("#addPhoneAndVolly").validationEngine();
		});


	</script>

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
	
	
	if($_SESSION['VOLLY_JUST_ADDED'] == 'true') {

		echo '<a href="#?w=500" rel="popup4" class="poplight"></a>';
		session_start();		
		$_SESSION['VOLLY_JUST_ADDED'] = false;
	}
	

	
	?>
<div id="wrap">
<nav id="mainnavuser">
<br>
<div class="clear"></div>

<h3>
<div class="clear"></div>
<div class="programNameTitle">
<?php echo $_SESSION['PROGRAM_NAME'];?>

</div>
<div class="clear"></div>
<div class="orgAddress">
<?php echo $_SESSION[$programAddressSaved];?> - 
<?php echo  $_SESSION[$programCitySaved];?>, 
<?php echo $_SESSION[$programStateSaved];?> 
<?php echo $_SESSION[$programZipSaved];?> -
<a target="_blank" href="http://maps.google.com/?q=<?php echo $_SESSION[$programAddressSaved]; echo ','; echo  $_SESSION[$programCitySaved]; echo ','; echo $_SESSION[$programStateSaved]; echo ','; echo $_SESSION[$programZipSaved];?>">Map It</a>
<?php 

			echo '<a href="https://www.facebook.com/sharer/sharer.php?u=http://volly.it&t=Help Change the World!"><img src="../images/facebook.png" width="62" height="22" alt="Facebook" /></a>';	

	
			echo '<a href="https://twitter.com/intent/tweet?text=I think you should help me change the world! I am Volunteering with ',$_SESSION['ORG_NAME_VIEW'],' at ',$_SESSION['PROGRAM_NAME'],' and you should too!"><img src="../images/twittershare.png" width="62" height="22" alt="Twitter" /></a>';	
	
	?>
	
<a href="#"><img src="../images/message.png" width="99" height="34"></a>
		
</div>
<?php

if($_SESSION['VOLLYING_FOR_PROGRAM'] == 'true')
{
		echo '<h1>You Are Volunteering for this Program! <a href="#" onclick="';
		echo "popup(400, 'popup3');";
		echo '"class="poplight">Cant make it?</a></h1>';



}?>
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

<div class="slidersizing" style="margin: 0 0 0 80px;">
<ul id="slider">
</ul> <!-- end Slider #1 -->
</div>



<div class="clear"></div>

<br><br>

<!--This is used for the Program Coordinators box-->
<div class="programCoords">
<div class="box3">
<div class="leftText" style="float: left;">
   Program Coordinators
</div>


</div>
</div>




<!--This is used for the  open positions box-->
<div class="openPositions">
<div class="TextBox1">
<div class="leftText" style="float:left; font:bold 1.0em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 0px 0px 80px;">
<?php echo $_SESSION['POSITIONS_CREATED'];?>  Open Positions
</div>

</div>
</div>


<!--This is used for the Program Coordinators box part 2-->
<div class="programCoordsBox2">
<div class="snapShotBox" style="overflow-y: scroll;">
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
		echo '<a href="#" onclick="';
		echo "popup(450, 'popup5'); addHidden('",$_SESSION[$posName],"', 'positionProgram');";
		echo '"class="poplight">Volly It!</a>';
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
<!--a href="program-message.php">View all Messages</a-->
</div>
</div>
</div>
<div class="clear"></div>

<!--This is used for the  program msgs box part 2-->
<div id="results2">
</div>

<div class="clear"></div>
<!--This is used for the program msgs box part 3-->
<div class="programCoordsBox2">
<div class="box3">
<br>
</div>
</div>

<div class="clear"></div>
<div id="popup5" class="popup_block" style="text-align:center;">
<?php if(($_SESSION['VOL_PHONE_PART_1'] != '') || ($_SESSION['VOL_PHONE_PART_2'] != '') || ($_SESSION['VOL_PHONE_PART_3'] != ''))
{
?>
	<h2>Almost done...</h2>
	<div class="clear"></div>
	<p>You are about to share your phone number with <?php echo $_SESSION['ORG_NAME']; ?>.<br>
	
	
<form id="addPhoneAndVolly2" name="addPhoneAndVolly2" method="post" action="add-phone-and-volly.php">
<input id="positionSelected" name="positionSelected" value="none" type=hidden>
Phone: <span>
<input type="tel" id="phone1" name="phone1" 
    size="4" onKeyup="autotab(this, document.addPhoneAndVolly.phone2)" data-validation-engine="validate[required,minSize[3]]" class="text-input" size="3" tabindex="4"  maxlength=3 value="<?php echo $_SESSION['VOL_PHONE_PART_1'];?>" />
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone2" name="phone2" 
    size="4" onKeyup="autotab(this, document.addPhoneAndVolly.phone3)" data-validation-engine="validate[required,minSize[3]]" class="text-input" size="3"  tabindex="5" maxlength=3 value="<?php echo $_SESSION['VOL_PHONE_PART_2'];?>"> 
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone3" name="phone3" size="4" maxlength="4" data-validation-engine="validate[required,minSize[4]]" class="text-input" tabindex="6" value="<?php echo $_SESSION['VOL_PHONE_PART_3'];?>">
</span>
<div class="clear"></div><br>
<input type="submit" name="Submit" value="Volly It!"></form>
<div class="clear"></div><br>
Why do you need my phone number? When volunteering for a program, <?php echo $_SESSION['ORG_NAME']; ?> may need to get a hold of you.<br>
We respect your privacy: your phone number will only be shared with organizations you are volunteering for. <br>
Check out our full <a href="legalstuff.php#usage-tab">Privacy Policy</a> for more details.
	<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a></p>
	<?php

}
else
{
	?>
	<h2>Almost done...</h2>
	<div class="clear"></div>
	<p>Looks like there is not a phone number tied to your profile.  Please enter phone number below.<br>
	
<form id="addPhoneAndVolly" name="addPhoneAndVolly" method="post" action="add-phone-and-volly.php">
<input id="positionSelected"  name="positionSelected" value="none" type=hidden>
Phone: <span>
<input type="tel" id="phone1" name="phone1" 
    size="4" onKeyup="autotab(this, document.addPhoneAndVolly.phone2)"  data-validation-engine="validate[required,minSize[3]]" class="text-input"  size="3" tabindex="4"  maxlength=3 value="<?php echo $_SESSION['VOL_PHONE_PART_1'];?>">
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone2" name="phone2" 
    size="4" onKeyup="autotab(this, document.addPhoneAndVolly.phone3)" data-validation-engine="validate[required,minSize[3]]"  size="3"  tabindex="5" maxlength=3 value="<?php echo $_SESSION['VOL_PHONE_PART_2'];?>"> 
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone3" name="phone3" size="4" maxlength="4" data-validation-engine="validate[required,minSize[4]]" tabindex="6" value="<?php echo $_SESSION['VOL_PHONE_PART_3'];?>">
</span>
<div class="clear"></div><br>
<input type="submit" name="Submit"  value="Volly It!"></form>
<div class="clear"></div><br>
Why do you need my phone number? When volunteering for a program, <?php echo $_SESSION['ORG_NAME']; ?> may need to get a hold of you.<br>
We respect your privacy: your phone number will only be shared with organizations you are volunteering for. <br>
Check out our full <a href="legalstuff.php#usage-tab">Privacy Policy</a> for more details.
<div class="clear"></div><br>
	<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a></p>
	<?php

}
?>

</div>



<div id="popup4" class="popup_block" style="text-align:center;">

	<h2>Bodacious!</h2>
	<div class="clear"></div>
	<p>You have successfully volunteered for:<br>
	<div class="clear"></div><br>
	<?php
	if(($_SESSION['PROGRAM_IMAGE']) == true) {
	
		echo '<div id="login" style="float:left;"><img src="uploaded_files/',$_SESSION['PROGRAM_IMAGE_PATH'],'" alt="Program Picture" width="240" height="180"></div>';
	}
	?>
	<b>Organization:</b><?php echo $_SESSION['ORG_NAME']; ?>
	<br>
	<b>Program:</b><?php echo $_SESSION['PROGRAM_NAME']; ?>
	<br>
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
	}?>
	<div class="clear"></div><br>
	<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a></p>
	We have sent you an e-mail confirmation.  Thanks for making a difference!
	<?php


?>

</div>


<div id="popup3" class="popup_block" style="text-align:center;">


	<h2>Cannot Make This Program?</h2>
	<div class="clear"></div>
	<p style="text-align:center;">Can't make it? Click the button below if you with to be removed from the program.<br>
	A notification will be sent to the organization that you can no longer make this program.
		<div class="clear"></div><br>
	<a href="cant-make-program.php">Can't Make It</a>
		<div class="clear"></div><br>
	<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Cancel</a></p>
</div>


</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>

<script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>
<script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
<script src="../js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../js/populateProgramCoords.js"></script>
<script type="text/javascript" src="../js/customPopupBox.js"></script>
<script src="../js/jquery.movingboxes.js"></script>
<script language="javascript" src="../js/autoTab.js"></script>




