<?php
$page_title = "Forget Password | Online Venue Booking System";
include './Header.php';

if(isset($_POST['sendEmail'])){
    $email = $_POST['user_email'];
    $query = "SELECT * FROM users WHERE email = '".$email."' LIMIT 1";
    $newPassword = rand(1, 10000000);
    // echo $newPassword;
    $result=mysqli_query($connection, $query);

    if (mysqli_num_rows($result)==1){
        //Change old Password
        $sql = "UPDATE users SET password = '" . $newPassword . "' WHERE email= '" . $email ."'";
        $res = mysqli_query($connection, $sql);

        //email - send query
        while($row = mysqli_fetch_assoc($result)){

        
            $name=$row['name'];
            $msg="Your account password chnage request is sent. Your temporary Password is: $newPassword. Use it to Log-in at Online Venue Booking System. THANK YOU!";
            $email=$row['email'];
            $to = $email;
            $subject = "Forget Password";
            $body = "Hi $name, $msg.";
            $headers = "From: teamzafhnofficial@gmail.com";
            mail($to, $subject, $body, $headers);
            
            echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
            <p class="p-2"><b>Success!</b> An email is sent to you.<i> Please Check Your Email Inbox. THANK YOU!</i></p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> </div>';
            
    }
}
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> Email not Found! <i>Please try again.</i></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
}
?>


<div class="container">
		<div class="row">
			<div class="col-6 offset-3" style="margin-top:100px; margin-bottom:100px;">
				<div class="card shadow-lg">
					<div class="card-header bg-dark text-white">
					<i class="fa fa-envelope fa-2x" aria-hidden="true"> Forget Password ?</i>
					</div>
					<div class="card-body">
					<form action="./ForgetPassword.php" method="post">
			<!-- <label for="user_email">Enter Your Email: </label> -->
			<input class="form-control" type="email" name="user_email" id="user_email" 
			placeholder="Please Enter Your Email ID" value="<?php if(isset($_POST['user_email'])){echo $_POST['user_email'];} ?>" required>

			<button type="submit" class="btn btn-outline-dark form-control mt-2"
            name="sendEmail" id="sendEmail" >Send Backup Email</button>
			</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
include './Footer.php'
?>