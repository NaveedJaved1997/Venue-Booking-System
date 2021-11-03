<?php
session_start();
unset($_SESSION["userId"]);
unset($_SESSION["userName"]);
unset($_SESSION["userRole"]);
// session_destroy();
//echo 'You have been logged out. <a href="./Index.php">Home</a>';
header("Location: ./Index.php");
?>