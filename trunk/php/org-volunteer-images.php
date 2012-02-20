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

	
		$rProg = mysql_query($qProg);
		echo '</div></div><div class="clear"></div><br>';
		$counter = 0;
		$display = 0;

	
		while($row = mysql_fetch_assoc($rProg))
		{
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
					
					//echo '<div id="page',$display,'"';
					//echo " style="display:none;">';
				}
	
				$counter = $counter + 1;
				$userString = 'userImage';
				$userString .= $counter;
				echo '<div id="', $userString,'" style="float:left;">';
				echo '<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><input id="volChecked" name="volChecked" type="checkbox" value="Checked" style="margin-right: 20px;"/><img src="uploaded_files/',$vol['userimage'],'" alt="Program Picture" width="50" height="50"></div>';
				echo '<div id="position">';
				echo '<a href="vol-manager.php?vol=',$vol['login'],'">',$vol['firstname']; echo ' '; echo $vol['lastname']; echo '</a>';
				echo '<input name="volLogin" id="volLogin" value =', $vol['login'],' type="hidden""></div>';	
				echo '</div>';	
				echo '<br>';	
				echo '<div class="clear"></div>';

		
				
			//}*/
		}
			

			
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



						
					}
					else
					{
						$pageNum = 1;
						echo '<script>	$("#page1").show();</script>';
	
					}
		
				}
				
				echo '</div>';
				echo '</div>';
				echo '</div>';
				
?>

	
