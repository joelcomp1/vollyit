<script src="../js/popup.js" type="text/javascript"></script>
<script src="../js/jquery.ez-pinned-footer.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery-1.5.1.min.js" type="text/javascript" charset="utf-8"></script>	
<?php
	//Start session
	session_start();
include("config.php");
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}
	$search_term = clean($_SESSION['SEARCH']);

if($_SESSION['SEARCH'] == 'Search')
{	
	$search_term = '';
}

$q = "SELECT * FROM orgs WHERE orgname LIKE '%".$search_term."%'";
$qProg = "SELECT * FROM programs WHERE programname LIKE '%".$search_term."%' and draft='Published'";
$qVols = "SELECT * FROM vols WHERE firstname LIKE '%".$search_term."%' or lastname LIKE '%".$search_term."%'";
$r = mysql_query($q);
$rProg = mysql_query($qProg);
$rVols = mysql_query($qVols);
echo (mysql_num_rows($r) + mysql_num_rows($rProg) + mysql_num_rows($rVols));
echo ' Search Results Returned from searching "';
echo $search_term;
echo '" ';
echo '<div class="clear"></div><br>';
echo '<div class="orgProgHeadingOrganizations" style="float:left;"><div class="box9">';


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
		$display = 0;
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
				$display += 1;
				echo '<div id="pageOrgs',$display,'" style="display:none;">';
			}
			$counter += 1;
			?>
				
				<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/<?php echo $row['orgimage']; ?>" alt="Org Picture" width="50" height="50"></div>
				<div id="searchResultsNameLocation">
				<a href="org-manager.php?orgname=<?php echo $row['orgname']; ?>&zipcode=<?php echo $row['zipcode']; ?>"><?php echo $row['orgname']; ?></a> (<?php echo $row['city']; echo ', '; echo $row['state']; echo ' '; echo $row['zipcode']; echo ')';?>
				</div>
				<div id="programlinks">
				<a href="org-manager.php?orgname=<?php echo $row['orgname']; ?>&zipcode=<?php echo $row['zipcode']; ?>"><img src="../images/vollyhere.png" width="138" height="45"></a>
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
echo '<div class="orgProgHeadingPrograms" style="float:left;"><div class="box9">';
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
		$displayPrograms = 0;
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
				$displayPrograms += 1;
				echo '<div id="page',$displayPrograms,'" style="display:none;">';
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
				<a href="program-manager.php?orgname=<?php echo $row['orgname']; ?>&programname=<?php echo $row['programname']; ?>"><img src="../images/vollyhere.png" width="138" height="45"></a>
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
				echo '<div id="extraPrograms" style="text-align:center;" id="searchResults">
				<a href="#" onclick="showAllPrograms()">View All The Programs Matching Your Search Criteria</a>
				</div><br>';
			}
	}
	echo '<div class="orgProgHeadingPeople" style="float:left;"><div class="box9">';
	if(mysql_num_rows($rVols)==0)//no result found
	{
		echo "No People Found that Match Your Criteria!</div></div>";
	}
	else //result found
	{	
		if(mysql_num_rows($rVols) == 1)
		{
			echo ' 1 Person matched your search criteria:';
		}
		else 
		{
			echo ' '; echo mysql_num_rows($rVols); echo ' People matched your search criteria:';
		}
		echo '</div></div><div class="clear"></div><br>';
		$counter = 0;
		$displayPeople = 0;
		while($row = mysql_fetch_assoc($rVols))
		{

			if(($counter % 5) == 0)
			{	
				if($counter != 0)
				{
					echo '</div>';
				}
				$displayPeople += 1;
				echo '<div id="pagePe',$displayPeople,'" style="display:none;">';
			}
			$counter += 1;
?>			
				
				<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/<?php echo $row['userimage']; ?>" alt="Volunteer Picture" width="50" height="50"></div>
				<div id="searchResultsNameLocation">
				<a href="vol-manager.php?vol=<?php echo $row['login']; ?>"><b><?php echo $row['firstname']; echo ' '; echo $row['lastname'];?></b></a> 
				<br>	
				</div><br>
				<div id="orgInfoForDisplay">
				<?php echo $row['city']; echo ', '; echo $row['state']; echo ' ';?>
				</div>
				<div id="programlinks">
				<a href="vol-manager.php?vol=<?php echo $row['login']; ?>"><img src="../images/viewprofiles.png" width="138" height="45"></a>
				</div>
				<br>
				
				<br><br>
				<div class="clear"></div>
				<br>
<?php
			

		}
			echo '</div>';
			echo '<script>	$("#pagePe1").show();</script>';
			if($counter > 5)
			{
				echo '<div id="extraPeople" style="text-align:center;">
				<a href="#" onclick="showAllPeople()">View All The People Matching Your Search Criteria</a>
				</div>';
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
<script type="text/javascript">function showAllPeople(){
			$(".orgProgHeadingOrganizations").hide();
			$(".orgProgHeadingPrograms").hide();
			$("#page1").hide();
			$("#pageOrgs1").hide();
			$("#extraPrograms").hide();
			$("#extraOrgs").hide();
			$("#extraPeople").hide();
			$("#backToResults").show();
			
			var classToShow = "#pagePe";
			var maxClass1 = <?php echo $displayPeople ?>;
			for(loop = 2; loop <= maxClass1;loop = loop + 1)
			{
				classToShow = classToShow + loop;
				$(classToShow).show();
			}

	
	}
	
	function showAllPrograms(){
			$(".orgProgHeadingOrganizations").hide();
			$(".orgProgHeadingPeople").hide();
			$("#pagePe1").hide();
			$("#pageOrgs1").hide();
			$("#extraPrograms").hide();
			$("#extraOrgs").hide();
			$("#extraPeople").hide();
			$("#backToResults").show();
			var classToShow = "#page";
			var maxClass = <?php echo $displayPrograms ?>;
			for(loop = 2; loop <= maxClass;loop = loop + 1)
			{
				classToShow = classToShow + loop;
				$(classToShow).show();
			}

	
	}
	
	function showAllOrgs(){
			$(".orgProgHeadingPrograms").hide();
			$(".orgProgHeadingPeople").hide();
			$("#pagePe1").hide();
			$("#page1").hide();
			$("#extraPrograms").hide();
			$("#extraOrgs").hide();
			$("#extraPeople").hide();
			$("#backToResults").show();
			var classToShow = "#pageOrgs";
			var maxClass = <?php echo $display ?>;
			for(loop = 2; loop <= maxClass;loop = loop + 1)
			{
				classToShow = classToShow + loop;
				$(classToShow).show();
			}

	
	}
	
		
	function showResults(){
			$(".orgProgHeadingPrograms").show();
			$(".orgProgHeadingPeople").show();
			$(".orgProgHeadingOrganizations").show();
			$("#extraPrograms").show();
			$("#extraOrgs").show();
			$("#extraPeople").show();
			$("#backToResults").hide();
			$("#pageOrgs1").show();			
			$("#pagePe1").show();
			$("#page1").show();
			
			var classToShow1 = "#page";
			var classToShow2 = "#pageOrgs";
			var classToShow3 = "#pagePe";
			var maxClass1 = <?php echo $display ?>;
			var maxClass2 = <?php echo $displayPrograms ?>;
			var maxClass3 = <?php echo $displayPeople ?>;
			for(loop = 2; loop <= maxClass1;loop = loop + 1)
			{
				classToShow2 = classToShow2 + loop;
				$(classToShow2).hide();
			}
			for(loop = 2; loop <= maxClass2;loop = loop + 1)
			{
				classToShow1 = classToShow1 + loop;
				$(classToShow1).hide();
			}
			for(loop = 2; loop <= maxClass3;loop = loop + 1)
			{
				classToShow3 = classToShow3 + loop;
				$(classToShow3).hide();
			}
	
	}
	
	
	</script>