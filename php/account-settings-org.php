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
<link href="loginmodule.css" rel="stylesheet" type="text/css" />

</head>

<body>
<script language="javascript">
function autotab(current,to){
    if (current.getAttribute && 
      current.value.length==current.getAttribute("maxlength")) {
        to.focus() 
        }
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
<a href="account-settings-org.php">Organization Account Settings</a> | <a href="account-settings-org-admin.php">Your User Account Settings</a>

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
	if(($_SESSION['ORG_IMAGE']) == true) {
	
		echo '<div id="login"><img src="uploaded_files/',$_SESSION['IMAGE_PATH'],'" alt="Organization Picture" width="320" height="240"></div>';
	}
	else
	{//This name is decieving, i am using the login pop up for the image upload.....
		echo '<div id="login">
<img src="../images/noorglogo.png" width="320" height="240" alt="header image2""> 
</div>';
	}
	?>
</div>
<div class="formToProcessOrgChanges">
 <b>Organization Name</b><br>
 <input name="Field121" type="text" class="field text medium" id="Field121" tabindex="1" style="color:#0000;" value="<?php echo $_SESSION['ORG_NAME'];?>" onfocus="this.value = this.value=='First Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'First Name' : this.value; this.value=='First Name' ? this.style.color='#999' : this.style.color='#000'"/>
 <br><br><b>Address</b><br>

<span class="full addr1">
<label for="Field126">Street Address</label>
<input id="Field126" name="Field126" type="text" class="field text addr large" value="<?php echo $_SESSION['ORG_ADDRESS']; ?>" tabindex="11" required />
</span>
<br>
<span class="left city" style="margin: 0px 10px 0px 0px;">
<label for="Field128">City</label>
<input id="Field128" name="Field128" type="text" class="field text addr" value="<?php echo $_SESSION['ORG_CITY']; ?>" tabindex="12" required />
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
<input id="Field130" name="Field130" type="text" class="field text addr" value="<?php echo $_SESSION['ORG_ZIPCODE']; ?>" maxlength="15" tabindex="14" required />
</span>
<br>

<br><b>Phone Number:</b>
<br>


<span>
<input type="tel" id="phone1" name="phone1" 
    size=4 onKeyup="autotab(this, document.accountSettingsOrg.phone2)" class="field text" size="3" tabindex="18"  maxlength=3 value="<?php echo $_SESSION['ORG_PHONE_PART_1']; ?>" required>
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone2" name="phone2" 
    size=4 onKeyup="autotab(this, document.accountSettingsOrg.phone3)" class="field text" size="3"  tabindex="19" maxlength=3 value="<?php echo $_SESSION['ORG_PHONE_PART_2']; ?>"required> 
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone3" name="phone3" size=4 maxlength=4 class="field text" tabindex="20" value="<?php echo $_SESSION['ORG_PHONE_PART_3']; ?>" required>
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
                    <option value="1" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 1){ echo 'selected="yes"';}?>>Advocacy & Human Rights</option>
                    <option value="2" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 2){ echo 'selected="yes"';}?>>Animals</option>
                    <option value="3" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 3){ echo 'selected="yes"';}?>>Arts & Culture</option>
                    <option value="4" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 4){ echo 'selected="yes"';}?>>Children & Youth</option>
                    <option value="5" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 5){ echo 'selected="yes"';}?>>Church</option>
                    <option value="6" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 6){ echo 'selected="yes"';}?>>Community</option>
                    <option value="7" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 7){ echo 'selected="yes"';}?>>Company & Corporations</option>
                    <option value="8" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 8){ echo 'selected="yes"';}?>>Computers & Technology</option>
                    <option value="9" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 9){ echo 'selected="yes"';}?>>Crisis Support</option>
                    <option value="10" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 10){ echo 'selected="yes"';}?>>Disabled </option>
                    <option value="11" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 11){ echo 'selected="yes"';}?>>Disaster Relief</option>
                    <option value="12" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 12){ echo 'selected="yes"';}?>>Domestic Aid</option>
                    <option value="13" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 13){ echo 'selected="yes"';}?>>Education </option>
                    <option value="14" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 14){ echo 'selected="yes"';}?>>Emergency & Safety</option>
                    <option value="15" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 15){ echo 'selected="yes"';}?>>Environment</option>
                    <option value="16" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 16){ echo 'selected="yes"';}?>>Faith-Based</option>
                    <option value="17" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 17){ echo 'selected="yes"';}?>>Health & Medicine</option>
                    <option value="18" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 18){ echo 'selected="yes"';}?>>Homeless & Housing</option>
                    <option value="19" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 19){ echo 'selected="yes"';}?>>Hunger</option>
                    <option value="20" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 20){ echo 'selected="yes"';}?>>Immigration & Refugees</option>
                    <option value="21" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 21){ echo 'selected="yes"';}?>>International Aid</option>
                    <option value="22" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 22){ echo 'selected="yes"';}?>>Justice & Legal</option>
                    <option value="23" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 23){ echo 'selected="yes"';}?>>Media & Broadcasting</option>
                    <option value="24" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 24){ echo 'selected="yes"';}?>>Politics</option>
                    <option value="25" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 25){ echo 'selected="yes"';}?>>Seniors</option>
                    <option value="26" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 26){ echo 'selected="yes"';}?>>Sports & Recreation</option>
                    <option value="27" <?php if($_SESSION['ORG_TYPE_PRIMARY'] == 27){ echo 'selected="yes"';}?>>Veterans & Military Family</option>
		</select>
