<?php
include './Header.php';

if (isset($_POST['vendor_name'])) {

	$uname = mysqli_real_escape_string($connection, $_POST['vendor_name']);
	$uemail = mysqli_real_escape_string($connection, $_POST['vendor_email']);
	$upwd = mysqli_real_escape_string($connection, $_POST['vendor_pwd']);
	$udob = mysqli_real_escape_string($connection, $_POST['vendor_dob']);
	//Check for email:
	$checkQuery = "SELECT email FROM users WHERE email= '" . $uemail . "'";
	$checkQueryResult = mysqli_query($connection, $checkQuery);
	$checkQueryrow = mysqli_fetch_assoc($checkQueryResult);
	if ($checkQueryrow) {
		echo '<div class="page-height">';
		echo '<div class="col card alert-danger mt-2 p-1">
				<p class="p-2"><b>ERROR!</b>This Email is <i>Already Registered.</i></p>
					</div>';
		echo '<a class="p-3 mt-3" href="./Index.php">Return Home</a>
					</div>';
	} else {
		$sql = "INSERT INTO users (name, email, password, date_of_birth, role)
				VALUES ('$uname', '$uemail', '$upwd', '$udob', 2)";
		$result = mysqli_query($connection, $sql);
		if ($result) {
			echo '<div class="page-height">';
			echo '<div class="col card alert-success mt-2 p-1">
					<p class="p-2"><b>Success!</b> Registration Completed. <i>again.</i></p>
						</div>';
			echo '<a class="p-3 mt-3" href="./Index.php">Return Home</a>
						 </div>';
		} else {
			echo '<div class="page-height">';
			echo '<div class="col card alert-danger mt-2 p-1">
					<p class="p-2"><b>ERROR!</b> Somehow an <i>Error.</i> occured.</p>
						</div>';
			echo '<a class="p-3 mt-3" href="./Index.php">Return Home</a>
						</div>';
		}
	}
}
