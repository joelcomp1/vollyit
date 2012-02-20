<?php
	require_once('auth.php');
	
	include "header-org.php";
	include "navigation.php";
	session_start(); 
	if($_GET['name'] != '')
	{
		$_SESSION['PROGRAM_NAME_TEMP'] = $_GET['name'];
	}
	if($_GET['image'] != '')
	{
		$_SESSION['PROGRAM_IMAGE_PATH'] = $_GET['image'];
	}
	if($_GET['address'] != '')
	{
		$_SESSION['PROGRAM_ADDRESS_TEMP'] =  $_GET['address'];
	}
	if($_GET['city'] != '')
	{
		$_SESSION['PROGRAM_CITY_TEMP'] =  $_GET['city'];
	}
	if($_GET['state'] != '')
	{
		$_SESSION['PROGRAM_STATE_TEMP'] =  $_GET['state'];
	}
	if($_GET['zip'] != '')
	{
		$_SESSION['PROGRAM_ZIP_TEMP'] =  $_GET['zip'];
	}
	if($_GET['descrip'] != '')
	{
		$_SESSION['TEMP_PROGRAM_DESCRIPTION'] =  $_GET['descrip'];
	}
	if($_GET['startDate'] != '')
	{
		$_SESSION['PROGRAM_DATE_TEMP'] =  $_GET['startDate'];
	}
	if($_GET['enddate'] != '')
	{
		$_SESSION['PROGRAM_END_DATE_TEMP'] =  $_GET['enddate'];
	}
	if($_GET['startTime'] != '')
	{
		$_SESSION['PROGRAM_START_TIME_TEMP'] =  $_GET['startTime'];
	}
	if($_GET['endtime'] != '')
	{
		$_SESSION['PROGRAM_END_TIME_TEMP'] =  $_GET['endtime'];
	}
	if($_GET['recurring'] != '')
	{
		$_SESSION['PROGRAM_RECURRING_TEMP'] = $_GET['recurring'];
	}
	if($_GET['repeats'] != '')
	{
		$_SESSION['PROGRAM_REPEATS_TEMP'] = $_GET['repeats'];
	}
	if($_GET['sunday'] != '')
	{
		$_SESSION['PROGRAM_DATE_SUNDAY_TEMP'] = $_GET['sunday'];
	}
	if($_GET['monday'] != '')
	{
		$_SESSION['PROGRAM_DATE_MONDAY_TEMP'] = $_GET['monday'];
	}
	if($_GET['tuesday'] != '')
	{
		$_SESSION['PROGRAM_DATE_TUESDAY_TEMP'] = $_GET['tuesday'];
	}
	if($_GET['wednesday'] != '')
	{
		$_SESSION['PROGRAM_DATE_WEDNESDAY_TEMP'] = $_GET['wednesday'];
	}
	if($_GET['thursday'] != '')
	{
		$_SESSION['PROGRAM_DATE_THURSDAY_TEMP'] = $_GET['thursday'];
	}
	if($_GET['friday'] != '')
	{
		$_SESSION['PROGRAM_DATE_FRIDAY_TEMP'] = $_GET['friday'];
	}
	if($_GET['saturday'] != '')
	{
		$_SESSION['PROGRAM_DATE_SATURDAY_TEMP'] = $_GET['saturday'];
	}
	if($_GET['noend'] != '')
	{
		$_SESSION['PROGRAM_NO_END_TEMP'] = $_GET['noend'];
	}
	if(isset($_SESSION['PROGRAM_IMAGE_PATH']))
	{
		$_SESSION['PROGRAM_IMAGE'] = 'true';
	}	
	if($_GET['reset'] != '')
	{
	        unset($_SESSION['PROGRAM_NAME_TEMP']);
			unset($_SESSION['PROGRAM_NAME']);
	        unset($_SESSION['PROGRAM_ADDRESS_TEMP']);
			unset($_SESSION['PROGRAM_CITY_TEMP']);
			unset($_SESSION['PROGRAM_STATE_TEMP']);
			unset($_SESSION['PROGRAM_ZIP_TEMP']);
	        unset($_SESSION['TEMP_PROGRAM_DESCRIPTION']);
			unset($_SESSION['TEMP_PROGRAM_IMAGE']);
			unset($_SESSION['TEMP_PROGRAM_NAME']);
			unset($_SESSION['TEMP_PROGRAM_PARENT_NAME']);
			unset($_SESSION['TEMP_PROGRAM_PARENT_IMAGE']);
			unset($_SESSION['TEMP_ORG_IMAGE']);
			unset($_SESSION['TEMP_ORG_PRGORAM_NAME']);
			unset($_SESSION['TEMP_ORG_PROGRAM_CITY']);
			unset($_SESSION['TEMP_ORG_PROGRAM_STATE']);		
			unset($_SESSION['TEMP_PROGRAM_TAGS']);	
			unset($_SESSION['PROGRAM_IMAGE_PATH']);
	}
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['ORG_NAME'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link href="../css/liveQuery.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../form.css" type="text/css" />



</head>

<body>

<div id="wrap">
<div id="mainnavuser">
<div class="clear"></div>
<h3>

Create Your Program

<div class="easyAs">
Easy as 1.. 2.. 3..
</div>
</h3>

<!--This is used for the upcoming vollys box-->
<div class="createNewProgram"  style="text-align:center;">
<img src="../images/program-progression.png" width="600" height="80">
</div>



<div class="clear"></div>
<div class="programHeading">
<h4 id="title1">1. Program Info</h4>
</div>
<div class="clear"></div>
<div class="programIconImage">
<img src="../images/oneProgram.png">
</div>

<div id="popupContact3">
	<a id="popupContactClose3">x</a>
	<p id="contactArea">

<form id="Upload" action="upload.processor.php" enctype="multipart/form-data" method="post">
		<p>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">
			<div id="imageUpload" style="text-align:center">
	
			<label for="file">Upload a Picture!</label>
			<br>
			<br>
			<input id="file" type="file" name="file">
				<br>
			
<br>
			<input id="submit" type="submit" name="submit" value="Upload Program Photo!">
				</div>
		</p>
	</form>
		</p>
	</div>
	<div id="backgroundPopup3"></div>
	
	

	
<div id="popup4" class="popup_block">
Help info here about Program coordinators
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Go Back</a>
</div>
<div id="popup5" class="popup_block">
	<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Go Back</a>
	<p id="contactArea">

<form id="Upload" action="upload.processor.php" enctype="multipart/form-data" method="post">
		<p>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">
			<div id="imageUpload" style="text-align:center">
	
			<label for="file">Upload a Picture!</label>
			<br>
			<br>
			<input id="file" type="file" name="file">
				<br>
			
<br>
			<input id="submit" type="submit" name="submit" value="Upload Program Photo!">
				</div>
		</p>
	</form>
		</p>
</div>

<div id="popupContact5">
	<a id="popupContactClose5">x</a>
	<p id="contactArea">
		Help info here about program type
		</p>
	</div>
	<div id="backgroundPopup5"></div>
	
<div id="popupContact6">
	<a id="popupContactClose6">x</a>
	<p id="contactArea">
		Help info here about collaborative prgoram
		</p>
	</div>
	<div id="backgroundPopup6"></div>
	
<div id="popupContact7">
	<a id="popupContactClose7">x</a>
	<p id="contactArea">
		Help info here about parent program
		</p>
	</div>
	<div id="backgroundPopup7"></div>
	
<div id="popupContact8">
	<a id="popupContactClose8">x</a>
	<p id="contactArea">
		Help info here about child prgoram
		</p>
	</div>
	<div id="backgroundPopup8"></div>
	<br><br><br>
<div class="programOutStyle">
<div class="boxCreateProgram">
<div id="containerProgram" class="ltr">
<form id="createProgramForm" name="createProgramForm" class="wufoo topLabel page" autocomplete="on" enctype="multipart/form-data" method="post" novalidate action="process-program-part1.php">
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
<div class="thumbnailProgram">
	<?php
	if(($_SESSION['PROGRAM_IMAGE']) == 'true') {
	
		echo '<div id="orgLogo"';
		?>
		onclick="popup(350, 'popup5');" class="poplight"
		<?php echo 'style="float:left;"><img src="uploaded_files/',$_SESSION['PROGRAM_IMAGE_PATH'],'" alt="Program Picture" width="200" height="200">
		 <br><I> Click Image to Add or Change Photo</I></div>';
	}
	else
	{//This name is decieving, i am using the orgLogo pop up for the image upload of the Program.....
		echo '<div id="orgLogo" style="float:left;"><img src="../images/nophoto.png" width="200" height="200" alt="header image2""> <br><I> Click Image to Add or Change Photo</I></div>';
	}
	?>
	

</div>
<div id="programInfo" style="float:left; padding: 0px 0px 0px 30px; width: 300px;">
<ul>
<li id="foli1" class="     ">
<label class="desc" id="title1" for="Field1">
Program Name
</label>

<div>
<input id="Field1" name="Field1" type="text" class="field text large" value="<?php echo $_SESSION['PROGRAM_NAME_TEMP'];?>" maxlength="255" tabindex="1" onkeyup="" />

</div>
</li>
<li id="foli126" class="complex      ">
<label class="desc" id="title126" for="Field126">
Address
</label>
<div>
<span class="full addr1">
<input id="Field126" name="Field126" type="text" class="field text addr" value="<?php echo $_SESSION['PROGRAM_ADDRESS_TEMP']; ?>" tabindex="2" required />
<label for="Field126">Street Address</label>
</span>
<span class="left city">
<input id="Field128" name="Field128" type="text" class="field text city" value="<?php echo $_SESSION['PROGRAM_CITY_TEMP']; ?>" tabindex="3" required />
<label for="Field128">City</label>
</span>
<span class="right state">
<select id="Field129" name="Field129"  class="field text addr" tabindex="4" value="">
                    <option value="">Select a State</option>
                    <option value="AK" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'AK'){ echo 'selected="yes"';}?>>Alaska</option>
                    <option value="AL" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'AL'){ echo 'selected="yes"';}?>>Alabama</option>
                    <option value="AR" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'AR'){ echo 'selected="yes"';}?>>Arkansas</option>
                    <option value="AZ" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'AZ'){ echo 'selected="yes"';}?>>Arizona</option>
                    <option value="CA" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'CA'){ echo 'selected="yes"';}?>>California</option>
                    <option value="CO" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'CO'){ echo 'selected="yes"';}?>>Colorado</option>
                    <option value="CT" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'CT'){ echo 'selected="yes"';}?>>Connecticut</option>
                    <option value="DC" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'DC'){ echo 'selected="yes"';}?>>Washington D.C.</option>
                    <option value="DE" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'DE'){ echo 'selected="yes"';}?>>Delaware</option>
                    <option value="FL" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'FL'){ echo 'selected="yes"';}?>>Florida</option>
                    <option value="GA" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'GA'){ echo 'selected="yes"';}?>>Georgia</option>
                    <option value="HI" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'HI'){ echo 'selected="yes"';}?>>Hawaii</option>
                    <option value="IA" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'IA'){ echo 'selected="yes"';}?>>Iowa</option>
                    <option value="ID" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'ID'){ echo 'selected="yes"';}?>>Idaho</option>
                    <option value="IL" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'IL'){ echo 'selected="yes"';}?>>Illinois</option>
                    <option value="IN" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'IN'){ echo 'selected="yes"';}?>>Indiana</option>
                    <option value="KS" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'KS'){ echo 'selected="yes"';}?>>Kansas</option>
                    <option value="KY" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'KY'){ echo 'selected="yes"';}?>>Kentucky</option>
                    <option value="LA" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'LA'){ echo 'selected="yes"';}?>>Louisiana</option>
                    <option value="MA" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'MA'){ echo 'selected="yes"';}?>>Massachusetts</option>
                    <option value="MD" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'MD'){ echo 'selected="yes"';}?>>Maryland</option>
                    <option value="ME" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'ME'){ echo 'selected="yes"';}?>>Maine</option>
                    <option value="MI" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'MI'){ echo 'selected="yes"';}?>>Michigan</option>
                    <option value="MN" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'MN'){ echo 'selected="yes"';}?>>Minnesota</option>
                    <option value="MO" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'MO'){ echo 'selected="yes"';}?>>Missourri</option>
                    <option value="MS" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'MS'){ echo 'selected="yes"';}?>>Mississippi</option>
                    <option value="MT" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'MT'){ echo 'selected="yes"';}?>>Montana</option>
                    <option value="NC" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'NC'){ echo 'selected="yes"';}?>>North Carolina</option>
                    <option value="ND" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'ND'){ echo 'selected="yes"';}?>>North Dakota</option>
                    <option value="NE" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'NE'){ echo 'selected="yes"';}?>>Nebraska</option>
                    <option value="NH" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'NH'){ echo 'selected="yes"';}?>>New Hampshire</option>
                    <option value="NJ" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'NJ'){ echo 'selected="yes"';}?>>New Jersey</option>
                    <option value="NM" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'NM'){ echo 'selected="yes"';}?>>New Mexico</option>
                    <option value="NV" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'NV'){ echo 'selected="yes"';}?>>Nevada</option>
                    <option value="NY" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'NY'){ echo 'selected="yes"';}?>>New York</option>
                    <option value="OH" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'OH'){ echo 'selected="yes"';}?>>Ohio</option>
                    <option value="OK" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'OK'){ echo 'selected="yes"';}?>>Oklahoma</option>
                    <option value="OR" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'OR'){ echo 'selected="yes"';}?>>Oregon</option>
                    <option value="PA" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'PA'){ echo 'selected="yes"';}?>>Pennsylvania</option>
                    <option value="PR" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'PR'){ echo 'selected="yes"';}?>>Puerto Rico</option>
                    <option value="RI" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'RI'){ echo 'selected="yes"';}?>>Rhode Island</option>
                    <option value="SC" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'SC'){ echo 'selected="yes"';}?>>South Carolina</option>
                    <option value="SD" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'SD'){ echo 'selected="yes"';}?>>South Dakota</option>
                    <option value="TN" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'TN'){ echo 'selected="yes"';}?>>Tennessee</option>
                    <option value="TX" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'TX'){ echo 'selected="yes"';}?>>Texas</option>
                    <option value="UT" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'UT'){ echo 'selected="yes"';}?>>Utah</option>
                    <option value="VA" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'VA'){ echo 'selected="yes"';}?>>Virginia</option>
                    <option value="VT" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'VT'){ echo 'selected="yes"';}?>>Vermont</option>
                    <option value="WA" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'WA'){ echo 'selected="yes"';}?>>Washington</option>
                    <option value="WI" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'WI'){ echo 'selected="yes"';}?>>Wisconsin</option>
                    <option value="WV" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'WV'){ echo 'selected="yes"';}?>>West Virginia</option>
                    <option value="WY" <?php if($_SESSION['PROGRAM_STATE_TEMP'] == 'WY'){ echo 'selected="yes"';}?>>Wyoming</option>
		</select>
