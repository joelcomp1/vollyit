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
<div id="leftheading" style="float:left; vertical-align:top;">
<a href="org-notifications.php"><img src="../images/notification.jpg" width="30" height="30"></a><a href="org-messages.php"><img src="../images/messages.jpg" width="30" height="30"></a><a href="org-feedback.php"><img src="../images/feedback.png" width="75" height="30"></a>
</div>
<div id="rightheading" style="float:right;">
<a href="member-pricing.php"><img src="../images/pricing.png" width="75" height="30"></a>
<a href="member-features.php"><img src="../images/features.png" width="75" height="30"></a>
<a href="member-support.php"><img src="../images/support.png" width="75" height="30"></a>
<a href="member-contactus.php"><img src="../images/contactus.png" width="75" height="30"></a>
<div style="vertical-align:top; float:right;">
<select name="profileSelect" onchange="redirectMe(this)">
  <option value="member-index-org.php"><?php echo $_SESSION['SESS_MEMBER_ID'];?></option>
  <option value="account-settings-org.php">Account Settings</option>
  <option value="logout.php">Logout</option>
</select>
</div>
<br>
<div class="clear"></div>
<br>
<div id="views" style="float:right">
<a href="member-index-org.php">Organization View</a> | <a href="org-manager.php?orgname=<?php echo $_SESSION['ORG_NAME'],'&zipcode=',$_SESSION['ORG_ZIPCODE'];?>">Volunteer View</a>
</div>
</div>
</div>
<script type="text/javascript">
function redirectMe (sel) {
    var url = sel[sel.selectedIndex].value;
    window.location = url;
}
</script>
</head>
