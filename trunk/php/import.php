<script type="text/javascript" src="../js/jquery.js"></script>
<?php
include("config.php");
session_start();

require_once 'excel_reader2.php';
 
  $data = array();
  

  
  if ( $_FILES['file']['tmp_name'] )
  {
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Error: " . $_FILES["file"]["error"] . "<br />";
		}
		else
		{
		//	echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		//	echo "Type: " . $_FILES["file"]["type"] . "<br />";
		//	echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		//	echo "Stored in: " . $_FILES["file"]["tmp_name"];
			move_uploaded_file($_FILES["file"]["tmp_name"],
			"uploaded_files/" . $_FILES["file"]["name"]);
		//	echo "Stored in: " . "uploaded_files/" . $_FILES["file"]["name"];  
		}
  
  
	//$data = new Spreadsheet_Excel_Reader("uploaded_files/" . $_FILES["file"]["name"]);

	$_SESSION['UPLOADED_EXCEL_DATA'] = "uploaded_files/" . $_FILES["file"]["name"];;

header("location: add-volunteers-org.php");
exit();


  }
$row = 2;
$col = 1;
$counter = 0;
$display = 0;
 ?>

<h2>Review Your Imported List</h2>
	<div id="addVolsFirstName" style="float:left; padding: 0 0 0 40px;">
  First Name</div>
  	<div id="addVolsLastName" style="float:left; padding: 0 0 0 40px;">
  Last Name</div>
  	<div id="addVolsEmail" style="float:left; padding: 0 0 0 40px;">
  E-Mail Address</div>
  	<div id="addVolsPhone" style="float:left; padding: 0 0 0 40px;">
  Phone Number</div>
  <div class="clear"></div>
  <br>


  <?php  while($data->val($row,$col) != '') {
	if(($counter % 20) == 0)
	{	
		if($counter != 0)
		{
				echo '</div>';
		}
		$display += 1;
		echo '<div id="page',$display,'" style="display:none;">';
	}
	$counter = $counter + 1;

  ?>
	<div id="addVolsFirstName" style="float:left; padding: 0 0 0 20px;">
 <?php echo $data->val($row,$col); $col++; ?>
 </div>
  	<div id="addVolsLastName" style="float:left; padding: 0 0 0 40px;">
 <?php echo $data->val($row,$col); $col++;?>
 </div>
  	<div id="addVolsEmail" style="float:left; padding: 0 0 0 40px;">
 <?php echo $data->val($row,$col); $col++; ?>
 </div>
  	<div id="addVolsPhone" style="float:left; padding: 0 0 0 40px;">
 <?php echo $data->val($row,$col); $row++;$col = 1;?>
 </div>
  <div class="clear"></div>
<br><br>
  <?php 

  }
  
	echo '</div>';

 

					if($display > 1)
					{
						echo '<script type="text/javascript">$(document).ready(function () {	$("#page1").show(); });</script>';
						$pageNum = 1;
						echo '<div id="showNext" style="float:right; padding: 0 10px 0px 10px;">';
						echo '<a href="#" onclick="determineNext()">Next</a>';
						echo '</div>';
						
						echo '<div id="showPrev" style="display:none; float:right; padding: 0 10px 0 10px;">';
						echo '<a href="#" onclick="determinePrev()">Previous</a>';
						echo '</div>';
						echo 'There are ',$display,' pages of results';
						
					}
					else
					{
						$pageNum = 1;
						echo '<script>	$("#page1").show();</script>';
						echo 'There is ',$display,' page of results';
					}

  ?>
	<a href="add-volunteers.php">Add <?php echo $counter; ?> Volunteers!</a>
 

  
  	<script type="text/javascript">function determineNext(){
	var loop = 0; 
	var className = "#page";
	var classToShow = "#page";
	var maxClass = <?php echo $display ?>;
	for(loop = 1; loop <= maxClass;loop = loop + 1)
	{
		className = className + loop;
		if($(className).is(":visible"))
		{ 
			$(className).hide();
			classToShow = classToShow + (loop + 1);
			$(classToShow).show();
			$("#showPrev").show();
			if(maxClass == (loop + 1))
			{
				$("#showNext").hide();
			}
			
			break;
		}
		className = "#page";
	}
	}
	
	function determinePrev(){
	var loop = 0; 
	var className = "#page";
	var classToShow = "#page";
	var maxClass = <?php echo $display ?>;
	for(loop = 1; loop <= maxClass;loop = loop + 1)
	{

		className = className + loop;
		if($(className).is(":visible"))
		{
			$(className).hide();
			classToShow = classToShow + (loop - 1);
			$(classToShow).show();
			$("#showNext").show();
			
			if((loop - 1) == 1)
			{
				$("#showPrev").hide();
			}
	
			break;
		}
		className = "#page";
	}
	}
	
	
	
	
	</script>