<label for="Field129">State</label>
</span>
<span class="left zip">
<input id="Field130" name="Field130" type="text" class="field text addr" value="<?php echo $_SESSION['PROGRAM_ZIP_TEMP']; ?>" maxlength="15" tabindex="5" required />
<label for="Field130">Postal / Zip Code</label>
</span>

</div>
</li>
</div>
<div class="clear"></div>
<label class="desc" id="title3" for="Field3">
Program Description
</label>

<div style="float:left; width: 550px;">
<textarea id="Field3" 
name="Field3" 
class="field textarea medium" 
spellcheck="true" 
rows="10" cols="30" 
tabindex="6" 
style="resize: none;"
 ><?php echo $_SESSION['TEMP_PROGRAM_DESCRIPTION'];?></textarea>
</div>
<div class="clear"></div>
<br>
<!--div id="tags" style="float:left; padding: 0px;">
<div class="tagsStyle" >
Tags: How would you like this program to be searched?
</div>
<br>
<div class="volSearchRightInnter" style="float:left; font:0.9em 'TeXGyreAdventor', Arial, sans-serif!important;">
This helps volunteers find your organization.  Just start <br>typing words that describe your organization your <br>programs and your programs and hit enter.
</div>
<div class="clear"></div>
<br>
<div class="volSearchLeftInnter" style="float:left; padding: 0px 20px 0px 0px;">
<input name="inputString" type="text" size="30" id="inputString" tabindex="7" onkeyup="lookup(this.value);" onblur="fillTags();" value="<?php if(isset($_SESSION['TEMP_PROGRAM_TAGS'])) {echo $_SESSION['TEMP_PROGRAM_TAGS'];} else { echo 'Start Typing Keywords here...';}?>" onfocus="this.value = this.value=='Start Typing Keywords here...' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Start Typing Keywords here...' : this.value; this.value=='Start Typing Keywords here...' ? this.style.color='#999' : this.style.color='#000'"/>
<div class="suggestionsBox" id="suggestions" style="display: none; text: font:bold 0.4em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<img src="../images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList" id="autoSuggestionsList">
		&nbsp;
	</div>
	</div>