<br><br><b>
Secondary Organization Type
</b>
<select id="Field160" name="Field160"  class="field text addr" tabindex="17" value="">
                    <option value="" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == ''){ echo 'selected="yes"';}?>>Organization Type</option>
                    <option value="1" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 1){ echo 'selected="yes"';}?>>Advocacy & Human Rights</option>
                    <option value="2" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 2){ echo 'selected="yes"';}?>>Animals</option>
                    <option value="3" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 3){ echo 'selected="yes"';}?>>Arts & Culture</option>
                    <option value="4" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 4){ echo 'selected="yes"';}?>>Children & Youth</option>
                    <option value="5" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 5){ echo 'selected="yes"';}?>>Church</option>
                    <option value="6" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 6){ echo 'selected="yes"';}?>>Community</option>
                    <option value="7" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 7){ echo 'selected="yes"';}?>>Company & Corporations</option>
                    <option value="8" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 8){ echo 'selected="yes"';}?>>Computers & Technology</option>
                    <option value="9" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 9){ echo 'selected="yes"';}?>>Crisis Support</option>
                    <option value="10" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 10){ echo 'selected="yes"';}?>>Disabled </option>
                    <option value="11" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 11){ echo 'selected="yes"';}?>>Disaster Relief</option>
                    <option value="12" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 12){ echo 'selected="yes"';}?>>Domestic Aid</option>
                    <option value="13" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 13){ echo 'selected="yes"';}?>>Education </option>
                    <option value="14" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 14){ echo 'selected="yes"';}?>>Emergency & Safety</option>
                    <option value="15" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 15){ echo 'selected="yes"';}?>>Environment</option>
                    <option value="16" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 16){ echo 'selected="yes"';}?>>Faith-Based</option>
                    <option value="17" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 17){ echo 'selected="yes"';}?>>Health & Medicine</option>
                    <option value="18" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 18){ echo 'selected="yes"';}?>>Homeless & Housing</option>
                    <option value="19" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 19){ echo 'selected="yes"';}?>>Hunger</option>
                    <option value="20" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 20){ echo 'selected="yes"';}?>>Immigration & Refugees</option>
                    <option value="21" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 21){ echo 'selected="yes"';}?>>International Aid</option>
                    <option value="22" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 22){ echo 'selected="yes"';}?>>Justice & Legal</option>
                    <option value="23" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 23){ echo 'selected="yes"';}?>>Media & Broadcasting</option>
                    <option value="24" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 24){ echo 'selected="yes"';}?>>Politics</option>
                    <option value="25" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 25){ echo 'selected="yes"';}?>>Seniors</option>
                    <option value="26" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 26){ echo 'selected="yes"';}?>>Sports & Recreation</option>
                    <option value="27" <?php if($_SESSION['ORG_TYPE_SECONDARY'] == 27){ echo 'selected="yes"';}?>>Veterans & Military Family</option>
		</select>
