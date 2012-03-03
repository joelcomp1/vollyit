<?php
	require_once('auth.php');
	
// make a note of the current working directory relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the location of the upload handler
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';

// set a max file size for the html upload form
$max_file_size = 3000000; // size in bytes
include "header-org.php";
include "navigation.php";

$state = $_GET['state'];

session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['SESS_MEMBER_ID'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/collection.js"></script>
  <script src="../js/popup.js" type="text/javascript"></script>
<link rel="stylesheet" href="../structure.css" type="text/css" />
<link rel="stylesheet" href="../form.css" type="text/css" />
 <script src="../scripts/wufoo.js" type="../text/javascript"></script>


</head>

<body>

<script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("search-keywords-tags.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fillTags(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
	
	


function autotab(current,to){
    if (current.getAttribute && 
      current.value.length==current.getAttribute("maxlength")) {
        to.focus() 
        }
}

		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-org-staff.php",
			success: function(msg)
				{
				$("#results9").html(msg);
				
				}
		});


  function addHidden(positionName, divName)
  {
	 positionSelected.value = positionName;
  
  }
  

		
</script>

<div id="wrap">
<div id="mainnavuser">


<br>
<br>
<div class="clear"></div>

<h3>

Account Settings
<br>
<a href="#" onclick="$('#accountSettingsOrg').show(); $('#accountSettingsForm').hide();">Organization Account Settings</a> | <a href="#" onclick="$('#accountSettingsOrg').hide(); $('#accountSettingsForm').show();">Your User Account Settings</a>

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
<div id="popup7" class="popup_block">
Help info on admins/staff
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
</div>	
	
<div id="popupContact10">
	<a id="popupContactClose10">x</a>
	<p id="contactArea">
		Help info here on plans/pricing
		</p>
	</div>
	<div id="backgroundPopup10"></div>
	
<div id="popupContact11">
	<a id="popupContactClose11">x</a>
	<p id="contactArea">
		Help info here about adding admins/staff
		</p>
	</div>
	<div id="backgroundPopup11"></div>

<br>
<div id="popupContact2">
	<a id="popupContactClose2">x</a>
	<center>
	<p id="contactArea">

<form id="Upload" action="upload.processor.php" enctype="multipart/form-data" method="post">
		<p>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">

		<center>
			<label for="file">Upload a Admin Picture</label>
			<br>
			<br>
			<input id="file" type="file" name="file">
				<br>
<br>
			<input id="submit" type="submit" name="submit" value="Upload a Admin Picture">
				</center>
		</p>
	</form></center>
		</p>
	
	</div>
	<div id="backgroundPopup2"></div>


