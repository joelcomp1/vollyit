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
<link rel="stylesheet" href="../form.css" type="text/css" />
</head>
<body>

<div id="wrap">
<div id="mainnavuser">
<br>
<div class="clear"></div>
<h3>
Terms of Use & Privacy Policy
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
<script src="../js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../js/privacyTerms.js"></script>





