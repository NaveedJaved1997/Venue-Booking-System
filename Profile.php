<?php
$page_title = "Manage Profile | Online Venue Booking System";
include './Dashboard-nav.php';
?>
<?php
// Update edit Profile
if (isset($_POST['user_name'])) {

    $uid = mysqli_real_escape_string($connection, $_POST['user_id']);
    $uname = mysqli_real_escape_string($connection, $_POST['user_name']);
    $uemail = mysqli_real_escape_string($connection, $_POST['user_email']);
    $udob = mysqli_real_escape_string($connection, $_POST['user_dob']);

    $sql = "UPDATE users SET name = '" . $uname . "', email = '" . $uemail . "', date_of_birth = '" . $udob . "' WHERE id= '" . $uid . "'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $_SESSION["username"]= $uname;
        echo '<script> alert("Data Uploaded"); </script>';
    } else {
        echo '<script> alert("Error Occured"); </script>';
    }
}
//Update Image
if(isset($_POST['upload_btn'])){
    $userid = $_POST['userid'];
    $image = $_FILES['imageupload']['name'];
    $temp = explode(".", $_FILES["imageupload"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);


    // $sql = "INSERT INTO images (name)
	// VALUES ('$newfilename')";
	// $result = mysqli_query($connection,$sql);
    $sql = "UPDATE users SET profile = '" . $newfilename . "' WHERE id= '" . $userid . "'";
    $result = mysqli_query($connection, $sql);

    if(copy($_FILES['imageupload']['tmp_name'], "./Includes/uploads/" .$newfilename)){

        // $findnewprofileid = "SELECT * FROM images WHERE name = '".$newfilename."' LIMIT 1";
        // $findnewprofile = mysqli_query($connection, $findnewprofileid);
        // $profileresults = mysqli_fetch_assoc($findnewprofile);
        // $updateprofileid = "UPDATE users SET image = '".$profileresults['id']."' WHERE id = $userid";
        // $profileupdate = mysqli_query($connection, $updateprofileid);

        //delete old file
        if(isset($_POST['profile'])){
            $fileName = $_POST['profile'];
            $filePath = "./Includes/uploads/" .$fileName;
            if($fileName == "1619639179.png"){

            }
            else{
                unlink($filePath);
            }

            // echo "File DELETED";
        }

        echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>Success!</b> Image Updated. <i>again.</i></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
            </div>';

    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> Somehow an <i>Error.</i> occured.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        
        </div>';


	}

	}


?>
<!-- Page content holder -->
<div class="page-content p-3" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-dark bg-dark rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

    <!-- Demo content -->
    <!-- <h1 class="display-4 text-white"><?php
                                            //   echo $_SESSION["username"] 
                                            ?>'s Profile</h1>
    <div id="carbon-block"></div>

  		<p class="lead text-white mb-0">
              </p>
  	<div class="separator"></div> -->
    <!-- php fetch data  -->
    <!-- Edit Profile Modal -->
    <?php
    $userid = $_SESSION["userId"];
    $sql = "SELECT * FROM users WHERE id='" . $userid . "' LIMIT 1";

    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);
            //echo $row["name"]."<br>";
            //echo $row["email"]."<br>";
            //echo $row["password"]."<br>";

    ?>

<!-- Update Prifle Picture Modal -->
<div class="modal fade" id="UpdateProfileModal" tabindex="-1" role="dialog" aria-labelledby="UpdateProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="UpdateProfileModalLabel">Select New Profile Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="#" method="post" enctype="multipart/form-data">
      <input type="hidden" name="userid" value="<?php echo $row["id"] ?>">
      <input type="hidden" name="profile" value="<?php echo $row["profile"] ?>">
        <input type="hidden" name="size" value="1000000">
        <input type="file" name="imageupload"  class="form-group" required>
          <button type="submit" name="upload_btn" class="btn btn-outline-dark form-control mt-2">Upload</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Update Prifle Picture Modal end -->

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
                            //  }
                             ?>
                            <a href="" type="button"  data-toggle="modal" data-target="#UpdateProfileModal">Change Profile</a><br/>
                            <?php echo $row["name"] ?>
                            </span><span class="text-black-50"><?php echo $row["email"] ?></span>
                            
                        </div>
                    </div>
                    
                    <form action="./Profile.php" method="POST" class="col-md-8">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                                    <h6><a href="./Dashboard.php">Back to home</a></h6>
                                </div>
                                <h6 class="text-right">Edit Profile</h6>
                            </div>
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $row["id"] ?>">
                            <div class="row mt-3 input-group ">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" 
                                name="user_name" placeholder="Full Name" value="<?php echo $row["name"] ?>">
                            </div>

                            <div class="row mt-3 input-group ">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <input type="email" class="form-control"  
                                name="user_email" placeholder="Email" value="<?php echo $row["email"] ?>">
                                </div>

                                <div class=" row mt-3 input-group ">
                                    <div class=" input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </div>
                            </div>
                            <input type="date" class="form-control"
                            name="user_dob" placeholder="date-of-birth" value="<?php echo $row["date_of_birth"] ?>">
                        </div>

                        <div class="mt-5 text-right"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
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





