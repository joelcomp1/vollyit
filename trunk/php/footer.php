<div id="footer">
	<div style="float:right; padding: 0 20px 0px 0;">
		<img src="../images/emptyIcon.jpg" width="50" height="50" >
	</div>
	<br>
	<div style="float:left; padding: 0px 0 0 50px;">
         <strong>&copy; Volly.it, Inc.</strong>
	</div>
	<div style="float:left; padding: 0px 0 0 10px;">
        <a href="php/about.php">About</a>
	</div>
	<div style="float:left; padding: 0px 0 0 10px;">
        <a href="php/contactus.php">Contact Us</a>
	</div>
	<div style="float:left; padding: 0px 0 0 10px;">
         <a href="http://www.volly.it/blog">Blog</a>
	</div>
	<div style="float:left; padding: 0px 0 0 10px;">
	<?php if($_SERVER['PHP_SELF'] == "/index.php")
	{
		echo '<a href="php/legalstuff.php">Legal Stuff</a>';
	}
	else
	{
		echo '<a href="legalstuff.php">Legal Stuff</a>';
	}
	?>
        
	</div>
</div>