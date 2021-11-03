<?php
if (isset($_POST['user_pass'])) {

    $uid = mysqli_real_escape_string($connection, $_POST['user_id']);
    $user_pwd = mysqli_real_escape_string($connection, $_POST['user_pwd']);
    $user_pass = mysqli_real_escape_string($connection, $_POST['user_pass']);
    $user_pass_c = mysqli_real_escape_string($connection, $_POST['user_pass_c']);

    if ($user_pass == $user_pass_c) {
        if ($user_pass == $user_pwd) {
            echo '<script> alert("ERROR! New Password is Same As Old Password"); </script>';
        } else {
            
            //Varify old password = true
            $sql = "SELECT * FROM clients WHERE id= '".$uid."' LIMIT 1";

            $result = mysqli_query($connection, $sql);
            if (mysqli_num_rows($result) == 1) {

                while ($row = mysqli_fetch_assoc($result)) {
                    //echo $row["name"]."<br>";
                    $oldPass = $row["password"];

                    if ($oldPass == $user_pwd) {
                        $sql = "UPDATE clients SET password = '" . $user_pass . "' WHERE id= '" . $uid . "'";
                        $result = mysqli_query($connection, $sql);
                        if ($result) {
                            echo '<script> alert("Password Changed Successfully!"); </script>';
                        } else {
                            echo '<script> alert("Error Occured"); </script>';
                        }
                    } else {
                        echo '<script> alert("Error! Incorrect Old Password"); </script>';
                    }
                }
                exit();
            } else {
                echo "No Password Found!";
                exit();
            }
        }
    } else {
        echo '<script> alert(" New Password does not MATCHED!"); </script>';
    }
}
?>




















<?php
if (isset($_POST['user_pass'])) {

    $uid = mysqli_real_escape_string($connection, $_POST['user_id']);
    $user_pwd = mysqli_real_escape_string($connection, $_POST['user_pwd']);
    $user_pass = mysqli_real_escape_string($connection, $_POST['user_pass']);
    $user_pass_c = mysqli_real_escape_string($connection, $_POST['user_pass_c']);

    if ($user_pass == $user_pass_c) {
        if ($user_pass == $user_pwd) {
            echo '<script> alert("ERROR! New Password is Same As Old Password"); </script>';
        } else {
            //Varify old password = true
            $sql = "SELECT * FROM clients WHERE id= '".$uid."' LIMIT 1";

            $result = mysqli_query($connection, $sql);
            if (mysqli_num_rows($result) == 1) {

                while ($row = mysqli_fetch_assoc($result)) {
                    //echo $row["name"]."<br>";
                    $oldPass = $row["password"];

                    if ($oldPass == $user_pwd) {
                        $sql = "UPDATE clients SET password = '" . $user_pass . "' WHERE id= '" . $uid . "'";
                        $result = mysqli_query($connection, $sql);
                        if ($result) {
                            echo '<script> alert("Password Changed Successfully!"); </script>';
                        } else {
                            echo '<script> alert("Error Occured"); </script>';
                        }
                    } else {
                        echo '<script> alert("Error! Incorrect Old Password"); </script>';
                    }
                }
                exit();
            } else {
                echo "No Password Found!";
                exit();
            }
        }
    } else {
        echo '<script> alert(" New Password does not MATCHED!"); </script>';
    }
}
?>