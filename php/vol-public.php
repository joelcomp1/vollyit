<?php
	require_once('auth.php');

	session_start();
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['VOL_USER_FIRST_NAME'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">

</head>

<body>



<div id="wrap">
<div id="mainnavuser">
<br>


<div class="clear"></div>
<h3>
</h3>
<div class="clear"></div>
<div class="thumbnail">
		<?php
	if(($_SESSION['VOL_USER_IMAGE']) == true) {
	
		echo '<div id="login"><img src="uploaded_files/',$_SESSION['IMAGE_USER_PATH'],'" alt="User Picture" width="320" height="240"></div>';
	}
	else
	{//This name is decieving, i am using the login pop up for the image upload.....
		echo '<div id="login">
<img src="../images/nophoto.png" width="320" height="240" alt="header image2""> 
</div>';
	}
	?>
<br>
<h4>
<?php echo $_SESSION['VOL_USER_FIRST_NAME']; echo ' '; echo $_SESSION['VOL_USER_LAST_NAME'];?></h4>
<div class="clear"></div>
<?php 
if(($_SESSION['VOL_FRIEND_STATUS'] != '') && ($_SESSION['VOL_FRIEND_STATUS'] != 'ACCEPTED'))
{
	echo 'Your Friend Request Has Been Sent<br>';
}
else if(($_SESSION['VOL_FRIEND_STATUS'] == 'ACCEPTED') || ($_SESSION['SESS_ORG_OR_VOL'] == 'ORG'))
{
}
else
{
	echo '<a href="add-friend.php">Add Me As Your Friend</a><br>';
	echo 'A Dolphin will smile if you do';

	}?>
	
<div id="popupContact">
	<center>
	
	</div>
	<div id="backgroundPopup"></div>
</div>

<!--This is used for the upcoming vollys box-->
<div class="boxFormat">
<div class="box1">
<div class="leftText" style="float: left;">
 <?php echo $_SESSION['VOL_USER_FIRST_NAME'];?>'s Upcoming Volly
</div>
<div class="rightText"  style="float: right;">       
<a href="#" onclick="popup(250, 'popup6');" class="poplight">view all</a>

</div>
</div>
</div>
<div class="boxFormat2">
<div class="box2">
<div id='results5'>
</div>
</div>
</div>
<div class="boxFormat2">
<div class="box1">
<br>
</div>
</div>

<!--This is used for the snapshot box-->
<div class="boxFormat3">
<div class="box1">
   Snapshot
</div>
</div>
<div class="boxFormat2">
<div class="box2">
<div class="volunteersSnapshot" style="float: left; font:bold 0.8em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 5px;">
<center>
<a href="#" onclick="popup(250, 'popup5');" class="poplight"><img src="../images/emptyIcon.jpg" width="40" height="40" ></a>
<br>
Organizations
</center>
</div>
<div class="upcomingSnapshot" style="float: left; font:bold 0.8em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 5px;">
<center>
<a href="#" onclick="popup(250, 'popup4');" class="poplight"><img src="../images/emptyIcon.jpg" width="40" height="40" ></a>
<br>
Friends
</center>
</div>
<div class="pastProgramsSnapshot" style="float: left; font:bold 0.8em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 5px;">
<center>
<a href="#" onclick="popup(250, 'popup6');" class="poplight"><img src="../images/emptyIcon.jpg" width="40" height="40" ></a>
<br>
Upcoming Vollys
</center>
</div>
<div class="collabSnapshot" style="float: left; font:bold 0.8em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 5px;">
<center>
<a href="#" onclick="popup(250, 'popup7');" class="poplight"><img src="../images/emptyIcon.jpg" width="40" height="40" ></a><br>
Past Vollys
</center>
</div>
</div>
</div>
<div class="boxFormat2">
<div class="box1">
<br>
</div>
</div>


<!--This is used for the about box-->
<div class="boxFormat4">
<div class="box3">
<div id="aboutMeLeft" style="float:left;">
   About Me 
</div>
</div>
</div>

<!--This is used for the users organizations box-->
<div class="boxFormat7">
<div class="box1">
<div class="leftText" style="float: left;">
 <?php echo $_SESSION['VOL_USER_FIRST_NAME'];?>'s  Organizations
</div>
<div class="rightText"  style="float: right;">        
<a href="#" onclick="popup(250, 'popup5');" class="poplight">view all</a>
</div>

</div>
</div>


<!--This is used for the about box part 2-->
<div class="boxFormat5">
<div class="box5">
<div style="text-align:left;">

 <?php echo $_SESSION['VOL_USER_ABOUTME'];?></textarea>

</div>
</div>
</div>


<!--This is used for the about box part 3-->

<div id='results2'>
</div>


<!--This is used for the users organizations box part 3-->
<div class="boxFormat2">
<div class="box1">
<br>
</div>
</div>

<!--This is used for the Friends box-->

<div id='results'>
</div>



<!--This is used for the About me box part 3-->
<div class="boxFormat5">
<div class="box3">
<br>
</div>
</div>


<!--This is used for the Friends box part 3-->
<div class="boxFormat2">
<div class="box1">
<br>
</div>
</div>
<div id="popup5" class="popup_block">
<div id='results3'>
</div>
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
</div>

<div id="popup4" class="popup_block">
<div id='results4'>
</div>
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
</div>

<div id="popup6" class="popup_block">
<div id='results6'>
</div>
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
</div>

<div id="popup7" class="popup_block">
<div id='results7'>
</div>
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
</div>

</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script src="../js/popup.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/volPublic.js"></script>
<script type="text/javascript" src="../js/customPopupBox.js"></script>