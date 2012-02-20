
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
		$qry = 'SELECT * FROM programcoords WHERE orgname="';
		$qry .= $orgname;
		$qry .= '" and programname="';
		$qry .= $programName;
		$qry .= '"';
		$rProg  =mysql_query($qry);
		

		while($row = mysql_fetch_assoc($rProg))
		{ 	//need to find what program is next
			

				
					$login = $row['coord1'];
				
					$rProg2 =mysql_query("SELECT * FROM vols WHERE login='$login'");
					$vol = mysql_fetch_assoc($rProg2);
				
					$name = $vol['firstname'];
					$name .= ' ';
					$name .= $vol['lastname'];		


					if($script == '/php/program-published.php' || $script == '/php/program-preview.php')
					{

						echo "<div style='float:left;' ><img src='uploaded_files/",$vol['userimage'],"'alt='Volunteer Picture' width='50' height='50'><br><input value=" , $login, " type='hidden'>", $name, "</div>";
					}
					else
					{
					?>
					<script type="text/javascript">
						var name =  <?php echo json_encode($name); ?>;
						var image =  <?php echo json_encode($vol['userimage']); ?>;
						var login =  <?php echo json_encode($login); ?>;
						fillTags( name, image, login);
						unhideInput();
					</script>
		
					<?php
					}
		}
	
	
	
?>