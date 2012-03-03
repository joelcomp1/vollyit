<!--This is used for the organizations box-->
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
$orgname = clean($_SESSION['ORG_NAME_VIEW']);
$script = clean($_SESSION['ref']);

$todaysDate = date("m/d/Y");
$today = strtotime($todaysDate);

$q = "SELECT * FROM programs WHERE orgname='$orgname' and draft='Published'";


$r = mysql_query($q);


?>



<div class="orgListComplete">
<?php	
		$counter = 0;
		while(($row = mysql_fetch_assoc($r)) && ($counter < 20))
		{
			$counter++;


		
			$programEndDate = strtotime($row['enddate']);
			$programStartDate = strtotime($row['date']);
				if(($programEndDate > $today) || ($row['enddate'] == ''))	
				{

?>
				<div id="friend" style="float:left; padding: 10px 10px 10px 10px; text-align:left;">
				<div id="programImageTable" style="float:left; padding: 0px 0px 0px 0px;"><img src="uploaded_files/<?php echo $row['programimage']; ?>" alt="User Picture" width="40" height="40"></div>
				<div id="friendinfo" style="float:left; padding: 0px 0px 0px 10px; ">
				<b><a href="program-manager.php?orgname=<?php echo $row['orgname']; ?>&programname=<?php echo $row['programname']; ?>"><?php echo $row['programname'];?></a></b>
				<br>
				<i><?php echo $row['city']; echo ', '; echo $row['state'];   ?></i>
				</div>
				</div>
				<div class="clear"></div>
		
				
<?php
				}
		}
?>
</div>