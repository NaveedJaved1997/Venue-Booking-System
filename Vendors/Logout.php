<?php
session_start();
// session_destroy();
unset($_SESSION["userId"]);
unset($_SESSION["userName"]);
unset($_SESSION["userRole"]);
//echo 'You have been logged out. <a href="./Index.php">Home</a>';
header("Location: ../Index.php");
?>