</li>
</div>
</div>
<br>
<br>
<br>
<br>
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
<?php if($_SESSION['ORG_PLAN_TYPE'] == 'The Free Plan'){ echo '<b>Your Current Plan:</b><br><br>';}?>
The Free Plan<br>
$0 Always<br>
100 Volunteers
<?php if($_SESSION['ORG_PLAN_TYPE'] != 'The Free Plan'){ echo '<br><a href="change-org-plan.php"><img src="../images/changeplan.png" width="90" height="40"></a>';}?>
</div>
<div class="plan2" style="float:left; padding: 70px 0px 0px 70px; width: 150px; height:30px; text-align:center;">
<?php if($_SESSION['ORG_PLAN_TYPE'] == 'The Basic'){ echo '<b>Your Current Plan:</b><br>';}?>
<br>
The Basic<br>
$49/month<br>
500 Volunteers<br>
Messaging Center
<?php if($_SESSION['ORG_PLAN_TYPE'] != 'The Basic'){ echo '<br><a href="change-org-plan.php"><img src="../images/changeplan.png" width="90" height="40"></a>';}?>
</div>
<div class="plan3" style="float:left; padding: 70px 0px 0px 70px; width: 150px; height:30px; text-align:center;">
<?php if($_SESSION['ORG_PLAN_TYPE'] == 'The Works'){ echo '<b>Your Current Plan:</b><br>';}?>
<br>
The Works <br>
$99/month<br>
1500 Volunteers<br>
Messaging Center
<?php if($_SESSION['ORG_PLAN_TYPE'] != 'The Works'){ echo '<br><a href="change-org-plan.php"><img src="../images/changeplan.png" width="90" height="40"></a>';}?>
</div>
<div class="plan4" style="float:left; padding: 70px 0px 100px 70px; width: 170px; height:30px; text-align:center;">
<?php if($_SESSION['ORG_PLAN_TYPE'] == 'The Supreme'){ echo '<b>Your Current Plan:</b><br>';}?>
<br>
The Supreme<br>
$149/month<br>
Unlimated Volunteers<br>
Messaging Center
<?php if($_SESSION['ORG_PLAN_TYPE'] != 'The Supreme'){ echo '<br><a href="change-org-plan.php"><img src="../images/changeplan.png" width="90" height="40"></a>';}?>
</div>
</div>
</div>

</div>
</div>
<br>
<br>
<br>


<div id="accountSettinGHeading" style="float:left; padding: 0px 0px 0px 200px;">
<br>
<h2>Organization Admins & Staff</h2>
</div>
<div class="clear"></div>
<div class="pricingPlansOuterBoxSettings">
<div class="pricingPlansAcctSettings">
</div>
</div>



<li id="foli126" class="section      ">
<section>
<h2 id="title126">4. Advanced Form</h2>
</section>
</li>

<li id="foli127" class="section      ">
<section>
<h3 id="title127">Link Your Profile</h3>
</section>
</li><li id="foli135" class="      ">
<label class="desc" id="title135" for="Field135">
Choose Type of Link
</label>
<script src="../js/addInputs.js" language="Javascript" type="text/javascript"></script>
     <div id="dynamicInput">
<div class = "f1">
<span>
<select id="Field1335" name="Field13351" class="field select medium" tabindex="25" > 
<option value="Website" selected="selected">
Website
</option>
<option value="Facebook" >
Facebook
</option>
<option value="Twitter" >
Twitter
</option>
<option value="LinkedIn" >
LinkedIn
</option>
<option value="Blog" >
Blog
</option>
<option value="YouTube" >
YouTube
</option>
</select>
</span>
</div>
<div class = "f2">
<span>
<input id="Field1116" name="Field11161" type="text" spellcheck="false" class="field text medium" value="Link" maxlength="255" tabindex="26" required /> 
</span>
</div>
</div>
<input type="button" value="Add another link" onClick="addInput('dynamicInput');">


