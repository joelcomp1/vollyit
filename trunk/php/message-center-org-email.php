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
 <script type="../text/javascript" src="../js/jquery.js"></script>
  <script type="../text/javascript" src="../js/collection.js"></script>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../form.css" type="text/css" />
    <link rel="stylesheet" href="../css/jquery-ui-1.8.14.custom.css" type="text/css" />
    <link rel="stylesheet" href="../css/jquery.ui.timepicker.css?v=0.2.9" type="text/css" />

    <script type="text/javascript" src="../js/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="../js/jquery.ui.core.min.js"></script>
		<script src="../js/calendar.js"></script>
		<link href="../css/calendar.css" rel="stylesheet">
    <script type="text/javascript" src="../js/jquery.ui.timepicker.js?v=0.2.9"></script>
<script src="../scripts/wufoo.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
	<link href="ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrap">
<div id="mainnavuser">
<div class="clear"></div>
<h3>
Messaging Center
<div class="allDay">
E-Mail Your Volunteers
</div>
</h3>

	<!-- This <div> holds alert messages to be display in the sample page. -->
	<div id="alerts">
		<noscript>
			<p>
				<strong>CKEditor requires JavaScript to run</strong>. In a browser with no JavaScript
				support, like yours, you should still see the contents (HTML data) and you should
				be able to edit it normally, without a rich editor interface.
			</p>
		</noscript>
	</div>
	<form action="contact.php" method="post">
		
	<textarea style="resize: none;"
class="ckeditor" cols="80" id="editor1" name="editor1" rows="10">Start Typing Here...</textarea>
		
		
			<input type="submit" value="Submit" />
	</form>
</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>






