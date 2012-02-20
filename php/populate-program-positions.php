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
		

		while($row = mysql_fetch_assoc($rProg))
		{ 	//need to find what program is next

					?>
					<script type="text/javascript">
						var value =  <?php echo json_encode($row['positionname']); ?>;
						var value2 =  <?php echo json_encode($row['numavail']); ?>;
						var value3 =  <?php echo json_encode($row['posdescrip']); ?>;
						addInput("programcoord", value, value2, value3);

					</script>
		
					<?php
				
				
			
		}
	
	
	
?>