</div>
</div-->


<div id="programCoords" style="float:left; padding: 0px">
<div class="tagsStyle">
<div id="programCoordsLeft" style="float:left;">
Program Coordinators
</div>
<div id="programCoordsRight" style="float:left;">
<img src="../images/help.png" width="20" height="20" onclick="popup(350, 'popup4');" class="poplight" >

</div>
</div>
<div class="clear"></div>
<div id="dynamicProgramCoords">
<input name="tags"  type="text" size="60" id="inputString2" onkeyup="lookupTags(this.value);" value="Start Typing Name" onfocus="this.value = this.value=='Start Typing Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Start Typing Name' : this.value; this.value=='Start Typing Name' ? this.style.color='#999' : this.style.color='#000'"/>
<div class="suggestionsBox2" id="suggestions2" style="display: none; text: font:bold 0.4em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<img src="../images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList2" id="autoSuggestionsList2">
		&nbsp;
	</div>
	</div>
<input type="button" value="Add Program Coordinator" onClick="unhideInput();">
<div id='results'>
</div>
</div>



</div>



<script type="text/javascript">
$(function() {    // Makes sure the code contained doesn't run until
                  //     all the DOM elements have loaded
    $('#Field160').change(function(){
        $('.selectColabOption').hide();
        $('#' + $(this).val()).show();
    });

});

