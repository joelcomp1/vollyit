<?php
	session_start();

	require_once('auth.php');
		
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
<link rel='stylesheet' type='text/css' href="../css/fullcalendar.css" />
<link rel='stylesheet' type='text/css' href="../css/fullcalendar.print.css" media='print' />
</head>
<body>

<div id="wrap">

<div id="mainnavuser">
<div class="clear"></div>
<h3>

Manage Your Programs

<div class="easyAs">
Easy as 1.. 2.. 3..
</div>
</h3>
<!--This is used for the upcoming vollys box-->
<div class="createNewProgram"  style="text-align:center;">
<a href="create-program-part1.php?reset=true"><img src="../images/program.png" width="150" height="80"></a>
</div>

<div class="yourprograms">
<div class="box9">
Your Programs
</div>
</div>

<div class="clear"></div>

<div class="yourprogramsViews">
<div class="leftLinks" style="float:left;">
<a href="#" class="listViewShowHide" onclick="$('.calendar').fullCalendar('destroy');">List View</a> | <a href="#" onclick="makeCalendar();" class="calendarViewShowHide">Calendar View</a>
</div>
<div class="listView">
<div class="rightLinks">

<form style="float:left; font:'TeXGyreAdventor', Arial, sans-serif!important;" method="post" action="program-management-display.php" id="programViewForm" name="programViewForm" enctype="multipart/form-data">
Now Viewing:  
<select name="programView" onchange="this.form.submit()">
<option value="UpcomingPrograms" <?php if($_SESSION['PROGRAM_VIEW_STATE'] == 'UpcomingPrograms'){ echo 'selected="yes"';}?>>Upcoming Programs</option>
<option value="PastPrograms"  <?php if($_SESSION['PROGRAM_VIEW_STATE'] == 'PastPrograms'){ echo 'selected="yes"';}?>>Past Programs</option>
<option value="Drafts" <?php if($_SESSION['PROGRAM_VIEW_STATE'] == 'Drafts'){ echo 'selected="yes"';}?>>Drafts</option>
<option value="All" <?php if($_SESSION['PROGRAM_VIEW_STATE'] == 'All'){ echo 'selected="yes"';}?>>All</option>
</select>
</form>


<form class="searchform" method="post" action="program-management-org.php" >
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
Your Programs
</div>
</div>



<div class="boxFormat14">
<div class="box10">
<div id='results'>
</div>
</div>
</div>
</div>
<div class="calendarView">
<?php 
if(isset($_SESSION['SHOW_CALENDAR']))
{
		echo '<script>$(".listView").hide();</script>';
}
?>


<div class="clear"></div>
<br><br>
<div class="calendar">
</div>
</div>
</div>
</div>

<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script type='text/javascript' src="../js/populateCalendar.js"></script>
<script type='text/javascript' src="../js/jquery-1.5.2.min.js"></script>
<script type='text/javascript' src="../js/fullcalendar.min.js"></script>
<script type="text/javascript" src="../js/populateProgramPage.js"></script>
<script src="../js/programMgmt.js" type="text/javascript" charset="utf-8"></script>



