<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	//Start session
	session_start();
	
	$login = $_GET['login'];
	$userid = $_GET['reset'];
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(isset($_SESSION['SESS_MEMBER_ID'])) 
	{
		if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
		{
			header("location: php/member-index-org.php");
		}
		else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
		{
			header("location: php/member-index-vol.php");
		}
		exit();
	}
	

	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: Web-based Volunteer Management</title>
<link href="style.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/collection.js"></script>
  <script src="js/popup.js" type="text/javascript"></script>
<link href="php/loginmodule.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.ez-pinned-footer.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery-1.5.1.min.js" type="text/javascript" charset="utf-8"></script>
<?php 
	if(isset($login) && isset($userid))
	{
		echo '<script src="js/reset-homepage.js" type="text/javascript" charset="utf-8"></script>';
	}
	else
	{
		echo '<script src="js/homepage.js" type="text/javascript" charset="utf-8"></script>';
	
	}
?>
	
<div class="header" style="height: 0px!important; padding: 0 0 0 0px!important">
<div id="leftheading" style="float:left; vertical-align:top;">
<form class="searchform" method="post" action="search-website.php" >
	<input class="searchfield" type="text" value="Search" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" />
	<input class="searchbutton" type="submit" value="Go" />
</form>
</div>
<nav id="mainnavuser">
<div id="heading" style="float:right">
<div class="wrapLanding">
<a href="#" class="show_hide"><img src="images/vollying.jpg" width="100" height="50" alt="header image2" class="headerimg2"></a>
</div>
<div class="slidingDiv3">
<a href="#" class="show_hide3"><img src="images/home.jpg" width="100" height="50" alt="header image2" class="headerimg2"></a>
</div>

</div>
<div id="headingLeft"  style="text-align:center;">
<h1 id="textlogo" style="float:none; text-align:center; margin:0px 80px 0px 0px;">
volly<span>.it</span>
</h1>
</div>

<br>
<div id="headingLeft"  style="text-align:center;">
<h2 style="float:none;">Volunteering to change the world</h2>
</div>
</nav>

</div>


<div id="mainnav">
	<?php
	if(($_SESSION['SESS_LOGOUT']) == 'true') 
	{
		echo '<a href="#?w=350" rel="popup3" class="poplight"></a>';	
		
	}
	if(($_SESSION['LOGIN_FAILED']) == 'true') 
	{
		echo '<a href="#?w=350" rel="popup3" class="poplight"></a>';	
	}
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<a href="#?w=350" rel="popup3" class="poplight"></a>';	
	}
	

	
	?>
</div>

</head>
<body>


<div id="popup3" class="popup_block">
	<?php	if(($_SESSION['SESS_LOGOUT']) == 'true') 
	{
		//Start session
		session_start();
		$_SESSION['SESS_LOGOUT'] = 'false';
		session_write_close();
		echo 'You Have been Logged Out';	
		
	}
	if(($_SESSION['LOGIN_FAILED']) == 'true') 
	{
		//Start session
		session_start();
		$_SESSION['LOGIN_FAILED'] = 'false';
		session_write_close();
		echo 'Your Login or Registration Failed, please try again';	
		
	}

	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
?>
</div>



<div class="slidingDiv">

<nav id="mainnavuser">


	<div style="text-align:center;">
<form id="loginForm" name="loginForm" method="post" action="php/login-exec.php">

<b>User ID</b>
	  <input name="login" type="text" class="textfield" id="logintest" tabindex="1" autofocus style="color:#0000;" value="User Name" onfocus="this.value = this.value=='User Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'User Name' : this.value; this.value=='User Name' ? this.style.color='#ccc' : this.style.color='#000'" />

	<b>    Password</b>
<input name="password" type="password" class="textfield" id="password"   tabindex="2" style="color:#0000;" value="Password" onfocus="this.value = this.value=='Password' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Password' : this.value; this.value=='Password' ? this.style.color='#ccc' : this.style.color='#000'"/>
  
  &nbsp;<input type="submit" name="Submit" value="Login"  tabindex="3"/>
  <div class="clear"></div>
  <br>

	

</form>

