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
		$qProg = "SELECT * FROM programs where orgname='$orgname' and draft='Published' and programname='$indexClosest'";
		$rProg = mysql_query($qProg);
		if(mysql_num_rows($rProg) > 0)
		{
		while($row = mysql_fetch_assoc($rProg))
		{
		
			$todaysDate = date("m/d/Y");
			$today = strtotime($todaysDate);
			$programStartDate = strtotime($row['date']);
	
			if($programStartDate >= $today) 	
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

					echo '<div id="orgHomeProgram">';
				echo $row['programname'];
				echo '</div>';	
				echo '<div id="programdateOrgHome">';	
				echo date('D, M jS',strtotime($row['date'])); echo date(' h:i A',strtotime($row['statetime']));
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
		
		}

		
			
	}
	}
	else
	{
			echo '<center>You Have No Upcoming Programs! <br> <br><a href="create-program-part1.php"><img src="../images/createprograms.jpg"></a></center>';
	}
	

	
	
	
?>