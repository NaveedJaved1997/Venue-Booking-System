<?php 

session_start();
require './Includes/db_connect.php';

//	$mail=$_POST['user_email'];
//	$password=$_POST['user_pwd'];
//	$msg="";
//	$result=mysqli_query( $connect_mysql, "SELECT * FROM clients WHERE email='$mail' AND password='$password' ");

	if (isset($_POST["user_email"])) {

		$mail=$_POST['user_email'];
		$password=$_POST['user_pwd'];

		$sql = "SELECT * FROM users WHERE Role=3 AND status=2 AND email='".$mail."' AND password='".$password."' LIMIT 1";

		$result=mysqli_query($connection, $sql);
		if (mysqli_num_rows($result)==1) {
			//echo "WELLCOME BACK ";
			//session_start();

		//while(
			$row = mysqli_fetch_assoc($result);//) 
			//{
    		//echo $row["name"]."<br>";
    		//session_start();

			$_SESSION["userId"]= $row["id"];
			$_SESSION["userName"]= $row["name"];
			$_SESSION["userRole"]= $row["role"];
			//echo "The session name is :";
			//echo $_SESSION["username"]."<br>";
			//echo '<a href="./Index.php">Home</a>';
			header("Location: ./Dashboard.php");
  			//}
			exit();
		}
		else{
			echo "Failed";
			exit();
		}

	}

?>