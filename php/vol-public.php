<?php
	require_once('auth.php');
	
// make a note of the current working directory relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the location of the upload handler
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';

// set a max file size for the html upload form
$max_file_size = 3000000; // size in bytes
	session_start();
	if(isset($_SESSION['SESS_MEMBER_ID'])) 
	{
		if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
		{
				include "header-org.php";
				include "navigation.php";
		}
		else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
		{
					include 'header-vol.php';
					include 'navigation-vol.php';
		}
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: <?php echo $_SESSION['VOL_USER_FIRST_NAME'];?>'s Profile</title>
<link href="../style.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/collection.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
  <script src="../js/popup.js" type="text/javascript"></script>
  <script type="text/javascript" src="../js/characterCounter.js"></script>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>

<body>


<div id="wrap">
<div id="mainnavuser">
<br>
<div id="popup4" class="popup_block" style="text-align:center;">
<a id="imageUploadClose">x</a>
<form id="Upload" action="upload.processor.php" enctype="multipart/form-data" method="post">
		<p>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">

		<center>
			<label for="file">You need a Picture!</label>
			<br>
			<br>
			<input id="file" type="file" name="file">
				<br>
<br>
			<input id="submit" type="submit" name="submit" value="Upload me!">
				</center>
		</p>
	
	
	</form>
</div>
<div id="backgroundCloseImageLoad"></div>

<div class="clear"></div>
<h3>
</h3>
<div class="clear"></div>
<div class="thumbnail">
		<?php
	if(($_SESSION['VOL_USER_IMAGE']) == true) {
	
		echo '<div id="login"><img src="uploaded_files/',$_SESSION['IMAGE_USER_PATH'],'" alt="User Picture" width="320" height="240"></div>';
	}
	else
	{//This name is decieving, i am using the login pop up for the image upload.....
		echo '<div id="login">
<img src="../images/nophoto.png" width="320" height="240" alt="header image2""> 
</div>';
	}
	?>
<br>
<h1>
<?php echo $_SESSION['VOL_USER_FIRST_NAME']; echo ' '; echo $_SESSION['VOL_USER_LAST_NAME'];?></h1>
<div class="clear"></div>
<a href="add-friend.php">Add Me As Your Friend</a><br>
A Dolphin will smile if you do

	
<div id="popupContact">
	<center>
	
	</div>
	<div id="backgroundPopup"></div>
</div>

<!--This is used for the upcoming vollys box-->
<div class="boxFormat">
<div class="box1">
<div class="leftText" style="float: left;">
 <?php echo $_SESSION['VOL_USER_FIRST_NAME'];?>'s Upcoming Volly
</div>
<div class="rightText"  style="float: right;">        
<a href="view-all-vol-programs.php">view all</a>
</div>
</div>
</div>
<div class="boxFormat2">
<div class="box2">
	<?php
	if(($_SESSION['VOL_PROGRAMS']) == true) {
	
		echo '';
	}
	else
	{
		echo '<div id="upcomingPrograms" style="text-align:center;">No Upcoming Vollys!</div>';
	}
	?>
</div>
</div>
<div class="boxFormat2">
<div class="box1">
<br>
</div>
</div>

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
<a href="organizations-vol.php"><img src="../images/emptyIcon.jpg" width="40" height="40" ></a>
<br>
Organizations
</center>
</div>
<div class="upcomingSnapshot" style="float: left; font:bold 0.8em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 5px;">
<center>
<a href="vol-friends.php"><img src="../images/emptyIcon.jpg" width="40" height="40" ></a>
<br>
Friends
</center>
</div>
<div class="pastProgramsSnapshot" style="float: left; font:bold 0.8em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 5px;">
<center>
<a href="upcoming-vols.php"><img src="../images/emptyIcon.jpg" width="40" height="40" ></a>
<br>
Upcoming Vollys
</center>
</div>
<div class="collabSnapshot" style="float: left; font:bold 0.8em 'TeXGyreAdventor', Arial; padding: 0px 0px 0px 5px;">
<center>
<a href="vollys.php?state=past"><img src="../images/emptyIcon.jpg" width="40" height="40" ></a>
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


<!--This is used for the about box-->
<div class="boxFormat4">
<div class="box3">
<div id="aboutMeLeft" style="float:left;">
   About Me 
</div>
</div>
</div>

<!--This is used for the users organizations box-->
<div class="boxFormat7">
<div class="box1">
<div class="leftText" style="float: left;">
 <?php echo $_SESSION['VOL_USER_FIRST_NAME'];?>'s  Organizations
</div>
<div class="rightText"  style="float: right;">        
<a href="view-all-organizations.php">view all</a>
</div>

</div>
</div>


<!--This is used for the about box part 2-->
<div class="boxFormat5">
<div class="box5">
<div style="text-align:left;">

 <?php echo $_SESSION['VOL_USER_ABOUTME'];?></textarea>

</div>
</div>
</div>


<!--This is used for the about box part 3-->
<div class="userOrganizations">
<div class="box2">
<br>
</div>
</div>

<!--This is used for the users organizations box part 3-->
<div class="boxFormat2">
<div class="box1">
<br>
</div>
</div>

<!--This is used for the Friends box-->
<div class="boxFormat3">
<div class="box1">
<div class="leftText" style="float: left;">
 <?php echo $_SESSION['VOL_USER_FIRST_NAME'];?>'s  Friends
</div>
<div class="rightText"  style="float: right;">        
<a href="view-all-friends.php">view all</a>
</div>

</div>
</div>

<!--This is used for the Friends box part 2-->
<div class="boxFormat2">
<div class="box2">
</div>
</div>

<!--This is used for the About me box part 3-->
<div class="boxFormat5">
<div class="box3">
<br>
</div>
</div>


<!--This is used for the Friends box part 3-->
<div class="boxFormat2">
<div class="box1">
<br>
</div>
</div>

</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>



<script type="text/javascript">
$(document).ready(function(){



	$.fn.popOpen = function(){
		
		popID = $(this).attr('rel'); //Get Popup Name
		popURL = $(this).attr('href'); //Get Popup href to define size
		
		//Pull Query & Variables from href URL
		query= popURL.split('?');
		dim= query[1].split('&');
		popWidth = dim[0].split('=')[1]; //Gets the first query string value
		
		
		//Fade in the Popup and add close button
		$('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend();
		
		//Define margin for center alignment (vertical + horizontal) - we add 80 to the height/width to accomodate for the padding + border width defined in the css
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;
		
		//Apply Margin to Popup
		$('#' + popID).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		//Fade in Background
		$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer 
		
	};

	//When you click on a link with class of poplight and the href starts with a # 
	$('a.poplight[href^=#]').click(function() {
		$(this).popOpen(); //Run popOpen function on click
		return false;
	});
	
	$('a.poplight[href=#?w=350]').popOpen(); //Run popOpen function once on load
	
	//Close Popups and Fade Layer
/*	$('a.close, #fade').live('click', function() { //When clicking on the close or fade layer...
	  	$('#fade , .popup_block').fadeOut(); //fade them both out
		$('#fade').remove();
		return false;
	});*/


	popOpen
	
});
</script>
