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
$q = "SELECT * FROM friends WHERE id_request='$login' and status<>'DECLINED' and status<>'ACCEPTED'";
$r = mysql_query($q);

	if(mysql_num_rows($r)==0)//no result found
	{
		echo "No Pending Friend Requests";
	}
	else //result found
	{	

		while($row = mysql_fetch_assoc($r))
		{
			$requester = $row['id_inviter'];
			$q1 = "SELECT * FROM vols where login='$requester'";
			$r2 = mysql_query($q1);
			$volInfo = mysql_fetch_assoc($r2);

?>
				
				<div id="programImageTable" style="float:left; padding: 0px 0px 0px 0px;"><img src="uploaded_files/<?php echo $volInfo['userimage']; ?>" alt="User Picture" width="40" height="40"></div>
				<div id="friendRequestInfo">
				<b><a href="vol-manager.php?vol=<?php echo $volInfo['login']; ?>"><?php echo $volInfo['firstname']; echo ' '; echo $volInfo['lastname'];?></a></b>
				<a href="accept.php?request_id=<?php echo $volInfo['login']; ?>"><img src="../images/accept.png" width="50" height="25"></a><a href="decline.php?request_id=<?php echo $volInfo['login']; ?>"><img src="../images/decline.png" width="50" height="25"></a>
				</div>
				<br>	
				<div class="clear"></div>
				<br>

<?php
		}
	}
?>