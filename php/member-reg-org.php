<?php

	require_once('auth.php');
	
	// make a note of the current working directory relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the location of the upload handler
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';

// set a max file size for the html upload form
$max_file_size = 3000000; // size in bytes

include "navigation-empty.php";

session_start();

$plan = $_GET['plan'];




?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: Web-based Volunteer Management</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../structure.css" type="text/css" />
<link rel="stylesheet" href="../form.css" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/collection.js"></script>
<script src="../js/popup.js" type="text/javascript"></script>
<script src="../scripts/wufoo.js" type="../text/javascript"></script>
<script type="text/javascript" src="../js/characterCounter.js"></script>


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

	
</script>

<div class="header" style="height: 120px!important;">
<div id="mainnav" style="text-align:center; vertical-align:top; margin: 0px 150px 0px 0px;">
		<?php
	if(($_SESSION['ORG_PAID']) == 'NO' && $paid != 'true') {
		//did we get paid?!
		$orgid = $_SESSION['ORG_ID'];
		require_once('config.php');
		$qry3 = "select * from orgs where orgid='$orgid'";
		$result2 = @mysql_query($qry3);
		$requestInfo = mysql_fetch_assoc($result2);

		if($requestInfo['paid'] == 'YES')
		{	session_regenerate_id();
			$_SESSION['ORG_PAID'] = "YES";
		}
		else
		{	
			echo '<a href="#?w=350" rel="popup3" class="poplight"></a>';	
		}
	}
	?>
<center>
<h1>
Volly<span>.it</span>
</h1>
<br>
<h2>Volunteering to change the world</h2>
</center>
</div>
</div>
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
<div id="wrap" style="border: 0!important; border-width: 0!important;">

<br>
<div class="clear"></div>
<?php
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<div id="errors" style="text-align:center;">';
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		echo '</div>';
		unset($_SESSION['ERRMSG_ARR']);
	}
?>

<div id="container" class="ltr">
<form id="orgRegForm" name="orgRegForm" class="wufoo topLabel page" autocomplete="on" novalidate enctype="multipart/form-data" method="post" action="complete-reg-exec.php">

<div class="clear"></div>
<section>
<h2 id="title1215" style="background:#504842;">1. Your Info</h2>
</section>
<div style="float:left;">
Hi  <?php echo $_SESSION['SESS_MEMBER_ID']; ?>! We just need some more information about you and your organization.  Almost There!</div>
<div class="thumbnailAdmin" style="float:left;">
	<?php
	if(($_SESSION['ADMIN_IMAGE']) == "loaded") {
	
		echo '<div id="login"><img src="uploaded_files/',$_SESSION['ADMIN_IMAGE_PATH'],'" alt="Admin Picture" width="180" height="120"></div>';
	}
	else
	{//This name is decieving, i am using the login pop up for the image upload.....
		echo '<div id="login"><img src="../images/nophoto.png" width="180" height="120" alt="header image2"> </div>';
	}
	?>

<br>
<I> Click Image to Add or Change Photo Your Photo</I>
<br>
</div>
<li >
<label class="desc" id="title1" for="Field1">
Name

</label>
<span>
<input id="eBann2" name="Field1" type="text" class="field text fn" value="<?php echo $_SESSION['FIRST_NAME']; ?>" size="20" maxlength="20" tabindex="5"/>
<label for="Field1">First</label>
</span>
<span>
<input id="eBann3" name="Field2" type="text" class="field text ln" value="<?php echo $_SESSION['LAST_NAME']; ?>" size="30"  maxlength="20" tabindex="6"/>
<label for="Field2">Last</label>
</span>
</li>


<li id="foli114" class="     ">
<label class="desc" id="title114" for="Field114">
Position in Organization
</label>
<div>
<input id="eBann4" name="Field114" type="text" class="field text medium" value="<?php echo $_SESSION['POSITION_IN_ORG']; ?>" maxlength="50" tabindex="8" />
</div>
</li>