<form id="accountSettingsForm" name="accountSettingsForm" method="post" action="complete-reg-exec-vol.php" style="display:none;">
<div class="thumbnail">
		<?php
	if(($_SESSION['VOL_IMAGE']) == true) {
	
		echo '<div id="login"><img src="uploaded_files/',$_SESSION['VOL_IMAGE_PATH'],'" alt="User Picture" width="320" height="240"></div>';
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
<input type="image" name="Submit" src="../images/savechanges.png" height="120" width="200"  tabindex="13" value="Save Changes from Org" />
 </div>
</div>
</div>
</div>
</form>











<form id="accountSettingsOrg" name="accountSettingsOrg" method="post" action="complete-reg-exec.php">
<div class="orgaccountsettings">
<div id="accountSettinGHeading" style="float:left">
<br>
<h2>Organization Info</h2>
</div>
<br>
<br>
<br>
<div class="thumbnail">
	<?php
	if(($_SESSION['ORG_IMAGE']) ==  true) {
	
		echo '<div id="orgLogo"><img src="uploaded_files/',$_SESSION['IMAGE_PATH'],'" alt="Org Logo Picture" width="320" height="240"></div>';
	}
	else
	{//This name is decieving, i am using the login pop up for the image upload.....
		echo '<div id="orgLogo">
<img src="../images/noorglogo.png" width="320" height="240" alt="header image2"> 
</div>';
	}
	?>

<br>
<I> Click above to Add or Change Photo the Organization Logo</I>
<br>
</div>

<div class="formToProcessOrgChanges">
 <b>Organization Name</b><br>
 <input name="Field121" type="text" class="field text medium" id="Field121" tabindex="1" style="color:#0000;" value="<?php echo $_SESSION['ORG_NAME'];?>" onfocus="this.value = this.value=='First Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'First Name' : this.value; this.value=='First Name' ? this.style.color='#999' : this.style.color='#000'"/>
 <br><br><b>Address</b><br>

<span class="full addr1">
<label for="Field126">Street Address</label>
<input id="Field126" name="Field126" type="text" class="field text addr large" value="<?php echo $_SESSION['ORG_ADDRESS']; ?>" tabindex="11" />
</span>
<br>
<span class="left city" style="margin: 0px 10px 0px 0px;">
<label for="Field128">City</label>
<input id="Field128" name="Field128" type="text" class="field text addr" value="<?php echo $_SESSION['ORG_CITY']; ?>" tabindex="12" />
</span>
<span class="left state">
<label for="Field129">State  </label>
<select id="Field129" name="Field129"  class="field text addr" tabindex="13" value="" select="AK">
                    <option value="">Select a State</option>
                    <option value="AK" <?php if($_SESSION['ORG_STATE'] == 'AK'){ echo 'selected="yes"';}?>>Alaska</option>
                    <option value="AL" <?php if($_SESSION['ORG_STATE'] == 'AL'){ echo 'selected="yes"';}?>>Alabama</option>
                    <option value="AR" <?php if($_SESSION['ORG_STATE'] == 'AR'){ echo 'selected="yes"';}?>>Arkansas</option>
                    <option value="AZ" <?php if($_SESSION['ORG_STATE'] == 'AZ'){ echo 'selected="yes"';}?>>Arizona</option>
                    <option value="CA" <?php if($_SESSION['ORG_STATE'] == 'CA'){ echo 'selected="yes"';}?>>California</option>
                    <option value="CO" <?php if($_SESSION['ORG_STATE'] == 'CO'){ echo 'selected="yes"';}?>>Colorado</option>
                    <option value="CT" <?php if($_SESSION['ORG_STATE'] == 'CT'){ echo 'selected="yes"';}?>>Connecticut</option>
                    <option value="DC" <?php if($_SESSION['ORG_STATE'] == 'DC'){ echo 'selected="yes"';}?>>Washington D.C.</option>
                    <option value="DE" <?php if($_SESSION['ORG_STATE'] == 'DE'){ echo 'selected="yes"';}?>>Delaware</option>
                    <option value="FL" <?php if($_SESSION['ORG_STATE'] == 'FL'){ echo 'selected="yes"';}?>>Florida</option>
                    <option value="GA" <?php if($_SESSION['ORG_STATE'] == 'GA'){ echo 'selected="yes"';}?>>Georgia</option>
                    <option value="HI" <?php if($_SESSION['ORG_STATE'] == 'HI'){ echo 'selected="yes"';}?>>Hawaii</option>
                    <option value="IA" <?php if($_SESSION['ORG_STATE'] == 'IA'){ echo 'selected="yes"';}?>>Iowa</option>
                    <option value="ID" <?php if($_SESSION['ORG_STATE'] == 'ID'){ echo 'selected="yes"';}?>>Idaho</option>
                    <option value="IL" <?php if($_SESSION['ORG_STATE'] == 'IL'){ echo 'selected="yes"';}?>>Illinois</option>
                    <option value="IN" <?php if($_SESSION['ORG_STATE'] == 'IN'){ echo 'selected="yes"';}?>>Indiana</option>
                    <option value="KS" <?php if($_SESSION['ORG_STATE'] == 'KS'){ echo 'selected="yes"';}?>>Kansas</option>
                    <option value="KY" <?php if($_SESSION['ORG_STATE'] == 'KY'){ echo 'selected="yes"';}?>>Kentucky</option>
                    <option value="LA" <?php if($_SESSION['ORG_STATE'] == 'LA'){ echo 'selected="yes"';}?>>Louisiana</option>
                    <option value="MA" <?php if($_SESSION['ORG_STATE'] == 'MA'){ echo 'selected="yes"';}?>>Massachusetts</option>
                    <option value="MD" <?php if($_SESSION['ORG_STATE'] == 'MD'){ echo 'selected="yes"';}?>>Maryland</option>
                    <option value="ME" <?php if($_SESSION['ORG_STATE'] == 'ME'){ echo 'selected="yes"';}?>>Maine</option>
                    <option value="MI" <?php if($_SESSION['ORG_STATE'] == 'MI'){ echo 'selected="yes"';}?>>Michigan</option>
                    <option value="MN" <?php if($_SESSION['ORG_STATE'] == 'MN'){ echo 'selected="yes"';}?>>Minnesota</option>
                    <option value="MO" <?php if($_SESSION['ORG_STATE'] == 'MO'){ echo 'selected="yes"';}?>>Missourri</option>
                    <option value="MS" <?php if($_SESSION['ORG_STATE'] == 'MS'){ echo 'selected="yes"';}?>>Mississippi</option>
                    <option value="MT" <?php if($_SESSION['ORG_STATE'] == 'MT'){ echo 'selected="yes"';}?>>Montana</option>
                    <option value="NC" <?php if($_SESSION['ORG_STATE'] == 'NC'){ echo 'selected="yes"';}?>>North Carolina</option>
                    <option value="ND" <?php if($_SESSION['ORG_STATE'] == 'ND'){ echo 'selected="yes"';}?>>North Dakota</option>
                    <option value="NE" <?php if($_SESSION['ORG_STATE'] == 'NE'){ echo 'selected="yes"';}?>>Nebraska</option>
                    <option value="NH" <?php if($_SESSION['ORG_STATE'] == 'NH'){ echo 'selected="yes"';}?>>New Hampshire</option>
                    <option value="NJ" <?php if($_SESSION['ORG_STATE'] == 'NJ'){ echo 'selected="yes"';}?>>New Jersey</option>
                    <option value="NM" <?php if($_SESSION['ORG_STATE'] == 'NM'){ echo 'selected="yes"';}?>>New Mexico</option>
                    <option value="NV" <?php if($_SESSION['ORG_STATE'] == 'NV'){ echo 'selected="yes"';}?>>Nevada</option>
                    <option value="NY" <?php if($_SESSION['ORG_STATE'] == 'NY'){ echo 'selected="yes"';}?>>New York</option>
                    <option value="OH" <?php if($_SESSION['ORG_STATE'] == 'OH'){ echo 'selected="yes"';}?>>Ohio</option>
                    <option value="OK" <?php if($_SESSION['ORG_STATE'] == 'OK'){ echo 'selected="yes"';}?>>Oklahoma</option>
                    <option value="OR" <?php if($_SESSION['ORG_STATE'] == 'OR'){ echo 'selected="yes"';}?>>Oregon</option>
                    <option value="PA" <?php if($_SESSION['ORG_STATE'] == 'PA'){ echo 'selected="yes"';}?>>Pennsylvania</option>
                    <option value="PR" <?php if($_SESSION['ORG_STATE'] == 'PR'){ echo 'selected="yes"';}?>>Puerto Rico</option>
                    <option value="RI" <?php if($_SESSION['ORG_STATE'] == 'RI'){ echo 'selected="yes"';}?>>Rhode Island</option>
                    <option value="SC" <?php if($_SESSION['ORG_STATE'] == 'SC'){ echo 'selected="yes"';}?>>South Carolina</option>
                    <option value="SD" <?php if($_SESSION['ORG_STATE'] == 'SD'){ echo 'selected="yes"';}?>>South Dakota</option>
                    <option value="TN" <?php if($_SESSION['ORG_STATE'] == 'TN'){ echo 'selected="yes"';}?>>Tennessee</option>
                    <option value="TX" <?php if($_SESSION['ORG_STATE'] == 'TX'){ echo 'selected="yes"';}?>>Texas</option>
                    <option value="UT" <?php if($_SESSION['ORG_STATE'] == 'UT'){ echo 'selected="yes"';}?>>Utah</option>
                    <option value="VA" <?php if($_SESSION['ORG_STATE'] == 'VA'){ echo 'selected="yes"';}?>>Virginia</option>
                    <option value="VT" <?php if($_SESSION['ORG_STATE'] == 'VT'){ echo 'selected="yes"';}?>>Vermont</option>
                    <option value="WA" <?php if($_SESSION['ORG_STATE'] == 'WA'){ echo 'selected="yes"';}?>>Washington</option>
                    <option value="WI" <?php if($_SESSION['ORG_STATE'] == 'WI'){ echo 'selected="yes"';}?>>Wisconsin</option>
                    <option value="WV" <?php if($_SESSION['ORG_STATE'] == 'WV'){ echo 'selected="yes"';}?>>West Virginia</option>
                    <option value="WY" <?php if($_SESSION['ORG_STATE'] == 'WY'){ echo 'selected="yes"';}?>>Wyoming</option>
		</select>

</span>
<br>
<span class="left zip">
Postal / Zip Code
<input id="Field130" name="Field130" type="text" class="field text addr" value="<?php echo $_SESSION['ORG_ZIPCODE']; ?>" maxlength="15" tabindex="14"  />
</span>
<br>

<br><b>Phone Number:</b>
<br>


<span>
<input type="tel" id="phone1" name="phone1" 
    size=4 onKeyup="autotab(this, document.accountSettingsOrg.phone2)" class="field text" size="3" tabindex="18"  maxlength=3 value="<?php echo $_SESSION['ORG_PHONE_PART_1']; ?>" >
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone2" name="phone2" 
    size=4 onKeyup="autotab(this, document.accountSettingsOrg.phone3)" class="field text" size="3"  tabindex="19" maxlength=3 value="<?php echo $_SESSION['ORG_PHONE_PART_2']; ?>"> 
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone3" name="phone3" size=4 maxlength=4 class="field text" tabindex="20" value="<?php echo $_SESSION['ORG_PHONE_PART_3']; ?>" >
</span>
<br>
<br><b>
Organization E-mail
</b>

<input id="Field132" name="Field132" type="email" spellcheck="false" class="field text medium" value="<?php echo $_SESSION['ORG_EMAIL']; ?>" maxlength="255" tabindex="15" /> 

<br><br><b>
Primary Organization Type
</b>
<select id="Field159" name="Field159"  class="field text addr" tabindex="16" value=""> 
                    <option value="" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == ''){ echo 'selected="yes"';}?>>Organization Type</option>
                    <option value="Advocacy & Human Rights" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Advocacy & Human Rights'){ echo 'selected="yes"';}?>>Advocacy & Human Rights</option>
                    <option value="Animals" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Animals'){ echo 'selected="yes"';}?>>Animals</option>
                    <option value="Arts & Culture" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Arts & Culture'){ echo 'selected="yes"';}?>>Arts & Culture</option>
                    <option value="Children & Youth" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Children & Youth'){ echo 'selected="yes"';}?>>Children & Youth</option>
                    <option value="Church" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Church'){ echo 'selected="yes"';}?>>Church</option>
                    <option value="Community" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Community'){ echo 'selected="yes"';}?>>Community</option>
                    <option value="Company & Corporations" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Company & Corporations'){ echo 'selected="yes"';}?>>Company & Corporations</option>
                    <option value="Computers & Technology" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Computers & Technology'){ echo 'selected="yes"';}?>>Computers & Technology</option>
                    <option value="Crisis Support" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Crisis Support'){ echo 'selected="yes"';}?>>Crisis Support</option>
                    <option value="Disabled" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Disabled'){ echo 'selected="yes"';}?>>Disabled </option>
                    <option value="Disaster Relief" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Disaster Relief'){ echo 'selected="yes"';}?>>Disaster Relief</option>
                    <option value="Domestic Aid" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Domestic Aid'){ echo 'selected="yes"';}?>>Domestic Aid</option>
                    <option value="Education" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Education'){ echo 'selected="yes"';}?>>Education </option>
                    <option value="Emergency & Safety" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Emergency & Safety'){ echo 'selected="yes"';}?>>Emergency & Safety</option>
                    <option value="Environment" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Environment'){ echo 'selected="yes"';}?>>Environment</option>
                    <option value="Faith-Based" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Faith-Based'){ echo 'selected="yes"';}?>>Faith-Based</option>
                    <option value="Health & Medicine" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Health & Medicine'){ echo 'selected="yes"';}?>>Health & Medicine</option>
                    <option value="Homeless & Housing" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Homeless & Housing'){ echo 'selected="yes"';}?>>Homeless & Housing</option>
                    <option value="Hunger" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Hunger'){ echo 'selected="yes"';}?>>Hunger</option>
                    <option value="Immigration & Refugees" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Immigration & Refugees'){ echo 'selected="yes"';}?>>Immigration & Refugees</option>
                    <option value="International Aid" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'International Aid'){ echo 'selected="yes"';}?>>International Aid</option>
                    <option value="Justice & Legal" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Justice & Legal'){ echo 'selected="yes"';}?>>Justice & Legal</option>
                    <option value="Media & Broadcasting" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Media & Broadcasting'){ echo 'selected="yes"';}?>>Media & Broadcasting</option>
                    <option value="Politics" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Politics'){ echo 'selected="yes"';}?>>Politics</option>
                    <option value="Seniors" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Seniors'){ echo 'selected="yes"';}?>>Seniors</option>
                    <option value="Sports & Recreation" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Sports & Recreation'){ echo 'selected="yes"';}?>>Sports & Recreation</option>
                    <option value="Veterans & Military Family" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 'Veterans & Military Family'){ echo 'selected="yes"';}?>>Veterans & Military Family</option>		</select>
