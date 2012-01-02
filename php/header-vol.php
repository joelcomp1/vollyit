<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<div class="header">
<div id="headerIcon" style="float:left;">
<img src="../images/emptyIcon.jpg" width="70" height="70" >
</div>
<div id="leftheading" style="float:left; vertical-align:top;">
<form class="searchform" method="post" action="search-website.php" >
	<input class="searchfield" type="text" value="Search" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" />
	<input class="searchbutton" type="submit" value="Go" />
</form>
</div>
<div id="rightheading" style="float:right;">
		<?php
	if(($_SESSION['VOL_IMAGE']) == true) {
	
		echo '<img src="uploaded_files/',$_SESSION['IMAGE_PATH'],'" alt="User Picture" width="30" height="30">';
	}
	else
	{//This name is decieving, i am using the login pop up for the image upload.....
		echo '<img src="../images/nophoto.png" width="30" height="30" alt="header image2">';
	}
	?>
<a href="vol-notifications.php"><img src="../images/notification.jpg" width="30" height="30"></a><a href="vol-messages.php"><img src="../images/messages.jpg" width="30" height="30"></a><a href="vol-friend-requests.php"><img src="../images/friendrequest.jpg" width="30" height="30"></a>
<div style="vertical-align:top; float:right;">
<select name="profileSelect" onchange="redirectMe(this)">
  <option value="member-index-vol.php"><?php echo $_SESSION['SESS_MEMBER_ID'];?></option>
  <option value="account-settings-vol.php">Account Settings</option>
  <option value="logout.php">Logout</option>
</select>
</div>
<br>
<div class="clear"></div>
<br>
</div>
</div>
<script type="text/javascript">
function redirectMe (sel) {
    var url = sel[sel.selectedIndex].value;
    window.location = url;
}
</script>
</head>
