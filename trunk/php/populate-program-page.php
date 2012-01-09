<?php

include("config.php");
session_start();

	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}
$search_term = clean($_SESSION['SEARCH']);
$orgname = $_SESSION['ORG_NAME'];
$state  = $_SESSION['PROGRAM_VIEW_STATE'];
if($_SESSION['SEARCH'] == 'Filter')
{	
	$search_term = '';
}
if(($state  == 'UpcomingPrograms') || ($state  == ''))
{
	$qProg = "SELECT * FROM programs where orgname='$orgname' and draft='Published' and programname LIKE '%".$search_term."%'";
}
else if($state  == 'PastPrograms')
{
	$qProg = "SELECT * FROM programs where orgname='$orgname' and draft='Published' and programname LIKE '%".$search_term."%'";
}
else if($state  == 'All')
{
	$qProg = "SELECT * FROM programs where orgname='$orgname' and programname LIKE '%".$search_term."%'";
}
else if($state  == 'Drafts')
{
	$qProg = "SELECT * FROM programs where orgname='$orgname' and draft<>'Published' and programname LIKE '%".$search_term."%'";
}

		$rProg = mysql_query($qProg);
		echo '</div></div><div class="clear"></div><br>';
		$counter = 0;
		
		$display = 0;
		while($row = mysql_fetch_assoc($rProg))
		{
		
			$todaysDate = date("m/d/Y");
			$today = strtotime($todaysDate);
			$programEndDate = strtotime($row['enddate']);
			$programStartDate = strtotime($row['date']);
				
			if(((($programEndDate < $today) && ($row['enddate'] != '')) && ($state  == 'PastPrograms'))
				|| ($state  == 'Drafts') || ($state  == 'All') 
				|| (($programStartDate >= $today) && (($state == 'UpcomingPrograms') || ($state == '')))) 	
			{
				$totalOpenPositions = 0;
				$tempProgramName = $row['programname'];
				$tempOrgName = $row['orgname'];
				$q1 = "SELECT * FROM programpositions where orgname='$tempOrgName' and programname='$tempProgramName'";
				$r2 = mysql_query($q1);
				while($positions = mysql_fetch_assoc($r2))
				{
					$totalOpenPositions += ($positions['numavail'] - $$positions['numtaken']);
			
				}
				$numPrograms = mysql_num_rows($r2);
				if(($counter % 5) == 0)
				{	
					if($counter != 0)
					{
						echo '</div>';
					}
					$display += 1;
					echo '<div id="page',$display,'" style="display:none;">';
				}

				$counter = $counter + 1;
				echo '<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/',$row['programimage'],'" alt="Program Picture" width="180" height="120"></div>';
				echo '<div id="position">';
				echo '<a href="program-manager.php?programname=',$row['programname'],'&orgname=',$row['orgname'],'">',$row['programname'],'</a>';
				if($row['draft'] != 'Published')
				{
					echo '     Draft';
				}
				echo '</div><br><br>';	
				echo '<div id="programdate">';	
				if($row['enddate'] == '' && $row['date'] == '')
				{
					//don't do anything since this is a draft and it hasn't been set yet
				}
				else
				{
					echo date('l, M jS Y',strtotime($row['date'])); echo ' at ';echo date(' h:i A',strtotime($row['starttime']));
				}
				
				if($row['endDate'] == '' && $row['date'] == '')
				{
					//don't do anything since this is a draft and it hasn't been set yet
				}
				else if($row['date'] == $row['enddate']) //If its the same day show end time
				{
					echo date(' h:i A',strtotime($row['endtime']));
				}
				else if($row['endDate'] == '')
				{
					echo ' to '; echo date(' h:i A',strtotime($row['endtime']));
				}
				else
				{
					echo ' to ';
					echo date('l, M jS Y',strtotime($row['enddate'])); echo ' at ';echo date(' h:i A',strtotime($row['endtime']));
				}
				echo '</div>';
				echo '<div id="programlinks">';	
				echo '<p id="tooltip1" style="float:left;"><a href="introduction.php"><a href="program-manager.php?programname=',$row['programname'],'&orgname=',$row['orgname'],'"><img src="../images/editProgramsSmall.png" width="30" height="30"><span>Edit Prgoram</span></a></p><p id="tooltip2" style="float:left;"><a href="program-vol-list.php"><img src="../images/volGroup.jpg" width="30" height="30"><span>Volunteers</span></a></p><p id="tooltip3" style="float:left;"><a href="clone-program.php"><img src="../images/cloneProgram.png" width="30" height="30"><span>Clone Program</span></a></p><p id="tooltip4" style="float:left;"><a href="delete-program.php?programname=',rawurlencode($row['programname']),'"><img src="../images/trashCan.jpg" width="30" height="30"><span>Delete Program</span></a></p>';
				echo '</div>';
				echo '<br><br>';	
				echo '<div id="programopen">';	
				if($totalOpenPositions != '')
				{
					echo $totalOpenPositions;
					echo ' Open Positions';
				}
				echo '</div><br>';	
				echo '<div class="clear"></div>';
				if(($counter % 5) != 0)
				{
					echo '<div class="boxFormat16">';
					echo '<div class="box16">';
					echo '</div>';
					echo '</div>';
				}
		
				
			}
		}
			
	
				echo '<div class="boxFormat16">
				<div class="box16" style="border: #fff">
				</div>
				</div>';
			
				echo '</div>';
				echo '</div>';
				echo '<div class="boxFormat13" style="padding: 0px 0 0 0px;">
				<div class="endProgramBox">';
				
				echo '<div id="leftsearchPage" style="float: right; padding: 0 20px 0px 0px;"">';
				if($counter == 0)
				{
					echo 'No Programs Match this criteria';
					
				}
				else
				{
					
					
					if($display > 1)
					{
						echo '<script>	$("#page1").show();</script>';
						$pageNum = 1;
						echo '<div id="showNext" style="float:right; padding: 0 10px 0px 10px;">';
						echo '<a href="#" onclick="determineNext()">Next</a>';
						echo '</div>';
						
						echo '<div id="showPrev" style="display:none; float:right; padding: 0 10px 0 10px;">';
						echo '<a href="#" onclick="determinePrev()">Previous</a>';
						echo '</div>';
						echo 'There are ',$display,' pages of results';
						
					}
					else
					{
						$pageNum = 1;
						echo '<script>	$("#page1").show();</script>';
						echo 'There is ',$display,' page of results';
					}
		
				}
				
				echo '</div>';
				echo '</div>';
				echo '</div>';
?>
	<script type="text/javascript">function determineNext(){
	var loop = 0; 
	var className = "#page";
	var classToShow = "#page";
	var maxClass = <?php echo $display ?>;
	for(loop = 1; loop <= maxClass;loop = loop + 1)
	{
		className = className + loop;
		if($(className).is(":visible"))
		{ 
			$(className).hide();
			classToShow = classToShow + (loop + 1);
			$(classToShow).show();
			$("#showPrev").show();
			if(maxClass == (loop + 1))
			{
				$("#showNext").hide();
			}
			
			break;
		}
		className = "#page";
	}
	}
	
	function determinePrev(){
	var loop = 0; 
	var className = "#page";
	var classToShow = "#page";
	var maxClass = <?php echo $display ?>;
	for(loop = 1; loop <= maxClass;loop = loop + 1)
	{

		className = className + loop;
		if($(className).is(":visible"))
		{
			$(className).hide();
			classToShow = classToShow + (loop - 1);
			$(classToShow).show();
			$("#showNext").show();
			
			if((loop - 1) == 1)
			{
				$("#showPrev").hide();
			}
	
			break;
		}
		className = "#page";
	}
	}
	
	
	
	
	</script>
	
