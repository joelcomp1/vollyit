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
<link href="../css/liveQuery.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>
<script LANGUAGE="JavaScript" src="../js/textMsg.js"></script>
</head>
<body>

<div id="wrap">
<div id="mainnavuser">
<br>
<div class="clear"></div>
<h3>

Messaging Center

<div class="allDay">
Text Your Volunteers
</div>
</h3>





<div class="clear"></div>

<div class="boxFormat10">
<div class="contactVols">


<form id="sendSms" name="sendSms" method="post" action="send-sms.php">
<div class="volSearchLeftInnter" style="float:left">
To: 

<input name="name" type="text" size="30" id="inputString" onkeyup="lookup(this.value);" onblur="fillPrograms();" value="Program Name" onfocus="this.value = this.value=='Program Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Program Name' : this.value; this.value=='Program Name' ? this.style.color='#999' : this.style.color='#000'"/>
<div class="suggestionsBox" id="suggestions" style="display: none; text: font:bold 0.4em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<img src="../images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList" id="autoSuggestionsList">
		&nbsp;
	</div>
	</div>


</div>
 <div class="clear"></div>
 <br>
      Type Text Message:
	  <div class="clear"></div>

	  <font size="1" face="arial, helvetica, sans-serif"> 
<textarea name="textMsg"   id="textMsg" class="textfield"
rows="5" cols="37" style="resize: none;" onKeyDown="CountLeft(this.form.textMsg, this.form.left,160);" onKeyUp="CountLeft(this.form.textMsg,this.form.left,160);"
 >
</textarea>
<input readonly type="text" name="left" size=3 maxlength=3 value="160"> characters left</font>

	
      &nbsp;
	  <br>
	  <br><br>
	  <input type="image" name="Submit" src="../images/send.jpg" height="50" width="90" value="Send" tabindex="22" /></td>

 
</form>
<div class="clear"></div>
</div>
</div>
</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>





