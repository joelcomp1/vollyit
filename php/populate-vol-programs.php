<link rel="stylesheet" type="text/css" href="../css/capslide.css" media="screen"/>
<script src="../js/jquery.capSlide.js" type="text/javascript"></script>
<?php
include("config.php");
session_start();
$login = $_SESSION['SESS_MEMBER_ID'];
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}
	
		$qry = 'SELECT distinct * FROM programvol WHERE vollogin="';
		$qry .= $login;
		$qry .= '"';
		$rProg  =mysql_query($qry);
	
		$todaysDate = date("m/d/Y");
		$today = strtotime($todaysDate);
	
		$closestDate = '';
		$indexClosest = '';
		$tempCounter = 0;
				$upcomingCounter = 0;
				while($row2 = mysql_fetch_assoc($rProg))
				{ 	//need to find what program is next

					
					$programName = $row2['programname'];
					
					$q = "SELECT * FROM programrepeats WHERE programname='$programName'";
					$r = mysql_query($q);
					$repeats = mysql_fetch_assoc($r);

					$q = "SELECT * FROM programs WHERE programname='$programName'";
					$r = mysql_query($q);
					$row = mysql_fetch_assoc($r);
					
		
					if($row['enddate'] != '' && ($today < strtotime($row['enddate'])))
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
				if(($row['enddate'] == '') && ($repeats['repeats'] != ''))//Recurring and no end date, goes forever
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
					else
					{	
						$dateToIterate =  $row['date'];
						$programStartDate = strtotime($dateToIterate);
			
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
			
	
	

		$rProg = mysql_query("SELECT distinct * FROM programvol WHERE vollogin='$login'");				
		
		if(mysql_num_rows($rProg) > 0)
		{
			$counter = 0;
			$today = strtotime($todaysDate);
		
			echo '<div id="upcomingVollys">';
			while($row = mysql_fetch_assoc($rProg))
			{	
		
				if(strtotime($closetPrograms[$counter]['closestDate']) >= $today)
				{
					$stringToPass = '"#capslide_img_cont';
					$stringToPass .= $counter;
					$stringToPass .= '"';
					$qry = 'SELECT * FROM programs WHERE orgname="';
					$qry .= $row['orgname'];
					$qry .= '" and programname="';
					$qry .= $row['programname'];
					$qry .= '"';
					$rProg2 = mysql_query($qry);
		
					$hideRemoveName = 'removeOrg';
					$hideRemoveName .= $counter;
					$newString = '#';
					$newString .= $hideRemoveName;
					//$hideRemoveName .= $counter;
					$someString = 'capslide_img_cont';
					$someString .= $counter;
					$row2 = mysql_fetch_assoc($rProg2);
					?>
					<script type="text/javascript">
					$(function(){
					$(<?php echo $stringToPass; ?>).capslide({
						caption_color	: "black",
						caption_bgcolor	: "white",
						overlay_bgcolor : "#832EA5",
						border			: "10px solid #ccc",
						showcaption	    : true
						});
						});
					</script>
					
					<?php echo '<div id="',$someString,'"';
					echo 'class="ic_container" style="float:left;">';
					echo '<div id="programImageTable" style="text-align:center;"><img src="uploaded_files/',$row2['programimage'],'" alt="Program Picture" width="240" height="180"></div>';
					echo '<div class="overlay" style="display:none;"></div>';
					echo '    <div class="ic_caption">';
					echo '        <p class="ic_category">';
					echo '<div id="viewOrgLink" style="float:right;">';	
					echo '<a href="program-manager.php?orgname=',$row['orgname'],'&programname=',$row['programname'],'"><img src="../images/arrowright.jpg"  width="40" height="40"></a>';
					echo '</div>';				echo '<div id="volOrganizatonPage" style="text-align:center; padding: 0 0 0 20px;"><b>';
					echo $row2['programname']; 
					
					echo '</b><br>';
					echo date('l, M jS Y',strtotime($closetPrograms[$counter]['closestDate'])); echo ' at ';echo date(' h:i A',strtotime($row2['starttime']));
		//			echo date('D, M jS',strtotime($closestDate)); echo ' at '; echo date(' h:i A',strtotime($progInfo['starttime']));
					?>		
					</div>
					</p>
					<h3></h3>
					<p class="ic_text" style="text-align:center;">
					<?php echo $row2['programdescrip']; ?>
					</p>
					</div>
					</div>
			
<?php
				
				}$counter++;
				
				
			}
			echo '</div>';
			$rProg = mysql_query("SELECT * FROM programvol WHERE vollogin='$login'");		
			$counter = 0;
			$today = strtotime($todaysDate);
			echo '<div id="pastVollys" style="display:none;">';
			while($row = mysql_fetch_assoc($rProg))
			{	
				if(strtotime($closetPrograms[$counter]['closestDate']) < $today)
				{
					$stringToPass = '"#capslide_img_cont';
					$stringToPass .= $counter;
					$stringToPass .= '"';
					$qry = 'SELECT * FROM programs WHERE orgname="';
					$qry .= $row['orgname'];
					$qry .= '" and programname="';
					$qry .= $row['programname'];
					$qry .= '"';
					$rProg2 = mysql_query($qry);
		
					$hideRemoveName = 'removeOrg';
					$hideRemoveName .= $counter;
					$newString = '#';
					$newString .= $hideRemoveName;
					//$hideRemoveName .= $counter;
					$someString = 'capslide_img_cont';
					$someString .= $counter;
					$row3 = mysql_fetch_assoc($rProg2);
					?>
					<script type="text/javascript">
					$(function(){
					$(<?php echo $stringToPass; ?>).capslide({
						caption_color	: "black",
						caption_bgcolor	: "white",
						overlay_bgcolor : "#832EA5",
						border			: "10px solid #ccc",
						showcaption	    : true
						});
						});
					</script>
					
					<?php echo '<div id="',$someString,'"';
					echo 'class="ic_container" style="float:left;">';
					echo '<div id="programImageTable" style="text-align:center;"><img src="uploaded_files/',$row3['programimage'],'" alt="Program Picture" width="240" height="180"></div>';
					echo '<div class="overlay" style="display:none;"></div>';
					echo '    <div class="ic_caption">';
					echo '        <p class="ic_category">';
					echo '<div id="viewOrgLink" style="float:right;">';	
					echo '<a href="program-manager.php?orgname=',$row['orgname'],'&programname=',$row['programname'],'"><img src="../images/arrowright.jpg"  width="40" height="40"></a>';
					echo '</div>';				echo '<div id="volOrganizatonPage" style="text-align:center; padding: 0 0 0 20px;"><b>';
					echo $row3['programname']; 
					
					echo '</b><br>';
					echo date('l, M jS Y',strtotime($row3['date'])); echo ' at ';echo date(' h:i A',strtotime($row3['starttime']));
		//			echo date('D, M jS',strtotime($closestDate)); echo ' at '; echo date(' h:i A',strtotime($progInfo['starttime']));
					?>		
					</div>
					</p>
					<h3></h3>
					<p class="ic_text" style="text-align:center;">
					<?php echo $row3['programdescrip']; ?>
					</p>
					</div>
					</div>
			
<?php
					
			//	}
				$counter++;
			
			}
			echo '</div>';
		
		}
	}		
	
?>