</li><li id="foli124" class="section      ">
<section>
<h3 id="title124">Tags</h3>
</section>
</li><li id="foli11" class=" twoColumns     ">
<fieldset>
<![if !IE | (gte IE 8)]>
<legend id="title11" class="desc">
What is your Organization involved with?
<span id="req_11" class="req">*</span>
</legend>
<![endif]>
<!--[if lt IE 8]>
<label id="title11" class="desc">
What is your Organization involved with?
<span id="req_11" class="req">*</span>
</label>
<![endif]-->

<div>
<span>
<input id="Field11" name="Field11" type="checkbox" class="field checkbox" value="Animal" tabindex="27" />
<label class="choice" for="Field11">Animal</label>
</span>
<span>
<input id="Field12" name="Field12" type="checkbox" class="field checkbox" value="Community Development" tabindex="28" />
<label class="choice" for="Field12">Community Development</label>
</span>
<span>
<input id="Field13" name="Field13" type="checkbox" class="field checkbox" value="Athletics" tabindex="29" />
<label class="choice" for="Field13">Athletics</label>
</span>
<span>
<input id="Field14" name="Field14" type="checkbox" class="field checkbox" value="Community Service" tabindex="30" />
<label class="choice" for="Field14">Community Service</label>
</span>
<span>
<input id="Field15" name="Field15" type="checkbox" class="field checkbox" value="Children" tabindex="31" />
<label class="choice" for="Field15">Children</label>
</span>
<span>
<input id="Field16" name="Field16" type="checkbox" class="field checkbox" value="Corporate Event" tabindex="32" />
<label class="choice" for="Field16">Corporate Event</label>
</span>
<span>
<input id="Field17" name="Field17" type="checkbox" class="field checkbox" value="Church" tabindex="33" />
<label class="choice" for="Field17">Church</label>
</span>
<span>
<input id="Field18" name="Field18" type="checkbox" class="field checkbox" value="Disaster Relief" tabindex="34" />
<label class="choice" for="Field18">Disaster Relief</label>
</span>
<span>
<input id="Field19" name="Field19" type="checkbox" class="field checkbox" value="College or University" tabindex="35" />
<label class="choice" for="Field19">College or University</label>
</span>
<span>
<input id="Field20" name="Field20" type="checkbox" class="field checkbox" value="Emergency Management" tabindex="36" />
<label class="choice" for="Field20">Emergency Management</label>
</span>
</div>
</fieldset>
</li>

<li id="foli137" class="section      ">
<section>
<h3 id="title137">Additional Admins</h3>
</section>
</li>
Type in the e-mail address(es) and we'll send the info!
<script src="../js/addInputs.js" language="Javascript" type="text/javascript"></script>

     <div id="dynamicInputAdmins">
<input id="Field261" name="Field261" type="email" spellcheck="false" class="field text medium" value="E-Mail" maxlength="255" tabindex="37" required /> 
     </div>
     <input type="button" value="Add another" onClick="addInput('dynamicInputAdmins');">


<br>
</li><li id="foli135" class="     ">
<fieldset>
<![if !IE | (gte IE 8)]>
<legend id="title135" class="desc">
</legend>
<![endif]>
<!--[if lt IE 8]>
<label id="title135" class="desc">
Check All That Apply
</label>
<![endif]-->
<div>
<span>
<input id="Field13511" name="Field13511" type="checkbox" class="field checkbox" value="Volunteers must be invited or approved by organization in order to join" tabindex="38" />
<label class="choice" for="Field13511">I agree to the Volly.it <a href="/termsofuse"> Terms of Use </a> and <a href="/privacypolicy"> Privacy Policy</a></label>
</span>
</div>
</fieldset>
</li>

    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" tabindex="39" value="Create Organization" /></td>
	  <center>
	  </center>
    </tr>
	</ul>
</form> 
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
			<input id="submit" type="submit" name="submit" value="Upload Organization Image!">
				</center>
		</p>
	</form></center>
		</p>
	
	</div>
	<div id="backgroundPopup3"></div>
</div><!--container-->
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>