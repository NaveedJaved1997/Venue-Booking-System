<?php
$page_title = "Change Password | Online Venue Booking System";
include './Dashboard-nav.php';
?>
<?php

//Change Password
if (isset($_POST['user_pass'])) {

    $uid = mysqli_real_escape_string($connection, $_POST['user_id']);
    $user_pwd = mysqli_real_escape_string($connection, $_POST['user_pwd']);
    $user_pass = mysqli_real_escape_string($connection, $_POST['user_pass']);

    $sql = "SELECT * FROM users WHERE id= '" . $uid . "' LIMIT 1";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_fetch_array($result);
    if ($num > 0) {
        $db_pass = $num["password"];
        if ($db_pass == $user_pwd) {
            $sql = "UPDATE users SET password = '" . $user_pass . "' WHERE id= '" . $uid . "'";
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
<!-- Page content holder -->
<div class="page-content p-3" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-dark bg-dark rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

    <?php
    $name = $_SESSION["userName"];
    $sql = "SELECT * FROM users WHERE name='" . $name . "' LIMIT 1";

    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

    ?>

        <div class="row">
            <div class="col">

                <!-- template here -->
                <div class="container rounded bg-white mt-5">
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <?php
                            // $images = "SELECT * FROM images WHERE id='".$row['image']."' LIMIT 1";
                            // $res_image = mysqli_query($connection, $images);

                            // while ($img = mysqli_fetch_assoc($res_image)) {
                                  
                            ?>

                            <img class="rounded-circle mt-5" src="./Includes/uploads/<?php echo $row['profile'] ?>" width="90"><span class="font-weight-bold">
                            <?php 
                        // } ?>
                                    <?php echo $row["name"] ?>
                                </span><span class="text-black-50"><?php echo $row["email"] ?></span>

                            </div>
                        </div>

                        <form action="./ChnagePassword.php" method="POST" id="ChangePasswordForm" class="col-md-8">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                                        <h6><a href="./Dashboard.php">Back to home</a></h6>
                                    </div>
                                    <h6 class="text-right">Change Password</h6>
                                </div>
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $row["id"] ?>">
                                <div class="row mt-3 input-group ">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-key" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control" name="user_pwd" id="user_pwd" placeholder="Enter Old Password">
                                </div>

                                <div class="row mt-3 input-group ">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-key" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control" name="user_pass" id="user_pass" placeholder="Enter New Password">
                                </div>

                                <div class=" row mt-3 input-group ">
                                    <div class=" input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-key" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control" name="user_pass_c" id="user_pass_c" placeholder="Confirm New Password">
                                </div>
                                <div id="passwordNotMatchedError" class="alert alert-danger col-11 m-2">
                                <p><b>Error! </b> New Password Does Not Matched.<i> Try Again.</i> </p>
                                </div>
                                <div  id="passwordSameError" class="alert alert-info alert-dismissible fade show col-11 m-2">
                                <p><b>Error! </b> New Password Is Same As Old Password.<i> Try Again.</i> </p>
                                </div>
                                <div class="mt-5 text-right"><button id="changePassword" class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                        </form>
                    </div>
                </div>
            </div>

        <?php
    }
        ?>
        <!-- <div class="col-lg-5">

            </div> -->
        </div>
</div>

<!-- End content -->



<script>
$(document).ready(function(){
    $("#passwordNotMatchedError").hide();
    $("#passwordSameError").hide();
});

    $("#changePassword").click(function(e) {
        e.preventDefault();
        var passC = $("#user_pass_c").val();
        var pass = $("#user_pass").val();
        var pwd = $("#user_pwd").val();

        if (pwd == '' || null) {
            alert("ERROR! Feild Required.");
            $("#user_pwd").addClass("border-danger");
        } else if (pass == '' || null) {
            alert("ERROR! Feild Required.");
            $("#user_pwd").removeClass("border-danger");
            $("#user_pwd").addClass("border-success");
            $("#user_pass").addClass("border-danger");
        } else if (passC == '' || null) {
            alert("ERROR! Feild Required.");
            $("#user_pass").removeClass("border-danger");
            $("#user_pass").addClass("border-success");
            $("#user_pass_c").addClass("border-danger");
        } else if (pwd == pass) {
            $("#user_pass_c").removeClass("border-danger");
            $("#user_pass_c").addClass("border-success");
            // alert("ERROR! New Password is Same As Old Password.");
            $("#passwordNotMatchedError").hide();
            $("#passwordSameError").show();
        } else if (pass != passC) {
            // alert("ERROR! New Password Does Not Matched.");
            $("#passwordSameError").hide();
            $("#passwordNotMatchedError").show();
        } else {
            $("#ChangePasswordForm").submit();
        }

    });
</script>


</body>

</html>