</Script>
<script type="text/javascript" src="../js/customPopupBox.js"></script>

<div class="clear"></div>
<br>
<!--div class="programType">
<h4 id="title1">Program Type</h4>
<img src="../images/help.png" width="20" height="20" id="helpCoolab" style="padding: 0px 0px 0px 10px;">
</div>
<div class="clear"></div>
<br>

<select id="Field160" name="Field160"  class="field text addr" tabindex="9" >
                    <option value="" <?php if(!isset($_SESSION['TEMP_PROGRAM_IMAGE'])){ echo 'selected="yes"';}?>>Regular Program</option>
                    <option value="collabEvent" <?php if(isset($_SESSION['TEMP_ORG_IMAGE'])){ echo 'selected="yes"';}?>>Collaborative Program</option>
                    <option value="parentProgram" <?php if(isset($_SESSION['TEMP_PROGRAM_PARENT_IMAGE'])){ echo 'selected="yes"';}?>>Parent Program</option>
                    <option value="childProgram" <?php if(isset($_SESSION['TEMP_PROGRAM_IMAGE'])){ echo 'selected="yes"';}?>>Child Program</option>
		</select-->
<div class="clear"></div>
<br>
<div id="collabEvent" class="selectColabOption" style="float:left; <?php if(!isset($_SESSION['TEMP_ORG_IMAGE'])){ echo 'display:none;';}?>">
<div class="collabStyle" style="margin: 0px 0px 0px 0px;">
Collaborative <img src="../images/help.png" width="20" height="20" id="helpCollaborative" style="padding: 0px 0px 0px 180px;">
</div>
<div name="makeProgramCollab" class="makeProgramCollab" style="float:left;">
<div class="programCoollab" style="float:left; margin: 0px 0px 0px 0px">
Who would you like to collaborate with?</div>
<div class="clear"></div>
<br>