<br>

</li>
</div>
</div>
<br>
<br>
<br>
<br>
<div id="accountSettinGHeading" style="float:left">
<br>
<h2>Organization Admins & Staff</h2>
</div><a href="#">add another</a>
<div class="clear"></div><br><br>
<!--This populates the staff, same query as on org page-->
<div id='results9'>
</div>
<a href="#" onclick="popup(250, 'popup7');" class="poplight"><img src="../images/help.png" width="20" height="20" style="padding: 0px 0px 0px 50px;"></a>

<div class="clear"></div><br><br>
<div id="accountSettinGHeading" style="float:left">
<br>
<h2>Organization Privacy Settings</h2>
</div>
<div class="clear"></div><br>




<input id="radioDefault_134" name="Field134" type="hidden" value="" />


<input id="Field134_0" name="Field134" type="radio" class="field radio" value="Public" tabindex="21" <?php if($_SESSION['ORG_PRIVACY'] == 'Public'){ echo 'checked="checked"'; } ?>
/>
<label class="choice" for="Field134_0">
Public Profile</label>
Your full profile is viewable and searchable on the volly.it site by all users. Full profiles include your organizations information,your programs and your list of volunteers with public profiles.

<div class="clear"></div><br>
<div style="padding: 0 0 0 00px; float:left;">

