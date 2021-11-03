<?php
session_start();
include'./Includes/db_connect.php';
if(!empty($_SESSION["userId"]) && ($_SESSION['userRole'] == 1)){

        
header('location:./Dashboard.php');    
}
else{
    header('location:./Login.php');
}

?>