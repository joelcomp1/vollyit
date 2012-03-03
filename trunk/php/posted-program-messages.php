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
$programName = clean($_SESSION['PROGRAM_NAME']);
$orgName = clean($_SESSION['ORG_NAME']);

if($script == "/php/member-index-vol.php")
{
	$q = "SELECT * FROM volconn WHERE id_inviter='$login' and status='ACCEPTED'";


}
else
{
	$q = "SELECT * FROM programmsgs WHERE orgname='$orgName' and programname='$programName'";
}
$r = mysql_query($q);

$totalMsgs = mysql_num_rows($r);

?>

<!--This is used for the Friends box part 2-->
<div class="programMsgBox2">
<div class="programMessages" style="overflow-y:scroll;">


<?php	
		$counter = 0;
		while(($row = mysql_fetch_assoc($r)))
		{


?>
				<div id="friend" style="float:left; padding: 0px 0px 0px 10px; text-align:center;">
				<div id="programImageTable" style="float:none; padding: 0px 0px 0px 0px;"><b><?php echo $row['subject']; echo '  (Posted: '; echo date("M j", strtotime($row['date'])); echo ' @ '; echo date("g a", $row['date']);  echo ')';?></b></div>
				<div class="clear"></div><div id="friendinfo" style="float:none;">
					<?php echo $row['content']; ?>

				</div>
					<?php if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
					{?>
				<a href="delete-program-msg.php?programname=<?php  echo $row['programname']; ?>&orgname=<?php  echo $row['orgname']; ?>&subject=<?php echo $row['subject']; ?>">Delete</a>
				<?php } ?>
				</div>
				<div class="clear"></div><br><br>
<?php
		}
		
		if($totalMsgs == 0)
		{
			echo '<center>No Posted Messages <br> <br><a href="#"  onclick="';
			echo "popup(350, 'popup6');";
			echo '" rel="popup6" class="poplight""><img src="../images/programmsg.png"></a></center>';
		
		}
?>
</div>
</div>