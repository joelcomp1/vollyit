<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "coolguy1";
$database_name = "volly";

$link = mysql_connect($hostname, $username, $password) or die("Cannot connect to the database!");
mysql_select_db($database_name) or die("Cannot select the database!");
?>