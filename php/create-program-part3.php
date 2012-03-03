<?php
	require_once('auth.php');
	
	include "header-org.php";
	include "navigation.php";
	
	if($_GET['startDate'] != '')
	{
		$_SESSION['PROGRAM_DATE_TEMP'] = $_GET['startDate'];
	}
	if($_GET['enddate'] != '')
	{
		$_SESSION['PROGRAM_END_DATE_TEMP'] = $_GET['enddate'];
	}
	if($_GET['startTime'] != '')
	{
		$_SESSION['PROGRAM_START_TIME_TEMP'] = $_GET['startTime'];
	}
	if($_GET['endtime'] != '')
	{
		$_SESSION['PROGRAM_END_TIME_TEMP'] = $_GET['endtime'];
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
	
	if($_GET['edit'] != '')
	{
		$_SESSION['EDIT_PROGRAM']= $_GET['edit'];
	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['ORG_NAME'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../form.css" type="text/css" />
<script type="text/javascript">
$(function(){
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "populate-program-positions.php",
			success: function(msg)
				{
				$("#results").html(msg);
				$("#results").fadeIn();
				}
		});
		
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "org-volunteer-images.php",
			success: function(msg)
				{
				$("#results2").html(msg);
				$("#results2").fadeIn();
				}
		});
});	
</script>
</head>
<body>



<div id="wrap">
<div id="mainnavuser">
<br>
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
<div id="popupContact7">
	<a id="popupContactClose7">x</a>
	<p id="contactArea">
		Help info here about parent program
		</p>
	</div>
	<div id="backgroundPopup7"></div>
	


<div class="clear"></div>
<div class="programHeading">
<h4 id="title1">3. Program Positions</h4>
</div>
<div class="clear"></div>
<div class="programIconImage">
<img src="../images/threeProgram.png">
</div>

<div class="programOutStyle">
<div class="boxCreateProgram">

<form id="createProgramForm" name="createProgramForm" class="wufoo topLabel page" autocomplete="off" enctype="multipart/form-data" method="post" novalidate action="handle-position.php">

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
<div class="programType">
<h4 id="title1">Create Positions</h4>
<img src="../images/help.png" width="20" height="20" onclick="popup(350, 'popup4');" class="poplight" >
</div>
<div class="clear"></div>
<br>
<?php if($_SESSION['PROGRAM_GENERAL_POSITIONS'] == 'true') { 
echo "<script type='text/javascript'>$(document).ready(function() {";
echo '$("#programcoord").hide(); $("#openPositions").hide(); $("#generalPositions").hide();';
echo '})</script>'; } ?>
<div style="float:left; padding: 0px 30px 0px 0px;">
<input id="Field6" name="Field6" type="checkbox" value="General" tabindex="4"  onclick="$('#programcoord').toggle(); $('#openPositions').toggle();  $('#generalPositions').toggle();" <?php if($_SESSION['PROGRAM_GENERAL_POSITIONS'] == 'true')
																																				{ echo 'checked="yes"'; } ?>
																																				 /> </div>
<div style="float:left; font: 1.3em ; padding: 0px 30px 0px 0px;">
General Positions Only (no specific positions)</div>
<div class="clear"></div>
<br>
<div id="programcoord">
<li id="foli1" class="posName      ">
<label class="desc" id="title8" for="Field8">
Position Name
</label>

<input id="Field8" name="Field8" type="text" class="field text medium" value="" maxlength="255" tabindex="1" onKeyUp="toCount('Field8','sBann2','{CHAR} characters left',50);" />
<div id="aboutMeRight" style="float:right;">
  <span id="sBann2" class="text">50 characters left.</span>
</div>

</li>



<li id="foli3" class="posDescript      ">
<label class="desc" id="title9" for="Field9">
Position Description
</label>
<div>
<textarea id="Field9" 
name="Field9" 
class="field textarea medium" 
spellcheck="true" 
rows="10" cols="50" 
tabindex="2" 
onKeyUp="toCount('Field9','sBann','{CHAR} characters left',500);"
 ></textarea>
<div id="aboutMeRight" style="float:right;">
  <span id="sBann" class="text">500 characters left.</span>
</div>
</div>
</li>

<li id="foli11" class="     ">
<label class="desc" id="title11" for="Field11">
Number of Open Positions
</label>
<div id="numberOpen">
<div id="field11" style="float: left;">
<input id="Field11" name="Field11" type="text" style="float:left;" class="field text medium" value="1" maxlength="200" tabindex="3"  />
<input type="button" value=" /\ " onclick="this.form.Field11.value++;" style="font-size:6px;margin:0;padding:0;width:20px;height:11px;" ><br>
<input type="button" value=" \/ " onclick="this.form.Field11.value--;" style="font-size:6px;margin:0;padding:0;width:20px;height:10px;" >
</div>

