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
	
	$qry = 'SELECT * FROM additadmins WHERE orgname="';
	$qry .= $orgname;
	$qry .= '"';
	
	$rProg = mysql_query($qry);		

	while($row = mysql_fetch_assoc($rProg))
	{
		$tempVol = $row['additemail'];
		$q1 = "SELECT * FROM vols where email='$tempVol'";
		$r2 = mysql_query($q1);
		$vol = mysql_fetch_assoc($r2);

		echo '<div style="text-align:center;">';
		echo '<a href="vol-manager.php?vol=',$vol['login'],'">';
		if($vol['userimage'] != '')
		{
			echo '<img src="uploaded_files/',$vol['userimage'],'" width="40" height="40" alt="User Picture"></a>';	
		}
		else
		{
			echo '<img src="../images/nophoto.png"  width="40" height="40"  alt="User Picture"></a>';	
		}
		echo '</div>';
		echo '<div class="clear"></div>';
		echo '<p style="text-align:center;">';
		echo $vol['firstname']; echo ' '; echo $vol['lastname'];
		echo '</p>';
	}
	//now make the one for the creater of the organization
	$qry = 'SELECT * FROM orgs WHERE orgname="';
	$qry .= $orgname;
	$qry .= '"';
	
	$rProg = mysql_query($qry);	
	$row = mysql_fetch_assoc($rProg);
	$tempVol = $row['login'];

	$q1 = "SELECT * FROM vols where login='$tempVol'";
	$r2 = mysql_query($q1);
	$vol = mysql_fetch_assoc($r2);
	
	echo '<div style="float:left">';
	echo '<a href="vol-manager.php?vol=',$vol['login'],'">';
	if($vol['userimage'] != '')
	{
		echo '<img src="uploaded_files/',$vol['userimage'],'" width="40" height="40" alt="User Picture"></a>';	
	}
	else
	{
		echo '<img src="../images/nophoto.png"  width="40" height="40"  alt="User Picture"></a>';	
	}
	echo '</div>';
	echo '<div class="clear"></div>';
	echo '<p style="float:left;">';
	echo $vol['firstname']; echo ' '; echo $vol['lastname'];
	echo '</p>';
						
?>




	
