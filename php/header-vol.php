<?php 
session_start();
$_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../style.css" rel="stylesheet" type="text/css">
<script type="../text/javascript" src="../js/jquery.js"></script>
<script type="../text/javascript" src="../js/collection.js"></script>
<script src="../js/jquery.ez-pinned-footer.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/programMgmt.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>
<script type='text/javascript' src="../js/jquery-1.5.2.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.11.custom.min.js"></script>
<head>
<div class="header">
<div id="headerIcon" style="float:left;">
<img src="../images/emptyIcon.jpg" width="70" height="70" >
</div>
<div id="leftheading" style="float:left; vertical-align:top;">
<form class="searchform" method="post" action="search-website.php" >
	<input class="searchfield" type="text" value="Search" name="search" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" />
	<input class="searchbutton" type="submit" value="Go" />
</form>
</div>
<div id="rightheading" style="float:right;">
		<?php
	if(($_SESSION['VOL_IMAGE']) == true) {
	
		echo '<img style="vertical-align:top; float:left;" src="uploaded_files/',$_SESSION['IMAGE_PATH'],'" alt="User Picture" width="30" height="30">';
	}
	else
	{//This name is decieving, i am using the login pop up for the image upload.....
		echo '<img  style="vertical-align:top; float:left;" src="../images/nophoto.png" width="30" height="30" alt="header image2">';
	}
	?>
<a href="#" class="trigger3"><img src="../images/notification.jpg" width="30" height="30"></a><a href="#" class="trigger2"><img src="../images/messages.jpg" width="30" height="30"></a><a href="#"  class="trigger"><img src="../images/friendrequest.jpg" width="30" height="30"></a>
<div style="vertical-align:top; float:right;">
<select name="profileSelect" onchange="redirectMe(this)">
  <option value="member-index-vol.php"><?php echo $_SESSION['SESS_MEMBER_ID'];?></option>
  <option value="account-settings-vol.php" <?php if($_SESSION['ref'] == "/php/account-settings-vol.php") { echo 'selected=true'; } ?>>Account Settings</option>
  <?php if($_SESSION['VOLUNTEER_IS_ADMIN']	== 'true')
  { ?>
  
    <option value="switch-mode.php" <?php if($_SESSION['ref'] == "/php/switch-mode.php") { echo 'selected=true'; } ?>>Switch to Organization View</option>
  <?php }?>
  <option value="logout.php">Logout</option>
</select>
</div>
<br>
<div class="clear"></div>
<br>
</div>
</div>
<script type="text/javascript" src="../js/redirect.js"></script>
<script type="text/javascript" src="../js/volNotificationPopups.js"></script>
<script type="text/javascript" src="../js/friendRequests.js"></script>

<div class="panel">
</div>
<div class="panel2">
</div>
<div class="panel3">
</div>
</head>
