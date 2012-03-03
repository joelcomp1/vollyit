<?php
	require_once('auth.php');

	//includes for use with voice mail
	include '../twilio/Services/Twilio/Capability.php';
	include "voicemail-setup.php";

	include "header-org.php";
	include "navigation.php";
	$programName = $_GET['programname'];
	$numberOfVols = $_GET['numvols'];
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
<script type="text/javascript" src="../js/customPopupBox.js"></script>
<script LANGUAGE="JavaScript">

function CountLeft(field, count, max) {

if (field.value.length > max)

field.value = field.value.substring(0, max);

else

count.value = max - field.value.length;

}
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("search-programs-noorg.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fillPrograms(thisValue, numberOfVols) {
		$('#inputString').val(thisValue);
		var messages = document.getElementById('messagesLeft');
		var currentMsgs =  <?php echo json_encode($_SESSION['ORG_MESSAGES']); ?>;
		messages.innerHTML = (currentMsgs - numberOfVols);
		
		setTimeout("$('#suggestions').hide();", 200);
	}


</script>
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

<input name="name" type="text" size="30" id="inputString" onkeyup="lookup(this.value);" onblur="fillPrograms();" 
<?php if($programName != '')
{
		echo 'value="';
		echo $programName;
		echo '"';
}
else{
	echo 'value="Program Name"' ;
}?>

onfocus="this.value = this.value=='Program Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Program Name' : this.value; this.value=='Program Name' ? this.style.color='#999' : this.style.color='#000'"/>
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

<div id="MessageInfo">
Message Count:
<br>
<div class="clear"></div>
Messages Left Before Send: <?php echo $_SESSION['ORG_MESSAGES'];?>
<br>
<div class="clear"></div>
Messages Left After Send: <div id="messagesLeft"><?php
	if($numberOfVols > 0)
	{
	?>
		<script LANGUAGE="JavaScript">
		var messages = document.getElementById('messagesLeft');
		var numberOfVols =  <?php echo json_encode($numberOfVols); ?>;
		var currentMsgs =  <?php echo json_encode($_SESSION['ORG_MESSAGES']); ?>;
		messages.innerHTML = (currentMsgs - numberOfVols);
		</script>
	<?php
	
	}
	else
	{
	 echo $_SESSION['ORG_MESSAGES'];
	}?></div>
<br>
<div class="clear"></div>
<a href="#" onclick="popup(250, 'popup3');" class="poplight">purchase more messages</a>
<div class="clear"></div>
</div>
</div>
</div>
<div id="popup3" class="popup_block">
<h2>Pay As You Go Messaging</h2>

<form class="paypal" action="payments.php" method="post" id="paypal_form" target="_blank">    
	<input type="hidden" name="cmd" value="_xclick" /> 
    <input type="hidden" name="no_note" value="1" />
    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
    <input type="hidden" name="first_name" value="Customer's First Name"  />
    <input type="hidden" name="last_name" value="Customer's Last Name"  />
    <input type="hidden" name="payer_email" value="customer@example.com"  />
    <input type="hidden" name="item_number" value="Messages" / >
	100 Messages (never expire)
	<div class="clear"></div><br>
	<div id="field11" style="float: left;">
	<input id="Field11" name="Field11" type="text" style="float:left;" class="field text medium" value="1" maxlength="200" tabindex="3"  />
	<input type="button" value=" /\ " onclick="this.form.Field11.value++;" style="font-size:6px;margin:0;padding:0;width:20px;height:11px;" ><br>
	<input type="button" value=" \/ " onclick="this.form.Field11.value--;" style="font-size:6px;margin:0;padding:0;width:20px;height:10px;" >
	</div>
    <input type="submit"  value="Submit Payment"/>
</form>
<p style="text-align:center;">
Messages include voice and text messages.  This is a great way to pay only for what you need and supplement your plan from time to time.
This is a one time fee billed to your account and these messages never expire!</p>



<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
</div>
<?php if($_SESSION['ORG_PLAN'] == 'supreme')
{ ?>
		<script LANGUAGE="JavaScript">
			$("#MessageInfo").hide();
		</script>

<?php
}
?>

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