<input id="Field134_1" name="Field134" type="radio"  class="field radio" value="Private" tabindex="22" <?php if($_SESSION['ORG_PRIVACY'] == 'Private'){ echo 'checked="checked"'; } ?>/>
<label class="choice" for="Field134_1" >
Private Profile </label> 
Your limited profile is viewable and searchable on the volly.it site by all users.  Limited profiles include only your organizations information and program list.
</div>

<div class="clear"></div><br><br>
<div id="accountSettinGHeading" style="float:left">
<br>
<h2>Connetions</h2>
</div>
<div class="clear"></div><br>
<div class="clear"></div>
<div style="float:left;">
WebSite
</div>
<div style="float:left; padding: 0px 0px 0px 99px;">
<input id="orgwebsite" name="orgwebsite" type="text" spellcheck="false" class="field text large" value="<?php echo $_SESSION['ORG_WEBSITE'];?>" size=50 maxlength="255" tabindex="2"  /> 
</div>
<div class="clear"></div>
<div style="float:left;">
Facebook
</div>
<div style="float:left; padding: 0px 0px 0px 91px;">
<input id="orgfacebook" name="orgfacebook" type="text" spellcheck="false" class="field text large" value="<?php echo $_SESSION['FACEBOOK_LINK'];?>" size=50 maxlength="255" tabindex="3"  /> 
</div>
<div class="clear"></div>
<div style="float:left;">
Twitter
</div>
<div style="float:left; padding: 0px 0px 0px 106px;">
<input id="orgtwitter" name="orgtwitter" type="text" spellcheck="false" class="field text large" value="<?php echo $_SESSION['TWITTER_LINK'];?>"  size=50maxlength="255" tabindex="4"  /> 
</div>
<div class="clear"></div>
<div style="float:left;">
LinkedIn
</div>
<div style="float:left; padding: 0px 0px 0px 100px;">
<input id="orglinkedin" name="orglinkedin" type="text" spellcheck="false" class="field text large" value="<?php echo $_SESSION['LINKEDIN_LINK'];?>" size=50 maxlength="255" tabindex="5"  /> 
</div>
<div class="clear"></div>
 <div style="float:left;">