</div>
	  <div id="login">
  <a href="#">Forgot Password?</a>
  </div>
<div id="popupContact2">
	<a id="popupContactClose2">x</a>
	
	<h2 style=" padding:0px 0 0 30px!important; float:none; text-align: left;">Reset Password</h2>
	<p id="contactArea" style=" padding:0px 0 0 30px!important; float:none; text-align: left;">
	Enter the email address you used whne creating your accround.  Hit the send button and we will send you an email with instructions to reset your password.
	<br><br>
<form id="loginForm" name="loginForm" method="post" action="php/reset-password.php">
<b>Email</b>
	  <input name="email" type="text" class="textfield" id="email" tabindex="1" autofocus style="color:#0000;" value="E-mail" onfocus="this.value = this.value=='E-mail' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'E-mail' : this.value; this.value=='E-mail' ? this.style.color='#ccc' : this.style.color='#000'" />
	&nbsp;<input type="submit" name="Submit" value="Send"  tabindex="1"/>

</form>
		</p>
	 
	</div>
	<div id="backgroundPopup2"></div>
</nav>
	
	
	</div>

<div class="slidingDiv2">
<nav id="mainnavuser">
Some various Content here</nav></div>



<div class="slidingDiv4">

<nav id="mainnavuser">
	<?php	
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
?>

	<h2 style="float:none; text-align:center;"> Reset Your Password </h2>
	<div style="text-align:center;">
<form id="loginForm" name="loginForm" method="post" style="float:none; text-align:center;" action="php/password-reset-form.php">
		<input type="hidden" name="userid" value="<?php echo $userid;?>">
      <b>User ID</b>
	  

		<input name="login" type="text" class="textfield"  tabindex="1" id="login"  autofocus style="color:#0000;" value="<?php echo $login;?>"/>
		<div class="clear"></div>
		<b>New Password</b>

	<input name="password" type="password" class="textfield"  tabindex="2"  id="password"  style="color:#0000;" value=""/>
   <div class="clear"></div>
   <b>Confirm New Password </b>
      <input name="cpassword" type="password"  tabindex="3" class="textfield" id="cpassword" />
	     <div class="clear"></div>
    &nbsp;
      <input type="submit" name="Submit"  tabindex="4" value="Reset Password" />
</form>
</div>
</nav>
</div>


<div class="wrapLanding">
<nav id="mainnavuser">
<p align=center>
<iframe width="320" height="240" src="http://www.youtube.com/embed/dkHbQrlQ7yE" frameborder="0" align="middle" ></iframe>
</p>
<h3><b>Get Started</b></h3>
<div class="clear"></div>

<div class="landingLinks" style="text-align:center; height: 200px;">
<div class="homepageOrg">
<div id="newOrg" style="font:bold 1.6em 'TeXGyreAdventor', Arial, sans-serif!important;  text-align:center;">
Organizations
<br>
<img class="floatleft" src="images/homepageClickable2.png" style="padding: 0 0 0 20px;" alt="header image"  class="headerimg"  usemap ="#homepagemap">  
<br>
</div>

<div class="clear"></div>
<div style="font:bold 1.2em 'TeXGyreAdventor', Arial, sans-serif!important;  text-align:center;">
The ultimage way to manage and recruit volunteers.
<br>
Simple. Quick. Easy.
</div>
</div>
<div class="homepageVol">
<div id="newVol" style="font:bold 1.6em 'TeXGyreAdventor', Arial, sans-serif!important;  text-align:center;">
Volunteers
<br>
<img class="floatleft" src="images/homepageClickable.png" style="padding: 0 0 0 40px;" alt="header image"  class="headerimg"  usemap ="#homepagemap"> 
<br>
</div>
<div class="clear"></div>
<div style="font:bold 1.2em 'TeXGyreAdventor', Arial, sans-serif!important;  text-align:center;">
Find opportunities.  Champion causes.  Make a difference.
<br>
Don't wait
</div>
</div>
</div>

<div id="popupContactVol">
		<a id="popupContactCloseVol">x</a>
		<center>
		<h2 style=" padding:0px 0 0 0px!important; float:none;">Sweet we are Stoked you want to Volly!</h2>
		<p id="contactArea">
		<?php
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
	?>
	<center>