<ul>
<li id="foli120" class="first section      ">
<section>
<h2 id="title120" style="background:#504842;">2. Organization Info</h2>
</section>
</li><li id="foli121" class="     ">
<label class="desc" id="title121" for="Field121">
Organization Name

</label>
<div style="float:left;">
<input id="eBann5" name="Field121" type="text" class="field text large" value="<?php echo $_SESSION['ORG_NAME']; ?>" maxlength="50" tabindex="9" required />
</div>
<div class="thumbnailOrgLogoReg">
	<?php
	if(($_SESSION['ORG_IMAGE']) == "loaded") {
	
		echo '<div id="orgLogo"><img src="uploaded_files/',$_SESSION['IMAGE_PATH'],'" alt="Org Logo Picture" width="180" height="120"></div>';
	}
	else
	{//This name is decieving, i am using the login pop up for the image upload.....
		echo '<div id="orgLogo">
<img src="../images/noorglogo.png" width="180" height="120" alt="header image2"> 
</div>';
	}
	?>

<br>
<I> Click above to Add or Change Photo the Organization Logo</I>
<br>
</div>
</li>

<li id="foli122" 
class="     "><label class="desc" id="title122" for="Field122">
Organization Description
</label>
<div>
<textarea id="eBann" 
name="Field122" 
class="field textarea medium" 
spellcheck="true" 
rows="10" cols="50" 
tabindex="10" 
maxlength="500"
onKeyUp="toCount('eBann','sBann','{CHAR} characters left',500);">
  <?php echo $_SESSION['ORG_DESC']; ?></textarea>
      <br>
      <span id="sBann" class="text">500 characters left.</span>

</div>

</li>

<li id="foli126" class="complex      ">
<label class="desc" id="title126" for="Field126">
Address

</label>
<div>
<span class="full addr1">
<input id="Field126" name="Field126" type="text" class="field text addr" value="<?php echo $_SESSION['ORG_ADDRESS']; ?>" tabindex="11" required />
<label for="Field126">Street Address</label>
</span>
<span class="left city">
<input id="Field128" name="Field128" type="text" class="field text addr" value="<?php echo $_SESSION['ORG_CITY']; ?>" tabindex="12" required />
<label for="Field128">City</label>
</span>
<span class="right state">
<select id="Field129" name="Field129"  class="field text addr" tabindex="13" value="">
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
<label for="Field129">State</label>
</span>
<span class="left zip">
<input id="Field130" name="Field130" type="text" class="field text addr" value="<?php echo $_SESSION['ORG_ZIPCODE']; ?>" maxlength="15" tabindex="14" required />
<label for="Field130">Postal / Zip Code</label>
</span>

</div>
</li>
<li id="foli132" class="     ">
<label class="desc" id="title132" for="Field132">
Organizations E-mail
</label>
<div>
<input id="Field132" name="Field132" type="email" spellcheck="false" class="field text medium" value="<?php echo $_SESSION['ORG_EMAIL']; ?>" maxlength="255" tabindex="15" /> 
</div>
<br>
<label class="desc" id="title159" for="Field159">
Primary Organization Type
</label>
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
<li id="foli10" class="phone      ">
<label class="desc" id="title10" for="Field10">
Phone Number

</label>

<form name = "phone13">



<span>
<input type="tel" id="phone1" name="phone1" 
    size=4 onKeyup="autotab(this, document.orgRegForm.phone2)" class="field text" size="3" tabindex="18"  maxlength=3 value="<?php echo $_SESSION['PHONE_PART_1']; ?>" required>
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone2" name="phone2" 
    size=4 onKeyup="autotab(this, document.orgRegForm.phone3)" class="field text" size="3"  tabindex="19" maxlength=3 value="<?php echo $_SESSION['PHONE_PART_2']; ?>"required> 
