<?php
	session_start();

	$displayState = $_GET['state'];

	require_once('auth.php');
	
	include "populate-programs.php";
	
	if($displayState != '')
	{

		if($displayState == 'upcoming')
		{
			session_regenerate_id();
			$_SESSION['PROGRAM_VIEW_STATE'] = 'UpcomingPrograms';
			session_write_close();
		
		}
		else if($displayState == 'past')
		{
			session_regenerate_id();
			$_SESSION['PROGRAM_VIEW_STATE'] = 'PastPrograms';
			session_write_close();
		}
		else if($displayState == 'all')
		{
			session_regenerate_id();
			$_SESSION['PROGRAM_VIEW_STATE'] = 'All';
			session_write_close();
		}
	}
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
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery.ez-pinned-footer.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery-1.5.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/programMgmt.js" type="text/javascript" charset="utf-8"></script>
<script type='text/javascript' src="../js/jquery-1.5.2.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.11.custom.min.js"></script>
<script type='text/javascript' src="../js/fullcalendar.min.js"></script>
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
<a href="create-program-part1.php"><img src="../images/program.png" width="150" height="80"></a>
</div>

<div class="yourprograms">
<div class="box9">
Your Programs
</div>
</div>

<div class="clear"></div>

<div class="yourprogramsViews">
<div class="leftLinks" style="float:left;">
<a href="#" class="listViewShowHide">List View</a> | <a href="#" class="calendarViewShowHide">Calendar View</a>
</div>
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


<form method="get" action="program-search.php" style="float:left; font:'TeXGyreAdventor', Arial, sans-serif!important;" >
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

<div class="listView">
<div class="boxFormat13">
<div class="box14">
Your Programs
</div>
</div>



<div class="boxFormat14">
<div class="box10">

