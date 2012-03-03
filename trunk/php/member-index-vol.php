<?php

	require_once('auth.php');
	
// make a note of the current working directory relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the location of the upload handler
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';

// set a max file size for the html upload form
$max_file_size = 3000000; // size in bytes

session_start();

include 'header-vol.php';
include 'navigation-vol.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['SESS_MEMBER_ID'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/collection.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script src="../js/popup.js" type="text/javascript"></script>
</head>

<body>


<div id="wrap">
		<?php
	if(($_SESSION['SESS_FIRST_TIME']) == true) {
		echo '<a href="#?w=350" rel="popup3" class="poplight"></a>';	
	}
	?>



<div id="mainnavuser">

<div class="clear"></div>

<div style="float: left;padding: 50px 0px 0px 70px;">
<a href="search-vol.php"><img src="../images/startvollying.png" width="320" height="90"></a>
</div>


<div class="boxFormat">
<div class="box1">
<div class="leftText" style="float: left;">
<a href="#" onclick="popup(250, 'popup6');" class="poplight">Your Upcoming Vollys</a>
</div>
<div class="rightText"  style="float: right;">        
</div>
</div>
</div>


<div class="boxFormat2">
<div class="box2">
<div id='results5'>
</div>
</div>
</div>

<div class="clear"></div>
<div class="thumbnail" style="padding: 0px 0 0 70px!important;">
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

<div id="nameOfUser" style="padding: 0px 0px 0px 20px; font: bold 1.9em 'TeXGyreAdventor', Arial, sans-serif; color:#d35537; text-shadow:#fff 1px 1px 1px; text-transform:uppercase; text-align:center;">
<?php echo $_SESSION['VOL_FIRST_NAME']; echo ' '; echo $_SESSION['VOL_LAST_NAME'];?>
</div>

<div class="clear"></div>
<div style="text-align:center;">
<b> Tell your friends about Volly.it</b><br>
A Dolphin will smile if you do
</div>
	
<div id="popupContact">
	<center>
	
	</div>
	<div id="backgroundPopup"></div>
</div>

<!--This is used for the upcoming vollys box-->




<!--This is used for the snapshot box-->
<div class="boxFormat3">
<div class="box1">
   Snapshot
</div>
</div>
<div class="boxFormat2">
<div class="box2">
<div class="volunteersSnapshot" style="float: left; font:bold 0.8em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 5px;">
<center>
<a href="#" onclick="popup(250, 'popup5');" class="poplight"><img src="../images/emptyIcon.jpg" width="40" height="40" ></a>
<br>
Organizations
</center>
</div>
<div class="upcomingSnapshot" style="float: left; font:bold 0.8em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 5px;">
<center>
<a href="#" onclick="popup(250, 'popup4');" class="poplight"><img src="../images/emptyIcon.jpg" width="40" height="40" ></a>
<br>
Friends
</center>
</div>
<div class="pastProgramsSnapshot" style="float: left; font:bold 0.8em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 5px;">
<center>
<a href="#" onclick="popup(250, 'popup6');" class="poplight"><img src="../images/emptyIcon.jpg" width="40" height="40" ></a>
<br>
Upcoming Vollys
</center>
</div>
<div class="collabSnapshot" style="float: left; font:bold 0.8em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 5px;">
<center>
<a href="#" onclick="popup(250, 'popup7');" class="poplight"><img src="../images/emptyIcon.jpg" width="40" height="40" ></a>
<br>
Past Vollys
</center>
</div>
</div>
</div>
<div class="boxFormat2">
<div class="box1">
<br>
</div>
</div>


<!--This is used for the users organizations box-->
<div class="boxFormat7">
<div class="box1">
<div class="leftText" style="float: left;">
<a href="#" onclick="popup(250, 'popup5');" class="poplight">My Organizations</a>
</div>
<div class="rightText"  style="float: right;">        
<a href="search-vol.php">find organizations</a>
</div>

</div>
</div>

<div id='results2'>
</div>


<!--This is used for the about box-->
<div class="aboutmevol">
<div class="box3">
<div id="aboutMeLeft" style="float:left;">
   About Me 
</div>
<div id="aboutMeRight" style="float:right;">
  <span id="sBann" class="text">500 characters left.</span>
</div>
</div>
</div>





