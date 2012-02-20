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
	

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['ORG_NAME'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../css/jquery-ui-1.8.14.custom.css" type="text/css" />
<link rel="stylesheet" href="../css/jquery.ui.timepicker.css?v=0.2.9" type="text/css" />
<link href="../css/calendar.css" rel="stylesheet">
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
<h4 id="title1">2. Schedule Your Program</h4>
</div>
<div class="clear"></div>
<div class="programIconImage">
<img src="../images/twoProgram.png">
</div>

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
<div class="programOutStyle">
<div class="boxCreateProgram">

<div id="containerProgram" class="ltr">

<form id="createProgramForm" name="createProgramForm" class="wufoo topLabel page" autocomplete="off" enctype="multipart/form-data" method="post" novalidate action="process-program-part2.php">






<br><br><br>
<div class="container">
<div style="float:left; font:bold 1.3em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 30px 0px 0px;">
        Start Date :
</div>
<p><input tabindex="1" type="text" class="calendarSelectDate" id="Field1" name="Field1" value="<?php if(isset($_SESSION['PROGRAM_DATE_TEMP'])){echo $_SESSION['PROGRAM_DATE_TEMP'];} else{echo 'dd/mm/yyyy';}?>"/></p>
</div>
<div id="calendarDiv"></div>

<span class="hours">
					
 <div>
        <br>
<div style="float:left; font:bold 1.3em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 30px 0px 0px;">
        Start Time :
</div>
<div style="float:left; padding: 0px 30px 0px 0px;">
    <input type="text" style="width: 70px" name="timepicker_start" id="timepicker_start" tabindex="2" value="<?php echo $_SESSION['PROGRAM_START_TIME_TEMP'];?>" />
</div>
        
<div style="float:left; font:bold 1.3em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 30px 0px 0px;">
        End Time :
</div>
<div style="float:left; padding: 0px 30px 0px 0px;">
        <input type="text" style="width: 70px" name="timepicker_end" id="timepicker_end" tabindex="3" value="<?php echo $_SESSION['PROGRAM_END_TIME_TEMP'];?>" />
</div> <?php if($_SESSION['PROGRAM_RECURRING_TEMP'] == 'Recurring') { 
echo "<script type='text/javascript'>$(document).ready(function() {";
echo '$(".repeatsChecker").show();';
echo '})</script>'; } ?>
		<input id="Field6" name="Field6" type="checkbox" value="Recurring" tabindex="4" onclick="$('.repeatsChecker').toggle();"  <?php if($_SESSION['PROGRAM_RECURRING_TEMP'] == 'Recurring')
																																				{ echo 'checked="yes"'; } ?>
																																				 />
<div style="float:left; font:bold 1.3em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 30px 0px 0px;">
		Recurring Program:
</div>
        <script type="text/javascript">
		
            $(document).ready(function() {

                $('#timepicker_start').timepicker({
                    showLeadingZero: false,
                    onHourShow: tpStartOnHourShowCallback,
                    onMinuteShow: tpStartOnMinuteShowCallback
                });
                $('#timepicker_end').timepicker({
                    showLeadingZero: false,
                    onHourShow: tpEndOnHourShowCallback,
                    onMinuteShow: tpEndOnMinuteShowCallback
                });
				
				$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		})
			
				
				
            });

            function tpStartOnHourShowCallback(hour) {
                var tpEndHour = $('#timepicker_end').timepicker('getHour');
                // Check if proposed hour is prior or equal to selected end time hour
                if (hour <= tpEndHour) { return true; }
                // if hour did not match, it can not be selected
                return false;
            }
            function tpStartOnMinuteShowCallback(hour, minute) {
                var tpEndHour = $('#timepicker_end').timepicker('getHour');
                var tpEndMinute = $('#timepicker_end').timepicker('getMinute');
                // Check if proposed hour is prior to selected end time hour
                if (hour < tpEndHour) { return true; }
                // Check if proposed hour is equal to selected end time hour and minutes is prior
                if ( (hour == tpEndHour) && (minute < tpEndMinute) ) { return true; }
                // if minute did not match, it can not be selected
                return false;
            }

            function tpEndOnHourShowCallback(hour) {
                var tpStartHour = $('#timepicker_start').timepicker('getHour');
                // Check if proposed hour is after or equal to selected start time hour
                if (hour >= tpStartHour) { return true; }
                // if hour did not match, it can not be selected
                return false;
            }
            function tpEndOnMinuteShowCallback(hour, minute) {
                var tpStartHour = $('#timepicker_start').timepicker('getHour');
                var tpStartMinute = $('#timepicker_start').timepicker('getMinute');
                // Check if proposed hour is after selected start time hour
                if (hour > tpStartHour) { return true; }
                // Check if proposed hour is equal to selected start time hour and minutes is after
                if ( (hour == tpStartHour) && (minute > tpStartMinute) ) { return true; }
                // if minute did not match, it can not be selected
                return false;
            }

        </script>

