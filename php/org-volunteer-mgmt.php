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
<script src="../js/jquery.ez-pinned-footer.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery-1.5.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/programMgmt.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>
<script type='text/javascript' src="../js/jquery-1.5.2.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.11.custom.min.js"></script>
<script src="../js/popup.js" type="text/javascript"></script>

<script type="text/javascript">

$(function(){
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-vol-page.php",
			success: function(msg)
				{
				$("#results").html(msg);
				$("#results").fadeIn();
				}
		});

		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-pending-vols.php",
			success: function(msg)
				{
				$("#results2").html(msg);
				$("#results2").fadeIn();
				}
		});
	
	

});	
</script>
</head>
<body>

<div id="wrap">

<div id="mainnavuser">

<div id="popupContact12">
<div class="boxFormat20">
<div class="box20">
Volunteers Pending Your Approval
<div style="float:right">
<a href="approve-all-pending.php">approve all</a>
</div>
</div>
</div>
<div id='results2'>
</div>	 
	</div>
<div id="backgroundPopup12"></div>

<div class="clear"></div>
<h3>

Manage Your Volunteers

<div class="easyAs">
Building a community has never been this easy!</div>
</h3>
<!--This is used for the upcoming vollys box-->
<div class="createNewProgram"  style="text-align:center;">
<a href="add-volunteers-org.php"><img src="../images/addvols.png" width="176" height="68"></a>

<div id="searchResults" style="padding: 0 0 0 60px;">
<a href="#"><?php echo $_SESSION['NUM_OF_VOLUNTEERS_PENDING']; ?> Volunteers Pending Approval</a>
</div>

</div>

<div class="clear"></div>
<div style="float:right; font:bold 1.2em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0 30px 0 0px;">
<?php echo $_SESSION['NUM_OF_VOLUNTEERS']; ?> Volunteers
</div>
<div class="yourprogramsViews">
<div class="leftLinks" style="float:left;">
<form style="float:left; font:'TeXGyreAdventor', Arial, sans-serif!important;" method="post" action="vol-management-display.php" id="volView" name="volView" enctype="multipart/form-data">
View:    
<select name="volView" onchange="this.form.submit()">
<option value="All" <?php if($_SESSION['VOL_VIEW_STATE'] == 'All'){ echo 'selected="yes"';}?>>All</option>
<option value="Active"  <?php if($_SESSION['VOL_VIEW_STATE'] == 'Active'){ echo 'selected="yes"';}?>>Active</option>
<option value="Pending" <?php if($_SESSION['VOL_VIEW_STATE'] == 'Pending'){ echo 'selected="yes"';}?>>Pending</option>
</select>
</form>
<form style="float:left; font:'TeXGyreAdventor', Arial, sans-serif!important;" method="post" action="vol-management-display.php" id="volSort" name="volSort" enctype="multipart/form-data">
   Sort By:  
<select name="volSort" onchange="this.form.submit()">
<option value="RecentlyAdded" <?php if($_SESSION['VOL_SORT_STATE'] == 'RecentlyAdded'){ echo 'selected="yes"';}?>>Recently Added</option>
<option value="AlphaFirstName"  <?php if($_SESSION['VOL_SORT_STATE'] == 'AlphaFirstName'){ echo 'selected="yes"';}?>>Alphabetical by First Name</option>
<option value="AlphaLastName" <?php if($_SESSION['VOL_SORT_STATE'] == 'AlphaLastName'){ echo 'selected="yes"';}?>>Alphabetical by Last Name</option>
<option value="NumVollys" <?php if($_SESSION['VOL_SORT_STATE'] == 'NumVollys'){ echo 'selected="yes"';}?>>Number of Vollys</option>
<option value="Status" <?php if($_SESSION['VOL_SORT_STATE'] == 'Status'){ echo 'selected="yes"';}?>>Status</option>

</select>
</form>
</div>
<div class="listView">
<div class="rightLinks">


<a href="excel-download.php"><img src="../images/excel.jpg" width="30" height="30">Download to Excel</a>
<form class="searchform" method="post" action="org-volunteer-mgmt.php" >
<table bgcolor="#FFFFFF" cellpadding="0px" cellspacing="0px" >
<tr>
<td style="border-style:none; font:'TeXGyreAdventor', Arial, sans-serif!important;"">
<div style="background: url(../images/roundbox.gif) no-repeat left top; padding: 0px; height: 22px;">
<input type="text" name="zoom_query" style="border: none; background-color: transparent; width: 106px; padding-left: 5px; padding-right: 5px;" value="Filter" onfocus="this.value = this.value=='Filter' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Filter' : this.value; this.value=='Filter' ? this.style.color='#999' : this.style.color='#000'"> 
</div>
</td>
<td style="border-style:none; "> 
<input type="submit" value="" style="border-style: none; background: url('../images/searchbutton1.gif') no-repeat; width: 24px; height: 22px;">
</td>
</tr>
</table>
</form>
</div>
</div>
</div>

<div class="listView">
<div class="boxFormat13">
<div class="box14">
<div style="width:350px; float:left;">
Info 
</div> 
<div style="width:130px; float:left;">
Status 
</div> 
<div style="width:190px; float:left;">
E-Mail 
</div> 
<div style="width:90px; float:left;">
Phone 
</div> 
<div style="width:80px; float:left;">
Vollys 
</div>       
</div>
</div>
<div class="boxFormat14">
<div class="box10">
<div id='results'>
</div>
</div>
</div>
</div>

</div>
</div>

<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>





