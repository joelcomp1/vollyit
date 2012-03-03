<?php
// functions.php
function check_txnid($tnxid){
	global $link;
	return true;
	$valid_txnid = true;
    //get result set
    $sql = mysql_query("SELECT * FROM `payments` WHERE txnid = '$tnxid'", $link);		
	if($row = mysql_fetch_array($sql)) {
        $valid_txnid = false;
	}
    return $valid_txnid;
}

function check_price($price, $id){
    $valid_price = false;
    //you could use the below to check whether the correct price has been paid for the product
    
	/* 
	$sql = mysql_query("SELECT amount FROM `products` WHERE id = '$id'");		
    if (mysql_numrows($sql) != 0) {
		while ($row = mysql_fetch_array($sql)) {
			$num = (float)$row['amount'];
			if($num == $price){
				$valid_price = true;
			}
		}
    }
	return $valid_price;
	*/
	return true;
}

function updatePayments($data){	
    global $link;
	if(is_array($data)){	
		//Check if the org has a account already
		if(!is_numeric($data['org_name']))
		{
		
			$sql =  mysql_query("selcet * from payasyougo where orgname='".$data['org_name']."'");
			$payasyougo = mysql_fetch_assoc($sql);	
			if (mysql_numrows($sql) == 0) {
				$sql =  mysql_query("INSERT INTO payasyougo(orgname, messages) VALUES('".$data['org_name']."','".($data['quantity'] * 100)."')");
			}
			else
			{	
				$updatemsgs = $data['quantity'] * 100;
				$updatemsgs += $payasyougo['messages'];
				$sql =  mysql_query("update payasyougo set messages='".($updatemsgs)."' where orgname='".$data['org_name']."'");
			}
		}
		else
		{
			if($data['payment_status'] == "Completed") //we got paid!
			{
				$sql =  mysql_query("update orgs set paid='YES' where orgid='".$data['org_name']."'");
				$_SESSION['ORG_PAID'] = 'YES';
			}
			else if($data['txn_type'] == "subscr_cancel")//they canceled
			{
				$sql =  mysql_query("update orgs set paid='NO', suspend='true' where orgid='".$data['org_name']."'");
				$_SESSION['ORG_PAID'] = 'NO';
			}
			else if($data['txn_type'] == "subscr_ failed")//they didn't pay...send e-mail
			{
			
			
			}
		}


        $sql = mysql_query("INSERT INTO `payments` (txnid, payment_amount, payment_status, itemid, createdtime, orgname,payer_id) VALUES (
                '".$data['txn_id']."' ,
                '".$data['payment_amount']."' ,
                '".$data['payment_status']."' ,
                '".$data['item_number']."' ,
                '".date("Y-m-d H:i:s")."' ,
				'".$data['org_name']."',
				'".$data['payer_id']."'
				
                )", $link);
    return mysql_insert_id($link);
    }
}
?>