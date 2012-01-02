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
	
	//Sanitize the POST values

	$positionName = clean($_POST['Field8']);
	$posDescription = clean($_POST['Field9']);
	$numOpen = clean($_POST['Field11']);
	$nextState= clean($_POST['Submit']);
	$orgName = clean($_SESSION['ORG_NAME']);
	$positionsCreated = clean($_SESSION['POSITIONS_CREATED']);
	$programName = 'PROGRAM_NAME';
	$programsCreated = clean($_SESSION['PROGRAMS_CREATED']);
	$programName .= $programsCreated;
	$programName = clean($_SESSION[$programName]);
	
	//Input Validations

			
	if($nextState == 'Create Position')
	{
		if($positionName == '') {
			$errmsg_arr[] = 'Position Name Missing';
			$errflag = true;
		}
		//If there are input validations, redirect back to the login form
		if($errflag) {
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			header("location: create-program-part3.php");
			exit();
		}

	
	$qry = "INSERT INTO programPositions(orgname, programname, positionname, posdescrip, numavail, numtaken) 
	VALUES('$orgName','$programName', '$positionName', '$posDescription', '$numOpen', '0')";
	$result = @mysql_query($qry);
	
	$howManyRows = "select * from programPositions where orgname='$orgName' and programname='$programName'";
	
	$newqry = @mysql_query($howManyRows);
	$rows = mysql_num_rows($newqry);
	

	$displayePosName = 'POSITION_NAME';
	$displayePosName .= $rows;
	
	$displayeNumOpen = 'NUM_OPEN';
	$displayeNumOpen .= $rows;
	
	$displayumClosed = 'NUM_FILLED';
	$displayumClosed .= $rows;
	//Check whether the query was successful or not
	if($result && $newqry) {
			//create program part 1 Successful
			session_regenerate_id();
			$_SESSION[$displayePosName] = $positionName;
			$_SESSION[$displayeNumOpen] = $numOpen;
			$_SESSION[$displayumClosed] = '0';
			
			$_SESSION['POSITIONS_CREATED'] = $rows;
			session_write_close();
			
			
			header("location: create-program-part3.php");
			exit();
	}else {
		die("Query failed");
	}
	}
	else if($nextState == 'Draft')
	{
		header("location: program-management-org.php");
		
		for($i = 1; $i <= $_SESSION['POSITIONS_CREATED']; $i++)
		{
			$posName = 'POSITION_NAME';
			$posName .= $i;
	
			$numOpen = 'NUM_OPEN';
			$numOpen .= $i;
		
			$numClosed = 'NUM_FILLED';
			$numClosed .= $i;
		
			if( isset($_SESSION[$posName]) && isset($_SESSION[$numOpen])) {
			unset($_SESSION[$posName]);
			unset($_SESSION[$numOpen]);
			unset($_SESSION[$numClosed]);
			}
		}
			
	}
	else if($nextState == 'Submit')
	{
		header("location: program-preview.php");
	}
	else
	{
		for($i = 1; $i <= $positionsCreated; $i++)
		{
	
		$posName = 'POSITION_NAME';
		$posName .= $i;
	
		$numOpen = 'NUM_OPEN';
		$numOpen .= $i;
	
		$numClosed = 'NUM_FILLED';
		$numClosed .= $i;
	
		$remove = 'REMOVE';
		$remove .= $i;
	
		if($nextState == $remove)
		{
			//Delete this from the table
			$posToDelete = clean($_SESSION[$posName]);
			$numToDelete = clean($_SESSION[$numOpen]);
			$qry = "delete from programpositions where orgname='$orgName' and programname='$programName' and positionname='$posToDelete'";
			$result = @mysql_query($qry);
	
			//Check whether the query was successful or not
			if($result) {
				
				//Need to correct all the sessions after this so it displays OK
				$offset = $i + 1;
				for($j = $offset; $j <= ($positionsCreated + 1); $j++)
				{
					$posName = 'POSITION_NAME';
					$posName .= $j;
	
					$numOpen = 'NUM_OPEN';
					$numOpen .= $j;
				
					$numClosed = 'NUM_FILLED';
					$numClosed .= $i;
				
					$posToChange = clean($_SESSION[$posName]);
					$numToChange = clean($_SESSION[$numOpen]);
					$numTakenToChange = clean($_SESSION[$numClosed]);
					
					$newPosition = 'POSITION_NAME'; 
					$newPosition .= ($j - 1);
					
					$newOpen = 'NUM_OPEN'; 
					$newOpen .= ($j - 1);
					
					$newTaken = 'NUM_FILLED'; 
					$newTaken .= ($j - 1);
					
					
					$_SESSION[$newPosition] = $posToChange;
					$_SESSION[$newOpen] = $numToChange;
					$_SESSION[$newTaken] = '0';
				}
				session_regenerate_id();
				unset($_SESSION[$posName]);
				unset($_SESSION[$numOpen]);
				$positionsCreated = $positionsCreated - 1;
				$_SESSION['POSITIONS_CREATED'] = $positionsCreated;
				session_write_close();

			
				header("location: create-program-part3.php");
				exit();
			}else {
				die("Query failed");
			}
			
			break;
		}
		}
	
	
	
	}
?>