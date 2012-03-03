<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

	//Start session
	session_start();
	
	$login = $_GET['login'];
	if($_GET['reset'] != '')
	{
		$userid = $_GET['reset'];
	}
	else if($_GET['userid'] != '')
	{
		$userid = $_GET['userid'];
	}
	
	$orgid = $_GET['orgid'];
	$createAccount = $_GET['createaccount'];
	$plan = $_GET['plan'];

	$volerror = $_GET['volerror'];
	$orgerror = $_GET['orgerror'];

	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(($_COOKIE['session_id'] != '') &&( $_COOKIE['passwd'] != '') && (!isset($_SESSION['ERRMSG_ARR'])) && (!isset($login) && !isset($userid)) 
	&& (!isset($userid) && !isset($createAccount)))
	{
		require_once('php/login-exec.php'); //figure out these cookies
	}
	if((isset($_SESSION['SESS_MEMBER_ID']) && $_SESSION['ORG_FINISHED'] != 'false') && (!isset($login) && !isset($userid)) 
	&& (!isset($userid) && !isset($createAccount)))
	{
		if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
		{
			if(($_SESSION['ORG_PAID']) == 'NO') 
			{
				header("location: php/member-reg-org.php");
			}
			else
			{
				header("location: php/member-index-org.php");
			}
		}
		else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
		{
			header("location: php/member-index-vol.php");
		}
		exit();
	}



	
?>
<script type="text/javascript">
	var plan = <?php echo json_encode($plan); ?>;
	var planSaved = <?php echo json_encode($_SESSION['ORG_PLAN_TEMP']); ?>;
	var volerror = <?php echo json_encode($volerror); ?>;
	var orgerror = <?php echo json_encode($orgerror); ?>;
</script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: Web-based Volunteer Management</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="css/template.css" type="text/css"/>
<script type='text/javascript' src="../js/jquery-1.5.2.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.11.custom.min.js"></script>
 <script type="text/javascript">
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#loginForm").validationEngine();
	});
</script>

<?php 
	if(isset($login) && isset($userid))
	{
		echo '<script src="js/reset-homepage.js" type="text/javascript" charset="utf-8"></script>';
	}
	else if(isset($userid) && isset($createAccount))
	{
		if($createAccount == 'yes')
		{
			echo '<script src="js/newvol-homepage.js" type="text/javascript" charset="utf-8"></script>';
		}
		else 
		{
			echo '<script src="js/link-exisitng.js" type="text/javascript" charset="utf-8"></script>';
		}

	}
	else
	{
		echo '<script src="js/homepage.js" type="text/javascript" charset="utf-8"></script>';
	
	}
?>
	
<div class="header" style="height: 0px!important; padding: 0 0 0 0px!important">
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
<h1 id="textlogo" style="float:none; text-align:center; margin:0px 0px 0px 0px;">
volly<span>.it</span>
</h1>
</div>

<br>
<div id="headingLeft"  style="float:none; text-align:center;">
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
<?php if($createAccount == 'no')
{
	echo 'Login below to link your account to the organization';
	

}?>

	<div style="text-align:center;">
<form id="loginForm" name="loginForm" method="post" action="php/login-exec.php
<?php if($createAccount == 'no')
{
	echo '?link=';
	echo $orgid;
	

}?>

">

<b>User ID</b>
	  <input name="login" type="text" class="textfield" id="logintest" tabindex="1" autofocus style="color:#0000;" value="User Name" onfocus="this.value = this.value=='User Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'User Name' : this.value; this.value=='User Name' ? this.style.color='#ccc' : this.style.color='#000'" />

	<b>    Password</b>
<input name="password" type="password" class="textfield" id="password"   tabindex="2" style="color:#0000;"/>
  
  &nbsp;<input type="submit" name="Submit" value="Login"  tabindex="3"/>
  <div class="clear"></div>
  <br>

	

</form>

</div>
	  <div id="login">
	  
  <a href="#" onclick="popup(350, 'popup4');" class="poplight">Forgot Password?</a>
  </div>
<div id="popup4" class="popup_block">

	
	<h2 style=" padding:0px 0 0 30px!important; float:none; text-align: left;">Reset Password</h2>
	<p id="contactArea" style=" padding:0px 0 0 30px!important; float:none; text-align: left;">
	Enter the email address you used whne creating your account.  Hit the send button and we will send you an email with instructions to reset your password.
	<br><br>
<form id="loginForm" name="loginForm" method="post" action="php/reset-password.php">
<b>Email</b>
	  <input name="email" type="text" class="textfield" id="email" tabindex="1" autofocus style="color:#0000;" value="E-mail" onfocus="this.value = this.value=='E-mail' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'E-mail' : this.value; this.value=='E-mail' ? this.style.color='#ccc' : this.style.color='#000'" />
	&nbsp;<input type="submit" name="Submit" value="Send"  tabindex="1"/>

</form>
		</p>
	 
	</div>

</nav>
	
	
	</div>

<div class="slidingDiv2">
<nav id="mainnavuser">
Some various Content here</nav></div>


<div class="slidingDiv5">
<nav id="mainnavuser" style="text-align:center;">



	<h2 style=" padding:0px 0 0 0px!important; float:none;">Get Pumped!</h2>
	<?php 
	if($plan == 'supreme')
	{
		echo 'You are about to sign up for The Supreme Plan!';
	}
	else if($plan == 'pro')
	{
		echo 'You are about to sign up for The Pro Plan!';
	}
	else
	{
		echo 'You are about to sign up for our Free Plan! <br> or you can choose one of your <a href="php/pricing-plan.php">beefy plans</a>';
	}
	?>
	<p id="contactArea">

  <div class="clear"></div>
  <br>