<?php
$displayedPrograms = 0;
	for($j = 0; $j <= count($_SESSION['CREATED_PROGRAM_INDEX']); $j++)
	{
		$i = $_SESSION['CREATED_PROGRAM_INDEX'][$j];
		$programName = 'PROGRAM_NAME';
		$programName .= $i;
	
		$programImage = 'PROGRAM_IMAGE_PATH';
		$programImage .= $i;
		
		$date = 'PROGRAM_DATE';
		$date .= $i;
	
		$timeStart = 'PROGRAM_START_TIME';
		$timeStart .= $i;
	
		$endTime = 'PROGRAM_END_TIME';
		$endTime .= $i;
	
		$endDate = 'PROGRAM_END_DATE';
		$endDate .= $i;
		
		$programStatus = 'PROGRAM_STATUS';
		$programStatus .= $i;
	    
		$totalPositionsAvailable = 'POSITIONS_AVAIL';
		$totalPositionsAvailable .= $i;
		
		if($_SESSION['PROGRAM_VIEW_STATE'] == 'All')
		{
			if(isset($_SESSION[$programName])) 
			{
				$displayedPrograms += 1;
				echo '<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/',$_SESSION[$programImage],'" alt="Program Picture" width="180" height="120"></div>';
				echo '<div id="position">';
				echo '<a href="program-manager.php?programname=',$_SESSION[$programName],'&orgname=',$_SESSION['ORG_NAME'],'">',$_SESSION[$programName],'</a>';
				if($_SESSION[$programStatus] != 'Published')
				{
					echo '     Draft';
				}
				echo '</div><br><br>';	
				echo '<div id="programdate">';	
				if($_SESSION[$endDate] == '' && $_SESSION[$date] == '')
				{
					//don't do anything since this is a draft and it hasn't been set yet
				}
				else
				{
					echo date('l, M jS Y',strtotime($_SESSION[$date])); echo ' at ';echo date(' h:i A',strtotime($_SESSION[$timeStart]));
				}
				
				if($_SESSION[$endDate] == '' && $_SESSION[$date] == '')
				{
					//don't do anything since this is a draft and it hasn't been set yet
				}
				else if($_SESSION[$date] == $_SESSION[$endDate]) //If its the same day show end time
				{
					echo date(' h:i A',strtotime($_SESSION[$endTime]));
				}
				else if($_SESSION[$endDate] == '')
				{
					echo ' to '; echo date(' h:i A',strtotime($_SESSION[$endTime]));
				}
				else
				{
					echo ' to ';
					echo date('l, M jS Y',strtotime($_SESSION[$endDate])); echo ' at ';echo date(' h:i A',strtotime($_SESSION[$endTime]));
				}
				echo '</div>';
				echo '<div id="programlinks">';	
				echo '<p id="tooltip1" style="float:left;"><a href="introduction.php"><a href="program-manager.php?programname=',$_SESSION[$programName],'&orgname=',$_SESSION['ORG_NAME'],'"><img src="../images/editProgramsSmall.png" width="30" height="30"><span>Edit Prgoram</span></a></p><p id="tooltip2" style="float:left;"><a href="program-vol-list.php"><img src="../images/volGroup.jpg" width="30" height="30"><span>Volunteers</span></a></p><p id="tooltip3" style="float:left;"><a href="clone-program.php"><img src="../images/cloneProgram.png" width="30" height="30"><span>Clone Program</span></a></p><p id="tooltip4" style="float:left;"><a href="delete-program.php?programname=',rawurlencode($_SESSION[$programName]),'"><img src="../images/trashCan.jpg" width="30" height="30"><span>Delete Program</span></a></p>';
				echo '</div>';
				echo '<br><br>';	
				echo '<div id="programopen">';	
				if($_SESSION[$totalPositionsAvailable] != '')
				{
					echo $_SESSION[$totalPositionsAvailable];
					echo ' Open Positions';
				}
				echo '</div><br>';	
				echo '<div class="clear"></div>';
				if(($displayedPrograms < 5))
				{
					echo '<div class="boxFormat16">';
					echo '<div class="box16">';
					echo '</div>';
					echo '</div>';
				}
			}
			$totalOpenPositions = 0;
		}
		else if($_SESSION['PROGRAM_VIEW_STATE'] == 'Drafts')
		{
			if(isset($_SESSION[$programName]) && ($_SESSION[$programStatus] != 'Published'))
			{
				$displayedPrograms += 1;
				echo '<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/',$_SESSION[$programImage],'" alt="Program Picture" width="180" height="120"></div>';
				echo '<div id="position">';
				echo '<a href="program-manager.php?programname=',$_SESSION[$programName],'&orgname=',$_SESSION['ORG_NAME'],'">',$_SESSION[$programName],'</a>';
				if($_SESSION[$programStatus] != 'Published')
				{
					echo '     Draft';
				}
				echo '</div><br><br>';	
				echo '<div id="programdate">';	
				if($_SESSION[$endDate] == '' && $_SESSION[$date] == '')
				{
					//don't do anything since this is a draft and it hasn't been set yet
				}
				else
				{
					echo date('l, M jS Y',strtotime($_SESSION[$date])); echo ' at ';echo date(' h:i A',strtotime($_SESSION[$timeStart]));
				}
				
				if($_SESSION[$endDate] == '' && $_SESSION[$date] == '')
				{
					//don't do anything since this is a draft and it hasn't been set yet
				}
				else if($_SESSION[$date] == $_SESSION[$endDate]) //If its the same day show end time
				{
					echo date(' h:i A',strtotime($_SESSION[$endTime]));
				}
				else if($_SESSION[$endDate] == '')
				{
					echo ' to '; echo date(' h:i A',strtotime($_SESSION[$endTime]));
				}
				else
				{
					echo ' to ';
					echo date('l, M jS Y',strtotime($_SESSION[$endDate])); echo ' at ';echo date(' h:i A',strtotime($_SESSION[$endTime]));
				}
				echo '</div>';
				echo '<div id="programlinks">';	
				echo '<p id="tooltip1" style="float:left;"><a href="introduction.php"><a href="program-manager.php?programname=',$_SESSION[$programName],'&orgname=',$_SESSION['ORG_NAME'],'"><img src="../images/editProgramsSmall.png" width="30" height="30"><span>Edit Prgoram</span></a></p><p id="tooltip2" style="float:left;"><a href="program-vol-list.php"><img src="../images/volGroup.jpg" width="30" height="30"><span>Volunteers</span></a></p><p id="tooltip3" style="float:left;"><a href="clone-program.php"><img src="../images/cloneProgram.png" width="30" height="30"><span>Clone Program</span></a></p><p id="tooltip4" style="float:left;"><a href="delete-program.php?programname=',rawurlencode($_SESSION[$programName]),'"><img src="../images/trashCan.jpg" width="30" height="30"><span>Delete Program</span></a></p>';
				echo '</div>';
				echo '<br><br>';	
				echo '<div id="programopen">';	
				if($_SESSION[$totalPositionsAvailable] != '')
				{
					echo $_SESSION[$totalPositionsAvailable];
					echo ' Open Positions';
				}
				echo '</div><br>';	
				echo '<div class="clear"></div>';
				echo '<div class="boxFormat16">';
				echo '<div class="box16">';
				echo '</div>';
				echo '</div>';
			}
			$totalOpenPositions = 0;
		}
		else if($_SESSION['PROGRAM_VIEW_STATE'] == 'PastPrograms')
		{
			$todaysDate = date("m/d/Y");
			$today = strtotime($todaysDate);
			$programEndDate = strtotime($_SESSION[$endDate]);
			if(isset($_SESSION[$programName]) && ($programEndDate < $today) && ($_SESSION[$programStatus] == 'Published')) 
			{
				$displayedPrograms += 1;
				echo '<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/',$_SESSION[$programImage],'" alt="Program Picture" width="180" height="120"></div>';
				echo '<div id="position">';
				echo '<a href="program-manager.php?programname=',$_SESSION[$programName],'&orgname=',$_SESSION['ORG_NAME'],'">',$_SESSION[$programName],'</a>';
				echo '</div><br><br>';	
				echo '<div id="programdate">';	
				if($_SESSION[$endDate] == '' && $_SESSION[$date] == '')
				{
					//don't do anything since this is a draft and it hasn't been set yet
				}
				else
				{
					echo date('l, M jS Y',strtotime($_SESSION[$date])); echo ' at ';echo date(' h:i A',strtotime($_SESSION[$timeStart]));
				}
				
				if($_SESSION[$endDate] == '' && $_SESSION[$date] == '')
				{
					//don't do anything since this is a draft and it hasn't been set yet
				}
				else if($_SESSION[$date] == $_SESSION[$endDate]) //If its the same day show end time
				{
					echo date(' h:i A',strtotime($_SESSION[$endTime]));
				}
				else if($_SESSION[$endDate] == '')
				{
					echo ' to '; echo date(' h:i A',strtotime($_SESSION[$endTime]));
				}
				else
				{
					echo ' to ';
					echo date('l, M jS Y',strtotime($_SESSION[$endDate])); echo ' at ';echo date(' h:i A',strtotime($_SESSION[$endTime]));
				}
				echo '</div>';
				echo '<div id="programlinks">';	
				echo '<p id="tooltip1" style="float:left;"><a href="introduction.php"><a href="program-manager.php?programname=',$_SESSION[$programName],'&orgname=',$_SESSION['ORG_NAME'],'"><img src="../images/editProgramsSmall.png" width="30" height="30"><span>Edit Prgoram</span></a></p><p id="tooltip2" style="float:left;"><a href="program-vol-list.php"><img src="../images/volGroup.jpg" width="30" height="30"><span>Volunteers</span></a></p><p id="tooltip3" style="float:left;"><a href="clone-program.php"><img src="../images/cloneProgram.png" width="30" height="30"><span>Clone Program</span></a></p><p id="tooltip4" style="float:left;"><a href="delete-program.php?programname=',rawurlencode($_SESSION[$programName]),'"><img src="../images/trashCan.jpg" width="30" height="30"><span>Delete Program</span></a></p>';
				echo '</div>';
				echo '<br><br>';	
				echo '<div id="programopen">';	
				if($_SESSION[$totalPositionsAvailable] != '')
				{
					echo $_SESSION[$totalPositionsAvailable];
					echo ' Open Positions';
				}
				echo '</div><br>';	
				echo '<div class="clear"></div>';
				echo '<div class="boxFormat16">';
				echo '<div class="box16">';
				echo '</div>';
				echo '</div>';
			}
			$totalOpenPositions = 0;
		}
		else if(($_SESSION['PROGRAM_VIEW_STATE'] == 'UpcomingPrograms') || ($_SESSION['PROGRAM_VIEW_STATE'] == ''))
		{
			$todaysDate = date("m/d/Y");
			$today = strtotime($todaysDate);
			$programStartDate = strtotime($_SESSION[$date]);
			if(isset($_SESSION[$programName]) && ($programStartDate >= $today) && ($_SESSION[$programStatus] == 'Published')) 
			{
				$displayedPrograms += 1;
				echo '<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/',$_SESSION[$programImage],'" alt="Program Picture" width="180" height="120"></div>';
				echo '<div id="position">';
				echo '<a href="program-manager.php?programname=',$_SESSION[$programName],'&orgname=',$_SESSION['ORG_NAME'],'">',$_SESSION[$programName],'</a>';
				echo '</div><br><br>';	
				echo '<div id="programdate">';	
				if($_SESSION[$endDate] == '' && $_SESSION[$date] == '')
				{
					//don't do anything since this is a draft and it hasn't been set yet
				}
				else
				{
					echo date('l, M jS Y',strtotime($_SESSION[$date])); echo ' at ';echo date(' h:i A',strtotime($_SESSION[$timeStart]));
				}
				
				if($_SESSION[$endDate] == '' && $_SESSION[$date] == '')
				{
					//don't do anything since this is a draft and it hasn't been set yet
				}
				else if($_SESSION[$date] == $_SESSION[$endDate]) //If its the same day show end time
				{
					echo date(' h:i A',strtotime($_SESSION[$endTime]));
				}
				else if($_SESSION[$endDate] == '')
				{
					echo ' to '; echo date(' h:i A',strtotime($_SESSION[$endTime]));
				}
				else
				{
					echo ' to ';
					echo date('l, M jS Y',strtotime($_SESSION[$endDate])); echo ' at ';echo date(' h:i A',strtotime($_SESSION[$endTime]));
				}
				echo '</div>';
				echo '<div id="programlinks">';	
				echo '<p id="tooltip1" style="float:left;"><a href="introduction.php"><a href="program-manager.php?programname=',$_SESSION[$programName],'&orgname=',$_SESSION['ORG_NAME'],'"><img src="../images/editProgramsSmall.png" width="30" height="30"><span>Edit Prgoram</span></a></p><p id="tooltip2" style="float:left;"><a href="program-vol-list.php"><img src="../images/volGroup.jpg" width="30" height="30"><span>Volunteers</span></a></p><p id="tooltip3" style="float:left;"><a href="clone-program.php"><img src="../images/cloneProgram.png" width="30" height="30"><span>Clone Program</span></a></p><p id="tooltip4" style="float:left;"><a href="delete-program.php?programname=',rawurlencode($_SESSION[$programName]),'"><img src="../images/trashCan.jpg" width="30" height="30"><span>Delete Program</span></a></p>';
				echo '</div>';
				echo '<br><br>';	
				echo '<div id="programopen">';	
				if($_SESSION[$totalPositionsAvailable] != '')
				{
					echo $_SESSION[$totalPositionsAvailable];
					echo ' Open Positions';
				}
				echo '</div><br>';	
				echo '<div class="clear"></div>';
				echo '<div class="boxFormat16">';
				echo '<div class="box16">';
				echo '</div>';
				echo '</div>';
			}
			$totalOpenPositions = 0;
		}
	}
	echo '</div>';
	echo '</div>';
	echo '<div class="boxFormat13">';
	echo '<div class="box14" style="text-align:center;">';
	if($displayedPrograms >= 1)
	{
		echo 'Now Showing: 1-';
		echo $displayedPrograms;
		echo ' of ',$displayedPrograms;
	}
	else
	{
		echo 'No Results';
	}
?>

</div>
</div>
</div>
<div class="calendarView">
<script type='text/javascript'>

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		var i = 0;
		var eventList = new Array();
			for(i = 0; i <= 1;  i=i+1)
			{
				eventList[0] = {title: 'something', start: new Date(y, m, 1)};
			}
		
		
		$('.calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			editable: true,

				eventList[]
		});
		
	});

</script>
<div class="clear"></div>
<br><br>
<div class="calendar">
</div>
</div>

<div class="clear"></div>


</div>
</div>

<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>