Blog
</div>
<div style="float:left; padding: 0px 0px 0px 127px;">
<input id="orgblog" name="orgblog" type="text" spellcheck="false" class="field text large" value="<?php echo $_SESSION['BLOG_LINK'];?>"  size=50 maxlength="255" tabindex="6"  /> 
</div>
<div class="clear"></div>
 <div style="float:left;">
YouTube
</div>
<div style="float:left; padding: 0px 0px 0px 96px;">
<input id="orgyoutube" name="orgyoutube" type="text" spellcheck="false" class="field text large" value="<?php echo $_SESSION['YOUTUBE_LINK'];?>" size=50  maxlength="255" tabindex="7"  /> 
</div>

<div class="clear"></div><br><br>
<div id="accountSettinGHeading" style="float:left">
<br>
<h2>Tags & Keywords</h2>
</div>
<div class="clear"></div><br>

<div class="volSearchRightInnter" style="float:left;">
This is what determines how you pop up on search results.  Make sure your tags are relevant to your organization.
</div>
<div class="clear"></div><br>
<div class="volSearchLeftInnter" style="float:left; padding: 0px 20px 0px 0px;">
<input name="inputString" type="text" size="30" id="inputString" autocomplete="off" onkeyup="lookup(this.value);" onblur="fillTags();" <?php if(isset($_SESSION['ORG_TAG']))
{	echo 'value="';
	echo $_SESSION['ORG_TAG'];
	echo '"';
	}
	else
	echo 'value="Start Typing Keywords here..."';
