 <?php

	include("config.php");
	session_start();

	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}

	$script = clean($_SESSION['ref']);
	if($script == '/php/org-public.php')
	{
		$orgname = $_SESSION['ORG_NAME_VIEW'];
	}
	else
	{
		$orgname = $_SESSION['ORG_NAME'];
	}
	
	$qry = 'SELECT * FROM additadmins WHERE orgname="';
	$qry .= $orgname;
	$qry .= '"';
	
	$rProg = mysql_query($qry);		

	while($row = mysql_fetch_assoc($rProg))
	{
		$tempVol = $row['additemail'];
		$q1 = "SELECT * FROM vols where email='$tempVol'";
		$r2 = mysql_query($q1);
		$vol = mysql_fetch_assoc($r2);

		echo '<div>';
		echo '<a href="vol-manager.php?vol=',$vol['login'],'">';
		if($vol['userimage'] != '')
		{
			echo '<img src="uploaded_files/',$vol['userimage'],'" width="40" height="40" alt="User Picture"></a>';	
		}
		else
		{
			echo '<img src="../images/nophoto.png"  width="40" height="40"  alt="User Picture"></a>';	
		}
		echo '</div>';
		echo '<div class="clear"></div>';
		echo '<p>';
		echo $vol['firstname']; echo ' '; echo $vol['lastname'];
		echo '<a href="remove-staff.php?login='.$vol['login'].'">Remove</a></p>';
	}
	//now make the one for the creater of the organization
	$qry = 'SELECT * FROM orgs WHERE orgname="';
	$qry .= $orgname;
	$qry .= '"';
	
	$rProg = mysql_query($qry);	
	$row = mysql_fetch_assoc($rProg);
	$tempVol = $row['login'];

	$q1 = "SELECT * FROM vols where login='$tempVol'";
	$r2 = mysql_query($q1);
	$vol = mysql_fetch_assoc($r2);
	
	echo '<div>';
	echo '<a href="vol-manager.php?vol=',$vol['login'],'">';
	if($vol['userimage'] != '')
	{
		echo '<img src="uploaded_files/',$vol['userimage'],'" width="40" height="40" alt="User Picture"></a>';	
	}
	else
	{
		echo '<img src="../images/nophoto.png"  width="40" height="40"  alt="User Picture"></a>';	
	}
	echo '</div>';
	echo '<div class="clear"></div>';
	echo '<p">';
	echo $vol['firstname']; echo ' '; echo $vol['lastname'];
	echo '</p>';
						
?>
<script src="../js/addInputs.js" language="Javascript" type="text/javascript"></script>

     <div id="dynamicInputAdmins">
<input style="float:left;"id="Field261a1" name="Field261a1" type="text" spellcheck="false" class="field text small" value="First Name" maxlength="255" tabindex="37" onfocus="this.value = this.value=='First Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'First Name' : this.value; this.value=='First Name' ? this.style.color='#999' : this.style.color='#000'"/> 
<input id="Field262a1" name="Field262a1" type="text" spellcheck="false" class="field text small" value="Last Name" maxlength="255" tabindex="37" onfocus="this.value = this.value=='Last Name' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'Last Name' : this.value; this.value=='Last Name' ? this.style.color='#999' : this.style.color='#000'"/> 
<input style="float:left;"id="Field260a1" name="Field260a1" type="email" spellcheck="false" class="field text small" value="E-mail Address" maxlength="255" tabindex="37" onfocus="this.value = this.value=='E-mail Address' ? '' : this.value; this.style.color='#000';" onfocusout="this.value = this.value == '' ? this.value = 'E-mail Address' : this.value; this.value=='E-mail Address' ? this.style.color='#999' : this.style.color='#000'"  /> 

     </div>
     <input type="button" value="Add another" onClick="addInput('dynamicInputAdmins');">



	
