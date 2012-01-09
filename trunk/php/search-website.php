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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
<link rel="stylesheet" href="../form.css" type="text/css" />

<script type="text/javascript" src="http://static.twilio.com/libs/twiliojs/1.0/twilio.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="../js/popup.js" type="text/javascript"></script>
<script src="../js/jquery.ez-pinned-footer.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery-1.5.1.min.js" type="text/javascript" charset="utf-8"></script>		
<script src="../js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
						
$(function(){
		//$("#search-form").hide();
		$("#search-text").animate({"width":"229px"});
		$("#results").fadeOut();
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "search-website-query.php",
			success: function(msg)
				{
				$("#results").html(msg);
				$("#results").fadeIn();
				//$("#search-text").html("<a href='#' id='search-again'>Search Again</a>");
				}
		});
	return false;
	
	

});	
</script>
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






