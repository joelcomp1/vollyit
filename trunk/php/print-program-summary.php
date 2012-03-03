 <?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	require_once 'wordGen/PHPWord.php';
	//Array to store validation errors
	$errmsg_arr = array();
	$filename = "generatedFiles/";
	$filename .= $_SESSION['ORG_NAME'];
	$filename .= ' - ';
	$filename .= $_SESSION['PROGRAM_NAME'];
	$filename .= '.doc';
	$_SESSION['PROGRAM_FILE_PATH'] = $filename;
	$orgname = $_SESSION['ORG_NAME'];
	$programname = $_SESSION['PROGRAM_NAME'];
	
	
	
	// New Word Document
	$PHPWord = new PHPWord();
	$section = $PHPWord->createSection();
	// New portrait section
	
	$PHPWord->addTitleStyle(1, array('size'=>20, 'color'=>'333333', 'bold'=>true, 'align'=>'center'));
	$PHPWord->addTitleStyle(2, array('size'=>16, 'color'=>'666666'));
	
	// Add text elements
	$programName = "Program Name: ";
	$programName .= $_SESSION['PROGRAM_NAME'];
	$section->addTitle($programName , 1, array('align'=>'center'));
	
	
	// Add image elements
	$imageLocation = "uploaded_files/";
	$imageLocation .= $_SESSION['PROGRAM_IMAGE_PATH'];
	$section->addImage($imageLocation, array('width'=>320, 'height'=>240, 'align'=>'center'));
	$section->addTextBreak(1);
	$section->addText("Program Description: ", array('bold'=>true, 'align'=>'center'));
	$section->addTextBreak(1);
	$section->addText($_SESSION['PROGRAM_DESCRIPTION']);
	$section->addTextBreak(1);
	$section->addText("Program Volunteers: ", array('bold'=>true, 'align'=>'center'));
	$section->addTextBreak(1);

	$qry = 'SELECT distinct * FROM programvol WHERE orgname="';
	$qry .= $orgname;
	$qry .= '" and programname="';
	$qry .= $programname;
	$qry .= '"';
	
	$rProg = mysql_query($qry);		

	while($row = mysql_fetch_assoc($rProg))
	{
		$tempVol = $row['vollogin'];
		$q1 = "SELECT * FROM vols where login='$tempVol'";
		$r2 = mysql_query($q1);
	
		$vol = mysql_fetch_assoc($r2);


		if($vol['userimage'] != '')
		{
			$imageLocation = "uploaded_files/";
			$imageLocation .= $vol['userimage'];
			$section->addImage($imageLocation, array('width'=>40, 'height'=>40, 'align'=>'left'));
			
		}
		else
		{
			$section->addImage("../images/nophoto.png", array('width'=>40, 'height'=>40, 'align'=>'left'));
		}
		$name = $vol['firstname'];
		$name .= ' ';
		$name .= $vol['lastname'];
		$name .= '			';
		$name .= $vol['email'];
		$section->addText($name);

		$section->addTextBreak(1);
	}
	
	$qry = 'SELECT * FROM programcoords WHERE orgname="';
	$qry .= $orgname;
	$qry .= '" and programname="';
	$qry .= $programname;
	$qry .= '"';
	
	$rProg = mysql_query($qry);	
	
	//also populate program coordnators
	while($row = mysql_fetch_assoc($rProg))
	{
	
		$qry2 = 'SELECT * FROM programvol WHERE orgname="';
		$qry2 .= $orgname;
		$qry2 .= '" and programname="';
		$qry2 .= $programname;
		$qry2 .= '" and vollogin="';
		$qry2 .= $row['coord1'];
		$qry2 .= '"';
	
		$check = mysql_query($qry2);	
		if(mysql_num_rows($check) == 0)
		{
			$tempVol = $row['coord1'];
			$q1 = "SELECT * FROM vols where login='$tempVol'";
			$r2 = mysql_query($q1);
	
			$vol = mysql_fetch_assoc($r2);
				echo '<li>';
				echo '<div style="text-align:center;">';
				echo '<a href="vol-manager.php?vol=',$vol['login'],'">';
				if($vol['userimage'] != '')
				{
					echo '<img src="uploaded_files/',$vol['userimage'],'" width="160" height="120" alt="User Picture"></a>';	
				}
				else
				{
					echo '<img src="../images/nophoto.png"  width="160" height="120"  alt="User Picture"></a>';	
				}
				echo '</div>';
				echo '<div class="clear"></div>';
				echo '<p style="text-align:center;">';
				echo $vol['firstname']; echo ' '; echo $vol['lastname'];
				echo '</p>';
				echo '</li>';	
		}				
	
	}



// Save File
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save($filename);
	

 
 