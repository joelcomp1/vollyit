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
$orgname = clean($_SESSION['ORG_NAME']);
$sortstate  = clean($_SESSION['VOL_SORT_STATE']);
$viewstate  = clean($_SESSION['VOL_VIEW_STATE']);


if($_SESSION['SEARCH'] == 'Filter')
{	
	$search_term = '';
}
if(($viewstate  == 'All') || ($viewstate  == ''))
{
	$qProg = "SELECT * FROM volConn where id_request='$orgname' and id_inviter LIKE '%".$search_term."%'";
}
else if($viewstate  == 'Active')
{
	$qProg = "SELECT * FROM volConn where id_request='$orgname' and status='ACCEPTED' and id_inviter LIKE '%".$search_term."%'";
}
else if($viewstate  == 'Pending')
{
	$qProg = "SELECT * FROM volConn where id_request='$orgname' and status='REQUEST_SENT' and id_inviter LIKE '%".$search_term."%'";
}
	$howMany = "SELECT * FROM volConn where id_request='$orgname' and status='ACCEPTED'";
	$numOf = mysql_query($howMany);
	$_SESSION['NUM_OF_VOLUNTEERS'] = mysql_num_rows($numOf);
	
	$howMany = "SELECT * FROM volConn where id_request='$orgname' and status='REQUEST_SENT'";
	$numOf = mysql_query($howMany);
	$_SESSION['NUM_OF_VOLUNTEERS_PENDING'] = mysql_num_rows($numOf);
	
		$rProg = mysql_query($qProg);
		echo '</div></div><div class="clear"></div><br>';
		$counter = 0;
		
		$display = 0;

	
		while($row = mysql_fetch_assoc($rProg))
		{
		
			$todaysDate = date("m/d/Y");
			$today = strtotime($todaysDate);
			$updatedDate = strtotime($row['updated_at']);
		
			//if(1) 	
			//{
				
				$tempVol = $row['id_inviter'];
				$q1 = "SELECT * FROM vols where login='$tempVol'";
				$r2 = mysql_query($q1);
				
				$vol = mysql_fetch_assoc($r2);
				
				if(($counter % 10) == 0)
				{	
					if($counter != 0)
					{
						echo '</div>';
					}
					$display += 1;
					//echo '<div id="page',$display,'"';
					//echo " style="display:none;">';
				}
	
				$counter = $counter + 1;
				echo '<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/',$vol['userimage'],'" alt="Program Picture" width="50" height="50"></div>';
				echo '<div id="position">';
				echo '<a href="vol-manager.php?vol=',$vol['login'],'">',$vol['firstname']; echo ' '; echo $vol['lastname']; echo '</a>';
				echo '</div><br><br>';	
				echo '<div id="volunteerAboutMe" >';	
				echo substr($vol['aboutme'],0,40); echo '...';
				echo '</div>';
				echo '<div id="volStatusRequest" style="float:left;">';	
				if($row['status'] == 'REQUEST_SENT')
				{
					echo 'Pending';
				}
				if($row['status'] == 'ACCEPTED')
				{
					echo 'Active';
				}
				if($row['status'] == 'DECLINED')
				{
					echo 'Declined';
				}
				
				echo '</div>';
				echo '<div id="vollinkRequest" style="float:left; width: 150px;">';	
				echo $vol['email'];
				echo '</div>';
				echo '<div id="vollinkRequest" style="float:left;">';	
				if($vol['phonenumber'] != '')
				{
					echo $vol['phonenumber'];
				}
				else
				{
					echo 'N/A';
				}echo '</div>';
				echo '<div id="vollinkRequest" style="float:left;">';	
				echo 'N/A';
				echo '</div>';
				echo '<br><br>';	
				echo '<br>';	
				echo '<div class="clear"></div>';
				if(($counter % 10) != 0)
				{
					echo '<div class="boxFormat16">';
					echo '<div class="box16">';
					echo '</div>';
					echo '</div>';
				}
		
				
			//}*/
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
					echo 'No Volunteers Match This Criteria';
					
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
<script type="text/javascript" src="../js/populateVolPage.js"></script>
	