?>	onfocus="this.value = this.value=='Start Typing Keywords here...' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Start Typing Keywords here...' : this.value; this.value=='Start Typing Keywords here...' ? this.style.color='#999' : this.style.color='#000'"/>
<div class="suggestionsBox" id="suggestions" style="display: none; text: font:bold 0.4em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<img src="../images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList" id="autoSuggestionsList">
		&nbsp;
	</div>
	</div>
</div>




<div class="orgaccountsettingsplanOuter">
<div class="orgaccountsettingsplan">
<div id="accountSettinGHeading" style="float:left; padding: 10px 0px 0px 00px;">
<h2>Plans and Pricing</h2>
</div>
<div style="float:right; padding: 40px 0px 0px 0px">
<img src="../images/help.png" width="20" height="20" id="planPricingHelp" style="padding: 0px 0px 0px 50px;">
</div>
<div class="clear"></div>
<div class="pricingPlansOuterBoxSettings">
<div class="pricingPlansAcctSettingsChange">
<div class="plan1" style="float:left; padding: 70px 0px 0px 0px; width: 150px; height:30px; text-align:center;">
<?php if($_SESSION['ORG_PLAN'] == 'free'){ echo '<b>Your Current Plan:</b><br><br>';}?>
The Free Plan<br>
50 Volunteers
<?php if($_SESSION['ORG_PLAN'] != 'free'){ ?>
<A HREF="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=DLCCFCXLJ39N2">
<img src="../images/changeplan.png" width="90" height="40">
</A>
<?php
}
?>
</div>
<div class="plan2" style="float:left; padding: 70px 0px 0px 70px; width: 150px; height:30px; text-align:center;">
<?php if($_SESSION['ORG_PLAN'] == 'pro'){ echo '<b>Your Current Plan:</b><br>';}?>
<br>
The Pro<br>
$49.95/month<br>
250 Volunteers<br>
1,000 Messages/month
<?php if($_SESSION['ORG_PLAN'] != 'pro'){ echo '<br><a href="#" onclick="';
											echo "popup(250, 'popup3'); planSelected.value = 'pro'";
							echo ' " class="poplight"><img src="../images/changeplan.png" width="90" height="40"></a>';}?>
