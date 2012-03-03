<?php
include("config.php");
session_start();

	$orgname = $_SESSION['ORG_NAME'];
	$script = clean($_SESSION['ref']);
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}
	if($_SESSION['PROGRAM_NAME_TEMP'] != '')
	{
		$programName = $_SESSION['PROGRAM_NAME_TEMP'];
	}
	if($_SESSION['PROGRAM_NAME'] != '')
	{
		$programName = $_SESSION['PROGRAM_NAME'];
	}
		$qry = 'SELECT * FROM programpositions WHERE orgname="';
		$qry .= $orgname;
		$qry .= '" and programname="';
		$qry .= $programName;
		$qry .= '"';
		$rProg  =mysql_query($qry);
		$positions = array();
		$counter = 0;
		
		
		

		while($row = mysql_fetch_assoc($rProg))
		{ 	//need to find what program is next
			
					?>
					<script type="text/javascript">
			
						var value =  <?php echo json_encode($row['positionname']); ?>;
						var value2 =  <?php echo json_encode($row['numavail']); ?>;
						var value3 =  <?php echo json_encode($row['posdescrip']); ?>;
						addInput("programcoord", value, value2, value3, counter);
				
					</script>
		
					<?php
				$counter++;
				$qry2 = 'SELECT * FROM programvol WHERE orgname="';
				$qry2 .= $orgname;
				$qry2 .= '" and programname="';
				$qry2 .= $programName;
				$qry2 .= '" and positionname="';
				$qry2 .= $row['positionname'];
				$qry2 .= '"';
				$rProg2  =mysql_query($qry2);

				$tempName = $row['positionname'];
				$positions[$tempName] = $counter;
				while($row2 = mysql_fetch_assoc($rProg2))
				{ 	//need to find what program is next
						$qry3 = 'SELECT * from vols WHERE login="';
						$qry3 .= $row2['vollogin'];
						$qry3 .= '"';
						$rProg3  = mysql_query($qry3);
						$vol = mysql_fetch_assoc($rProg3);
						$name = $vol['firstname'];
						$name .= ' ';
						$name .= $vol['lastname'];
						$posNameTemp = $row2['positionname'];
					?>
					<script type="text/javascript">
						var value4 =  "progCoordChild" + <?php echo json_encode($positions[$posNameTemp]); ?> + "open";
						var value6 =  "progCoordChild" + <?php echo json_encode($positions[$posNameTemp]); ?>;
						var value5 =  <?php echo json_encode($row2['positionname']); ?>;
						var login =  <?php echo json_encode($row2['vollogin']); ?>;
						var name =  <?php echo json_encode( $name); ?>;
						addVols(document.getElementById("resultsOpen"), document.getElementById(value4),value5, name, login,document.getElementById(value6));

					</script>
		
					<?php
				
				
			
				}
				
				
			
		}
		if($_SESSION['EDIT_PROGRAM'] != '')
		{		$posNameTemp = $_SESSION['EDIT_PROGRAM']; 
		?>
				<script type="text/javascript">
				var value6 =  "progCoordChild" + <?php echo json_encode($positions[$posNameTemp]); ?>;
				positionnumber = <?php echo json_encode($positions[$posNameTemp]); ?>;
				editPositions(document.getElementById("results"), document.getElementById(value6),positionnumber);

					</script> 
					<?php
		
		}
		
		
		unset($_SESSION['EDIT_PROGRAM']);
		

	
	
	
?>