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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['SESS_MEMBER_ID'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrap">
<div id="mainnavuser">
<div class="clear"></div>
<h3>
<?php echo $_SESSION['ORG_NAME_VIEW'];?>

<div class="clear"></div>
<div class="orgAddress">
<?php echo $_SESSION['ORG_ADDRESS_VIEW'];?> - 
<?php echo $_SESSION['ORG_CITY_VIEW'];?>, 
<?php echo $_SESSION['ORG_STATE_VIEW'];?> 
<?php echo $_SESSION['ORG_ZIPCODE_VIEW'];?> -
<a target="_blank" href="http://maps.google.com/?q=<?php echo $_SESSION['ORG_ADDRESS_VIEW']; echo ','; echo $_SESSION['ORG_CITY_VIEW']; echo ','; echo $_SESSION['ORG_STATE_VIEW']; echo ','; echo $_SESSION['ORG_ZIPCODE_VIEW'];?>">Map It</a>
<?php 
	if(isset($_SESSION['FACEBOOK_LINK_VIEW'])) 
	{
		if(substr($_SESSION['FACEBOOK_LINK_VIEW'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['FACEBOOK_LINK_VIEW'],'"><img src="../images/facebook.png" width="62" height="22" alt="Facebook" /></a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['FACEBOOK_LINK_VIEW'],'"><img src="../images/facebook.png" width="62" height="22" alt="Facebook" /></a>';	
		}
	}

	if(isset($_SESSION['TWITTER_LINK_VIEW'])) 
	{
		if(substr($_SESSION['TWITTER_LINK_VIEW'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['TWITTER_LINK_VIEW'],'"><img src="../images/twittershare.png" width="62" height="22" alt="Twitter" /></a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['TWITTER_LINK_VIEW'],'"><img src="../images/twittershare.png" width="62" height="22" alt="Twitter" /></a>';	
		}
		
	}
	echo '  ';
	?>
	
<a href="#"><img src="../images/message.png" width="99" height="34"></a>

</div> 
</h3>
<div id="popupContact2">
	
	
	<h2 style=" padding:0px 0 0 30px!important; float:none; text-align: center;">Volly Here?</h2>
	<p id="contactArea" style=" padding:0px 0 0 30px!important; float:none; text-align: center;">
We are about to share your profile with <?php echo $_SESSION['ORG_NAME_VIEW'];?>.  Once the organization approves your volunteer request, you will be added
as a regular volunteer.	<br>
<a href="add-volunteer-request.php"><img src="../images/vollyit.png" width="117" height="48" ></a>

<a id="popupContactClose2" style="right:0px; top: 0px; position:relative;">Close</a>
Please Note: You are sharing your information with this organization.  This organization may use your shared information to contact you.
By continuing, you are accepting the Volly It <a href="legalstuff.php">Terms of Use</a> and <a href="legalstuff.php">Privacy Policy</a>
		</p>
	 
	</div>
<div class="thumbnailOrg">
	<?php
	if(($_SESSION['ORG_IMAGE_VIEW']) == true) {
	
		echo '<img src="uploaded_files/',$_SESSION['IMAGE_PATH_ORG_VIEW'],'" alt="Organization Picture" width="320" height="240">';
	}
	else
	{//This name is decieving, i am using the login pop up for the image upload.....
		echo '<img src="../images/noorglogo.png" width="320" height="240" alt="header image2""> ';
	}
	?>
	<div id="temp" style="padding: 0 0 0 60px;">
	
<?php 

if(($_SESSION['ORG_FRIEND_STATUS_VIEW'] == 'REQUEST_SENT') || ($_SESSION['ORG_FRIEND_STATUS_VIEW'] == 'DECLINED'))
{
	echo '<br><br>Your Volunteer Request Has Been Sent<br>';
}
else if(($_SESSION['ORG_FRIEND_STATUS_VIEW'] == 'ACCEPTED'))
{
}
else
{?>

	<a href="#" onclick="popup(250, 'popup4');" class="poplight"><img src="../images/vollyit.png" width="117" height="48" ></a><br>Share Your Profile With 
	<?php
	echo $_SESSION['ORG_NAME_VIEW'];

}?>
	

	</div>
	</div>


<!--This is used for the upcoming vollys box-->
<div class="boxFormat">
<div class="TextBox1">
<div class="leftText" style="float: left;">
About Us</div>
</div>
</div>

<div class="boxFormat2">
<div class="nextPrograms">

	<div style="text-align:left;">

 <?php echo $_SESSION['ORG_DESC_VIEW'];?>

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
<a href="#"><img src="../images/emptyIcon.jpg" width="30" height="40" ></a>
<br>
Volunteers
</div>
<div class="upcomingSnapshot" style="float: left; font:bold 0.6em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 9px; text-align:center;">

<a href="#"><img src="../images/emptyIcon.jpg" width="30" height="40" ></a>
<br>
Upcoming Programs

</div>
<div class="pastProgramsSnapshot" style="float: left; font:bold 0.6em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 9px; text-align:center;">
<a href="#"><img src="../images/emptyIcon.jpg" width="30" height="40" ></a>
<br>
Past Programs
</div>
<div class="collabSnapshot" style="float: left; font:bold 0.6em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 9px; text-align:center;">
<a href="#"><img src="../images/emptyIcon.jpg" width="30" height="40" ></a>
<br>
Collaborations
</div>
</div>
</div>


<!--This is used for the About Us box-->
<div class="aboutUsBox">
<div class="box3">
<div class="leftText" style="float: left;">
 Connect With Us
</div></div>
</div>


<!--This is used for the  snapshot  box part 3-->
<div class="connections3Box">
<div class="box1">
<br>
</div>
</div>

<!--This is used for the About Us  box part 2-->
<div class="boxFormat5">
<div class="snapShotBox">

	<center>
<?php
	if(isset($_SESSION['ORG_WEBSITE_VIEW'])) 
	{
		if(substr($_SESSION['ORG_WEBSITE_VIEW'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['ORG_WEBSITE_VIEW'],'">',$_SESSION['ORG_WEBSITE_VIEW'],'</a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['ORG_WEBSITE_VIEW'],'">',$_SESSION['ORG_WEBSITE_VIEW'],'</a>';	
		}

	}?>
<br>
<?php echo $_SESSION['ORG_PHONE_VIEW'];?>
<br>
<?php
	if(isset($_SESSION['ORG_EMAIL_VIEW'])) 
	{
		echo '<a href="mailto:',$_SESSION['ORG_EMAIL_VIEW'],'"><img src="../images/email.png" width="20" height="20" alt="E-mail" /></a>';
	}

	if(isset($_SESSION['FACEBOOK_LINK_VIEW'])) 
	{
		if(substr($_SESSION['FACEBOOK_LINK_VIEW'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['FACEBOOK_LINK_VIEW'],'"><img src="../images/fbook.png" width="20" height="20" alt="Facebook" /></a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['FACEBOOK_LINK_VIEW'],'"><img src="../images/fbook.png" width="20" height="20" alt="Facebook" /></a>';	
		}
	}

	if(isset($_SESSION['TWITTER_LINK_VIEW'])) 
	{
		if(substr($_SESSION['TWITTER_LINK_VIEW'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['TWITTER_LINK_VIEW'],'"><img src="../images/twitter.png" width="20" height="20" alt="Twitter" /></a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['TWITTER_LINK_VIEW'],'"><img src="../images/twitter.png" width="20" height="20" alt="Twitter" /></a>';	
		}
		
	}

	if(isset($_SESSION['LINKEDIN_LINK_VIEW'])) 
	{
		if(substr($_SESSION['LINKEDIN_LINK_VIEW'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['LINKEDIN_LINK_VIEW'],'"><img src="../images/linkedin.png" width="20" height="20" alt="Linked In" /></a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['LINKEDIN_LINK_VIEW'],'"><img src="../images/linkedin.png" width="20" height="20" alt="Linked In" /></a>';	
		}

	}

	if(isset($_SESSION['BLOG_LINK_VIEW'])) 
	{
		if(substr($_SESSION['BLOG_LINK_VIEW'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['BLOG_LINK_VIEW'],'"><img src="../images/blogger.png" width="20" height="20" alt="Blog" /></a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['BLOG_LINK_VIEW'],'"><img src="../images/blogger.png" width="20" height="20" alt="Blog" /></a>';	
		}
	}

	if(isset($_SESSION['YOUTUBE_LINK_VIEW'])) 
	{
		if(substr($_SESSION['YOUTUBE_LINK_VIEW'], 0, 4) == 'http')
		{
			echo '<a href="',$_SESSION['YOUTUBE_LINK_VIEW'],'"><img src="../images/youTube.png" width="20" height="20" alt="You Tube" /></a>';
		}
		else
		{	
			echo '<a href="http://',$_SESSION['YOUTUBE_LINK_VIEW'],'"><img src="../images/youTube.png" width="20" height="20" alt="You Tube" /></a>';	
		}
	}
?>
</center>
	
</div>
</div>
<div class="clear"></div>




<!--This is used for the About Us box part 3-->
<div class="aboutUsBox">
<div class="box3">
<br>
</div>
</div>

<div id="popup5" class="popup_block">
	<h2 style=" padding:0px 0 0 30px!important; float:none; text-align: center;">Remove Organization</h2><br>
	<p id="contactArea" style=" padding:0px 0 0 30px!important; float:none; text-align: center;">
Are you sure you want to be removed from the list of regular volunteers at <?php echo $_SESSION['ORG_NAME_VIEW'];?>?  A notification will be sent to the organization
that you no longer wish to volunteer here.<br><br>
<a href="remove-volunteer-request.php" onclick="$('#entryPage').hide(); $('#entryPage2').show();"><img src="../images/removeorg.png"></a><br>
<br>
		</p>

	 
	
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Cancel</a>
</div>

<div id="popup4" class="popup_block" style="text-align:center;">
<div id="entryPage">
	<h2 style=" padding:0px 0 0 30px!important; float:none; text-align: center;">Volly Here?</h2>
	<p id="contactArea" style=" padding:0px 0 0 30px!important; float:none; text-align: center;">
We are about to share your profile with <?php echo $_SESSION['ORG_NAME_VIEW'];?>.  Once the organization approves your volunteer request, you will be added
as a regular volunteer.	<br>
<a href="add-volunteer-request.php" onclick="$('#entryPage').hide(); $('#entryPage2').show();"><img src="../images/vollyit.png" width="117" height="48" ></a>
<br>
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Cancel </a><br><br>
Please Note: You are sharing your information with this organization.  This organization may use your shared information to contact you.
By continuing, you are accepting the Volly It <a href="legalstuff.php">Terms of Use</a> and <a href="legalstuff.php">Privacy Policy</a>
		</p>
</div>
<div id="entryPage2" style="display:none;">
	<h2 style=" padding:0px 0 0 30px!important; float:none; text-align: center;">Awesomeness!</h2>
	<p id="contactArea" style=" padding:0px 0 0 30px!important; float:none; text-align: center;">
A volunteer request has been sent to <?php echo $_SESSION['ORG_NAME_VIEW'];?>.  We will notify you when your profile has been approved!
<br>
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();"><img src="../images/ok.png"></a><br><br>
		</p>
</div>
</div>
<?php 
if(($_SESSION['ORG_FRIEND_STATUS_VIEW'] == 'ACCEPTED'))
{?>
	<a href="#" onclick="popup(350, 'popup5');" class="poplight" style="float:right; padding: 10px 10px 10px 10px;"><img src="../images/removeorg.png"></a>
<?php
}
?>


</div>

</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script type="text/javascript" src="../js/customPopupBox.js"></script>




