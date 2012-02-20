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
$orgName = clean($_SESSION['ORG_NAME']);

$q = "SELECT * FROM volConn WHERE id_request='$orgName' and status<>'DECLINED' and status<>'ACCEPTED'";
$r = mysql_query($q);

	if(mysql_num_rows($r)==0)//no result found
	{
		echo "No Pending Volunteer Requests";
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
				<div id="vollyRequestInfo" style="float:left;" >Yahoo! 
				<a href="vol-manager.php?vol=<?php echo $volInfo['login']; ?>"><?php echo $volInfo['firstname']; echo ' '; echo $volInfo['lastname'];?></a> wants to volly for your organization!</div>
				<a href="approve-vol.php?request_id=<?php echo $volInfo['login']; ?>"><img src="../images/approve.png" width="61" height="20"></a><a href="reject-vol.php?request_id=<?php echo $volInfo['login']; ?>"><img src="../images/reject.png" width="61" height="20"></a>
				</div>
				<br>	
				<div class="clear"></div>
				<br>

<?php
		}
	}
?>