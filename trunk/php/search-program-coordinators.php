<?php
	//Start session
	session_start();
	
	//Include database connection details
	include("config.php");
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	$orgName = $_SESSION['ORG_NAME'];
	
	

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
				// eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 10
				
				
				$query = mysql_query("SELECT * FROM vols WHERE firstname LIKE '%".$queryString."%' or lastname LIKE '%".$queryString."%' ");
				if($query) {
			
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = mysql_fetch_object($query)) 
					{
						$login = $result->login;
						$query2 = mysql_query("SELECT * FROM volConn WHERE id_inviter='$login' and id_request='$orgName' and status='ACCEPTED'");
						if(mysql_num_rows($query2) > 0)
						{
							// Format the results, im using <li> for the list, you can change it.
							// The onClick function fills the textbox with the result.				
							
							$name = $result->firstname;
							$name .= ' ';
							$name .= $result->lastname;
							
							echo '<li onClick="fillTags(\''.$name.'\', \''.$result->userimage.'\', \''.$result->login.'\');">'.$result->firstname.' '.$result->lastname.'</li>';
							
							
						} 
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