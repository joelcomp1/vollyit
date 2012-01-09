<?php
include("config.php");
session_start();
$orgname = $_SESSION['ORG_NAME'];
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}


		$qProg = "SELECT * FROM programs where orgname='$orgname' and draft='Published'";
		$rProg = mysql_query($qProg);

		$todaysDate = date("m/d/Y");
		$today = strtotime($todaysDate);
		$closestDate = '';
		$indexClosest = '';
		while($row = mysql_fetch_assoc($rProg))
		{ //need to find what program is next
			
			$programStartDate = strtotime($row['date']);
			if(($programStartDate >= $today) && ($programStartDate != ''))
			{
				if(($programStartDate < $closestDate) || ($closestDate == ''))
				{
					$closestDate = $programStartDate;
					$indexClosest = $row['programname'];
				}
			}
		}		
		

		$counter = 0;

		$rProg = mysql_query($qProg);
		if(mysql_num_rows($rProg) > 0)
		{
		while($row = mysql_fetch_assoc($rProg))
		{
		
			$todaysDate = date("m/d/Y");
			$today = strtotime($todaysDate);
			$programStartDate = strtotime($row['date']);
			
			if(($programStartDate >= $today) && ($counter < 3))
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
				echo date('D, M jS',strtotime($row['date'])); echo date(' h:i A',strtotime($row['starttime']));
				echo '</div>';
				echo '<br>';
				echo '<div id="programopen">';	

				echo '</div><br>';	
				echo '<div class="clear"></div>';

		
		}

		
			
	}
	}
	else
	{
			echo '<center>You Have No Upcoming Programs! <br> <br><a href="create-program-part1.php"><img src="../images/createprograms.jpg"></a></center>';
	}
	

	
	
	
?>