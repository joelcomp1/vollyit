<?php
	require_once('auth.php');

	session_start();
	
	include("config.php");
	include 'header-vol.php';
	include 'navigation-vol.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['SESS_MEMBER_ID'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link href="../css/capslide.css" rel="stylesheet" type="text/css"/>
</head>

<body>


<div id="wrap">
<div id="mainnavuser">
<br>

<div class="clear"></div>
<h3 style="font: bold 3.2em 'TeXGyreAdventor', Arial, sans-serif;">
Your Vollys
</h3>
<div class="clear"></div>

<div class="yourOrganizationsCollection">
<div id='results'>
</div>
</div>
<a href="#" onclick="

$('#pastVollys').toggle();

$('#upcomingVollys').toggle(); 
if(this.innerHTML == 'View Past Vollys')
{
	this.innerHTML = 'View Current Vollys'
}
else
{
	this.innerHTML = 'View Past Vollys'
}
">View Past Vollys</a>
</div>

</div>

<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script type="text/javascript" src="../js/populateVolPrograms.js"></script>
<script type="text/javascript" src="../js/customPopupBox.js"></script>