</span>
<span class="symbol">-</span>
<span>
<input type="tel" id="phone3" name="phone3" size=4 maxlength=4 class="field text" tabindex="20" value="<?php echo $_SESSION['PHONE_PART_3']; ?>" required>
</span>

</li><li id="foli133" class="section      ">
<section>
<h2 id="title133" style="background:#504842;">3. Organization Privacy Settings</h2>
</section>
</li><li id="foli134" class=" notStacked     ">
<fieldset>
<![if !IE | (gte IE 8)]>
<legend id="title134" class="desc">
</legend>
<![endif]>
<!--[if lt IE 8]>
<label id="title134" class="desc">
</label>
<![endif]-->
<div style="width:1000px;">
<input id="radioDefault_134" name="Field134" type="hidden" value="" />
<div style="padding: 0 0 0 0px; float:left; width:500px;">

<input id="Field134_0" name="Field134" type="radio" class="field radio" value="Public" tabindex="21" checked="checked"  
/>
<label class="choice" for="Field134_0">
Public - Searchable and viewable by everyone.</label>
</div>
<div style="padding: 0 0 0 00px; float:left; width:500px;">

<input id="Field134_1" name="Field134" type="radio"  class="field radio" value="Private" tabindex="22" />
<label class="choice" for="Field134_1" >
Private - Group content and activity is visable to everyone.</label> 
</div>
</div>
</fieldset>

</li>


<li id="foli127" class="section      ">
<section>
<h3 id="title127" style="background:#A4A4A4;">Link Your Profile</h3>
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
<input id="Field1116" name="Field11161" type="text" spellcheck="false" class="field text medium" value="" maxlength="255" tabindex="26" required /> 
</span>
</div>
</div>
<input type="button" value="Add another link" onClick="addInput('dynamicInput');">


</li><li id="foli124" class="section      ">
<section>
<h3 id="title124" style="background:#A4A4A4;">Tags</h3>
</section>
</li>

<![if !IE | (gte IE 8)]>
<legend id="title11" class="desc">
What is your Organization involved with?

</legend>
<![endif]>
<!--[if lt IE 8]>
<label id="title11" class="desc">
What is your Organization involved with?
<span id="req_11" class="req">*</span>
</label>
<![endif]-->

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
<div class="volSearchRightInnter" style="float:left;">
This helps volunteers find your organization.  <br>Just start typing words that describe your organization your programs and your programs and hit enter.
</div>

<li id="foli137" class="section      ">
<section>
<h3 id="title137" style="background:#A4A4A4;">Additional Admins</h3>
</section>
</li>
Type in the name and e-mail address(es) and we'll send the info!
<script src="../js/addInputs.js" language="Javascript" type="text/javascript"></script>

     <div id="dynamicInputAdmins">
<input style="float:left;"id="Field261a1" name="Field261a1" type="text" spellcheck="false" class="field text small" value="First Name" maxlength="255" tabindex="37" onfocus="this.value = this.value=='First Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'First Name' : this.value; this.value=='First Name' ? this.style.color='#999' : this.style.color='#000'"/> 
<input id="Field262a1" name="Field262a1" type="text" spellcheck="false" class="field text small" value="Last Name" maxlength="255" tabindex="37" onfocus="this.value = this.value=='Last Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Last Name' : this.value; this.value=='Last Name' ? this.style.color='#999' : this.style.color='#000'"/> 
<input style="float:left;"id="Field260a1" name="Field260a1" type="email" spellcheck="false" class="field text small" value="E-mail Address" maxlength="255" tabindex="37" onfocus="this.value = this.value=='E-mail Address' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'E-mail Address' : this.value; this.value=='E-mail Address' ? this.style.color='#999' : this.style.color='#000'"  /> 

     </div>
     <input type="button" value="Add another" onClick="addInput('dynamicInputAdmins');">


<br>
</li>
</li><li id="foli133" class="section      ">
<section>
<h2 id="title133" style="background:#504842; text-align:center;">Your Plan</h2>
</section>
</li>

