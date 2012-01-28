<?php
include("config.php");
$search_term = filter_var($_GET["name"], FILTER_SANITIZE_STRING);
$search_term2 = filter_var($_GET["tags"], FILTER_SANITIZE_STRING);
$search_term3 = filter_var($_GET["location"], FILTER_SANITIZE_STRING);
if($search_term == 'Enter Program/Organization Name')
{	
	$search_term = '';
}
if($search_term2 == 'Enter Keywords/Interests')
{	
	$search_term2 = '';
}
if($search_term3 != 'Enter Any Location')
{
	list($city, $state) = split('[,]', $search_term3);
}
$q = "SELECT * FROM orgs WHERE orgname LIKE '%".$search_term."%' and tag LIKE '%".$search_term2."%'  and city LIKE '%".$city."%'  and state LIKE '%".$state."%'";
$qProg = "SELECT * FROM programs WHERE programname LIKE '%".$search_term."%' and tag LIKE '%".$search_term2."%'  and city LIKE '%".$city."%'  and state LIKE '%".$state."%' and draft='Published'";
$r = mysql_query($q);
$rProg = mysql_query($qProg);
echo '<div class="orgProgHeadingOrganizations"><div class="box9">';


	if(mysql_num_rows($r)==0)//no result found
	{
		echo "No Organizations Found that Match Your Criteria!</div></div>";
	}
	else //result found
	{	
		if(mysql_num_rows($r) == 1)
		{
			echo ' 1 Organization matched your search criteria:';
		}
		else 
		{
			echo ' '; echo mysql_num_rows($r); echo ' Organizations matched your search criteria:';
		}
		echo '</div></div><div class="clear"></div><br>';
		$counter = 0;
		$displayOrgs = 0;
		while($row = mysql_fetch_assoc($r))
		{
			$tempOrgName = $row['orgname'];
			$q1 = "SELECT * FROM programs where orgname='$tempOrgName' and draft='Published'";
			$r2 = mysql_query($q1);
			$numPrograms = mysql_num_rows($r2);
			if(($counter % 5) == 0)
			{	
				if($counter != 0)
				{
					echo '</div>';
				}
				$displayOrgs += 1;
				echo '<div id="pageOrgs',$displayOrgs,'" style="display:none;">';
			}
			$counter += 1;
?>
				
				<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/<?php echo $row['orgimage']; ?>" alt="Org Picture" width="50" height="50"></div>
				<div id="searchResultsNameLocation">
				<a href="org-manager.php?orgname=<?php echo $row['orgname']; ?>&zipcode=<?php echo $row['zipcode']; ?>"><?php echo $row['orgname']; ?></a> (<?php echo $row['city']; echo ', '; echo $row['state']; echo ' '; echo $row['zipcode']; echo ')';?>
				</div>
				<div id="programlinks">
				<a href="org-manager.php?orgname=<?php echo $row['orgname']; ?>&zipcode=<?php echo $row['zipcode']; ?>"><img src="../images/vollyhere.png" width="120" height="55"></a>
				</div>
				<br>	
				<div id="orgInfoForDisplay">
				<?php if($row['primaryorgtype'] != '') {echo $row['primaryorgtype']; echo ', ';}?> <?php if($row['secondaryorgtype'] != '') {echo $row['secondaryorgtype'];} echo '    -    '; if($numPrograms != ''){echo $numPrograms;} else { echo '0';} echo ' Upcoming Programs'; echo '    -    '; if($numVols != ''){echo $numVols;} else { echo '0';} echo ' Volunteering Here';?>
				</div>
			
				<br><br>
				<div class="clear"></div>
				<br>





<?php
		}
			echo '</div>';
			echo '<script>	$("#pageOrgs1").show();</script>';
			if($counter > 5)
			{
				echo '<div id="extraOrgs" style="text-align:center;">
				<a href="#" onclick="showAllOrgs()">View All The Organizations Matching Your Search Criteria</a>
				</div><br>';
			}
		
	}
echo '<div class="orgProgHeadingPrograms"><div class="box9">';
	if(mysql_num_rows($rProg)==0)//no result found
	{
		echo "No Programs Found that Match Your Criteria!</div></div>";
	}
	else //result found
	{	
		if(mysql_num_rows($rProg) == 1)
		{
			echo ' 1 Program matched your search criteria:';
		}
		else 
		{
			echo ' '; echo mysql_num_rows($rProg); echo ' Programs matched your search criteria:';
		}
		echo '</div></div><div class="clear"></div><br>';
		$counter = 0;
		$displayProgs = 0;
		while($row = mysql_fetch_assoc($rProg))
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
				$displayProgs += 1;
				echo '<div id="page',$displayProgs,'" style="display:none;">';
			}
			$counter += 1;
?>
				
				<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/<?php echo $row['programimage']; ?>" alt="Program Picture" width="50" height="50"></div>
				<div id="searchResultsNameLocation">
				<a href="program-manager.php?orgname=<?php echo $row['orgname']; ?>&programname=<?php echo $row['programname']; ?>"><b><?php echo $row['programname']; ?></b></a> (<?php echo $row['city']; echo ', '; echo $row['state']; echo ' '; echo $row['zipcode']; echo ')';?>
				<br>	
				<a href="org-manager.php?orgname=<?php echo $row['orgname']; ?>&zipcode=<?php echo $row['zipcode']; ?>"><?php echo $row['orgname']; ?></a>
				<br>
				</div>
				<div id="programlinks">
				<a href="program-manager.php?orgname=<?php echo $row['orgname']; ?>&programname=<?php echo $row['programname']; ?>"><img src="../images/vollyhere.png" width="120" height="55"></a>
				</div>
				<br><br>
				<div id="orgInfoForDisplay">
				<?php echo date('l, F jS Y',strtotime($row['date'])); echo '    -    '; echo $row['starttime']; echo '    -    '; echo $totalOpenPositions; echo ' More Volunteers Needed';?>
				</div>
				
				<br><br>
				<div class="clear"></div>
				<br>
<?php
			}
			echo '</div>';
			echo '<script>	$("#page1").show();</script>';
			if($counter > 5)
			{
				echo '<div id="extraPrograms" style="text-align:center;">
				<a href="#" onclick="showAllPrograms()">View All The Programs Matching Your Search Criteria</a>
				</div><br>';
			}
		
	}
					echo '<div id="backToResults" style="display:none; text-align:center;">
				<a href="#" onclick="showResults()">Back To Search Results</a>
				</div>';
	echo '<div class="boxFormat16">
				<div class="box16" style="border: #fff">
				</div>
				</div>';
	
	
	
?>
<script type="text/javascript" src="../js/search.js"></script>