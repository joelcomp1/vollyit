<?php
	//Start session
	session_start();
	
	//Include database connection details
	include("config.php");
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to pg server
	$orgname = $_SESSION['ORG_NAME'];

		// Is there a posted query string?
		if(isset($_POST['queryString'])) {

			$queryString = mysql_escape_string($_POST['queryString']);

			// Is the string length greater than 0?
			
			if(strlen($queryString) >0) {

				// Run the query: We use LIKE '$queryString%'
				// The percentage sign is a wild-card, in my example of countries it works like this...
				// $queryString = 'Uni';
				// Returned data = 'United States, United Kindom';
				
				// YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
				// eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 25
				
				
				$query = mysql_query("SELECT * FROM programs WHERE draft='Published' and orgname='$orgname' and programname LIKE '$queryString%' LIMIT 25");
				if($query) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = mysql_fetch_object($query)) {
			
						// Format the results, im using <li> for the list, you can change it.
						// The onClick function fills the textbox with the result.

						$programName = $result->programname;
						$query2 = mysql_query("SELECT * FROM programvol WHERE orgname='$orgname' and programname='$programName'");

						echo $result->recurring;
						$numberVols = mysql_num_rows($query2);
						// YOU MUST CHANGE: $result->value to $result->your_colum
	         			echo '<li onClick="fillPrograms(\''.$result->programname.'\', \''.$numberVols.'\', \''.$result->recurring.'\');">'.$result->programname.'</li>';

	         		}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}

				
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	
?>