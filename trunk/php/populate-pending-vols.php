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

	$orgname = clean($_SESSION['ORG_NAME']);

	$qProg = "SELECT * FROM volConn where id_request='$orgname' and status='REQUEST_SENT'";

	$rProg = mysql_query($qProg);
	$counter = 0;
		
	$display = 0;

	echo '</div></div><div class="clear"></div><br>';
	while($row = mysql_fetch_assoc($rProg))
	{
				$tempVol = $row['id_inviter'];
				$q1 = "SELECT * FROM vols where login='$tempVol'";
				$r2 = mysql_query($q1);
				
				$vol = mysql_fetch_assoc($r2);
					
				echo '<div id="programImageTable" style="float:left; padding: 0px 0px 0px 10px;"><img src="uploaded_files/',$vol['userimage'],'" alt="Program Picture" width="50" height="50"></div>';
				echo '<div id="positionToShow">';
				echo '<a href="vol-manager.php?vol=',$vol['login'],'">',$vol['firstname']; echo ' '; echo $vol['lastname']; echo '</a>';
				echo '</div><br>';	
				echo '<div style="float:right;">';	
				echo '<a href="approve-vol.php?request_id=',$tempVol,'"><img src="../images/approve.png" width="61" height="20"></a><a href="reject-vol.php?request_id=',$tempVol,'"><img src="../images/reject.png" width="61" height="20"></a>';
				echo '</div>';
				echo '<div id="volInfo" style="float:left;">';
				echo 'E-Mail: ';
				echo $vol['email'];
				echo '</div><br>';
				echo '<div id="volInfo" style="float:left;">';
				if($vol['phonenumber'] != '')
				{
					echo 'Phone: ';
					echo $vol['phonenumber'];
				}
				echo '</div>';	
	
				echo '<div class="clear"></div>';
				echo '<br>';

	}
							
?>
	

	
