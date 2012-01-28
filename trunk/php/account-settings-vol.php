<?php
	require_once('auth.php');
	

	session_start();
	
	include 'header-vol.php';
include 'navigation-vol.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['SESS_MEMBER_ID'];?>'s Profile</title>
</head>

<body>


<div id="wrap">
<div id="mainnavuser">

<br>
<div id="popup4" class="popup_block" style="text-align:center;">
<a id="imageUploadClose">x</a>
<form id="Upload" action="upload.processor.php" enctype="multipart/form-data" method="post">
		<p>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">

		<center>
			<label for="file">You need a Picture!</label>
			<br>
			<br>
			<input id="file" type="file" name="file">
				<br>
<br>
			<input id="submit" type="submit" name="submit" value="Upload me!">
				</center>
		</p>
	
	
	</form>
</div>
<div id="backgroundCloseImageLoad"></div>
<div id="popupContact7">
	<a id="popupContactClose7">x</a>
	<p id="contactArea">
		Help info about email
		</p>
	</div>
	<div id="backgroundPopup7"></div>
	
	
<div id="popupContact8">
	<a id="popupContactClose8">x</a>
	<p id="contactArea">
		Help info about phone
		</p>
	</div>
	<div id="backgroundPopup8"></div>



<div class="clear"></div>
<h3>
<div class="box4">
Account Settings
</div>
</h3>
<div class="clear"></div>
		<?php
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<br><li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
	?>
<div class="thumbnail">
		<?php
	if(($_SESSION['VOL_IMAGE']) == true) {
	
		echo '<div id="login"><img src="uploaded_files/',$_SESSION['IMAGE_PATH'],'" alt="User Picture" width="320" height="240"></div>';
	}
	else
	{//This name is decieving, i am using the login pop up for the image upload.....
		echo '<div id="login">
<img src="../images/nophoto.png" width="320" height="240" alt="header image2""> 
</div>';
	}
	?>
<br>
<I> Click Image to Change Photo</I><br><br>
</div>
<div id="popupContact2">
	<a id="popupContactClose2">x</a>
	<center>
	<p id="contactArea">

<form id="Upload" action="upload.processor.php" enctype="multipart/form-data" method="post">
		<p>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">

		<center>
			<label for="file">Upload a Picture!</label>
			<br>
			<br>
			<input id="file" type="file" name="file">
				<br>
<br>
			<input id="submit" type="submit" name="submit" value="Upload me!">
				</center>
		</p>
	</form></center>
		</p>
	
	</div>
	<div id="backgroundPopup2"></div>


<form id="accountSettingsForm" name="accountSettingsForm" method="post" action="complete-reg-exec-vol.php">
<div class="formToProcessChanges">
 <b>First Name</b><br>
 <input name="firstName" type="text" class="field text large" id="login" tabindex="1" style="color:#0000;" value="<?php echo $_SESSION['VOL_FIRST_NAME'];?>" onfocus="this.value = this.value=='First Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'First Name' : this.value; this.value=='First Name' ? this.style.color='#999' : this.style.color='#000'"/>
<br><br>
 <b>Last Name</b><br>
 <input name="lastName" type="text" class="field text large" id="login2" tabindex="2" style="color:#0000;" value="<?php echo $_SESSION['VOL_LAST_NAME'];?>" onfocus="this.value = this.value=='First Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'First Name' : this.value; this.value=='First Name' ? this.style.color='#999' : this.style.color='#000'"/>
<br><br><b>E-Mail</b><br>

<input name="email" type="text" class="field text large" tabindex="3" id="email" style="color:#0000;" value="<?php echo $_SESSION['VOL_EMAIL'];?>" onfocus="this.value = this.value=='E-Mail' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'E-Mail' : this.value; this.value=='E-Mail' ? this.style.color='#999' : this.style.color='#000'" /></td>
<img src="../images/help.png" width="20" height="20" id="emailAccountSettings" style="padding: 0px 0px 0px 50px;"><br><br><b>Phone Number</b><br>