<!--This is used for the users organizations box part 3-->
<div class="boxFormat22">
<div class="box1">
<br>
</div>
</div>


<div class="clear"></div>
<!--This is used for the about box part 2-->
<div class="boxFormat5">
<div class="box5">
<form id="aboutMeForm" name="aboutMeForm" method="post" action="store-about-me.php">
<div>
<textarea id="eBann" 
name="aboutMeTextBox" 
style="resize: none;"
spellcheck="true" 
rows="5" cols="37" 
maxlength="500"
onKeyUp="toCount('eBann','sBann','{CHAR} characters left',500);">
 <?php
	if( isset($_SESSION['VOL_ABOUTME'])) {
		echo $_SESSION['VOL_ABOUTME'];
	}
	else
	{
		echo 'Click here to edit'; 
	}
	?></textarea>
	
	
	<center>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Save About Me" /></td>
	</center>
</div>
	</form>
</div>
</div>

<div id='results'>
</div>





<!--This is used for the Friends box part 3-->
<div class="boxFormat2">
<div class="box1">
<br>
</div>
</div>


<div class="clear"></div>
<!--This is used for the About me box part 3-->
<div class="boxFormat5">
<div class="box3">
<br>
</div>
</div>

<div id="popup5" class="popup_block">
<div id='results3'>
</div>
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
</div>

<div id="popup4" class="popup_block">
<div id='results4'>
</div>
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
</div>

<div id="popup6" class="popup_block">
<div id='results6'>
</div>
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
</div>

<div id="popup7" class="popup_block">
<div id='results7'>
</div>
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
</div>



<!--POPUP to finish registration if needed-->
<div id="popup3" class="popup_block">
	     <div id="finishUser" style="text-align:left;"><h4>Great! You're in. <br> We need a few more details.</h4>
		<br>
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
<form id="loginForm" name="loginForm" method="post" action="complete-reg-exec-vol.php">
<b>First Name</b>
 <input name="firstName" type="text" class="textfield" id="login" tabindex="1" style="color:#0000;" value="<?php echo $_SESSION['VOL_FIRST_NAME'];?>" onfocus="this.value = this.value=='First Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'First Name' : this.value; this.value=='First Name' ? this.style.color='#999' : this.style.color='#000'"/>
<br><b>Last Name</b>
<input name="lastName" type="text" class="textfield" id="lastName" tabindex="2" style="color:#0000;" value="<?php echo $_SESSION['VOL_LAST_NAME'];?>" onfocus="this.value = this.value=='Last Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Last Name' : this.value; this.value=='Last Name' ? this.style.color='#999' : this.style.color='#000'"/>
<br><b> City</b>
 <input name="city" type="text" class="textfield" tabindex="3" id="city" style="color:#0000;" value="<?php echo $_SESSION['VOL_CITY'];?>" onfocus="this.value = this.value=='City' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'City' : this.value; this.value=='City' ? this.style.color='#999' : this.style.color='#000'" /></td>
