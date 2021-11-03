<?php
$page_title = "Vendors | Online Venue Booking System";
include 'header.php';
?>

<!-- Login Modal -->
<div class="modal fade" id="VLoginModal" tabindex="-1" role="dialog" aria-labelledby="VLoginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="VLoginModalLabel">Log-in</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./Vendors/Login.php" method="post">
          <label for="vendor_email">Email: </label>
          <input class="form-control" type="email" name="vendor_email" id="vendor_email" required>
          <label for="vendor_pwd">Password</label>
          <input class="form-control" type="password" name="vendor_pwd" id="vendor_pwd" required>   
          <button type="submit" class="btn btn-outline-dark form-control mt-2">Log-in</button>
          <p>New vendor <b><a id="vregister-btn" href="./Register.html" data-toggle="modal" data-target="#VRegisterModal">Register</a></b> Here.</p>
      </form>
      </div>

    </div>
  </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="VRegisterModal" tabindex="-1" role="dialog" aria-labelledby="VRegisterModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="VRegisterModalLabel">Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./Vendors/Register.php" method="post">
          <label for="vendor_name">Name: </label>
          <input class="form-control" type="text" name="vendor_name" id="vendor_name" required>
          <label for="vendor_email">Email: </label>
          <input class="form-control" type="email" name="vendor_email" id="vendor_email" required>
          <label for="vendor_pwd">Password</label>
          <input class="form-control" type="password" name="vendor_pwd" id="vendor_pwd" required>   
          <label for="vendor_dob">Date of Birth</label>
          <input class="form-control" type="date" name="vendor_dob" id="vendor_dob" required>
          
          <button type="submit" class="btn btn-outline-dark form-control mt-2">Register</button>
          <p>Already Have An Account <b><a id="vlogin-btn" data-toggle="modal" data-target="#VLoginModal" href="./Login.html">Log-In</a></b> Here.</p>
      </form>
      </div>

    </div>
  </div>
</div>


<!-- Actual body -->
<!-- venues list start -->
<div class="container-fluid bg-venues pt-1 pb-5">
<div class="container">
<div class="">
  <h3 class="venues-head">Our Top Halls</h3>
</div>
  <div class="row">
  <?php 
 $sql = "SELECT * FROM venues WHERE availability=2  LIMIT 3";
 $result = mysqli_query($connection, $sql);

 while ($num = mysqli_fetch_assoc($result)) {

 
?>
    <div class="col-4">
      <div class="card bg-venues-card">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
            <?php 
            //  get image
        $images = "SELECT * FROM images WHERE id='".$num['image']."' LIMIT 1";
        $res_image = mysqli_query($connection, $images);
        $img = mysqli_fetch_assoc($res_image);
        if ($img >0) {
        
        ?>
        <img class="card-img" src="./Includes/uploads/<?php echo $img['name']; ?>"
    width="250px" height="250px">
    <?php }?>
              <!-- <img class="d-block w-100" src="./Includes/media/1.jpg" alt="First slide"> -->
            </div>
            <?php 
            //  get main image
        $findimage = "SELECT * FROM reviews WHERE item='venue' AND item_id='".$num['id']."' ";
        $res_imageId = mysqli_query($connection, $findimage);
        // $img_array = mysqli_fetch_assoc($res_images);
        while($img_ids = mysqli_fetch_assoc($res_imageId)) {
        
            // get review images
            $image = "SELECT * FROM images WHERE  id='".$img_ids['image_id']."'";
            $res_images = mysqli_query($connection, $image);
            // $img_array = mysqli_fetch_assoc($res_images);
            while($img_array = mysqli_fetch_assoc($res_images)) {

            
        ?>

            <div class="carousel-item">
            <img class="card-img" src="./Includes/uploads/<?php echo $img_array['name']; ?>"
            width="250px" height="250px" alt="The image: <?php echo $img_array['name']; ?> not available">
            </div>

            <!-- <div class="carousel-item">
              <img class="d-block w-100" src="./Includes/media/3.jpg" alt="Third slide">
            </div> -->
            <?php  } }?>
          </div>
          <!-- <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a> -->
          
        </div>
        
        <div class="card-footer">
         <?php echo $num['name'];?>
        </div>
      </div>
   
    </div>
<?php }?>


  </div>
</div>
</div>
<!-- venues list end -->





<?php
include 'footer.php'
?>