<div id="pricingPlansOuterBox">
<div class="pricingPlans">

<div class="clear"></div>
<br>
<?php if(($_SESSION['ORG_PLAN'] == 'supreme' && $plan == '') || $plan == 'supreme')
{

echo 'The Supreme:  Unlimated Volunteers and Unlimated Messages! ';

}
else if(($_SESSION['ORG_PLAN'] == 'pro' && $plan == '') || $plan == 'pro')
{
	echo 'The Pro:  Up to 250 Volunteers and 1,000 Messages!';
}
else
{
	echo 'The Free Plan:   Free Forver!  Up to 50 Volunteers! <a href="#" onclick="popup(250, ';
	echo "'popup3'";
	echo ');" class="poplight">Upgrade</a>';
}
 ?>
</div>
</div>

<li id="foli135" class="     ">
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
<div class="pricingPlans">
<div class="ourPlanLeft" style="float:left; font:bold 0.8em 'TeXGyreAdventor', Arial, sans-serif!important; width:400px;">
<input id="Field13511" name="Field13511" type="checkbox" class="field checkbox" value="Volunteers must be invited or approved by organization in order to join" tabindex="38" />
<label class="choice" for="Field13511">I agree to the Volly.it <a href="legalstuff.php#description-tab"> Terms of Use </a> and <a href="legalstuff.php#usage-tab">Privacy Policy</a></label>
</div>
<div class="ourPlanRight" style="float:right; padding: 0px 50px 0px 0px; font:1.0em 'TeXGyreAdventor', Arial, sans-serif!important;">
 <input type="image" src="../images/createorg.png" name="Submit" tabindex="39" value="Create Organization" /></div></div>


</span>
</div>
</fieldset>
</li>

    </tr>
	</ul>
</form> 

</div><!--container-->

<a class="powertiny" href="http://wufoo.com/tour/" title="Powered by Wufoo"
style="display:block !important;visibility:visible !important;text-indent:0 !important;position:relative !important;height:auto !important;width:95px !important;overflow:visible !important;text-decoration:none;cursor:pointer !important;margin:0 auto !important">
<span style="background:url(../images/powerlogo.png) no-repeat center 7px; margin:0 auto;display:inline-block !important;visibility:visible !important;text-indent:-9000px !important;position:static !important;overflow: auto !important;width:62px !important;height:30px !important">Wufoo</span>
<b style="display:block !important;visibility:visible !important;text-indent:0 !important;position:static !important;height:auto !important;width:auto !important;overflow: auto !important;font-weight:normal;font-size:9px;color:#777;padding:0 0 0 3px;">Designed</b>
</a>

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
	</div>

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
			<input id="submit" type="submit" name="submit" value="Upload Admin Image!">
				</center>
		</p>
	</form></center>
		</p>
	
	</div>
	<div id="backgroundPopup2"></div>

<div id="popup3" class="popup_block">

	<?php
	if($_SESSION['ORG_PLAN'] == 'pro')
	{
		echo 'Click "Submit Payment" to sign up for the Pro Plan';
	}
	else if($_SESSION['ORG_PLAN'] == 'supreme')
	{
		echo 'Click "Submit Payment" to sign up for the Supreme Plan';
	}
	else
	{
		echo 'Click Submit Payment to change your plan!';
	}?>

<form class="paypal" action="payments.php" method="post" id="paypal_form" target="_blank">    
	<input type="hidden" name="cmd" value="_xclick-subscriptions" /> 
    <input type="hidden" name="item_number" 
	<?php
	if($_SESSION['ORG_PLAN'] == 'pro')
	{
		echo 'value="pro" ';
	}
	else if($_SESSION['ORG_PLAN'] == 'supreme')
	{
		echo 'value="supreme" ';
	}?>

	
	/ >
	<div class="clear"></div><br>
    <input type="submit"  value="Submit Payment"/>
</form>


</div>
</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script type="text/javascript" src="../js/customPopupBox.js"></script>