<br><b>State</b>
 <select id="state" name="state"  class="field text addr" tabindex="4" value="">
         <option value="">Select a State</option>
                    <option value="AK" <?php if($_SESSION['VOL_STATE'] == 'AK'){ echo 'selected="yes"';}?>>Alaska</option>
                    <option value="AL" <?php if($_SESSION['VOL_STATE'] == 'AL'){ echo 'selected="yes"';}?>>Alabama</option>
                    <option value="AR" <?php if($_SESSION['VOL_STATE'] == 'AR'){ echo 'selected="yes"';}?>>Arkansas</option>
                    <option value="AZ" <?php if($_SESSION['VOL_STATE'] == 'AZ'){ echo 'selected="yes"';}?>>Arizona</option>
                    <option value="CA" <?php if($_SESSION['VOL_STATE'] == 'CA'){ echo 'selected="yes"';}?>>California</option>
                    <option value="CO" <?php if($_SESSION['VOL_STATE'] == 'CO'){ echo 'selected="yes"';}?>>Colorado</option>
                    <option value="CT" <?php if($_SESSION['VOL_STATE'] == 'CT'){ echo 'selected="yes"';}?>>Connecticut</option>
                    <option value="DC" <?php if($_SESSION['VOL_STATE'] == 'DC'){ echo 'selected="yes"';}?>>Washington D.C.</option>
                    <option value="DE" <?php if($_SESSION['VOL_STATE'] == 'DE'){ echo 'selected="yes"';}?>>Delaware</option>
                    <option value="FL" <?php if($_SESSION['VOL_STATE'] == 'FL'){ echo 'selected="yes"';}?>>Florida</option>
                    <option value="GA" <?php if($_SESSION['VOL_STATE'] == 'GA'){ echo 'selected="yes"';}?>>Georgia</option>
                    <option value="HI" <?php if($_SESSION['VOL_STATE'] == 'HI'){ echo 'selected="yes"';}?>>Hawaii</option>
                    <option value="IA" <?php if($_SESSION['VOL_STATE'] == 'IA'){ echo 'selected="yes"';}?>>Iowa</option>
                    <option value="ID" <?php if($_SESSION['VOL_STATE'] == 'ID'){ echo 'selected="yes"';}?>>Idaho</option>
                    <option value="IL" <?php if($_SESSION['VOL_STATE'] == 'IL'){ echo 'selected="yes"';}?>>Illinois</option>
                    <option value="IN" <?php if($_SESSION['VOL_STATE'] == 'IN'){ echo 'selected="yes"';}?>>Indiana</option>
                    <option value="KS" <?php if($_SESSION['VOL_STATE'] == 'KS'){ echo 'selected="yes"';}?>>Kansas</option>
                    <option value="KY" <?php if($_SESSION['VOL_STATE'] == 'KY'){ echo 'selected="yes"';}?>>Kentucky</option>
                    <option value="LA" <?php if($_SESSION['VOL_STATE'] == 'LA'){ echo 'selected="yes"';}?>>Louisiana</option>
                    <option value="MA" <?php if($_SESSION['VOL_STATE'] == 'MA'){ echo 'selected="yes"';}?>>Massachusetts</option>
                    <option value="MD" <?php if($_SESSION['VOL_STATE'] == 'MD'){ echo 'selected="yes"';}?>>Maryland</option>
                    <option value="ME" <?php if($_SESSION['VOL_STATE'] == 'ME'){ echo 'selected="yes"';}?>>Maine</option>
                    <option value="MI" <?php if($_SESSION['VOL_STATE'] == 'MI'){ echo 'selected="yes"';}?>>Michigan</option>
                    <option value="MN" <?php if($_SESSION['VOL_STATE'] == 'MN'){ echo 'selected="yes"';}?>>Minnesota</option>
                    <option value="MO" <?php if($_SESSION['VOL_STATE'] == 'MO'){ echo 'selected="yes"';}?>>Missourri</option>
                    <option value="MS" <?php if($_SESSION['VOL_STATE'] == 'MS'){ echo 'selected="yes"';}?>>Mississippi</option>
                    <option value="MT" <?php if($_SESSION['VOL_STATE'] == 'MT'){ echo 'selected="yes"';}?>>Montana</option>
                    <option value="NC" <?php if($_SESSION['VOL_STATE'] == 'NC'){ echo 'selected="yes"';}?>>North Carolina</option>
                    <option value="ND" <?php if($_SESSION['VOL_STATE'] == 'ND'){ echo 'selected="yes"';}?>>North Dakota</option>
                    <option value="NE" <?php if($_SESSION['VOL_STATE'] == 'NE'){ echo 'selected="yes"';}?>>Nebraska</option>
                    <option value="NH" <?php if($_SESSION['VOL_STATE'] == 'NH'){ echo 'selected="yes"';}?>>New Hampshire</option>
                    <option value="NJ" <?php if($_SESSION['VOL_STATE'] == 'NJ'){ echo 'selected="yes"';}?>>New Jersey</option>
                    <option value="NM" <?php if($_SESSION['VOL_STATE'] == 'NM'){ echo 'selected="yes"';}?>>New Mexico</option>
                    <option value="NV" <?php if($_SESSION['VOL_STATE'] == 'NV'){ echo 'selected="yes"';}?>>Nevada</option>
                    <option value="NY" <?php if($_SESSION['VOL_STATE'] == 'NY'){ echo 'selected="yes"';}?>>New York</option>
                    <option value="OH" <?php if($_SESSION['VOL_STATE'] == 'OH'){ echo 'selected="yes"';}?>>Ohio</option>
                    <option value="OK" <?php if($_SESSION['VOL_STATE'] == 'OK'){ echo 'selected="yes"';}?>>Oklahoma</option>
                    <option value="OR" <?php if($_SESSION['VOL_STATE'] == 'OR'){ echo 'selected="yes"';}?>>Oregon</option>
                    <option value="PA" <?php if($_SESSION['VOL_STATE'] == 'PA'){ echo 'selected="yes"';}?>>Pennsylvania</option>
                    <option value="PR" <?php if($_SESSION['VOL_STATE'] == 'PR'){ echo 'selected="yes"';}?>>Puerto Rico</option>
                    <option value="RI" <?php if($_SESSION['VOL_STATE'] == 'RI'){ echo 'selected="yes"';}?>>Rhode Island</option>
                    <option value="SC" <?php if($_SESSION['VOL_STATE'] == 'SC'){ echo 'selected="yes"';}?>>South Carolina</option>
                    <option value="SD" <?php if($_SESSION['VOL_STATE'] == 'SD'){ echo 'selected="yes"';}?>>South Dakota</option>
                    <option value="TN" <?php if($_SESSION['VOL_STATE'] == 'TN'){ echo 'selected="yes"';}?>>Tennessee</option>
                    <option value="TX" <?php if($_SESSION['VOL_STATE'] == 'TX'){ echo 'selected="yes"';}?>>Texas</option>
                    <option value="UT" <?php if($_SESSION['VOL_STATE'] == 'UT'){ echo 'selected="yes"';}?>>Utah</option>
                    <option value="VA" <?php if($_SESSION['VOL_STATE'] == 'VA'){ echo 'selected="yes"';}?>>Virginia</option>
                    <option value="VT" <?php if($_SESSION['VOL_STATE'] == 'VT'){ echo 'selected="yes"';}?>>Vermont</option>
                    <option value="WA" <?php if($_SESSION['VOL_STATE'] == 'WA'){ echo 'selected="yes"';}?>>Washington</option>
                    <option value="WI" <?php if($_SESSION['VOL_STATE'] == 'WI'){ echo 'selected="yes"';}?>>Wisconsin</option>
                    <option value="WV" <?php if($_SESSION['VOL_STATE'] == 'WV'){ echo 'selected="yes"';}?>>West Virginia</option>
                    <option value="WY" <?php if($_SESSION['VOL_STATE'] == 'WY'){ echo 'selected="yes"';}?>>Wyoming</option>
		</select>
