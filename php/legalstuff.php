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

<script type="text/javascript" src="http://static.twilio.com/libs/twiliojs/1.0/twilio.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
				
<script src="../js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
			// <![CDATA[
				
			$(document).ready(function () {
				$('#menu').tabify();
			});
					
			// ]]>
</script>
<script src="../js/calendar.js"></script>
<link href="../css/calendar.css" rel="stylesheet">
</head>
<body>

<div id="wrap">
<div id="mainnavuser">
<br>
<div class="clear"></div>
<h3>
<div class="box4">
Terms of Use & Privacy Policy
</div>
</h3>
<div class="clear"></div>
<br>
<br>
<ul id="menu" class="menu">
			<li class="active"><a href="#description">Terms of Use</a></li>
			<li><a href="#usage">Privacy Policy</a></li>
		</ul>


		<div id="description" class="content">
			<p>
			asdfasdf
			</p>
		</div>
		<div id="usage" class="content">
			<p>
asdfasdfasdf
			</p>
		</div>
</div></div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>






