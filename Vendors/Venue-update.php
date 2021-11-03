<?php
error_reporting(0);
$page_title = "Update Venues | Online Venue Booking System";
include './Dashboard-nav.php';
if (isset($_POST['update_venue_btn'])) {
    $id = $_POST['venue_id'];
    $name = $_POST['venue_name'];
    $address = $_POST['venue_address'];
    $price = $_POST['venue_price'];
    $description = $_POST['venue_description'];
    $availabilityStatus = mysqli_real_escape_string($connection, $_POST['availabilityStatus']);
    $venueImage = $_POST['venue_image_id'];
    $newImageID = '';
    $newImageID = $venueImage ;
    // echo $newImageID ;
    //Image 
    if(isset($_FILES['imageupload']['name'])){
        
        $image = $_FILES['imageupload']['name'];
        $temp = explode(".", $_FILES["imageupload"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $newImageID =  $newfilename;
        copy($_FILES['imageupload']['tmp_name'], "../Includes/uploads/" .$newfilename);
        // $imageInsert = "INSERT INTO images (name)
        // VALUES ('$newfilename')";
        // $resImage = mysqli_query($connection,$imageInsert);
    
        
        // {
        //     $findNewVenueImage = "SELECT * FROM images WHERE name = '".$newfilename."' LIMIT 1";
        //     $VenueImage = mysqli_query($connection, $findNewVenueImage);
        //     $VenueImageResults = mysqli_fetch_assoc($VenueImage);
        //     $newImageID = $VenueImageResults["id"];
        //     }
            // else{
            //             echo '<script> alert("erroe occured in image upload"); </script>';
            // }
    }
    else{
        $newImageID = $venueImage ;
    }


    $sql = "UPDATE venues SET name = '".$name."', address = '".$address."', description = '".$description."',
    price = '".$price."', image = '$newImageID', availability = '".$availabilityStatus."'
    WHERE id='".$id."'";
    $result = mysqli_query($connection, $sql);                 
    if ($result) {
        // echo '<script> alert("Data Updated"); </script>';
        
        //delete old file
        if(isset($_POST['venue_image_id'])){
            $fileName = $_POST['venue_image_id'];
            $filePath = "../Includes/uploads/" .$fileName;
            if($fileName == "1620150156.jpg"){

            }
            else{
                unlink($filePath);
            }
            // echo "File DELETED";
        }


        echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>Success!</b><i> Venue.</i> is Updated</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
            </div>';
            // header("Location: ./Venues.php");
            echo '<script>
            setTimeout(function(){
                var url = "./Venues.php";
                $(location).attr("href",url);
            }, 3000);
 
 
            </script>';

        } else {
        // echo '<script> alert("Error Occured"); </script>';
        echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> Somehow an <i>Error </i> occured.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        
        </div>';
    }}
?>
<!-- Page content holder -->
<div class="page-content p-3" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-dark bg-dark rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

    <!-- content -->
    <h1 class="display-4 text-white">Update Venues</h1>
    <div id="carbon-block"></div>

    <div class="separator"></div>
    <div class="row text-white">
        <div class="col-lg-12">
            <div class="container-fluid">
                <div class="row">
                <div class="card p-0 m-0 col ">
                    <div class="card-header bg-dark text-white">
                    Update Venue
                    </div>
                    <div class="card-body text-dark">
                    <?php
    //Update
    if (isset($_GET['edit_id'])) {
    $editId = $_GET['edit_id'];
    $sql = "SELECT * FROM venues WHERE  id = '" . $editId . "'";
    $result = mysqli_query($connection, $sql);                 
    while ($num =mysqli_fetch_assoc($result)) {

    ?>
               <form action="Venue-update.php" method="post" id="EditVenueMondal" enctype="multipart/form-data">
                    <input class="form-control" type="hidden" name="venue_id" id="venue_id" value="<?php echo $num['id']; ?>">
                    <label for="venue_name">Enter Venue Name</label>
                    <input class="form-control" type="text" name="venue_name" id="venue_name" value="<?php echo $num['name']; ?>">
                    <label for="venue_address">Enter Venue Address</label>
                    <input class="form-control" type="text" name="venue_address" id="venue_address" value="<?php echo $num['address']; ?>">
                    <label for="venue_description">Enter Venue Description</label>
                    <input class="form-control" type="text" name="venue_description" id="venue_description" value="<?php echo $num['description']; ?>">
                    <label for="venue_price">Enter Venue Price</label>
                    <input class="form-control" type="number" name="venue_price" id="venue_price" value="<?php echo $num['price']; ?>">
                    <label for=""></label>
                <select name="availabilityStatus" class="custom-select pt-1" id="availabilityStatus">
                <option selected>Choose Availability</option>
                <?php
                //for Availability Values
                // $query = "SELECT * FROM availability ";
                // $queryRes = mysqli_query($connection, $query);
                // while($availabilityRow = mysqli_fetch_assoc($queryRes)){
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
                <option  value="<?php echo $availabilityRow['id'];?>"><?php echo $availabilityRow['name'];?></option>
            
                </select>
            
                    <input type="hidden" name="venue_image_id" value="<?php echo $num['image'];?>">
                    <input type="hidden" name="size" value="1000000">
                    <input type="file" class="form-control-file pt-1" name="imageupload"  class="form-group" required>
                    <button id="update_venue_btn" name="update_venue_btn" type="submit" class="btn btn-outline-dark form-control mt-2">Update</button>
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