<span>
<input type="tel" id="phone1" name="phone1" 
    size="4" onKeyup="autotab(this, document.accountSettingsForm.phone2)" class="field text" size="3" tabindex="4"  maxlength=3 value="<?php echo $_SESSION['VOL_PHONE_PART_1'];?>">
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone2" name="phone2" 
    size="4" onKeyup="autotab(this, document.accountSettingsForm.phone3)" class="field text" size="3"  tabindex="5" maxlength=3 value="<?php echo $_SESSION['VOL_PHONE_PART_2'];?>"> 
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone3" name="phone3" size="4" maxlength="4" class="field text" tabindex="6" value="<?php echo $_SESSION['VOL_PHONE_PART_3'];?>"><img src="../images/help.png" width="20" height="20" id="phoneAccountSettings" style="padding: 0px 0px 0px 50px;">
</span>
<br>
</div>
<div class="clear"></div>
<div class="leftForm" style="float:left">
<div class="formChangesPrivacy">
<div class="box1">
<div class="leftText" style="float: left;">
Privacy Settings
</div>
</div>
</div>
<input id="radioDefault_134" name="Field134" type="hidden" value="" />
<div class="clear"></div>
<div class="aboutUsBox">
<div class="box2">

<span>
<input id="Field134_0" name="Field134" type="radio" class="field radio" value="Public" tabindex="7" <?php if($_SESSION['VOL_PRIVACY'] == 'Public'){ echo 'checked="checked"'; } ?>
/>
</span>
<label class="choice" for="Field134_0" >
Public Profile</label>

<br>
<br>
<div id="fontSize" style="font:0.8em 'TeXGyreAdventor', Arial, sans-serif!important;">
Your profile is viewable and searchable on the volly.it site by all users</div>
</div>
</div>
<div class="clear"></div>
<div class="aboutUsBox">
<div class="smallbox1">
<br>
</div>
</div>
<div class="clear"></div>
<div class="aboutUsBox">
<div class="box2">
<span>
<input id="Field134_1" name="Field134" type="radio" class="field radio" value="Private" tabindex="8"  <?php if($_SESSION['VOL_PRIVACY'] == 'Private'){ echo 'checked="checked"'; } ?>/>
<label class="choice" for="Field134_1" >
Private Profile</label>
<br>
<br>
<div id="fontSize" style="font:0.8em 'TeXGyreAdventor', Arial, sans-serif!important;">
Your limited profile is viewable and searchable on the volly.it site by all users.  Only volly.it friends and organizations, who you have chosen to share your profile information with, can view your full profile.
</div>
</span>
</div>
</div>
<div class="clear"></div>
<div class="aboutUsBox">
<div class="smallbox1">
<br>
</div>
</div>
<div class="clear"></div>
<div class="aboutUsBox">
<div class="box2">
<span>
<input id="Field134_2" name="Field134" type="radio" class="field radio" value="Hidden" tabindex="9" <?php if($_SESSION['VOL_PRIVACY'] == 'Hidden'){ echo 'checked="checked"'; } ?>/>
<label class="choice" for="Field134_2" >
Hidden Profile</label>
<br>
<br><div id="fontSize" style="font:0.8em 'TeXGyreAdventor', Arial, sans-serif!important;">
Your profile is completly hidden and does not show up in search results.  Only volly it friends and organizations, who you have chosen to share your profile information wiht, can view your profile.
</div>
</span>
</div>
</div>
<div class="clear"></div>
<div class="aboutUsBox">
<div class="box1">
<br>
</div>
</div>
</div>
<div class="rightform" style="float:right; padding: 50px 0px 0px 0px">
<div class="pwHeading" style="font: bold 1.5em 'TeXGyreAdventor', Arial, sans-serif!important;">
Change Password
</div>
<br>
<div class="chagnePassword" style="font: 1.3em 'TeXGyreAdventor', Arial, sans-serif!important;">
<div class="box1ChangePass" style="font: 1.3em 'TeXGyreAdventor', Arial, sans-serif!important;">
<br>
<label for="Field1">Old Password</label>
<input id="Field1" name="oldpassword" type="password" class="field text fn" value="" size="20" tabindex="10" />
<br>

<br>
<label for="Field1">New Password</label>
<input id="Field2" name="newpassword" type="password" class="field text fn" value="" size="20" tabindex="11" />
<br>

<br>
<label for="Field1">Confirm Password</label>
<input id="Field3" name="cpassword" type="password" class="field text ln" value="" size="30" tabindex="12" />
<br>

<br>
<div id="publish" style=" padding: 70px 0px 0px 0px">
<input type="image" name="Submit" src="../images/savechanges.png" height="120" width="200"  tabindex="13" value="Save Changes" />
 </div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script src="../js/popup.js" type="text/javascript"></script>
<script language="javascript" src="../js/autoTab.js"></script>



