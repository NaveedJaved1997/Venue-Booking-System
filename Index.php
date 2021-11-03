<?php
 $page_title = "Home | Online Venue Booking System";
include 'Header.php';

?>
<!-- Body -->
<!-- Header -->
<header id="header">
  <div class="intro">
    <div class="overlay">
      <div class="container">
        <div class="">
          <div class="intro-text">
            <h1>OVBS</h1>
            <p>Easy Booking For Venues</p>
            <a href="./BookVenue.php" class="btn btn-outline-white btn-lg">BOOK NOW</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- venues list start -->
<div class="container-fluid bg-venues pt-1 pb-5">
<div class="container">
<div class="">
  <h3 class="venues-head">Recent Listed Halls</h3>
</div>
<div class="row">
  <?php 
 $sql = "SELECT * FROM venues WHERE availability=2 ORDER BY venues.availability DESC LIMIT 3";
 $result = mysqli_query($connection, $sql);

 while ($num = mysqli_fetch_assoc($result)) {

 
?>
    <div class="col-sm-12 col-md-12 col-lg-4 ">
      <div class="card bg-venues-card">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
            <?php 
               
        //rating
        $query = mysqli_query($connection, "SELECT AVG(rating) as AVGRATE from reviews WHERE item='venue' AND item_id = '".$num['id']."'");
        $row = mysqli_fetch_array($query);
        $AVGRATE = $row['AVGRATE'];

            //  get image
        // $images = "SELECT * FROM images WHERE id='".$num['image']."' LIMIT 1";
        // $res_image = mysqli_query($connection, $images);
        // $img = mysqli_fetch_assoc($res_image);
        if ($num['image'] >0) {
        
        ?>
        <img class="card-img" src="./Includes/uploads/<?php echo $num['image']; ?>"
    width="250px" height="250px">
    <?php }?>
              <!-- <img class="d-block w-100" src="./Includes/media/1.jpg" alt="First slide"> -->
            </div>
            <?php 
            //  get main image
        $findimage = "SELECT * FROM reviews WHERE item='venue' AND item_id='".$num['id']."'";
        $res_imageId = mysqli_query($connection, $findimage);
        // $img_array = mysqli_fetch_assoc($res_images);
        $i = 0;
        while($img_ids = mysqli_fetch_assoc($res_imageId)) {
        
            // get review images
            // $image = "SELECT * FROM images WHERE  id='".$img_ids['image_id']."'";
            // $res_images = mysqli_query($connection, $image);
            // $img_array = mysqli_fetch_assoc($res_images);
            // while($img_array = mysqli_fetch_assoc($res_images)) {}

            if(($img_ids['image'] >0) && ($i <3)){
            
            
        ?>

            <div class="carousel-item">
            <img class="card-img" src="./Includes/uploads/<?php echo $img_ids['image']; ?>"
            width="250px" height="250px" alt="The image: <?php echo $img_ids['image']; ?> not available">
            </div>

            <!-- <div class="carousel-item">
              <img class="d-block w-100" src="./Includes/media/3.jpg" alt="Third slide">
            </div> -->
            <?php $i++; } }?>
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
         <a class="text-dark" href="./ShowDetails.php?venue=<?php echo $num['id'];?>"><?php echo $num['name'];?></a>
         <h6 class="p-1">Rating: <b><?php echo round($AVGRATE, 1); ?></b> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i></h6>
        </div>
      </div>
   
    </div>
<?php }?>


  </div>
  </div>
</div>
</div>
<!-- venues list end -->

<!-- Contact us -->
<div class="bg-light">
<div class="container bg-light pt-1 pb-3 text-center contact-container">
<h3 class="venues-head">Contact Us</h3>
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-4">
<span> <i class="fa fa-map-marker"></i> Sheikhupura Stadium, Punjab, Pakistan</span>&emsp;              
</div>  

<div class="col-sm-12 col-md-12 col-lg-4">
<span><i class="fa fa-phone"></i> +92 345 123 4567</span>&emsp;
</div>

<div class="col-sm-12 col-md-12 col-lg-4">
<span>  <i class="fa fa-envelope"></i> contact@ovbs.com</span>
</div>
</div>

</div>          
</div>
<?php
include 'Footer.php';
?>