<div id="dynamicCollabOrgs" style="margin: 0px 0px 0px 0px;">

<input name="inputString3" type="text" size="30" id="inputString3" onkeyup="lookupOrgs(this.value);" onblur="fillOrgs();" value="Type Organization Name" onfocus="this.value = this.value=='Type Organization Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Type Organization Name' : this.value; this.value=='Type Organization Name' ? this.style.color='#999' : this.style.color='#000'"/>
<div class="suggestionsBox3" id="suggestions3" style="display: none; text: font:bold 0.4em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<img src="../images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList3" id="autoSuggestionsList3">
		&nbsp;
	</div>
	</div>
<input type="submit" name="Submit"  value="Add Collaborative Program">
</div>
</div>
</div>
<div class="clear"></div>
<div id="speicalProgramType" style="float:left; <?php if(!isset($_SESSION['TEMP_ORG_IMAGE'])){ echo 'display:none;';}?> font:bold 1.5em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<?php 
		echo '<div id="childLogo" style="float:left;"><img src="uploaded_files/',$_SESSION['TEMP_ORG_IMAGE'],'" alt="Child Program Picture" width="75" height="75">';
		echo '</div><div id="pubLogo" style="float:left; margin: 0 0 0 10px;">',$_SESSION['TEMP_ORG_PRGORAM_NAME'];
		
	?>
	<br><br><div id="diffText" style="font:0.7em 'TeXGyreAdventor', Arial, sans-serif!important; margin: 10px;"><?php echo $_SESSION['TEMP_ORG_PROGRAM_CITY']; echo ', ',$_SESSION['TEMP_ORG_PROGRAM_STATE'];?>
	<a href="unset-advanced-program.php" style="margin: 10px;">remove</a></div>
	</div>
	
