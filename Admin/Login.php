<?php 
session_start();
require '../Includes/db_connect.php';

	if (isset($_POST["user_email"])) {
		$mail=$_POST['user_email'];
		$password=$_POST['user_pwd'];

		$sql = "SELECT * FROM users WHERE role=1 AND status=2 AND email='".$mail."' AND password='".$password."' LIMIT 1";

		$result=mysqli_query($connection, $sql);
		if (mysqli_num_rows($result)==1) {
			$row = mysqli_fetch_assoc($result);

			$_SESSION["userId"]= $row["id"];
 		    $_SESSION["userName"]= $row["name"];
			$_SESSION["userRole"]= $row["role"];
			 header("Location: ./Dashboard.php");
			exit();
		}
		else{
			echo "Failed";
			exit();
		}
	}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../Includes/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Includes/bootstrap/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
	<script src="../Includes/bootstrap/js/bootstrap.min.js"></script>
	<title>Admin Login</title>
</head>
<body class="bg-light">
	<div class="container">
		<div class="row">
			<div class="col-6 offset-3" style="margin-top: 120px;">
				<div class="card shadow-lg">
					<div class="card-header bg-dark text-white">
					<i class="fa fa-user-secret fa-2x" aria-hidden="true"> Admin Login </i>
					</div>
					<div class="card-body">
					<form action="./Login.php" method="post">
			<label for="user_email">Email: </label>
			<input class="form-control" type="email" name="user_email" id="user_email" 
			placeholder="Please Enter Your Email ID" required>
			<label for="user_pwd">Password</label>
			<input class="form-control" type="password" name="user_pwd" id="user_pwd" 
			placeholder="Please Enter Your Password" required>   
			<button type="submit" class="btn btn-outline-dark form-control mt-2">Log-in</button>
			</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>