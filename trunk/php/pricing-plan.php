<?php
	//Start session
	session_start();
		if($_SESSION['SESS_ORG_OR_VOL'] == 'ORG')
		{
				require_once('auth.php');
				include "header-org.php";
				include "navigation.php";
		}
		else
		{
			include "navigation-empty.php";
		}
		$page = $_GET['page'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Volly.it: Plans & Pricing</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../form.css" type="text/css" />	
</head>
<body>

<div id="wrap">
<div id="mainnavuser">
<div class="clear"></div>
<h3>
<div style="text-align:center;">
Plans & Pricing
</div>

</h3>




<div class="pricingPlansOuterBox">
<div class="pricingPlans">
<div class="ourPlans">


</div>
<div class="clear"></div>
<br>
<input id="radioDefault_pricing" name="radioPricing" type="hidden" value="" />
<div class="plan4" style="float:left; padding: 70px 0px 100px 70px; width: 170px; height:30px; text-align:center;">


The Supreme<br>
$249.95/month<br>
<b>Unlimated </b>Volunteers<br>
<b>Unlimated </b>Messages
<br>
<?php 
if($page == 'createorg')
{
	echo '<a href="member-reg-org.php?plan=supreme">Choose Plan</a>';
}
else
{
	echo '<a href="../index.php?plan=supreme">Choose Plan</a>';
}?>

</div>


<div class="plan2" style="float:left; padding: 70px 0px 100px 70px; width: 150px; height:30px; text-align:center;">



The Pro<br>
$49.95/month<br>
250 Volunteers<br>
<b>1,000 </b>Messages!
<br>
<?php 
if($page == 'createorg')
{
	echo '<a href="member-reg-org.php?plan=pro">Choose Plan</a>';
}
else
{
	echo '<a href="../index.php?plan=pro">Choose Plan</a>';
}?>

</div>
<div class="plan1" style="float:left; padding: 70px 0px 100px 70px; width: 150px; height:30px; text-align:center;">


The Free Plan<br>
Free Forever<br>
<b>Up to 50 Volunteers</b><br>
Pay as you go Messaging
<br>
<?php 
if($page == 'createorg')
{
	echo '<a href="member-reg-org.php?plan=free">Choose Plan</a>';
}
else
{
	echo '<a href="../index.php?plan=free">Choose Plan</a>';
}?>

</div>
</div>
</div>
<br>
<div class="clear"></div>
<h3>
<div style="text-align:center;">
Additional Pricing
</div>

</h3>
<div class="clear"></div>
<div style="float:left">
<br>Pay as you Go Messages</b>: $9.95 for 100 Messages
</div>
<div style="float:right">
Messages include voice and text messages. <br>
 This is a great way to pay only for what you need and supplement your plan from time to time.
</div>

<div class="clear"></div>
<br>
<h3>
<div style="text-align:center;">
A Few More Details
</div>

</h3>
<p>
<div style="float:left">
<b>Can I change My Plan At Any Time?</b><br>
Yup. Simply click on your account information in the header <br>
and you'll see your options.
</div>
<div style="float:right">
<b>Do I Have To Sign a Long-Term Contract?</b><br>
No.  Volly It is a monthly pay-as-you-go service.<br> There are no long term contracts or commitments on your part. <br> You simply pay month-to-month. <br>
 If you cancel, you'll be billed for the current month, but you won't be billed again.<br>
</div>
<div class="clear"></div>
<br>
<br>
<br>
<br>
<div style="float:left">
<b>Are There Additional Fees I'm Not Seeing</b><br>
No.  The prices you see above are all inclusive.  <br>Every plan Volly It plan includes all features with the <br>max volunteer and messaging counts.  <br>The site will not allow you to exceed the number of volunteers or messages.<br>
You will be notified if more people want to volunteer for your organization <br>than your account will allow and have the option of purchasing additional<br> messages if you run out for the month! <br> An opportunity to upgrade is 
always available.
</div>
<div style="float:right">
<b>What Types of Payments Do You Accept?</b><br>
Currently we accept Visa, Mastercard, American Express and Paypal. <br> At this time we only accept payments online so we will not be able to<br> accept a P.O., invoice you, or take an order over the phone.
</div>
<div class="clear"></div>
<br>
<br>
<div style="float:left">
<b>Any other questions before you sign-up?</b><br>
If you have questions about Volly It or the sign up process just submit a support request and we'll get right backt o you.  If you are worried about your security or privacy,
we can assure you our site and infastruecture is updated regularly with the latest security patches.  Check our our <a href="legalstuff.php#description-tab">Terms of Use</a> 
and <a href="legalstuff.php#usage-tab">Privacy Policy</a> if you have more questions.
</div>
</p>
</div>
</div>
<div id="footerclear"></div><?php include "footer.php";?>
</body>
</html>