<pre class="code" id="script_time_range" style="display: none">
$(document).ready(function() {
    $('#timepicker_start').timepicker({
        showLeadingZero: false,
        onHourShow: tpStartOnHourShowCallback,
        onMinuteShow: tpStartOnMinuteShowCallback
    });
    $('#timepicker_end').timepicker({
        showLeadingZero: false,
        onHourShow: tpEndOnHourShowCallback,
        onMinuteShow: tpEndOnMinuteShowCallback
    });
});

function tpStartOnHourShowCallback(hour) {
    var tpEndHour = $('#timepicker_end').timepicker('getHour');
    // Check if proposed hour is prior or equal to selected end time hour
    if (hour <= tpEndHour) { return true; }
    // if hour did not match, it can not be selected
    return false;
}
function tpStartOnMinuteShowCallback(hour, minute) {
    var tpEndHour = $('#timepicker_end').timepicker('getHour');
    var tpEndMinute = $('#timepicker_end').timepicker('getMinute');
    // Check if proposed hour is prior to selected end time hour
    if (hour < tpEndHour) { return true; }
    // Check if proposed hour is equal to selected end time hour and minutes is prior
    if ( (hour == tpEndHour) && (minute < tpEndMinute) ) { return true; }
    // if minute did not match, it can not be selected
    return false;
}

function tpEndOnHourShowCallback(hour) {
    var tpStartHour = $('#timepicker_start').timepicker('getHour');
    // Check if proposed hour is after or equal to selected start time hour
    if (hour >= tpStartHour) { return true; }
    // if hour did not match, it can not be selected
    return false;
}
function tpEndOnMinuteShowCallback(hour, minute) {
    var tpStartHour = $('#timepicker_start').timepicker('getHour');
    var tpStartMinute = $('#timepicker_start').timepicker('getMinute');
    // Check if proposed hour is after selected start time hour
    if (hour > tpStartHour) { return true; }
    // Check if proposed hour is equal to selected start time hour and minutes is after
    if ( (hour == tpStartHour) && (minute > tpStartMinute) ) { return true; }
    // if minute did not match, it can not be selected
    return false;
}
</pre>

    </div>
</span>

<div class="repeatsChecker">
<div class="clear"></div>
<br>
<div style="float:left; font:bold 1.3em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 30px 0px 0px;">
Repeats:
</div>
<div>

