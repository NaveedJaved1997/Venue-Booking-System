<?php include 'Header.php' ?>
<?php
// Update edit Profile
if (isset($_POST['user_name'])) {

    $uid = mysqli_real_escape_string($connection, $_POST['user_id']);
    $uname = mysqli_real_escape_string($connection, $_POST['user_name']);
    $uemail = mysqli_real_escape_string($connection, $_POST['user_email']);
    $udob = mysqli_real_escape_string($connection, $_POST['user_dob']);

    //    $sql = "UPDATE clients SET (name, email, date_of_birth)
    //  VALUES ('$uname', '$uemail', '$udob') WHERE id= '".$uid."'";    

    $sql = "UPDATE clients SET name = '" . $uname . "', email = '" . $uemail . "', date_of_birth = '" . $udob . "' WHERE id= '" . $uid . "'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        echo '<script> alert("Data Uploaded"); </script>';
    } else {
        echo '<script> alert("Error Occured"); </script>';
    }
}

//Change Password
if (isset($_POST['user_pass'])) {

    $uid = mysqli_real_escape_string($connection, $_POST['user_id']);
    $user_pwd = mysqli_real_escape_string($connection, $_POST['user_pwd']);
    $user_pass = mysqli_real_escape_string($connection, $_POST['user_pass']);
    //    $user_pass_c = mysqli_real_escape_string($connection, $_POST['user_pass_c']);

    //jquery check required
    // $sql = "UPDATE clients SET password = '" . $user_pass . "' WHERE id= '" . $uid . "'";
    // $result = mysqli_query($connection, $sql);
    // if ($result) {
    //     echo '<script> alert("Password Changed Successfully!"); </script>';
    // } else {
    //     echo '<script> alert("Error Occured"); </script>';
    // }
    //Varify old password = true
    $sql = "SELECT * FROM clients WHERE id= '" . $uid . "' LIMIT 1";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_fetch_array($result);
    if ($num > 0) {
        $db_pass = $num["password"];
        if ($db_pass == $user_pwd) {
            $sql = "UPDATE clients SET password = '" . $user_pass . "' WHERE id= '" . $uid . "'";
            $result = mysqli_query($connection, $sql);
            echo '<script> alert("Success! Password has been Changed."); </script>';
        } else {
            echo '<script> alert("Error! Old Password is INCORRECT"); </script>';
        }
    } else {
        echo '<script> alert("Error! Record Does not Found."); </script>';
    }
}

?>

<!-- Change Password Modal -->
<?php
$name = $_SESSION["username"];
$sql = "SELECT * FROM clients WHERE name='" . $name . "' LIMIT 1";

$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) == 1) {

    $row = mysqli_fetch_assoc($result);
        //echo $row["name"]."<br>";
        //echo $row["email"]."<br>";
        //echo $row["password"]."<br>";

?>
        <div class="modal fade" id="ChangePasswordModal" tabindex="-1" role="dialog" aria-labelledby="ChangePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="ChangePasswordModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="Settings.php" method="post" id="ChangePasswordForm">
                            <input class="form-control" type="hidden" name="user_id" id="user_id" value="<?php echo $row["id"] ?>">
                            <label for="user_pwd">Enter Old Password</label>
                            <input class="form-control" type="password" name="user_pwd" id="user_pwd" required>
                            <label for="user_pass">Enter New Password</label>
                            <input class="form-control" type="password" name="user_pass" id="user_pass" required>
                            <label for="user_pass_c">Confirm New PasswordPassword</label>
                            <input class="form-control" type="password" name="user_pass_c" id="user_pass_c" required>
                            <button id="changePassword" type="submit" class="btn btn-outline-success form-control mt-2">Change Password</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>
<!-- Edit Profile Modal -->
<?php
$name = $_SESSION["username"];
$sql = "SELECT * FROM clients WHERE name='" . $name . "' LIMIT 1";

$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) == 1) {

    $row = mysqli_fetch_assoc($result);
        //echo $row["name"]."<br>";
        //echo $row["email"]."<br>";
        //echo $row["password"]."<br>";

?>
        <div class="modal fade" id="EditProfileModal" tabindex="-1" role="dialog" aria-labelledby="EditProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="EditProfileModalLabel">Edit Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="Settings.php" method="post">
                            <input class="form-control" type="hidden" name="user_id" id="user_id" value="<?php echo $row["id"] ?>">
                            <label for="user_name">Name: </label>
                            <input class="form-control" type="text" name="user_name" id="user_name" required value="<?php echo $row["name"] ?>">
                            <label for="user_email">Email: </label>
                            <input class="form-control" type="email" name="user_email" id="user_email" required value="<?php echo $row["email"] ?>">
                            <label for="user_dob">Date of Birth</label>
                            <input class="form-control" type="date" name="user_dob" id="user_dob" required value="<?php echo $row["date_of_birth"] ?>">

                            <button type="submit" class="btn btn-outline-success form-control mt-2">Save Changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>

<!-- body start -->
<!-- sidebar -->
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <div class="card mt-1">
                <table class="table">
                    <thead class="bg-primary">
                        <th><a class="text-white" href="./Dashboard.php">Dashboard</a></th>
                    </thead>
                    <tr>
                        <td><a href="./Settings.php">Settings</a></td>
                    </tr>
                    <tr>
                        <td><a class="text-danger" href="./Logout.php">Logout</a></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- content -->

        <div class="row mt-2">
            <div class="col">
                <ul class="list-group">
                    <li class="list-group-item">
                        <img class="w-50 rounded mx-auto d-block" src="./Includes/media/default-user.png" alt="">
                    </li>
                    <li class="list-group-item"><b><?php echo $_SESSION["username"]; ?></b></li>
                    <li class="list-group-item"><b>
                            <a href="#" type="submit" data-toggle="modal" data-target="#EditProfileModal">Edit Profile</a></b></li>
                    <li class="list-group-item"><b>
                            <a href="#" type="submit" data-toggle="modal" data-target="#ChangePasswordModal">Change Password</a></b></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="./Includes/jquery/jquery.min.js"></script>
<script src="./Includes/bootstrap/js/bootstrap.min.js"></script>

<script>
    $("#changePassword").click(function(e) {
        e.preventDefault();
        var passC = $("#user_pass_c").val();
        var pass = $("#user_pass").val();
        var pwd = $("#user_pwd").val();
        //    alert(passC);

        // if (pass == null || passC == null || pwd ==null  ) {
        //     alert(pwd);
        //     alert("ERROR! Password is Required.");
        // } else {
            if (pass != passC) {
                alert("ERROR! New Password Does Not Matched.");
            } else {
                if (pass == pwd) {
                    alert("ERROR! New Password is Same As Old Password.");
                } else {
                    $("#ChangePasswordForm").submit();
                }
            }
        // }
    });
</script>
</body>

</html>