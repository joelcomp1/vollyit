<?php  
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false; 
	
	//Connect to mysql server
	$link = mysql_connect("localhost:3306", "root", "coolguy1");
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	else
	{
		$db_select = mysql_select_db("volly", $link);
		
		if(!$db_select)
		{
			die('Failed to connect to database: ' . mysql_error());
		}
	}
		
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}
	
// filename: upload.processor.php

// first let's set some variables

// make a note of the current working directory, relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the directory that will recieve the uploaded files
$uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'uploaded_files/';

// make a note of the location of the upload form in case we need it
$uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.form.php';

// make a note of the location of the success page
$uploadSuccess = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.success.php';

// name of the fieldname used for the file in the HTML form
$fieldname = 'file';



// Now let's deal with the upload

// possible PHP upload errors
$errors = array(1 => 'php.ini max file size exceeded', 
                2 => 'html form max file size exceeded', 
                3 => 'file upload was only partial', 
                4 => 'no file was attached');

// check the upload form was actually submitted else print form
isset($_POST['submit'])
	or error('the upload form is neaded', $uploadForm);

// check for standard uploading errors
($_FILES[$fieldname]['error'] == 0)
	or error($errors[$_FILES[$fieldname]['error']], $uploadForm);
	
// check that the file we are working on really was an HTTP upload
@is_uploaded_file($_FILES[$fieldname]['tmp_name'])
	or error('not an HTTP upload', $uploadForm);
	
// validation... since this is an image upload script we 
// should run a check to make sure the upload is an image
@getimagesize($_FILES[$fieldname]['tmp_name'])
	or error('only image uploads are allowed', $uploadForm);
	
// make a unique filename for the uploaded file and check it is 
// not taken... if it is keep trying until we find a vacant one
$now = time();
while(file_exists($uploadFilename = $uploadsDirectory.$now.'-'.$_FILES[$fieldname]['name']))
{
	$now++;
}
$fileNameForDisplay = $now.'-'.$_FILES[$fieldname]['name'];
// now let's move the file to its final and allocate it with the new filename
@move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename)
	or error('receiving directory insuffiecient permission', $uploadForm);
	$folder = 'uploaded_files/';
chmod( "$folder/" . basename( $_FILES['fieldname']['name']),0644);
// If you got this far, everything has worked and the file has been successfully saved.
// We are now going to redirect the client to the success page.


$submitButton = clean($_POST['submit']);//figure out what image we are uploading




if(($_SESSION['SESS_ORG_OR_VOL'] == 'ORG') && ($submitButton == 'Upload Organization Image!'))
{
	if(isset($_SESSION['IMAGE_PATH']))
	{

	$removeOldImage = 'uploaded_files/';
	$removeOldImage .= $_SESSION['IMAGE_PATH'];
		unlink($removeOldImage);
		unset($_SESSION['IMAGE_PATH']);
	}

session_regenerate_id();
$login = clean($_SESSION['SESS_MEMBER_ID']);
$qry = "update orgs set orgImage='$fileNameForDisplay' where login='$login';";
$result = @mysql_query($qry);
$_SESSION['ORG_IMAGE'] = 'loaded';
$_SESSION['IMAGE_PATH'] = $fileNameForDisplay;
$_SESSION['test'] = $result;
session_write_close();
if(isset($_SESSION['ORG_WEBSITE']))
{
	header("location: member-index-org.php");
}
else
{
header("location: member-reg-org.php");
}

}
if(($_SESSION['SESS_ORG_OR_VOL'] == 'ORG') && ($submitButton == 'Upload Organization Logo!'))
{
	if(isset($_SESSION['IMAGE_PATH']))
	{

	$removeOldImage = 'uploaded_files/';
	$removeOldImage .= $_SESSION['IMAGE_PATH'];
		unlink($removeOldImage);
		unset($_SESSION['IMAGE_PATH']);
	}

session_regenerate_id();
$login = clean($_SESSION['SESS_MEMBER_ID']);
$qry = "update orgs set orgImage='$fileNameForDisplay' where login='$login';";
$result = @mysql_query($qry);
$_SESSION['ORG_IMAGE'] = 'loaded';
$_SESSION['IMAGE_PATH'] = $fileNameForDisplay;

session_write_close();

	header("location: account-settings-org.php");



}