<br>
<input id="radioDefault_134" name="Field134" type="hidden" value="" />
<span>
<input id="Field134_0" name="Field134" type="radio" class="field radio" value="Public" tabindex="21" <?php if($_SESSION['VOL_PRIVACY'] == 'Public'){ echo 'checked="checked"'; } ?>
/>
<label class="choice" for="Field134_0" >
Public Profile</label>
</span>
<span>
<input id="Field134_1" name="Field134" type="radio" class="field radio" value="Private" tabindex="22" <?php if($_SESSION['VOL_PRIVACY'] == 'Private'){ echo 'checked="checked"'; } ?>/>
<label class="choice" for="Field134_1" >
Private Profile</label>
</span>
<span>
<input id="Field134_2" name="Field134" type="radio" class="field radio" value="Hidden" tabindex="23" <?php if($_SESSION['VOL_PRIVACY'] == 'Hidden'){ echo 'checked="checked"'; } ?>/>
<label class="choice" for="Field134_2" >
Hidden Profile</label>
</span>
<a href="#" onclick="$('#finishUser').hide(); $('#helpOnProfileType').show();"><img src="../images/help.png" width="20" height="20" style="float:right; padding: 0px 0px 0px 50px;"><a><br><br>
      &nbsp;
	  <div style="text-align:center;">
      <input type="submit" name="Submit" tabindex="6" value="Finish" />
		</div>

</form>
</div>
<div id="helpOnProfileType" style="display:none;">
Help info here about stuff <br>
<a href="#" onclick="$('#finishUser').show(); $('#helpOnProfileType').hide();">Back To Sign-up<a><br>
</div>
</div>
</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>



<script type="text/javascript" src="../js/memberIndexVol.js"></script>
<script type="text/javascript" src="../js/customPopupBox.js"></script>
<script type="text/javascript" src="../js/characterCounter.js"></script>
