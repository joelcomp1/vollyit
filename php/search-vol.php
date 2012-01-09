<?php
	require_once('auth.php');
	
// make a note of the current working directory relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the location of the upload handler
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';

// set a max file size for the html upload form
$max_file_size = 3000000; // size in bytes


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
 <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/collection.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
  <script type='text/javascript' src='../js/jquery.pack.js'></script>
  <script src="../js/popup.js" type="text/javascript"></script>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery.ez-pinned-footer.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery-1.5.1.min.js" type="text/javascript" charset="utf-8"></script>		
<script src="../js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("search-program-org-name.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
	
	function lookupTags(inputString2) {
		if(inputString2.length == 0) {
			// Hide the suggestion box.
			$('#suggestions2').hide();
		} else {
			$.post("search-keywords-tags.php", {queryString: ""+inputString2+""}, function(data1){
				if(data1.length >0) {
					$('#suggestions2').show();
					$('#autoSuggestionsList2').html(data1);
				}
			});
		}
	} // lookup
	
	function fillTags(thisValue2) {
		$('#inputString2').val(thisValue2);
		setTimeout("$('#suggestions2').hide();", 200);
	}
	
	function lookupLocation(inputString3) {
		if(inputString3.length == 0) {
			// Hide the suggestion box.
			$('#suggestions3').hide();
		} else {
			$.post("search-city-state.php", {queryString: ""+inputString3+""}, function(data2){
				if(data2.length >0) {
					$('#suggestions3').show();
					$('#autoSuggestionsList3').html(data2);
				}
			});
		}
	} // lookup
	
	function fillLocation(thisValue3) {
		$('#inputString3').val(thisValue3);
		setTimeout("$('#suggestions3').hide();", 200);
	}
	
$(function(){
	$("form#search-form").submit(function(){
		//$("#search-form").hide();
		//$("#search-text").animate({"width":"229px"});
		//$("#results").fadeOut();
		$.ajax({
			type:"GET",
			data: $(this).serialize(),
			url: "search.php",
			success: function(msg)
				{
				$("#results").html(msg);
				$("#results").fadeIn();
				//$("#search-text").html("<a href='#' id='search-again'>Search Again</a>");
				}
		});
	return false;
	});
	
/*	$("#search-again").live("click", function()
		{
			$("#search-text").html("Search");
			//$("#search-text").animate({"width":"58px"});
			$("#search-text").width("58px");
			$("#search-form").fadeIn();
		});*/
});	
</script>

<style type="text/css">
	body {
		font-family: Helvetica;
		font-size: 11px;
		color: #000;
	}
	
	h3 {
		margin: 0px;
		padding: 0px;	
	}

	.suggestionsBox, .suggestionsBox2, .suggestionsBox3{
		position: relative;
		left: 30px;
		margin: 10px 0px 0px 0px;
		width: 200px;
		background-color: #212427;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border: 2px solid #000;	
		color: #fff;
	}
	
	.suggestionList, .suggestionList2, .suggestionList3  {
		margin: 0px;
		padding: 0px;
	}
	
	.suggestionList li, .suggestionList2 li, .suggestionList3 li{
		
		margin: 0px 0px 3px 0px;
		padding: 3px;
		cursor: pointer;
	}
	
	.suggestionList li:hover, .suggestionList2 li:hover, .suggestionList3 li:hover{
		background-color: #659CD8;
	}
	
	
</style>

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

