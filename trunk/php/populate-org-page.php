<?php
include("config.php");
session_start();
$script = clean($_SESSION['ref']);
if($script == '/php/org-public.php')
{
	$orgname = $_SESSION['ORG_NAME_VIEW'];
}
else
{
	$orgname = $_SESSION['ORG_NAME'];
}
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}

		$qry = 'SELECT * FROM programs WHERE orgname="';
		$qry .= $orgname;
		$qry .= '" and draft="Published"';
		$rProg  =mysql_query($qry);

		$todaysDate = date("m/d/Y");
		$today = strtotime($todaysDate);
		$closestDate = '';
		$indexClosest = '';
		$counter = 0;
		$display = 0;
		$upcomingCounter = 0;
		while($row = mysql_fetch_assoc($rProg))
		{ 	//need to find what program is next
				$closestDate = '';
				$programName = $row['programname'];
				$q = "SELECT * FROM programrepeats WHERE programname='$programName'";
				$r = mysql_query($q);
				$repeats = mysql_fetch_assoc($r);
				if($row['enddate'] != '')
				{
					$dateToIterate =  $row['date'];
					while(strtotime($dateToIterate) < strtotime($row['enddate']))
					{
						if($repeats['repeats'] == 'Bi-Weekly')
						{
							$dateToIterate = date("m/d/Y",strtotime(date("m/d/Y", strtotime($dateToIterate)) . " +1 week"));
						}
						else if($repeats['repeats'] == 'Monthly')
						{
							$dateToIterate = date("m/d/Y",strtotime(date("m/d/Y", strtotime($dateToIterate)) . " +1 month"));
							$dateToIterate = date("m/d/Y",strtotime(date("m/d/Y", strtotime($dateToIterate)) . " -1 week"));
						}				
						else if($repeats['repeats'] == 'Yearly')
						{
							$dateToIterate = date("m/d/Y",strtotime(date("m/d/Y", strtotime($dateToIterate)) . " +1 year"));
							$dateToIterate = date("m/d/Y",strtotime(date("m/d/Y", strtotime($dateToIterate)) . " -1 week"));
						}
					
						if($repeats['everysun'] != '')
						{
							$index += 1;
							$nextSun = strtotime('next sunday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextSun);
						}
						if($repeats['everymon'] != '')
						{
							$index += 1;
							$nextMon = strtotime('next monday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextMon);
						}
						if($repeats['everytues'] != '')
						{
							$index += 1;
							$nextTue = strtotime('next tuesday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextTue);
						}
						if($repeats['everywed'] != '')
						{
							$index += 1;
							$nextWed = strtotime('next wednesday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextWed);
						}
						if($repeats['everythurs'] != '')
						{
							$index += 1;
							$nextThurs = strtotime('next thursday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextThurs);
						}
						if($repeats['everyfri'] != '')
						{
							$index += 1;
							$nextFri = strtotime('next friday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextFri);
						}
						if($repeats['everysat'] != '')
						{
							$index += 1;
							$nextSat = strtotime('next saturday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextSat);
						}
					
						$programStartDate = strtotime($dateToIterate);
						if(($programStartDate >= $today) && ($programStartDate != ''))
						{	
							$tempCounter = 0;
							while($closetPrograms[$tempCounter]['closestDate'] != '')
							{
								if(($programStartDate < strtotime($closetPrograms[$tempCounter]['closestDate'])))
								{
									$closetPrograms[$tempCounter + 1]['closestDate'] = $closetPrograms[$tempCounter]['closestDate'];
									$closetPrograms[$tempCounter + 1]['programname'] = $closetPrograms[$tempCounter]['programname'];
									$closetPrograms[$tempCounter]['closestDate'] = $dateToIterate;
									$closetPrograms[$tempCounter]['programname'] = $row['programname'];
									break;
								}
								$tempCounter++;
							}
							if($closetPrograms[$tempCounter]['closestDate'] == '')
							{
								$closetPrograms[$tempCounter]['closestDate'] = $dateToIterate;
								$closetPrograms[$tempCounter]['programname'] = $row['programname'];
								break;
							}
							else
							{
								break;
							}
						}

					}	
				}
				else if(($row['enddate'] == '') && ($repeats['repeats'] != ''))//Recurring and no end date, goes forever
				{
					$dateToIterate =  $row['date'];
					
					while((strtotime($dateToIterate)) < strtotime('12/31/2030'))
					{
						
						if($repeats['repeats'] == 'Bi-Weekly')
						{
							$dateToIterate = date("m/d/Y",strtotime(date("m/d/Y", strtotime($dateToIterate)) . " +2 week"));
						}
						else if($repeats['repeats'] == 'Monthly')
						{
							$dateToIterate = date("m/d/Y",strtotime(date("m/d/Y", strtotime($dateToIterate)) . " +1 month"));
						}				
						else if($repeats['repeats'] == 'Yearly')
						{
							$dateToIterate = date("m/d/Y",strtotime(date("m/d/Y", strtotime($dateToIterate)) . " +1 year"));
						}
						
						if($repeats['everysun'] != '')
						{
							$index += 1;
							$nextSun = strtotime('next sunday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextSun);
						}
						if($repeats['everymon'] != '')
						{
							$index += 1;
							$nextMon = strtotime('next monday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextMon);
						}
						if($repeats['everytues'] != '')
						{
							$index += 1;
							$nextTue = strtotime('next tuesday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextTue);
						}
						if($repeats['everywed'] != '')
						{
							$index += 1;
							$nextWed = strtotime('next wednesday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextWed);
						}
						if($repeats['everythurs'] != '')
						{
							$index += 1;
							$nextThurs = strtotime('next thursday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextThurs);	
						}
						if($repeats['everyfri'] != '')
						{
							$index += 1;
							$nextFri = strtotime('next friday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextFri);
						}
						if($repeats['everysat'] != '')
						{
							$index += 1;
							$nextSat = strtotime('next saturday',strtotime($dateToIterate));
							$dateToIterate = date("m/d/Y", $nextSat);	
						}
						
						$programStartDate = strtotime($dateToIterate);
						if(($programStartDate >= $today) && ($programStartDate != ''))
						{		
								$tempCounter = 0;
							while($closetPrograms[$tempCounter]['closestDate'] != '')
							{
								if(($programStartDate < strtotime($closetPrograms[$tempCounter]['closestDate'])))
								{
									$closetPrograms[$tempCounter + 1]['closestDate'] = $closetPrograms[$tempCounter]['closestDate'];
									$closetPrograms[$tempCounter + 1]['programname'] = $closetPrograms[$tempCounter]['programname'];
									$closetPrograms[$tempCounter]['closestDate'] = $dateToIterate;
									$closetPrograms[$tempCounter]['programname'] = $row['programname'];
									break;
								}
								$tempCounter++;
							}
							if($closetPrograms[$tempCounter]['closestDate'] == '')
							{
								$closetPrograms[$tempCounter]['closestDate'] = $dateToIterate;
								$closetPrograms[$tempCounter]['programname'] = $row['programname'];
								break;
							}
							else
							{
								break;
							}
						}
						
					}	
				}
					else if(($row['enddate'] == '') && ($repeats['repeats'] == '')) //only one day
					{
						$dateToIterate =  $row['date'];
						$programStartDate = strtotime($dateToIterate);
						if(($programStartDate >= $today) && ($programStartDate != ''))
						{	
							$tempCounter = 0;
							while($closetPrograms[$tempCounter]['closestDate'] != '')
							{
								if(($programStartDate < strtotime($closetPrograms[$tempCounter]['closestDate'])))
								{
									$closetPrograms[$tempCounter + 1]['closestDate'] = $closetPrograms[$tempCounter]['closestDate'];
									$closetPrograms[$tempCounter + 1]['programname'] = $closetPrograms[$tempCounter]['programname'];
									$closetPrograms[$tempCounter]['closestDate'] = $dateToIterate;
									$closetPrograms[$tempCounter]['programname'] = $row['programname'];
									break;
								}
								$tempCounter++;
							}
							if($closetPrograms[$tempCounter]['closestDate'] == '')
							{
								$closetPrograms[$tempCounter]['closestDate'] = $dateToIterate;
								$closetPrograms[$tempCounter]['programname'] = $row['programname'];
								
							}
				
						}
					}
					
		}
		
					
		

		$counter = 0;
	//	$rProg =mysql_query("SELECT * FROM programs WHERE orgname='".$orgname."' and draft='Published' and programname='$indexClosest'");
		$rProg =mysql_query("SELECT * FROM programs WHERE orgname='".$orgname."' and draft='Published' ");
		echo '<div id="upcomingProgramsFlow">';
		$weHaveAProgram = 'false';
		
		if(mysql_num_rows($rProg) > 0)
		{
			
			while($row = mysql_fetch_assoc($rProg))
			{
			
				if(strtotime($closetPrograms[$upcomingCounter]['closestDate']) >=  $today)
				{
					$weHaveAProgram = 'true';
					$totalOpenPositions = 0;
					$tempProgramName = $row['programname'];
					$tempOrgName = $row['orgname'];
					$r2 =mysql_query("SELECT * FROM programpositions WHERE orgname='".$tempOrgName."' and programname='$tempProgramName'");
	
					while($positions = mysql_fetch_assoc($r2))
					{
						$totalOpenPositions += ($positions['numavail'] - $positions['numtaken']);
				
					}
					$numPrograms = mysql_num_rows($r2);
					
	
					if(($counter % 1) == 0)
					{	
						$display += 1;
						echo '<div id="page',$display,'" style="display:none;">';
					}
					
					$counter += 1;
					echo '<div id="orgHomeProgram">';
					echo $row['programname'];
					echo '</div>';	
					echo '<div id="programdateOrgHome">';	
					echo date('l, M jS Y',strtotime($closetPrograms[$upcomingCounter]['closestDate'])); echo ' at ';echo date(' h:i A',strtotime($row['starttime']));
			//		echo date('D, M jS',strtotime($closestDate)); echo date(' h:i A',strtotime($row['starttime']));
					echo '</div>';
					echo $row['city']; echo ', '; echo  $row['state'];
					echo '<br><br>';
					echo '<div id="programlinks" style="float:none!important; background-color:green; color:#000!important;">';	
					if(totalOpenPositions != '')
					{
						if($numPrograms == '') //General, no specific positions
						{
							echo 'Come Help Out!';
						}
						else
						{
							echo $totalOpenPositions;
							echo ' More Volunteers Needed!';
						}
					}
					echo '</div>';
					echo '<br>';
					echo '<div id="viewProgramLink" style="float:none">';	
					echo '<a href="program-manager.php?programname=',$row['programname'],'&orgname=',$row['orgname'],'"><img src="../images/viewprogram.png"  width="90" height="40"></a>';
					echo '</div>';
					echo '<br><br>';
					echo '<br>';
					echo '<div id="programopen">';	
	
					echo '</div><br>';	
					echo '</div>';
					$upcomingCounter++;	
				}
			}
		
			if($weHaveAProgram == 'false')
			{
				if($script == "/php/member-index-org.php")
				{
					echo '<center>You Have No Upcoming Programs! <br> <br><a href="create-program-part1.php"><img src="../images/createprograms.jpg"></a></center>';
				}
				else
				{
					echo '<center>There are no Upcoming Programs! <br> <br> Check back again soon!</center>';
				}
		
					echo '</div>';
					echo '<div class="boxFormat2">';
					echo '<div class="box1">';
					echo '<br>';
					echo '</div>';
					echo '</div>';
					
			}
			else
			{
				echo '</div>';
				
			
				echo '<div class="boxFormat2">';
				echo '<div class="box1">';
	
	
			
				if($display > 1)
				{
					echo '<script>	$("#page1").show();</script>';
					$pageNum = 1;
					echo '<div id="showNext" style="float:right; ">';
					echo '<a href="#" onclick="determineNext()">Next</a>';
					echo '</div>';
					
					echo '<div id="showPrev" style="display:none; float:right; padding: 0 10px 0 10px;">';
					echo '<a href="#" onclick="determinePrev()">Previous</a>';
					echo '</div>';
					
					
				}
				else
				{
					$pageNum = 1;
					echo '<script>	$("#page1").show();</script>';
				
				}
				echo '</div>';
				echo '</div>';
			}
			
			
			
	}
	else
	{
		if($script == "/php/member-index-org.php")
		{
			echo '<center>You Have No Upcoming Programs! <br> <br><a href="create-program-part1.php"><img src="../images/createprograms.jpg"></a></center>';
		}
		else
		{
			echo '<center>There are no Upcoming Programs! <br> <br> Check back again soon!</center>';
		}
		
			echo '<div class="boxFormat2">';
			echo '<div class="box1">';
			echo '<br>';
			echo '</div>';
			echo '</div>';
			
	}
	

	
	
	
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