else if(($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')  && ($submitButton == 'Upload Admin Image!'))
{
	if(isset($_SESSION['ADMIN_IMAGE_PATH']))
	{

	$removeOldImage = 'uploaded_files/';
	$removeOldImage .= $_SESSION['ADMIN_IMAGE_PATH'];
		unlink($removeOldImage);
		unset($_SESSION['ADMIN_IMAGE_PATH']);
	}
session_regenerate_id();
$_SESSION['ADMIN_IMAGE'] = "loaded";
$_SESSION['ADMIN_IMAGE_PATH'] = $fileNameForDisplay;
session_write_close();
header("location: member-reg-org.php");
}
else if(($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')  && ($submitButton == 'Upload a Admin Picture'))
{
	if(isset($_SESSION['VOL_IMAGE_PATH']))
	{

		$removeOldImage = 'uploaded_files/';
		$removeOldImage .= $_SESSION['VOL_IMAGE_PATH'];
		unlink($removeOldImage);
		unset($_SESSION['VOL_IMAGE_PATH']);
	}

session_regenerate_id();
$login = clean($_SESSION['SESS_MEMBER_ID']);
$qry = "update vols set userImage='$fileNameForDisplay' where login='$login';";
$result = @mysql_query($qry);
$_SESSION['VOL_IMAGE'] = 'true';
$_SESSION['VOL_IMAGE_PATH'] = $fileNameForDisplay;
session_write_close();
header("location: account-settings-org.php?state=vol");
}

else if($_SESSION['SESS_ORG_OR_VOL'] == 'VOL')
{

	if(isset($_SESSION['IMAGE_PATH']))
	{

	$removeOldImage = 'uploaded_files/';
	$removeOldImage .= $_SESSION['IMAGE_PATH'];
		unlink($removeOldImage);
		unset($_SESSION['IMAGE_PATH']);
	}

session_regenerate_id();
$login = clean($_SESSION['SESS_MEMBER_ID']);
$qry = "update vols set userImage='$fileNameForDisplay' where login='$login';";
$result = @mysql_query($qry);
$_SESSION['VOL_IMAGE'] = 'true';
$_SESSION['IMAGE_PATH'] = $fileNameForDisplay;
session_write_close();
header("location: account-settings-vol.php");
}
else if($submitButton == 'Upload Program Photo!')
{

	if(isset($_SESSION['PROGRAM_IMAGE_PATH']))
	{

		$removeOldImage = 'uploaded_files/';
		$removeOldImage .= $_SESSION['PROGRAM_IMAGE_PATH'];
		unlink($removeOldImage);
		unset($_SESSION['PROGRAM_IMAGE_PATH']);
	}

session_regenerate_id();
$_SESSION['PROGRAM_IMAGE'] = 'true';
$_SESSION['PROGRAM_IMAGE_PATH'] = $fileNameForDisplay;
session_write_close();
header("location: create-program-part1.php");
mysql_close($link);
}



// make an error handler which will be used if the upload fails
function error($error, $location, $seconds = 5)
{
	header("Refresh: $seconds; URL=\"$location\"");
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"'."\n".
	'"http://www.w3.org/TR/html4/strict.dtd">'."\n\n".
	'<html lang="en">'."\n".
	'	<head>'."\n".
	'		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">'."\n\n".
	'		<link rel="stylesheet" type="text/css" href="stylesheet.css">'."\n\n".
	'	<title>Upload error</title>'."\n\n".
	'	</head>'."\n\n".
	'	<body>'."\n\n".
	'	<div id="Upload">'."\n\n".
	'		<h1>Upload failure</h1>'."\n\n".
	'		<p>An error has occured: '."\n\n".
	'		<span class="red">' . $error . '...</span>'."\n\n".
	'	 	The upload form is reloading</p>'."\n\n".
	'	 </div>'."\n\n".
	'</html>';
	exit;
} // end error handler

?>