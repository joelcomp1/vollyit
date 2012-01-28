<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	require_once('auth.php');
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
	session_regenerate_id();
	$search_term = filter_var($_POST["search"], FILTER_SANITIZE_STRING);
	$_SESSION['SEARCH'] = $search_term;
	session_write_close();

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php 	
if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
{
	echo $_SESSION['ORG_NAME'];
	}
		else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
		{
			echo $_SESSION['SESS_MEMBER_ID'];

		}
	
	?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="wrap">
<div id="mainnavuser">
<h3 style="float:left;"> All Results </h3>
<div class="boxFormat14">
<div class="orgProgSearch">
<div id='results'>
</div>
</div>
</div>

</div></div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script type="text/javaScript" src="../js/searchWebsite.js"></script>