</div>
<div class="plan3" style="float:left; padding: 70px 0px 100px 70px; width: 170px; height:30px; text-align:center;">
<?php if($_SESSION['ORG_PLAN'] == 'supreme'){ echo '<b>Your Current Plan:</b><br>';}?>
<br>
The Supreme<br>
$249.95/month<br>
Unlimated Volunteers<br>
Unlimated Messages
<?php if($_SESSION['ORG_PLAN'] != 'supreme'){ echo '<br><a href="#" onclick="';
											echo "popup(250, 'popup3'); planSelected.value = 'supreme'";
							echo ';" class="poplight"><img src="../images/changeplan.png" width="90" height="40"></a>';}?>
</div>
</div>
</div>

</div>
</div>
<br>
<br>
<br>











<A HREF="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=DLCCFCXLJ39N2">
<IMG SRC="https://www.paypalobjects.com/en_US/i/btn/btn_unsubscribe_LG.gif" BORDER="0">
</A>

<br>
<div id="publish" style=" padding: 0px 0px 0px 0px; float:right;">
<input type="image" name="Submit" src="../images/savechanges.png" height="120" width="200"  tabindex="13" value="Save Changes" />
 </div>

</form> 


<div id="popup3" class="popup_block">


	Click "Submit Payment" to upgrade your plan!


<form class="paypal" action="change-subscription.php" method="post" id="paypal_form" target="_blank">    
	<input type="hidden" name="cmd" value="_xclick-subscriptions" /> 
    <input id="planSelected" type="hidden" name="item_number" value="none"/ >
	<input type="hidden" name="modify" value="2">
	<div class="clear"></div><br>
    <input type="submit"  value="Submit Payment"/>
</form>

<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Close</a>
</div>


<div id="popupContact3">
	<a id="popupContactClose3">x</a>
	<center>
	<p id="contactArea">

<form id="Upload2" name="Upload2" value="Upload2" action="upload.processor.php" enctype="multipart/form-data" method="post">
		<p>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">
		<center>
			<label for="file">Upload a Organization Logo!</label>
			<br>
			<br>
			<input id="file" type="file" name="file">
				<br>
<br>
			<input id="submit" type="submit" name="submit" value="Upload Organization Logo!">
				</center>
		</p>
	</form></center>
		</p>
	
	</div>
	<div id="backgroundPopup3"></div>
	
	

	<?php

if($state == 'vol')
{
?>
<script type="text/javascript">
$('#accountSettingsOrg').hide(); $('#accountSettingsForm').show();
</script>

<?php
}
?>
	
</div><!--container-->
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script type="text/javascript" src="../js/customPopupBox.js"></script>