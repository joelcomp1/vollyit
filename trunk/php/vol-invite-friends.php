<?php
	require_once('auth.php');

	session_start();
	
	include 'header-vol.php';
	include 'navigation-vol.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['SESS_MEMBER_ID'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="init()">


<div id="wrap">
<div id="mainnavuser">
<br>
<div class="clear"></div>
<h3>



Invite Your Friends to Volly It!</h3>
<div class="clear"></div>

<!--This is used for the about box-->
<div class="socialOuter">
<div class="shareSocialSmallBoxes">
Share on Social Networks
</div>
</div>

<div class="socialOuter">
<div class="shareSocialSmallBoxes">
<div class="leftText" style="float: left;">
Share Link
</div>
</div>
</div>

<div class="socialInner">
<div class="inviteFriendsBox">

<a href="https://www.facebook.com/sharer/sharer.php?u=http://volly.it&t=Help Change the World!"><img src="../images/facebook.png" width="62" height="22" alt="Facebook" /></a>


<a href="https://twitter.com/intent/tweet?text=I think you should help me change the world! I am on Volly.it and you should be to!  Hop onto Volly.it today and start Volunteering!">
<img src="../images/twittershare.png" width="62" height="22" alt="Twitter" /></a>


</div>
</div>


<div class="boxFormat2">
<div class="inviteFriendsBox">
<div class="leftText" style="float: left; padding: 0px 0px 0px 10px">
<input id="Field1" name="Field1" type="text" class="field text large" value="<?php echo $_SESSION['USER_INVITE_LINK']; ?>" size="50" tabindex="5" required />



</div>
</div>
</div>
<div class="clear"></div>


<div class="socialOuter">
<div class="shareSocialSmallBoxes">
<br>
</div>
</div>


<div class="socialOuter">
<div class="shareSocialSmallBoxes">
<br>
</div>
</div>

<div class="clear"></div>
<br>
<br>
<!--This is used for the snapshot box-->
<div class="emailInvite">
<div class="emailInviteInner">
Send Invite Through E-mail
</div>
</div>
<div class="clear"></div>

<div class="emailInviteMain">



<div class="emailInviteInnerMain">
<form id="Sendemail" name="Sendemail" method="post" action="send-vol-email.php">




<div id="emailAdd">
<input id="Field1116" name="Field11161" type="text" spellcheck="false" class="field text medium" maxlength="255" tabindex="26" value="Enter e-mail..." onfocus="this.value = this.value=='Enter e-mail...' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Enter e-mail...' : this.value; this.value=='Enter e-mail...' ? this.style.color='#999' : this.style.color='#000'" /> 
<input type="button" value="Add E-Mail" onClick="addInput('emailAdd', document.Sendemail.Field11161.value);">
</div>

<div class="clear"></div><br>
<div style="float:left;">
<textarea id="emailContent2" 
name="emailContent" 
style="resize: none;"
spellcheck="true" 
rows="8" cols="37" >I think you should help me change the world! I am on Volly.it and think you should be to!  Hop onto Volly.it today and start volunteering!
</textarea>
</div>
<div id="hideFormClose">

</div>
<div class="clear"></div><br>

&nbsp;<input type="submit" name="Submit" value="Send E-Mail"  tabindex="1"/>
</form>
		<?php
	if( isset($_SESSION['ERRMSG_ARR'])) {
		echo '<ul class="err">';
		echo '<br><li>',$_SESSION['ERRMSG_ARR'],'</li>'; 
		
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
	?>
<div id="emailAdd2" style="float:right;">
<?php
include('open_inviter_results.php');
?>
</div>
</div>
</div>
<div class="clear"></div>
<div class="emailInvite">
<div class="emailInviteInner">
<br>
</div>
</div>
</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script src="../js/popup.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/characterCounter.js"></script>
<script src="../js/addInputs.js" language="Javascript" type="text/javascript"></script>