</div>
</li>

<div style="float: left; margin-left:500px">
<input id="addPosButton" type="button" value="Add Position" onClick="addInput('programcoord', document.createProgramForm.Field8.value,document.createProgramForm.Field11.value,document.createProgramForm.Field9.value);">




</div>



<div id="positions">
<div id="position">
Position
</div>
<div id="positionsOpen">
Positions Open
</div>
<div id="actions">
Actions
</div>
<div class="clear"></div>

<div id='results'>
</div>
</div>
 
</div>
<div class="clear"></div>
<div id="assignPositions" style="float:left;">
<h4 id="title1">Add Volunteers to Program</h4>
<img src="../images/help.png" width="20" height="20" onclick="popup(350, 'popup6');" class="poplight" >
<div class="clear"></div>
You've got volunteers.  You've got open positions.  Simple select and assign!

<div class="yourprogramsViews">
<div class="leftLinks" style="float:left;">


</div>

</div>

<div id="yourVolunteers" style="float:left; width: 500px;">
<h4 id="title1">Your Volunteers</h4>
<div class="clear"></div>
<!--form class="searchform" method="post" action="org-volunteer-mgmt.php" >
<table bgcolor="#FFFFFF" cellpadding="0px" cellspacing="0px" style="float:left">
<tr>
<td style="border-style:none; font:'TeXGyreAdventor', Arial, sans-serif!important;">
Search Volunteers
<div style="background: url(../images/roundbox.gif) no-repeat left top; padding: 0px; height: 22px;">

<input type="text" name="zoom_query" style="border: none; background-color: transparent; width: 90px; padding-left: 5px; padding-right: 5px;" value="Start Typing..." onfocus="this.value = this.value=='Start Typing...' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Start Typing...' : this.value; this.value=='Start Typing...' ? this.style.color='#999' : this.style.color='#000'"> 
</div>
</td>
<td style="border-style:none; "> 
<input type="submit" value="" style="border-style: none; background: url('../images/searchbutton1.gif') no-repeat; width: 24px; height: 22px;">
</td>
</tr>
</table>
</form-->
<div id='results2'>
</div>
</div>
<div id="openPositions" style="float:left;">
<h4 id="title1">Added Program Volunteers</h4>
<div class="clear"></div>
<div id="positionsOpenOrg">
<div id="positionAvailable">
Position
</div>
<div id="positionsOpen">
Positions Still Open
</div>
<div class="clear"></div>

<div id='resultsOpen'>
</div>
</div>
</div>
<div id="generalPositions" style="float:left; display:none">
<h4 id="title1">Open Positions</h4>
<div class="clear"></div>
<div id="positionsOpenOrg">
<div id="positionAvailable">
Volunteers
</div>
<div class="clear"></div>

<div id='resultsOpen'>
</div>
</div>
</div>

</div>


<div class="clear"></div>

 <div id="bottomProgram">
<div id="saveDraft" style="float:left;">
<input type="image" name="Submit" src="../images/saveDraft.png" height="80" width="150" value="Draft" tabindex="21" />
</div>

<div id="publish" style="float:left; padding: 0px 0px 0px 150px">
<input type="image" name="Submit" src="../images/Previous.png" height="80" width="150" value="Previous" tabindex="22" />
 </div>
<div id="publish" style="float:left; padding: 0px 0px 0px 10px">
<a href="#" onclick="popup(350, 'popup5');" class="poplight" ><img src="../images/publish.png" height="80" width="150" ></a>   

 </div>


<div id="popup5" class="popup_block">
	<h2 style=" padding:0px 0 0 30px!important; float:none; text-align: center;">No One Likes Suprises</h2><br>
	<p id="contactArea" style=" padding:0px 0 0 30px!important; float:none; text-align: center;">
			Ok, some people might.  But let's not do it here! If your volunteers DON'T KNOW they are volunteering for this program, please don't suprise them.  Make sure they know.</p>


<input type="submit" name="Submit" value="Submit" tabindex="23" />

	
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Go Back</a>
<!--/div-->

</div><!--container-->
<div id="popup4" class="popup_block">
help info here about creating positions
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Go Back</a>
</div>

<div id="popup6" class="popup_block">
help info here about assigning positions
<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Go Back</a>
</div>
</form> 
</div>
</div>


</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script src="../js/addInputs.js" language="Javascript" type="text/javascript"></script>
<script type="text/javascript" src="../js/characterCounter.js"></script>
<script type="text/javascript" src="../js/customPopupBox.js"></script>