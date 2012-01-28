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
	$q = "SELECT * FROM volconn WHERE id_inviter='$login' and status='ACCEPTED'";


}
else
{
	$q = "SELECT * FROM volconn WHERE id_inviter='$vol' and status='ACCEPTED'";
}
$r = mysql_query($q);

$totalOrgs = mysql_num_rows($r);

?>

<!--This is used for the Friends box part 2-->

<div class="orgListComplete">
<?php	
		$counter = 0;
		while(($row = mysql_fetch_assoc($r)) && ($counter < 20))
		{
			$counter++;
			$requester = $row['id_request'];
			$q1 = 'SELECT * FROM orgs WHERE orgname="';
			$q1 .= $requester;
			$q1 .= '"';
			$r2 = mysql_query($q1);
			$orgInfo = mysql_fetch_assoc($r2);

?>
				<div id="friend" style="float:left; padding: 10px 10px 10px 10px; text-align:left;">
				<div id="programImageTable" style="float:left; padding: 0px 0px 0px 0px;"><img src="uploaded_files/<?php echo $orgInfo['orgimage']; ?>" alt="User Picture" width="40" height="40"></div>
				<div id="friendinfo" style="float:left; padding: 0px 0px 0px 10px; ">
				<b><a href="org-manager.php?orgname=<?php echo $orgInfo['orgname']; ?>&zipcode=<?php echo $orgInfo['zipcode']; ?>"><?php echo $orgInfo['orgname'];?></a></b>
				<br>
				<i><?php echo $orgInfo['city']; echo ', '; echo $orgInfo['state'];   ?></i>
				</div>
				</div>
				<div class="clear"></div>
		
				
<?php
		}
?>
</div>