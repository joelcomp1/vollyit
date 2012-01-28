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
$login = clean($_SESSION['SESS_MEMBER_ID']);
$script = clean($_SESSION['ref']);
$vol = clean($_SESSION['VOL_LOGIN']);
if($script == "/php/member-index-vol.php")
{
	$q = "SELECT * FROM friends WHERE id_request='$login' and status='ACCEPTED'";
	$q1 = "SELECT * FROM friends WHERE id_inviter='$login' and status='ACCEPTED'";


}
else
{
	$q = "SELECT * FROM friends WHERE id_request='$vol' and status='ACCEPTED'";
	$q1 = "SELECT * FROM friends WHERE id_inviter='$vol' and status='ACCEPTED'";
}
$r = mysql_query($q);
$r1 = mysql_query($q1);

?>

<!--This is used for the Friends box part 2-->

<div class="orgListComplete">
<?php	
	$counter = 0;
		while(($row = mysql_fetch_assoc($r)) && ($counter < 20))
		{
			$counter++;
			$requester = $row['id_inviter'];
			$q1 = "SELECT * FROM vols where login='$requester'";
			$r2 = mysql_query($q1);
			$volInfo = mysql_fetch_assoc($r2);

?>
				<div id="friend" style="float:left; padding: 10px 10px 10px 10px;">
				<div id="programImageTable" style="float:left; padding: 0px 0px 0px 0px;"><img src="uploaded_files/<?php echo $volInfo['userimage']; ?>" alt="User Picture" width="40" height="40"></div>
				<div id="friendinfo" style="float:left; padding: 0px 0px 0px 10px;">
				<b><a href="vol-manager.php?vol=<?php echo $volInfo['login']; ?>"><?php echo $volInfo['firstname']; echo ' '; echo substr($volInfo['lastname'], 0, 1);?>.</a></b>
				</div>
				</div>
				<div class="clear"></div>

<?php
		}
		while(($row = mysql_fetch_assoc($r1)) && ($counter < 20))
		{
			$counter++;
			$requester = $row['id_request'];
			$q1 = "SELECT * FROM vols where login='$requester'";
			$r2 = mysql_query($q1);
			$volInfo = mysql_fetch_assoc($r2);
?>
				
				<div id="friend" style="float:left; padding: 10px 10px 10px 10px;">
				<div id="programImageTable" style="float:left; padding: 0px 0px 0px 0px;"><img src="uploaded_files/<?php echo $volInfo['userimage']; ?>" alt="User Picture" width="40" height="40"></div>
				<div id="friendinfo" style="float:left; padding: 0px 0px 0px 10px;">
				<b><a href="vol-manager.php?vol=<?php echo $volInfo['login']; ?>"><?php echo $volInfo['firstname']; echo ' '; echo $volInfo['lastname'];?></a></b>
				</div>
				</div>
				<div class="clear"></div>

<?php
		}
?>
</div>