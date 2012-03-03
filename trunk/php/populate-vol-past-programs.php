
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
$login = clean($_SESSION['SESS_MEMBER_ID']);
$script = clean($_SESSION['ref']);
$vol = clean($_SESSION['VOL_LOGIN']);
$todaysDate = date("m/d/Y");
$today = strtotime($todaysDate);
if($script == "/php/member-index-vol.php")
{
	$q = "SELECT distinct * FROM programvol WHERE vollogin='$login'";


}
else
{
	$q = "SELECT distinct * FROM programvol WHERE vollogin='$vol'";
}
$r = mysql_query($q);



?>

<div class="orgListComplete">
<?php	
		$counter = 0;
		while(($row = mysql_fetch_assoc($r)) && ($counter < 20))
		{
			$counter++;

			$q1 = 'SELECT * FROM programs WHERE orgname="';
			$q1 .= $row['orgname'];
			$q1 .= '" and programname="';
			$q1 .= $row['programname'];
			$q1 .= '"';
			$r2 = mysql_query($q1);
			$programInfo = mysql_fetch_assoc($r2);
		
			$programEndDate = strtotime($programInfo['enddate']);
			$programStartDate = strtotime($programInfo['date']);

				if((($programEndDate < $today) && ($programInfo['enddate'] != '')) || (($programInfo['enddate'] != '') && ($programInfo['recurring'] == '')))	
				{

?>
				<div id="friend" style="float:left; padding: 10px 10px 10px 10px; text-align:left;">
				<div id="programImageTable" style="float:left; padding: 0px 0px 0px 0px;"><img src="uploaded_files/<?php echo $programInfo['programimage']; ?>" alt="User Picture" width="40" height="40"></div>
				<div id="friendinfo" style="float:left; padding: 0px 0px 0px 10px; ">
				<b><a href="program-manager.php?orgname=<?php echo $programInfo['orgname']; ?>&programname=<?php echo $programInfo['programname']; ?>"><?php echo $programInfo['programname'];?></a></b>
				<br>
				<i><?php echo $programInfo['city']; echo ', '; echo $programInfo['state'];   ?></i>
				</div>
				</div>
				<div class="clear"></div>
		
				
<?php
				}
		}
?>
</div>