<?php
	require_once('auth.php');
	include "header-org.php";
	include "navigation.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['ORG_NAME'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../form.css" type="text/css" />	
</head>
<body>

<div id="wrap">
<div id="mainnavuser">
<div class="clear"></div>
<h3>
<div style="text-align:center;">
Messaging Center
</div>
<div class="allDay">
Remember how this used to take you all day? Not anymore!
</div>
</h3>
<br>


<div class="clear"></div>
<div class="programIconImage">
<a href="message-center-org-email.php"><img src="../images/emailMsgCenter.png"></a>
</div>

<div class="boxFormat10">
<div class="contactVols">
E-Mail Volunteers
<br>
<br>
Send out e-mails to your volunteers! Couldn't be easier!
</div>
</div>
<div class="clear"></div>
<br>
<div class="programIconImage">
<a href="message-center-org-voicemail.php"><img src="../images/voiceMailmsgCenter.png"></a>
</div>

<div class="boxFormat10">
<div class="contactVols">
Send Voice Mails
<br>
<br>
Record one voicemail and send to everyone! Amazing, huh?
</div>
</div>
<div class="clear"></div>
<br>
<div class="programIconImage">
<a href="message-center-org-textmsg.php"><img src="../images/txtmsgMsgCenter.png"></a>
</div>

<div class="boxFormat10">
<div class="contactVols">
Send Text Messages
<br>
<br>
Message all of your volunteers so fast!
</div>
</div>
<div class="clear"></div>



</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>