<form id="loginForm" name="loginForm" method="post" action="php/register-exec-vol.php">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
      <td><b>User ID</b></td>
	  
      <td>
		<input name="login" type="text" class="textfield"  tabindex="1" id="login"  autofocus style="color:#0000;" value="User Name" onfocus="this.value = this.value=='User Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'User Name' : this.value; this.value=='User Name' ? this.style.color='#ccc' : this.style.color='#000'"/>
		</td>
    </tr>
    <tr>
      <td><b>Password</b></td>
      <td>
<input name="password" type="password" class="textfield"  tabindex="2"  id="password"  style="color:#0000;" value="Password" onfocus="this.value = this.value=='Password' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Password' : this.value; this.value=='Password' ? this.style.color='#ccc' : this.style.color='#000'"/>
    </tr>
    <tr>
      <th>Confirm Password </th>
      <td><input name="cpassword" type="password"  tabindex="3" class="textfield" id="cpassword" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit"  tabindex="4" value=" Lets Go " /></td>
    </tr>
  </table>
</form>
</center>
</p>
</div>
<div id="backgroundPopupVol"></div>

<div id="popupContactOrg">
	<a id="popupContactCloseOrg">x</a>
	<h2 style=" padding:0px 0 0 0px!important; float:none;">Let's Get Your Organization Setup!</h2>
	<p id="contactArea">
	<?php
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
	?>
<center>
<form id="loginForm" name="loginForm" method="post" action="php/register-exec-org.php">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td><b>User ID</b></td>
	  <td>
		<input name="login" type="text" class="textfield" id="login" autofocus tabindex="1" style="color:#0000;" value="User Name" onfocus="this.value = this.value=='User Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'User Name' : this.value; this.value=='User Name' ? this.style.color='#ccc' : this.style.color='#000'"/>
		</td>
    </tr>
    <tr>
      <td><b>Password</b></td>
		<td>
		<input name="password" type="password" class="textfield"  tabindex="2" id="password"  style="color:#0000;" value="Password" onfocus="this.value = this.value=='Password' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Password' : this.value; this.value=='Password' ? this.style.color='#ccc' : this.style.color='#000'"/>
		<td>
	</tr>
    <tr>
      <th>Confirm Password </th>
      <td><input name="cpassword" type="password"  tabindex="3" class="textfield" id="cpassword" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit"  tabindex="4" value=" Lets Go " /></td>
    </tr>
  </table>
</form>
</center>
</p>
</div>
<div id="backgroundPopupOrg"></div>

	


 </div>
</div>
<div id="footerclear"></div><?php include "php/footer.php";?>
<div class="learnAboutVolly" style="text-align:center;"><a href="#"><img src="images/whyvolly.png"></a></div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){



	$.fn.popOpen = function(){
		
		popID = $(this).attr('rel'); //Get Popup Name
		popURL = $(this).attr('href'); //Get Popup href to define size
		
		//Pull Query & Variables from href URL
		query= popURL.split('?');
		dim= query[1].split('&');
		popWidth = dim[0].split('=')[1]; //Gets the first query string value
		
		
		//Fade in the Popup and add close button
		$('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend();
		
		//Define margin for center alignment (vertical + horizontal) - we add 80 to the height/width to accomodate for the padding + border width defined in the css
		var popMargTop = 0;
		var popMargLeft = 200;
		
		//Apply Margin to Popup
		$('#' + popID).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		//Fade in Background
		$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer 
		
	};

	//When you click on a link with class of poplight and the href starts with a # 
	$('a.poplight[href^=#]').click(function() {
		$(this).popOpen(); //Run popOpen function on click
		return false;
	});
	
	$('a.poplight[href=#?w=350]').popOpen(); //Run popOpen function once on load
	
	//Close Popups and Fade Layer
	$('a.close, #fade').live('click', function() { //When clicking on the close or fade layer...
	  	$('#fade , .popup_block').fadeOut(); //fade them both out
		$('#fade').remove();
		return false;
	});


	popOpen
	
});
</script>
