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
				

		$counter = 0;
		$closetPrograms[] = array();
		if(mysql_num_rows($rProg) > 0)
		{
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
								if($closetPrograms[0]['closestDate'] == '')
								{
									$closetPrograms[0]['closestDate'] = $dateToIterate;
									$closetPrograms[0]['programname'] = $row['programname'];
									break;
								}
								else if($programStartDate < strtotime($closetPrograms[0]['closestDate']))
								{
															
									$closetPrograms[1]['closestDate'] = $closetPrograms[0]['closestDate'];
									$closetPrograms[1]['programname'] = $closetPrograms[0]['programname'];
									$closetPrograms[0]['closestDate'] = $dateToIterate;
									$closetPrograms[0]['programname'] = $row['programname'];
									break;
								}
								else if($closetPrograms[1]['closestDate'] == '')
								{
									$closetPrograms[1]['closestDate'] = $dateToIterate;
									$closetPrograms[1]['programname'] = $row['programname'];
									break;
								}
								else if($programStartDate < strtotime($closetPrograms[1]['closestDate']))
								{
									$closetPrograms[2]['closestDate'] = $closetPrograms[1]['closestDate'];
									$closetPrograms[2]['programname'] = $closetPrograms[1]['programname'];
									$closetPrograms[1]['closestDate'] = $dateToIterate;
									$closetPrograms[1]['programname'] = $row['programname'];
									break;
								}
								else if($closetPrograms[2]['closestDate'] == '')
								{
									$closetPrograms[2]['closestDate'] = $dateToIterate;
									$closetPrograms[2]['programname'] = $row['programname'];
									break;
								}

								else if($programStartDate < strtotime($closetPrograms[2]['closestDate']))
								{
									$closetPrograms[2]['closestDate'] = $dateToIterate;
									$closetPrograms[2]['programname'] = $row['programname'];
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
								if($closetPrograms[0]['closestDate'] == '')
								{
									$closetPrograms[0]['closestDate'] = $dateToIterate;
									$closetPrograms[0]['programname'] = $row['programname'];
									break;
								}
								else if($programStartDate < strtotime($closetPrograms[0]['closestDate']))
								{
															
									$closetPrograms[1]['closestDate'] = $closetPrograms[0]['closestDate'];
									$closetPrograms[1]['programname'] = $closetPrograms[0]['programname'];
									$closetPrograms[0]['closestDate'] = $dateToIterate;
									$closetPrograms[0]['programname'] = $row['programname'];
									break;
								}
								else if($closetPrograms[1]['closestDate'] == '')
								{
									$closetPrograms[1]['closestDate'] = $dateToIterate;
									$closetPrograms[1]['programname'] = $row['programname'];
									break;
								}
								else if($programStartDate < strtotime($closetPrograms[1]['closestDate']))
								{
									$closetPrograms[2]['closestDate'] = $closetPrograms[1]['closestDate'];
									$closetPrograms[2]['programname'] = $closetPrograms[1]['programname'];
									$closetPrograms[1]['closestDate'] = $dateToIterate;
									$closetPrograms[1]['programname'] = $row['programname'];
									break;
								}
								else if($closetPrograms[2]['closestDate'] == '')
								{
									$closetPrograms[2]['closestDate'] = $dateToIterate;
									$closetPrograms[2]['programname'] = $row['programname'];
									break;
								}

								else if($programStartDate < strtotime($closetPrograms[2]['closestDate']))
								{
									$closetPrograms[2]['closestDate'] = $dateToIterate;
									$closetPrograms[2]['programname'] = $row['programname'];
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
								if($closetPrograms[0]['closestDate'] == '')
								{
									$closetPrograms[0]['closestDate'] = $dateToIterate;
									$closetPrograms[0]['programname'] = $row['programname'];
									break;
								}
								else if($programStartDate < strtotime($closetPrograms[0]['closestDate']))
								{
															
									$closetPrograms[1]['closestDate'] = $closetPrograms[0]['closestDate'];
									$closetPrograms[1]['programname'] = $closetPrograms[0]['programname'];
									$closetPrograms[0]['closestDate'] = $dateToIterate;
									$closetPrograms[0]['programname'] = $row['programname'];
									break;
								}
								else if($closetPrograms[1]['closestDate'] == '')
								{
									$closetPrograms[1]['closestDate'] = $dateToIterate;
									$closetPrograms[1]['programname'] = $row['programname'];
									break;
								}
								else if($programStartDate < strtotime($closetPrograms[1]['closestDate']))
								{
									$closetPrograms[2]['closestDate'] = $closetPrograms[1]['closestDate'];
									$closetPrograms[2]['programname'] = $closetPrograms[1]['programname'];
									$closetPrograms[1]['closestDate'] = $dateToIterate;
									$closetPrograms[1]['programname'] = $row['programname'];
									break;
								}
								else if($closetPrograms[2]['closestDate'] == '')
								{
									$closetPrograms[2]['closestDate'] = $dateToIterate;
									$closetPrograms[2]['programname'] = $row['programname'];
									break;
								}

								else if($programStartDate < strtotime($closetPrograms[2]['closestDate']))
								{
									$closetPrograms[2]['closestDate'] = $dateToIterate;
									$closetPrograms[2]['programname'] = $row['programname'];
									break;
								}
						}
				}			
			}	
			$i = 0;
			while(($closetPrograms[$i]['closestDate'] != '') && ($i < 3))
			{
				$indexClosest = $closetPrograms[$i]['programname'];
				$rProg = mysql_query("SELECT * FROM programs WHERE orgname='".$orgname."' and draft='Published' and programname='$indexClosest'");
				$row = mysql_fetch_assoc($rProg);
				$totalOpenPositions = 0;
				$tempProgramName = $row['programname'];
				$tempOrgName = $row['orgname'];
				
				$r2 =mysql_query("SELECT * FROM programpositions WHERE orgname='".$tempOrgName."' and programname='".$tempProgramName."'");

				while($positions = mysql_fetch_assoc($r2))
				{
					$totalOpenPositions += ($positions['numavail'] - $$positions['numtaken']);
			
				}
				$numPrograms = mysql_num_rows($r2);
				$counter += 1;

				echo '<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/',$row['programimage'],'" alt="Program Picture" width="180" height="120"></div>';
				echo '<div id="positionOrganizatonPage"><b>';
				echo $row['programname']; 
				echo '</b><div style="float:right; padding: 0px 10px 0px 10px;"> ';
				echo '( '; echo $row['city']; echo ', '; echo  $row['state']; echo ' )'; 
				echo '</div>';
			
				echo '</div>';
				echo '<br>';	
				echo '<div id="programdate">';	
				echo $row['programdescrip'];
				echo '</div>';
				echo '<div id="programlinks" style="background-color:green; color:#000!important;">';	
				if($totalOpenPositions != '')
				{
					if($numPrograms == '')
					{
						echo 'Come Help Out!';
					}
					else
					{
						echo $totalOpenPositions;
						echo ' More Needed!';
					}
				}
				else
				{
					echo 'Come Help Out!';
				}
				echo '</div>';
				echo '<br><br>';
				echo '<div id="viewProgramLink">';	
				echo '<a href="program-manager.php?programname=',$row['programname'],'&orgname=',$row['orgname'],'"><img src="../images/viewprogram.png"  width="90" height="40"></a>';
				echo '</div>';
				echo '<br><br>';
				echo '<div id="viewProgramLink">';	
				echo date('D, M jS',strtotime($closetPrograms[$i]['closestDate'])); echo date(' h:i A',strtotime($row['starttime']));
				echo '</div>';
				echo '<br>';
				echo '<div id="programopen">';	

				echo '</div><br>';	
				echo '<div class="clear"></div>';		
				$i++;
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
	
	}
		
	
?>