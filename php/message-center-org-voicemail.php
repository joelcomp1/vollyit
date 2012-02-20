<?php
	require_once('auth.php');

	//includes for use with voice mail
	include '../twilio/Services/Twilio/Capability.php';
	include "voicemail-setup.php";

	include "header-org.php";
	include "navigation.php";
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['ORG_NAME'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../form.css" type="text/css" />

<script type="text/javascript" src="http://static.twilio.com/libs/twiliojs/1.0/twilio.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		
</head>
<body>

<div id="wrap">
<div id="mainnavuser">
<br>
<div class="clear"></div>
<h3>
Messaging Center
</h3>
<div class="clear"></div>
<h3>
<div class="allDay">
Call Your Volunteers
</div>
</h3>
<?php	
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
?>
<div class="clear"></div>
<div class="boxFormat10">
<div class="contactVols">

<form id="sendSms" name="sendSms" method="post" action="send-voicemail.php">
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
      Record Voice Message:
	  <div class="clear"></div><br><br>

<input type="button" id="call" value="Begin Recording"/>
<input type="button" id="hangup" value="Stop Recording" style="display:none;"/>
<div id="status">
    Offline
</div>

	
      &nbsp;
	  <br>
	  <br><br>
	  <input type="image" name="Submit" src="../images/send.jpg" height="50" width="90" value="Send" tabindex="22" /></td>

 
</form>

</div>
</div>



</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script type="text/javascript">
		var conn = {};		
		
		$(document).ready(function(){
			Twilio.Device.setup("<?php echo $token->generateToken();?>",{"debug":true});
			$("#call").click(function() {  
				conn = Twilio.Device.connect();
			});
			$("#hangup").click(function() {  
  				conn.sendDigits("#");
				toggleCallStatus();
			});
			
			
			
			

			Twilio.Device.ready(function (device) {
				$('#status').text('Ready to start recording');
			});

			Twilio.Device.offline(function (device) {
				$('#status').text('Offline');
			});

			Twilio.Device.error(function (error) {
				$('#status').text(error);
			});

			Twilio.Device.connect(function (conn) {
				$('#status').text("On Air");
				$('#status').css('color', 'red');
				toggleCallStatus();
			});

			Twilio.Device.disconnect(function (conn) {
				$('#status').html('Recording ended<br/><a href="show_recordings.php">view recording list</a>');
				$('#status').css('color', 'black');
				toggleCallStatus();
			});
			
			function toggleCallStatus(){
				$('#call').toggle();
				$('#hangup').toggle();
			}
		});
</script>





