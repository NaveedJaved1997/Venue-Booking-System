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
            <a href="./Bookings.php" class="btn btn-outline-white btn-lg">BOOK NOW</a>
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
  <!-- carasole start -->

  <?php 
 $sql = "SELECT * FROM venues WHERE availability=2 ORDER BY `venues`.`id` DESC LIMIT 3";
 $result = mysqli_query($connection, $sql);

 while ($num = mysqli_fetch_assoc($result)) {
   
?>
    
    <?php 
        //rating
        $query = mysqli_query($connection, "SELECT AVG(rating) as AVGRATE from venue_rating WHERE venue_id = '".$num['id']."'");
        $row = mysqli_fetch_array($query);
        $AVGRATE = $row['AVGRATE'];
        //  get image
        $images = "SELECT * FROM images WHERE id='".$num['image']."' LIMIT 1";
        $res_image = mysqli_query($connection, $images);
        $img = mysqli_fetch_assoc($res_image);
        if ($img >0) {
 
    ?>
  <div class="col-sm-12 col-md-12 col-lg-4">
      <div class="card bg-venues-card">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
<div class="carousel-item">
            <img class="d-block w-100 card-img" src="./Includes/uploads/<?php echo $img['name']; ?>"
            width="250px" height="250px">
              <!-- <img class="d-block w-100" src="./Includes/media/1.jpg" alt="First slide"> -->
            </div>
    <?php 
    }
    else{

        ?>
        <div>
    <img class="card-img" src="./Includes/media/Default-venue.jpg" alt="" srcset=""
    width="250px" height="250px">
    </div>
    <?php }?>

    <div class="card-footer">
    <a class="text-dark" href="ShowDetails.php?venue_id=<?php echo $num["id"] ?>"
    type="button"><b><?php echo $num['name'];?></b></a>
    <h6 class="p-1"><b><?php echo round($AVGRATE, 1); ?></b> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i></h6>

    </div>
    </div>
</div>
<?php } ?>



         
<!-- carasole end -->


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