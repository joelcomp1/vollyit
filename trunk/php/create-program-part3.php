<?php
	require_once('auth.php');
	
	include "header-org.php";
	include "navigation.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['ORG_NAME'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
 <script type="../text/javascript" src="../js/jquery.js"></script>
  <script type="../text/javascript" src="../js/collection.js"></script>

  <script type="text/javascript" src="../js/jquery.1.4.2.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../css/jsDatePick_ltr.min.css" />
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../form.css" type="text/css" />
  <script src="../js/popup.js" type="text/javascript"></script>
<!-- JavaScript -->
<script src="scripts/wufoo.js"></script>
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
	
<div id="popupContact8">
	<a id="popupContactClose8">x</a>
	<p id="contactArea">
		Help info here about creating positions
		</p>
	</div>
	<div id="backgroundPopup8"></div>

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
<img src="../images/help.png" width="20" height="20" id="phoneAccountSettings">
</div>
<div class="clear"></div>
<br>
<div style="float:left; padding: 0px 30px 0px 0px;">
<input id="Field6" name="Field6" type="checkbox" value="Recurring" tabindex="4"  /> </div>
<div style="float:left; font: 1.3em ; padding: 0px 30px 0px 0px;">
General Positions Only (no specific positions)</div>
<div class="clear"></div>
<br>

<li id="foli1" class="posName      ">
<label class="desc" id="title8" for="Field8">
Position Name
</label>
<div>
<input id="Field8" name="Field8" type="text" class="field text medium" value="" maxlength="255" tabindex="1" onkeyup="" />
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
onkeyup=""
 ></textarea>

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
<div style="float: left; margin-left:500px">
<input id="createPosition" name="Submit" class="btTxt submit" type="submit" value="Create Position"/>
</div>
</div>
</li>

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



<?php

	for($i = 1; $i <= $_SESSION['POSITIONS_CREATED']; $i++)
	{
		$posName = 'POSITION_NAME';
		$posName .= $i;
	
		$numOpen = 'NUM_OPEN';
		$numOpen .= $i;
		
		$remove = 'REMOVE';
		$remove .= $i;
		if( isset($_SESSION[$posName]) && isset($_SESSION[$numOpen])) {
		echo '<div id="position">';
		echo $_SESSION[$posName];
		echo '</div>';
		echo '<div id="positionsOpen">';
		echo $_SESSION[$numOpen];
		echo '</div>';
		echo '<div id="actions">';
		echo '<input type="image" name="Submit" value="',$remove,'"  src="../images/remove.png" height="25" width="50"/>';
		echo '</div>';		
		
		echo '<div class="clear"></div>';
		
		
		}
	}
?>
 </div>
 
 
 
<div class="clear"></div>
<br>
<div class="clear"></div>

 <div id="bottomProgram">
<div id="saveDraft" style="float:left;">
<input type="image" name="Submit" src="../images/saveDraft.png" height="80" width="150" value="Draft" tabindex="21" /></td>
</div>

<div id="publish" style="float:left; padding: 0px 0px 0px 150px">
<input type="image" name="Submit" src="../images/Previous.png" height="80" width="150" value="Previous" tabindex="22" /></td>
 </div>
<div id="publish" style="float:left; padding: 0px 0px 0px 10px">
<input type="image" name="Submit" src="../images/publish.png" height="80" width="150" value="Submit" tabindex="22" /></td>
 </div>


</div><!--container-->


</form> 
</div>
</div>
</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>