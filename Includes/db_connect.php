<?php
//Database Connection
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "ovbs";

$connection = mysqli_connect($server_name, $user_name, $password, $db_name);
if ($connection) {
	//echo '<Script>alert("Database Connection Successful");</Script>';
}
else{
	die("Can not connect to Database.");
}
?>