</div>
<div id="parentProgram" class="selectColabOption" style="float:left; <?php if(!isset($_SESSION['TEMP_PROGRAM_PARENT_IMAGE'])){ echo 'display:none;';}?>">
<div class="collabStyle" style="margin: 0px 0px 0px 0px;">
Parent Program <img src="../images/help.png" width="20" height="20" id="emailAccountSettings" style="padding: 0px 0px 0px 180px;">
</div>
<div name="makeProgramCollab" class="makeProgramCollab" style="float:left;">
<div class="programCoollab" style="float:left; margin: 0px 0px 0px 0px">
Add Child Programs(s)</div>
<div class="clear"></div>
<br>

<div id="dynamicCollabOrgs" style="margin: 0px 0px 0px 0px;">
<input name="inputString2" type="text" size="30" id="inputString2" onkeyup="lookupPrograms(this.value);" onblur="fillPrograms();" value="Type Program Name" onfocus="this.value = this.value=='Type Program Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Type Program Name' : this.value; this.value=='Type Program Name' ? this.style.color='#999' : this.style.color='#000'"/>
<div class="suggestionsBox2" id="suggestions2" style="display: none; text: font:bold 0.4em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<img src="../images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList2" id="autoSuggestionsList2">
		&nbsp;
	</div>
	</div>
		<input type="submit" name="Submit"  value="Add Parent Program">