<form id="loginForm" name="loginForm" method="post" action="php/register-exec-org.php?plan=<?php echo $plan;?>">

     <b>Email</b>

			<?php if(isset($_SESSION['ORG_EMAIL_TEMP']))
			{
				echo '<input name="email" type="text" class="textfield" id="email" autofocus tabindex="1" style="color:#0000;" value="';
				echo $_SESSION['ORG_EMAIL_TEMP'];
				echo '"';
			}
			else
			{
			?>
				<input name="email" type="text" class="textfield" id="email" autofocus tabindex="1" style="color:#0000;" value="Email" onfocus="this.value = this.value=='Email' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Email' : this.value; this.value=='Email' ? this.style.color='#999' : this.style.color='#000'
			<?php
			}
			?>
			"/>

     <b>User ID</b>

			<?php if(isset($_SESSION['ORG_LOGIN_TEMP']))
			{
				echo '<input name="login" type="text" class="textfield" id="login" autofocus tabindex="2" style="color:#0000;" value="';
				echo $_SESSION['ORG_LOGIN_TEMP'];
				echo '"/>';
			}
			else
			{
			?>
				<input name="login" type="text" class="textfield" id="login" autofocus tabindex="2" style="color:#0000;" value="User Name" onfocus="this.value = this.value=='User Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'User Name' : this.value; this.value=='User Name' ? this.style.color='#999' : this.style.color='#000'"/>
			<?php
			}
			?>  <div class="clear"></div>
  <br>
<b>Password</b>

		<input name="password" type="password" class="textfield"  tabindex="3" id="password"  style="color:#0000;"/>
<b>Confirm Password</b>

      <input name="cpassword" type="password"  tabindex="4" class="textfield" id="cpassword" />
     &nbsp;
  <div class="clear"></div>
  <br>
	   By clicking "Continue" I agree to the Volly.it <a href="php/legalstuff.php#description-tab".php">Terms of Use</a> and <a href="php/legalstuff.php#usage-tab">Privacy Policy</a>
	     <div class="clear"></div>
  <br>
      <input type="submit" name="Submit"  tabindex="5" value=" Continue " />
  <div class="clear"></div>
  <br>
 <a href="php/pricing-plan.php">Choose Another Plan</a>
</form>
</p> 
</nav>
</div>




<div class="slidingDiv6">
<nav id="mainnavuser" style="text-align:center;">
	<h2 style=" padding:0px 0 0 0px!important; float:none;">Sweet we are Stoked you want to Volly!</h2>
	<p id="contactArea">

  <div class="clear"></div>
  <br>

<form id="loginForm" name="loginForm" method="post" action="php/register-exec-vol.php">

     <b>Email</b>

		<?php if(isset($_SESSION['VOL_EMAIL_TEMP']))
			{
				echo '<input name="email" type="text" class="textfield" id="email" autofocus tabindex="1" style="color:#0000;" value="';
				echo $_SESSION['VOL_EMAIL_TEMP'];
				echo '"';
			}
			else
			{
			?>
				<input name="email" type="text" data-validation-engine="validate[required]"  class="text-input" id="email" autofocus tabindex="1" style="color:#0000;" value="Email" onfocus="this.value = this.value=='Email' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Email' : this.value; this.value=='Email' ? this.style.color='#999' : this.style.color='#000'"/>
			<?php
			}
			?>




     <b>User ID</b>

			<?php if(isset($_SESSION['VOL_LOGIN_TEMP']))
			{
				echo '<input name="login" type="text" class="textfield" id="login" autofocus tabindex="2" style="color:#0000;" value="';
				echo $_SESSION['VOL_LOGIN_TEMP'];
				echo '"/>';
			}
			else
			{
			?>
				<input name="login" type="text" class="textfield" id="login" autofocus tabindex="2" style="color:#0000;" value="User Name" onfocus="this.value = this.value=='User Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'User Name' : this.value; this.value=='User Name' ? this.style.color='#999' : this.style.color='#000'"/>
			<?php
			}
			?>
			
  <div class="clear"></div>
  <br>
<b>Password</b>

		<input name="password" type="password" class="textfield"  tabindex="3" id="password"  style="color:#0000;"/>
<b>Confirm Password</b>

      <input name="cpassword" type="password"  tabindex="4" class="textfield" id="cpassword" />
     &nbsp;
  <div class="clear"></div>
  <br>
	   By clicking "Continue" I agree to the Volly.it <a href="php/legalstuff.php#description-tab">Terms of Use</a> and <a href="php/legalstuff.php#usage-tab">Privacy Policy</a>
	     <div class="clear"></div>
  <br>
      <input type="submit" name="Submit"  tabindex="5" value=" Continue " />
  <div class="clear"></div>
  <br>

</form>
</p>

</nav>
</div>



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



<div class="homepageOrg">
<div id="newOrg" style="font:bold 1.6em 'TeXGyreAdventor', Arial, sans-serif!important;  text-align:center;">
<br>
<a href="#">Make My Life Easier</a>  
<br>
</div>


</div><div class="clear"></div>
<div class="homepageVol">
<div id="newVol" style="font:bold 1.6em 'TeXGyreAdventor', Arial, sans-serif!important;  text-align:center;">
<br>
<a href="#" >Are you a volunteer?</a>  
</div>
<div class="clear"></div>
</div>
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
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;
		
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
		popUp(); //Run popOpen function on click
		return false;
	});
	
	$('a.poplight[href=#?w=350]').popOpen(); //Run popOpen function once on load
	
	//Close Popups and Fade Layer
	$('#fade').click( function() { //When clicking on the close or fade layer...
	  	$('#fade , .popup_block').fadeOut(); //fade them both out
		$('#fade').remove();
		return false;
	});


	popOpen
	
});

</script>
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
