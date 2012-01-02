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
</head>
<body>

<div id="wrap">
<div id="mainnavuser">
<div class="clear"></div>
<h3>
<div class="box4">
Messaging Center
</div>
<div class="allDay">
E-Mail Your Volunteers
</div>
</h3>
</div>
</div>
<form method="post" action="contact.php"> Email: <input name="email" type="text"><br> Message:<br> <textarea name="message" rows="15" cols="40"></textarea><br> <input type="submit"> </form> 
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>






