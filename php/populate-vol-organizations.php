<link rel="stylesheet" type="text/css" href="../css/capslide.css" media="screen"/>
<script src="../js/jquery.capSlide.js" type="text/javascript"></script>
<?php
include("config.php");
session_start();
$login = $_SESSION['SESS_MEMBER_ID'];
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return  mysql_escape_string($str);
	}
		$rProg = mysql_query("SELECT * FROM volConn WHERE id_inviter='$login' and status='ACCEPTED'");				
		
		if(mysql_num_rows($rProg) > 0)
		{
			$counter = 0;

			while($row = mysql_fetch_assoc($rProg))
			{	
				$stringToPass = '"#capslide_img_cont';
				$stringToPass .= $counter;
				$stringToPass .= '"';
				$qry = 'SELECT * FROM orgs WHERE orgname="';
				$qry .= $row['id_request'];
				$qry .= '"';
				$rProg2 = mysql_query($qry);
	
				$hideRemoveName = 'removeOrg';
				$hideRemoveName .= $counter;
				$newString = '#';
				$newString .= $hideRemoveName;
				//$hideRemoveName .= $counter;
				$someString = 'capslide_img_cont';
				$someString .= $counter;
				$row2 = mysql_fetch_assoc($rProg2);
				?>
				<script type="text/javascript">
				$(function(){
                $(<?php echo $stringToPass; ?>).capslide({
					caption_color	: "black",
					caption_bgcolor	: "white",
					overlay_bgcolor : "#832EA5",
					border			: "10px solid #ccc",
					showcaption	    : true
					});
					});
				</script>
				
                <?php echo '<div id="',$someString,'"';
				echo 'class="ic_container" style="float:left">';
                echo '<div id="programImageTable" style="text-align:center;"><img src="uploaded_files/',$row2['orgimage'],'" alt="Program Picture" width="240" height="180"></div>';
                echo '<div class="overlay" style="display:none;"></div>';
                echo '    <div class="ic_caption">';
                echo '        <p class="ic_category">';
				echo '<div id="viewOrgLink" style="float:right;">';	
				echo '<a href="org-manager.php?orgname=',$row['id_request'],'&zipcode=',$row2['zipcode'],'"><img src="../images/arrowright.jpg"  width="40" height="40"></a>';
				echo '</div>';				echo '<div id="volOrganizatonPage" style="text-align:center; padding: 0 0 0 20px;"><b>';
				echo $row2['orgname']; 
				echo '</b><br>';
				
				echo $row2['city']; echo ', '; echo  $row2['state'];	 ?>		
				</div>
				</p>
                <h3></h3>
                <p class="ic_text" style="text-align:center;">
			
				<a href="#" onclick="popup(350, 'popup5');  $('<?php echo $newString; ?>').show();" class="poplight"><img src="../images/removeorg.png"></a>
                </p>
                </div>
                </div>
			
				<?php echo '<div id="',$hideRemoveName,'" style="display:none;"';?>
				<div id="popup5" class="popup_block">
				<h2 style=" padding:0px 0 0 30px!important; float:none; text-align: center;">Remove Organization</h2><br>
				<p id="contactArea" style=" padding:0px 0 0 30px!important; float:none; text-align: center;">
				Are you sure you want to be removed from the list of regular volunteers at <?php echo $row['id_request']; ?>?  A notification will be sent to the organization
				that you no longer wish to volunteer here.<br><br>
				<a href="remove-volunteer-request.php?org=<?php echo $row['id_request'];?>" onclick="$('#entryPage').hide(); $('#entryPage2').show();"><img src="../images/removeorg.png"></a><br>
				<br>
				</p>	
				<a href="#" onclick="$('#fade , .popup_block').fadeOut(); $('#fade').remove();">Cancel</a>
				</div>
				</div>
				
			
<?php
				$counter++;
				
				
				
			}
		
		}		
	
?>