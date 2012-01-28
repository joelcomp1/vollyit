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

	$script = clean($_SESSION['ref']);
	if($script == '/php/org-public.php')
	{
		$orgname = $_SESSION['ORG_NAME_VIEW'];
	}
	else
	{
		$orgname = $_SESSION['ORG_NAME'];
	}
	
	$qry = 'SELECT * FROM volConn WHERE id_request="';
	$qry .= $orgname;
	$qry .= '" and status="ACCEPTED"';
	
	$rProg = mysql_query($qry);		

	while($row = mysql_fetch_assoc($rProg))
	{
		$tempVol = $row['id_inviter'];
		$q1 = "SELECT * FROM vols where login='$tempVol'";
		$r2 = mysql_query($q1);
	
		$vol = mysql_fetch_assoc($r2);
				echo '<li>';
				echo '<div style="text-align:center;">';
				echo '<a href="vol-manager.php?vol=',$vol['login'],'">';
				if($vol['userimage'] != '')
				{
					echo '<img src="uploaded_files/',$vol['userimage'],'" width="160" height="120" alt="User Picture"></a>';	
				}
				else
				{
					echo '<img src="../images/nophoto.png"  width="160" height="120"  alt="User Picture"></a>';	
				}
				echo '</div>';
				echo '<div class="clear"></div>';
				echo '<p style="text-align:center;">';
				echo $vol['firstname']; echo ' '; echo $vol['lastname'];
				echo '</p>';
				echo '</li>';		
	
	}
							
?>




	
