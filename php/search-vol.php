<?php
	require_once('auth.php');

	session_start();
	
	include("config.php");
	
	include 'header-vol.php';
	
	include 'navigation-vol.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['SESS_MEMBER_ID'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link href="../css/liveQuery.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrap">
<div id="mainnavuser">
<br>

<div id="backgroundCloseImageLoad"></div>
<div id="popupContact9">
	<a id="popupContactClose9">x</a>
	<p id="contactArea">
		Search Tips
		</p>
	</div>
	<div id="backgroundPopup9"></div>
<div class="clear"></div>
<h3 style="font: bold 3.2em 'TeXGyreAdventor', Arial, sans-serif;">
Find Organizations and Volunteer Opportunities
</h3>
<div class="clear"></div>
<div class="volSearching">
<div class="volSearchingBoarderResults">
<div class="volSearchReSearch">
<br>
<form id="search-form" name="search-form" autocomplete="off">
<div class="volSearchLeftInnter" style="float:left">
<input name="name" type="input-text" size="30" id="inputString" onkeyup="lookup(this.value);" value="Enter Program/Organization Name" onfocus="this.value = this.value=='Enter Program/Organization Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Enter Program/Organization Name' : this.value; this.value=='Enter Program/Organization Name' ? this.style.color='#999' : this.style.color='#000'"/>
<div class="suggestionsBox" id="suggestions" style="display: none; text: font:bold 0.4em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<img src="../images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList" id="autoSuggestionsList">
		&nbsp;
	</div>
	</div>


</div>
 
<div class="volSearchRightInnter" style="float:left; margin: 0px 0px 0px 15px">

<input name="tags"  type="text" size="30" id="inputString2" onkeyup="lookupTags(this.value);" value="Enter Keywords/Interests" onfocus="this.value = this.value=='Enter Keywords/Interests' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Enter Keywords/Interests' : this.value; this.value=='Enter Keywords/Interests' ? this.style.color='#999' : this.style.color='#000'"/>
<div class="suggestionsBox2" id="suggestions2" style="display: none; text: font:bold 0.4em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<img src="../images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList2" id="autoSuggestionsList2">
		&nbsp;
	</div>
	</div>
</div>

<div class="volSearchRightInnter" style="float:left; margin: 0px 0px 0px 15px">
in
<input name="location" type="text" size="20" id="inputString3" onkeyup="lookupLocation(this.value);" value="Enter Any Location" onfocus="this.value = this.value=='Enter Any Location' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Enter Any Location' : this.value; this.value=='Enter Any Location' ? this.style.color='#999' : this.style.color='#000'"/>
<div class="suggestionsBox3" id="suggestions3" style="display: none; text: font:bold 0.4em 'TeXGyreAdventor', Arial, sans-serif!important;">
	<img src="../images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList3" id="autoSuggestionsList3">
		&nbsp;
	</div>
	</div>
</div>
<div id="publish" style="float: right; vertical-align:top; padding: 0px 20px 0px 0px; margin: 0px 0px 0px 0px;">
<input type="image" name="Submit" src="../images/searchagain.png" height="30" width="80"  tabindex="13" value="Seach" />
<br>
<a href="#" id="searchtips">Search Tips</a>
</div>
</form>
</div>
</div>
</div>





<div class="boxFormat14">
<div class="orgProgSearch">
<div id='results'>
</div>
</div>
</div>


</div>

</div>
</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>
<script src="../js/popup.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/searchForVol.js"></script>
