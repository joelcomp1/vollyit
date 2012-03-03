<?php
$host_split = explode('.',$_SERVER['HTTP_HOST']);

$sandbox = true;
$domain = $sandbox ? 'http://joelcomp1.no-ip.org' : 'http://www.volly.it/';

$api_version = '74.0';
$application_id = $sandbox ? 'APP-80W284485P519543T' : '';
$developer_account_email = 'joel@volly.it';
$api_username = $sandbox ? 'joel_1330736284_biz_api1.volly.it' : 'info_api1.volly.it';
$api_password = $sandbox ? '1330736309' : 'HJPFVTMTX2EU85FW';
$api_signature = $sandbox ? 'AN1vt.LkkOrXzhD9kesM9b6CpfusAZ04yz30pvqB-208xUTouNVNznxt' : 'AORCh7EIk8jHyUg99valtjBcOQ-1AmkWCf0FVAxI3l7R4uRnaR3cziNj';

?>