</div>
</div>
</div>
<div class="clear"></div>
<div id="speicalProgramType" style="float:left; <?php if(!isset($_SESSION['TEMP_PROGRAM_PARENT_IMAGE'])){ echo 'display:none;';}?> font:bold 1.5em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<?php 
		echo '<div id="childLogo" style="float:left;"><img src="uploaded_files/',$_SESSION['TEMP_PROGRAM_PARENT_IMAGE'],'" alt="Parent Program Picture" width="75" height="75">';
		echo '</div><div id="pubLogo" style="float:left; margin: 0 0 0 10px;">',$_SESSION['TEMP_PROGRAM_PARENT_NAME'];
		
	?>
	<br><br><div id="diffText" style="font:0.7em 'TeXGyreAdventor', Arial, sans-serif!important; margin: 10px;">Published Event <a href="unset-advanced-program.php" style="margin: 10px;">remove</a></div>
	</div>
	
</div>

<div id="childProgram" class="selectColabOption" style="float:left; <?php if(!isset($_SESSION['TEMP_PROGRAM_IMAGE'])){ echo 'display:none;';}?>">

<div class="collabStyle" style="margin: 0px 0px 0px 0px;">
Child Program <img src="../images/help.png" width="20" height="20" id="phoneAccountSettings" style="padding: 0px 0px 0px 180px;">
</div>
<div name="makeProgramCollab" class="makeProgramCollab" style="float:left;">
<div class="programCoollab" style="float:left; margin: 0px 0px 0px 0px">
Add Parent Program</div>
<div class="clear"></div>
<br>

<div id="dynamicCollabOrgs" style="margin: 0px 0px 0px 0px;">
<input name="inputString4" type="text" size="30" id="inputString4" onkeyup="lookupPrograms2(this.value);" onblur="fillPrograms2();" value="Type Program Name" onfocus="this.value = this.value=='Type Program Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Type Program Name' : this.value; this.value=='Type Program Name' ? this.style.color='#999' : this.style.color='#000'"/>
<div class="suggestionsBox4" id="suggestions4" style="display: none; text: font:bold 0.4em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<img src="../images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList4" id="autoSuggestionsList4">
		&nbsp;
	</div>
	</div>
	<input type="submit" name="Submit"  value="Add Child Program">
</div>
</div>

</div>
<div class="clear"></div>
<div id="speicalProgramType" style="float:left; <?php if(!isset($_SESSION['TEMP_PROGRAM_IMAGE'])){ echo 'display:none;';}?> font:bold 1.5em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<?php 
		echo '<div id="childLogo" style="float:left;"><img src="uploaded_files/',$_SESSION['TEMP_PROGRAM_IMAGE'],'" alt="Child Program Picture" width="75" height="75">';
		echo '</div><div id="pubLogo" style="float:left; margin: 0 0 0 10px;">',$_SESSION['TEMP_PROGRAM_NAME'];
		
	?>
	<br><br><div id="diffText" style="font:0.7em 'TeXGyreAdventor', Arial, sans-serif!important; margin: 10px;">Published Event <a href="unset-advanced-program.php" style="margin: 10px;">remove</a></div>
	</div>
	
</div>
<div class="clear"></div>
<br>



  <div id="bottomProgram">
<div id="saveDraft" style="float:left;">
<input type="image" name="Submit" src="../images/saveDraft.png" height="80" width="150" value="Draft" tabindex="21" /></td>
</div>

<div id="publish" style="float:left; padding: 0px 0px 0px 300px">
<input type="image" name="Submit" src="../images/next.png" height="80" width="150" value="Submit" tabindex="22" /></td>
 </div>


</div><!--container-->
 
</div><!--container-->


</form> 
</div>
</div>
</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>

</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="../js/createProgramPart1.js"></script>
<script type="text/javascript" src="../js/searchProgCoord.js"></script>
<script src="../js/addInputs.js" language="Javascript" type="text/javascript"></script>
<script type="text/javascript" src="../js/populateProgramCoords.js"></script>