<select id="Field106" name="Field106" class="field select small" tabindex="5"  > 
<option value="Daily" <?php if($_SESSION['PROGRAM_REPEATS_TEMP'] == 'Daily'){ echo 'selected="yes"';}?>>
Daily
</option>
<option value="Weekly" <?php if($_SESSION['PROGRAM_REPEATS_TEMP'] == 'Weekly'){ echo 'selected="yes"';}?>>
Weekly
</option>
<option value="Bi-Weekly" <?php if($_SESSION['PROGRAM_REPEATS_TEMP'] == 'Bi-Weekly'){ echo 'selected="yes"';}?>>
Bi-Weekly
</option>
<option value="Monthly" <?php if($_SESSION['PROGRAM_REPEATS_TEMP'] == 'Monthly'){ echo 'selected="yes"';}?>>
Monthly
</option>
<option value="Yearly" <?php if($_SESSION['PROGRAM_REPEATS_TEMP'] == 'Yearly'){ echo 'selected="yes"';}?>>
Yearly
</option>
</select>
</div>
<div class="clear"></div>
<br>
<div style="float:left; font:bold 1.3em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 30px 0px 0px;">
Every:
</div>
<div id="Sunday" name="Sunday" style="float:left;">
<input type="checkbox" name="Sunday" value="Sunday" id="Sunday" tabindex="6" <?php if($_SESSION['PROGRAM_DATE_SUNDAY_TEMP'] != ''){ echo 'checked="yes"'; } ?>/>  Sunday<br/>
</div>
<div id="Monday" name="Monday" style="float:left; padding: 0px 0px 0px 10px;">
<input type="checkbox" name="Monday" value="Monday"  id="Monday" tabindex="7" <?php if($_SESSION['PROGRAM_DATE_MONDAY_TEMP'] != ''){ echo 'checked="yes"'; } ?>/>  Monday<br/>
</div>
<div id="Tuesday" name="Tuesday"  style="float:left; padding: 0px 0px 0px 10px;">
<input type="checkbox" name="Tuesday" value="Tuesday"  id="Tuesday" name="Tuesday" tabindex="8" <?php if($_SESSION['PROGRAM_DATE_TUESDAY_TEMP'] != ''){ echo 'checked="yes"'; } ?>/>  Tuesday<br/>
</div>
<div id="Wednesday" name="Wednesday"  style="float:left; padding: 0px 0px 0px 10px;">
<input type="checkbox" name="Wednesday" value="Wednesday"id="Wednesday" name="Wednesday"  tabindex="9" <?php if($_SESSION['PROGRAM_DATE_WEDNESDAY_TEMP'] != ''){ echo 'checked="yes"'; } ?>/>  Wednesday<br/>
</div>
<div id="Thursday" name="Thursday" style="float:left; padding: 0px 0px 0px 10px;">
<input type="checkbox" name="Thursday" value="Thursday" id="Thursday" name="Thursday"  tabindex="10" <?php if($_SESSION['PROGRAM_DATE_THURSDAY_TEMP'] != ''){ echo 'checked="yes"'; } ?>/>  Thursday<br/>
</div>
<div id="Friday" name="Friday"  style="float:left; padding: 0px 0px 0px 10px;">
<input type="checkbox" name="Friday" value="Friday" id="Friday" name="Friday"  tabindex="11" <?php if($_SESSION['PROGRAM_DATE_FRIDAY_TEMP'] != ''){ echo 'checked="yes"'; } ?>/>  Friday<br/>
</div>
<div id="Saturday" name="Saturday"  style="float:left; padding: 0px 0px 0px 10px;">
<input type="checkbox" name="Saturday" value="Saturday" id="Saturday" name="Saturday"  tabindex="12" <?php if($_SESSION['PROGRAM_DATE_SATURDAY_TEMP'] != ''){ echo 'checked="yes"'; } ?>/>  Saturday<br/>
</div>
<div class="clear"></div>
<br>
<div style="float:left; font:bold 1.3em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 30px 0px 0px;">
Date Ending:
</div>


<span>
<div class="container" style="float:left; font:bold 1.3em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 30px 0px 0px;">
<p><input type="text" class="calendarSelectDate" id="endDate" name="endDate" tabindex="13" value="<?php echo $_SESSION['PROGRAM_END_DATE_TEMP'];?>"/></p>
</div>
<div id="calendarDiv"></div>
</span>
 
<div style="float:left; font:bold 1.3em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 30px 0px 0px;">
OR		
</div>
<div style="float:left; font:bold 1.3em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 10px 0px 0px;">
		<input id="Field16" name="Field16" type="checkbox" value="No End Date" tabindex="14" <?php if($_SESSION['PROGRAM_NO_END_TEMP'] != ''){ echo 'checked="yes"'; } ?> />
</div>

<div style="float:left; font:bold 1.3em 'TeXGyreAdventor', Arial, sans-serif!important; padding: 0px 30px 0px 0px;">
No End Date
</div>

</div>


 
<div class="clear"></div>
<br>
<div class="clear"></div>

 <div id="bottomProgram">
<div id="saveDraft" style="float:left;">
<input type="image" name="Submit" src="../images/saveDraft.png" height="80" width="150" value="Draft" tabindex="15" /></td>
</div>

<div id="publish" style="float:left; padding: 0px 0px 0px 150px">
<input type="image" name="Submit" src="../images/Previous.png" height="80" width="150" value="Previous" tabindex="16" /></td>
 </div>
<div id="publish" style="float:left; padding: 0px 0px 0px 10px">
<input type="image" name="Submit" src="../images/next.png" height="80" width="150" value="Submit" tabindex="17" /></td>
 </div>


</div><!--container-->


</form> 
</div>
</div>
</div>
</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script type="text/javascript" src="../js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.ui.core.min.js"></script>
<script src="../js/calendar.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.ui.timepicker.js?v=0.2.9"></script>










