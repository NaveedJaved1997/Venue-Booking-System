<?php
error_reporting(0);
$page_title = "Update Cars | Online Venue Booking System";
include './Dashboard-nav.php';
if (isset($_POST['update_car_btn'])) {
    $id = $_POST['car_id'];
    $no = $_POST['car_number'];
    $des = $_POST['car_desc'];
    $price = $_POST['price'];
    $availabilityStatus = mysqli_real_escape_string($connection, $_POST['availabilityStatus']);
    $venueImage = $_POST['car_image_id'];
    $newImageID = $venueImage ;
    //Image 
    if(isset($_FILES['imageupload'])){
        
        $image = $_FILES['imageupload']['name'];
        $temp = explode(".", $_FILES["imageupload"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $newImageID = $newfilename;
        // $imageInsert = "INSERT INTO images (name)
        // VALUES ('$newfilename')";
        // $resImage = mysqli_query($connection,$imageInsert);
    
        copy($_FILES['imageupload']['tmp_name'], "../Includes/uploads/" .$newfilename);
        // {
            // $findNewVenueImage = "SELECT * FROM images WHERE name = '".$newfilename."' LIMIT 1";
            // $VenueImage = mysqli_query($connection, $findNewVenueImage);
            // $VenueImageResults = mysqli_fetch_assoc($VenueImage);
            // $newImageID = $VenueImageResults["id"];
            // }
            // else{
            //             echo '<script> alert("erroe occured in image upload"); </script>';
            // }
    }

    $sql = "UPDATE cars SET car_number = '".$no."',  price = '".$price."', description ='".$des."',
     image = '".$newImageID."', availability = '".$availabilityStatus."'
    WHERE id='".$id."'";
    $result = mysqli_query($connection, $sql);                 
    if ($result) {
        //delete old file
        if(isset($_POST['car_image_id'])){
            $fileName = $_POST['car_image_id'];
            $filePath = "../Includes/uploads/" .$fileName;
            if($fileName == "1625398391.jpg"){

            }
            else{
                unlink($filePath);
            }
            // echo "File DELETED";
        }

        echo '        <div class="page-height">';
        echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
        
        <p class="p-2"><b>Success!</b>Car record has been Modified.<i> Thank You!</i></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
            </div></div>';
            echo '<script>
            setTimeout(function(){
                var url = "./Cars.php";
                $(location).attr("href",url);
            }, 3000); 
            </script>';

    } else {
        echo '        <div class="page-height">';
        echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> Somehow an <i>Error.</i> occured.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        </div> </div>'; 
    }
}
?>
<!-- Page content holder -->
<div class="page-content p-3" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-dark bg-dark rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

    <!-- content -->
    <h1 class="display-4 text-white">Update Cars</h1>
    <div id="carbon-block"></div>

    <div class="separator"></div>
    <div class="row text-white">
        <div class="col-lg-12">
            <div class="container-fluid">
                <div class="row">
                <div class="card p-0 m-0 col ">
                    <div class="card-header bg-dark text-white">
                    Update Car
                    </div>
                    <div class="card-body text-dark">
                    <?php
    //Update
    if (isset($_GET['edit_id'])) {
    $editId = $_GET['edit_id'];
    $sql = "SELECT * FROM cars WHERE  id = '" . $editId . "'";
    $result = mysqli_query($connection, $sql);                 
    while ($num =mysqli_fetch_assoc($result)) {

    ?>
               <form action="Car-update.php" method="post" enctype="multipart/form-data" >
                    <input class="form-control" type="hidden" name="car_id" id="car_id" value="<?php echo $num['id']; ?>">
                    <label for="car_number">Enter Car Number</label>
                    <input class="form-control" type="text" name="car_number" id="car_number" value="<?php echo $num['car_number']; ?>">
                    <label for="price">Enter Car Price</label>
                    <input class="form-control" type="number" name="price" id="price" value="<?php echo $num['price']; ?>">
                    <label for="car_desc">Enter Car Description</label>
                    <input class="form-control" type="text" name="car_desc" id="car_desc" value="<?php echo $num['description']; ?>">
                    <label for=""></label>
                <select name="availabilityStatus" class="custom-select pt-1" id="availabilityStatus">
                <option >Choose Availability</option>
                <?php
                //for Availability Values
                // $query = "SELECT * FROM availability ";
                // $queryRes = mysqli_query($connection, $query);
                // $availabilityRow  = array("Pending", "Available", "Not Available");
                // for($i=0; $availabilityRow <=3; $i++){
                    if($num['availability']==1){
                        // echo "Pending";
                        echo '<option selected value="1">
                        Pending </option>';
                        echo '<option  value="2">
                        Available </option>';
                        echo '<option  value="3">
                            Not Available </option>';
                        }
                        else if($num['availability']==2){
                        //   echo "Available";
                        echo '<option  value="1">
                        Pending </option>';
                        echo '<option selected value="2">
                        Available </option>';
                        echo '<option  value="3">
                            Not Available </option>';
                          }
                          else if($num['availability']==3){
                            // echo "Not Available";
                            echo '<option  value="1">
                        Pending </option>';
                        echo '<option  value="2">
                        Available </option>';
                        echo '<option selected value="3">
                            Not Available </option>';
                            }
                    ?>
                </select>
                <input type="hidden" name="car_image_id" value="<?php echo $num['image'];?>">
                    <input type="hidden" name="size" value="1000000">
                    <label for="imageupload">Select Car Image</label>
                    <input type="file" class="form-control-file" name="imageupload" id="imageupload"  class="form-group" required>
                    <button id="update_car_btn" name="update_car_btn" type="submit" class="btn btn-outline-dark form-control mt-2">Update</button>
                </form>

  <?php
    }
        }
        ?>    
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End content -->

