<?php 
$host = "localhost"; 
$user = "root";
$password = "root";
$db = mysql_connect($host, $user, $password) or die(mysql_error()); 
mysql_select_db("images", $db); 



?>