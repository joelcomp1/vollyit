<?php
	session_start();

	$displayState = $_GET['state'];

	require_once('auth.php');
	
	if($displayState != '')
	{
		if($displayState == 'All')
		{
			session_regenerate_id();
			$_SESSION['VOL_VIEW_STATE'] = 'All';
			session_write_close();
		
		}
		else if($displayState == 'Active')
		{
			session_regenerate_id();
			$_SESSION['VOL_VIEW_STATE'] = 'Active';
			session_write_close();
		}
		else if($displayState == 'Pending')
		{
			session_regenerate_id();
			$_SESSION['VOL_VIEW_STATE'] = 'Pending';
			session_write_close();
		}
		else if($displayState == 'RecentlyAdded')
		{
			session_regenerate_id();
			$_SESSION['VOL_SORT_STATE'] = 'RecentlyAdded';
			session_write_close();
		
		}
		else if($displayState == 'AlphaFirstName')
		{
			session_regenerate_id();
			$_SESSION['VOL_SORT_STATE'] = 'AlphaFirstName';
			session_write_close();
		
		}
		else if($displayState == 'AlphaLastName')
		{
			session_regenerate_id();
			$_SESSION['VOL_SORT_STATE'] = 'AlphaLastName';
			session_write_close();
		
		}		
		else if($displayState == 'NumVollys')
		{
			session_regenerate_id();
			$_SESSION['VOL_SORT_STATE'] = 'NumVollys';
			session_write_close();
		
		}		
		else if($displayState == 'Status')
		{
			session_regenerate_id();
			$_SESSION['VOL_SORT_STATE'] = 'Status';
			session_write_close();
		
		}		
	}		

	
	session_regenerate_id();
	$search_term = filter_var($_POST["zoom_query"], FILTER_SANITIZE_STRING);
	$_SESSION['SEARCH'] = $search_term;
	session_write_close();

	include "header-org.php";
	include "navigation.php";	

?>
	
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['ORG_NAME'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
 <script type="../text/javascript" src="../js/jquery.js"></script>
  <script type="../text/javascript" src="../js/collection.js"></script>
  <script src="../js/popup.js" type="../text/javascript"></script>




<script src="../js/popup.js" type="text/javascript"></script>

<script type="text/javascript">

$(function(){
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "import-vols.php",
			success: function(msg)
				{
				$("#results").html(msg);
				$("#results").fadeIn();
				}
		});

});	
</script>
</head>
<body>

<div id="wrap">

<div id="mainnavuser">



<div class="clear"></div>
<h3>

Add Your Existing Volunteers

<div class="easyAs">
Add First Name, Last Name, E-mail, and Phone Number</div>
</h3>
<a href="vols.xls">Need Example?</a>

<form enctype="multipart/form-data" 
  action="import.php" method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
  <table width="600">
  <tr>
  <td>Names file:</td>
  <td><input type="file" name="file" /></td>
  <td><input type="submit" value="Import" /></td>
  </tr>
  </table>
  </form>
  
<div id='results'>
</div>

<div class="clear"></div>



</div>

</div>
</div>

<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>





