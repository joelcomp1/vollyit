<?php
// Database variables
include('config.php');
session_start(); 
// PayPal settings
$paypal_email = 'joel_1330736284_biz@volly.it';
				 
$notify_url = 'http://joelcomp1.no-ip.org/php/payments.php';

$quantity = $_POST["Field11"];
$item_name = 'Volly.it';
$itemFromPost = 	$_POST['item_number'];

			
			
			
if($quantity != '') //messages
{
	$return_url = 'http://joelcomp1.no-ip.org/php/member-index-org.php?success=true';
	$cancel_url = 'http://joelcomp1.no-ip.org/php/member-index-org.php?success=false';
	$item_amount = 9.95;
	$orgInfo = $_SESSION['ORG_NAME'];
}
else if(/*$_SESSION['ORG_PLAN'] == 'pro' || */$itemFromPost == 'pro')
{
	$return_url = 'http://joelcomp1.no-ip.org/php/member-reg-org.php?paid=true';
	$cancel_url = 'http://joelcomp1.no-ip.org/php/member-reg-org.php?paid=false';
	$item_amount = 49.95;
	$orgInfo = $_SESSION['ORG_ID'];
	$item_name .= " Pro Plan";
}
else if(/*$_SESSION['ORG_PLAN'] == 'supreme' || */$itemFromPost == 'supreme'){
	$return_url = 'http://joelcomp1.no-ip.org/php/member-reg-org.php?paid=true';
	$cancel_url = 'http://joelcomp1.no-ip.org/php/member-reg-org.php?paid=false';
	$item_amount = 249.95;
	$orgInfo = $_SESSION['ORG_ID'];
	$item_name .= " Supreme Plan";
}


$quantity = $_POST["Field11"];
if($quantity == '')
{	
	$quantity == 1;
}

// Include Functions
include("functions.php");


		
// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){

	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";	
	
	// Append amount& currency (£) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "custom=".urlencode($orgInfo)."&";
	
	if($quantity == '')
	{
		$querystring .= "a3=".urlencode($item_amount)."&";
		$querystring .= "src=".urlencode('1')."&";
		$querystring .= "t3=".urlencode('M')."&";
		$querystring .= "p3=".urlencode('1')."&";
		$querystring .= "invoice=".urlencode($_SESSION['ORG_ID'])."&";
		$querystring .= "no_note=".urlencode('1')."&";

		
		
	}
	else
	{
		$querystring .= "amount=".urlencode($item_amount)."&";
		$querystring .= "quantity=".urlencode($quantity)."&";
	}
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);


	// Redirect to paypal IPN
	header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
	exit();

}else{
	
	// Response from Paypal

	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
		$req .= "&$key=$value";
	}
	
	// assign posted variables to local variables
	$data['item_name']			= $_POST['item_name'];
	$data['item_number'] 		= $_POST['item_number'];
	$data['payment_status'] 	= $_POST['payment_status'];
	$data['payment_amount'] 	= $_POST['mc_gross'];
	$data['payment_currency']	= $_POST['mc_currency'];
	$data['txn_id']				= $_POST['txn_id'];
	$data['receiver_email'] 	= $_POST['receiver_email'];
	$data['payer_email'] 		= $_POST['payer_email'];
	$data['org_name'] 			= $_POST['custom'];
	$data['quantity'] 			= $_POST['quantity'];
	$data['payer_id'] 			= $_POST['payer_id'];
	$data['txn_type'] 			= $_POST['txn_type'];
		
	// post back to PayPal system to validate
	$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	
	$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);	
	
	if (!$fp) {
		// HTTP ERROR
	} else {	

		fputs ($fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
			if (strcmp($res, "VERIFIED") == 0) {
			
				// Used for debugging
				//@mail("you@youremail.com", "PAYPAL DEBUGGING", "Verified Response<br />data = <pre>".print_r($post, true)."</pre>");
						
				// Validate payment (Check unique txnid & correct price)
				$valid_txnid = check_txnid($data['txn_id']);
				$valid_price = check_price($data['payment_amount'], $data['item_number']);
				// PAYMENT VALIDATED & VERIFIED!
				if($valid_txnid && $valid_price){				
					$orderid = updatePayments($data);		
					if($orderid){					
						// Payment has been made & successfully inserted into the Database								
					}else{								
						// Error inserting into DB
						// E-mail admin or alert user
					}
				}else{					
					// Payment made but data has been changed
					// E-mail admin or alert user
				}						
			
			}else if (strcmp ($res, "INVALID") == 0) {
			
				// PAYMENT INVALID & INVESTIGATE MANUALY! 
				// E-mail admin or alert user
				
				// Used for debugging
				//@mail("you@youremail.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
			}		
		}		
	fclose ($fp);
	}	
}
?>