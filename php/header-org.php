<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
session_start();
$_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<div class="header">
<link href="../style.css" rel="stylesheet" type="text/css">
<script type="../text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>
<div id="headerIcon" style="float:left;">
<img src="../images/logo_tag.png">
</div>
<script type="text/javascript">function displayOverlay(){
	$("#navlist3").slideToggle('fast');
}
function displayOverlayMessages(){
$("#navlist4").toggle("fast");
}
function displayOverlaySearch(){
$("#navlist5").toggle("fast");
}
</script>
<div id="leftheading" style="float:left; vertical-align:top;">

<ul id="navlist3">
<li id="notificationsActive"></li>
</ul>
<ul id="navlist4">
<li id="messagesActive"></li>
</ul>
<ul id="navlist5">
<li id="searchActive"></li>
</ul>

<ul id="navlist2">
   <?php 
  
 	if($_SESSION['ref'] == "/php/member-features.php")
	{	
		echo '<li id="searchonpage"><a href="#" class="triggerSearch" onclick="displayOverlaySearch();"></a></li>';

	}
	else 
	{
		echo '<li id="search"><a href="#" class="triggerSearch" onclick="displayOverlaySearch();"></a></li>';
	}
	?>
  
  <li id="messages"><a href="#" class="trigger2" onclick="displayOverlayMessages();"></a></li>
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
	if(mysql_num_rows($r) > 0)//no result found
	{	
		
		echo ' <li id="notificationsexist"><span>';
		echo mysql_num_rows($r);
		echo '</span><a  href="#" class="trigger3" onclick="displayOverlay();"></a></li>';
		
		
	}
	else
	{
		echo ' <li id="notifications"><a  href="#" class="trigger3" onclick="displayOverlay();"></a></li>';
	}

?>
 
</ul>
<!--a href="#" class="trigger3"><img src="../images/notification.jpg" width="30" height="30"></a><a href="#" class="trigger2"><img src="../images/messages.jpg" width="30" height="30"></a-->
</div>
<div id="rightheading" style="float:right;">
<div style="vertical-align:top; float:right;">
<select name="profileSelect" onchange="redirectMe(this)">
  <option value="member-index-org.php"><?php echo $_SESSION['SESS_MEMBER_ID'];?></option>
  <option value="account-settings-org.php" <?php if($_SESSION['ref'] == "/php/account-settings-org.php") { echo 'selected=true'; } ?>>Account Settings</option>
  <option value="logout.php">Logout</option>
</select>
</div>
<ul id="navlist">
   <?php 
  
 	if($_SESSION['ref'] == "/php/member-features.php")
	{	
		echo '<li id="featuresonpage"><a href="member-features.php"><span>Features</span></a></li>';

	}
	else 
	{
		echo '<li id="features"><a href="member-features.php"><span>Features</span></a></li>';
	}
  
	if($_SESSION['ref'] == "/php/member-support.php")
	{	
		echo '<li id="supportonpage"><a href="member-support.php"><span>Support</span></a></li>';

	}
	else 
	{
		echo '<li id="support"><a href="member-support.php"><span>Support</span></a></li>';
	}
  
  
	if($_SESSION['ref'] == "/php/member-contactus.php")
	{	
		echo '<li id="contactusonpage"><a href="member-contactus.php"><span>Contact Us</span></a></li>';

	}
	else 
	{
		echo '<li id="contactus"><a href="member-contactus.php"><span>Contact Us</span></a></li>';
	}
  ?>
  
  
</ul>
<!--a href="member-features.php"><img src="../images/features.png" width="75" height="30"></a>
<a href="member-support.php"><img src="../images/support.png" width="75" height="30"></a>
<a href="member-contactus.php"><img src="../images/contactus.png" width="75" height="30"></a-->

<br>
<div class="clear"></div>
<br>
<!--div id="views" style="float:right">
<a href="member-index-org.php">Organization View</a> | <a href="org-manager.php?orgname=<?php echo $_SESSION['ORG_NAME'],'&zipcode=',$_SESSION['ORG_ZIPCODE'];?>">Volunteer View</a>
</div-->
</div>
</div>
<script type="text/javascript" src="../js/redirect.js"></script>
<script type="text/javascript" src="../js/volNotificationPopups.js"></script>
<script type="text/javascript" src="../js/volRequests.js"></script>

<div class="panel">
</div>
<div class="panel2">
</div>
<div class="panel3">
</div>
<div class="searchPanel">
<form class="searchform" method="post" action="search-website.php" >
	<input class="searchfield" type="text" value="Search" name="search" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" />
	<input class="searchbutton" type="submit" value="Go" />
</form>
</div>
</head>
