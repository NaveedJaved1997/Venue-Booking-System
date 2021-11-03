<?php
$page_title = "Cars Details | Online car Booking System";
include 'Header.php';


//Find Current user 
$client = '';
if(!empty($_SESSION["userId"])){
  $client = $_SESSION["userId"];
}

//Book a car
$userRole= "";
if(!empty($_SESSION["userRole"])){
  $userRole= $_SESSION["userRole"];
}
if (isset($_POST['car_id'])) {
  if(empty($_SESSION["userId"])){
    echo ' <div class="page-height">';
    echo '<div class="alert alert-warning alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>ERROR!</b> Please <i>Login Account </i> for booking.</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    </div>';
        echo '<a class="p-3 mt-3" href="./Bookings.php">Return to Booking Page</a>
        </div>';
  }
  else if($userRole!=3){
    echo ' <div class="page-height">';
    echo '<div class="alert alert-warning alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>ERROR!</b> Please <i>Login With A Client Account </i> for booking.</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    </div>';
        echo '<a class="p-3 mt-3" href="./Bookings.php">Return to Booking Page</a>
        </div>';
  
  } 
  
  else{

  
$id = $_POST['car_id'];
$date = $_POST['findcar'];
$details = $_POST['bookingdetails'];
//echo $details;

//Find Vendor
$find = "SELECT * FROM cars WHERE id = '" . $id . "' LIMIT 1 ";
$res = mysqli_query($connection, $find);
$row = mysqli_fetch_assoc($res);
$vendor = $row['vendor_id'];

//check if same date venue exists
$checkquery = "SELECT * FROM bookings WHERE date = '".$date."' AND item = 'car' AND item_id= '".$id."' LIMIT 1";
$checkqueryResults = mysqli_query($connection, $checkquery);
// $test = mysqli_fetch_assoc($checkqueryResults);
// echo $test['id']. "-". $test['date'] . "-" . $test['item']. "-" . $test['item_id'];
if(mysqli_num_rows($checkqueryResults)==1){
  echo '<div class="page-height">';
  echo '<div class="alert alert-warning alert-dismissible fade show mt-2 p-1" role="alert">
  <p class="p-2"><b>ERROR!</b> This Car is already registered for <i> "'.$date.'" </i> Please Change Date.</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
  </div>';
      echo '<a class="p-3 mt-3" href="./Halls.php">Return to Halls Page</a>
      </div>';
}
else{
  $sql = "INSERT INTO bookings (item, details, date, client_id, item_id, vendor_id)
VALUES ('car', '$details', '$date', '$client', '$id', '$vendor')";
$result = mysqli_query($connection,$sql);
//// $booking=array("item"=>"car", "details"=>"$details", "date"=>"$date");
//  $booking['item']="car";
//  $booking['details'] =$details;
//  $booking['date'] = $date;
  if ($result) {
    echo '        <div class="page-height">';
    echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
    
    <p class="p-2"><b>Success!</b> Booking Request has been sent. <i> Thank You!</i></p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        </div>';
        echo '<a class="p-3 mt-3" href="./Index.php">Return Home</a>
         </div>';
         echo "<script>
         setTimeout(function(){
             var url = './Payments.php?item=car&item_id=$id&date=$date';
             $(location).attr('href',url);
         }, 3000);
         </script>";
}
else{
    echo '        <div class="page-height">';
    echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>ERROR!</b> Somehow an <i>Error.</i> occured.</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    </div>';
        echo '<a class="p-3 mt-3" href="./Index.php">Return Home</a>
        </div>';
        echo '<script>
        setTimeout(function(){
            var url = "./Cars.php";
            $(location).attr("href",url);
        }, 3000); 
        </script>';
}
}


}
}

//get car details
        if (isset($_GET['car'])) {
        $cId = mysqli_real_escape_string($connection, $_GET['car']);

        //SELECT cars.id, cars.name, cars.price, cars.car_status FROM cars LEFT JOIN car_status ON cars.car_status= car_status.id

        // $sql2 = "SELECT availability.id, availability.name FROM availability RIGHT JOIN cars ON cars.availability = availability.id WHERE cars.id = '" . $cId . "' ";
        // $res = mysqli_query($connection, $sql2);
        // $status = mysqli_fetch_assoc($res);
       
        $sql = "SELECT * FROM cars WHERE cars.id = '".$cId."' ";
        $result = mysqli_query($connection, $sql);

        while ($num = mysqli_fetch_assoc($result)) {
        // if($res['id'] == $num['car_status']){
        // $tempStatus = $res['id'];
        // }}

?>
<!-- Start Booking Modal -->
<div class="modal fade" id="BookingModal" tabindex="-1" role="dialog" aria-labelledby="BookingModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="BookingModalLabel">New Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="findcarform" action="./ShowCarDetails.php" method="post">
          <input type="hidden" name="car_id" id="car_id" value="<?php echo $num['id'];?>">
          <label for="findcar">Select Date: </label>
          <input class="form-control" type="date" name="findcar" id="findcar" required>
          <label class="pt-1" for="bookingdetails">Enter Details</label>
          <textarea class="form-control" name="bookingdetails" id="bookingdetails" cols="10" rows="1"></textarea>
          <button type="submit" class="btn btn-outline-dark form-control mt-2"
          id="checkcar">Book</button>
      </form>
      <div id="booking-error" class="col card alert-danger mt-2 p-1">
    <p class="p-2"><b>ERROR!</b> Selected Date is <i>Passed.</i> Plese Select Correct New Date.</p>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- End Booking Modal -->
<div class="page-height bg-light">
<div class="container bg-light p-1">
<!-- <div class="row card-header bg-dark text-white mt-1 mb-1 p-3">
<?php echo $num['car_number'];?>
</div> -->
<div class="row">

<div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
<?php 
        //  get image
        // $images = "SELECT * FROM images WHERE id='".$num['image']."' LIMIT 1";
        // $res_image = mysqli_query($connection, $images);
        // $img = mysqli_fetch_assoc($res_image);
        if ($num['image'] >0) {
 
     ?>
        <img class="card-img" src="./Includes/uploads/<?php echo $num['image']; ?>"
        width="250px" height="320px">
     <?php 
    }
    else{

        ?>
<img class="card-img" src="./Includes/media/Default-car.jpg" alt="" srcset="">
<?php }?>
</div>
<div class="col-7 ">
<h3><b></b> <?php echo $num['car_number'];?></h3>
<p><b>Price:</b> <?php echo $num['price'];?></p>

<p><b>Availability</b>: <?php 
if($num['availability']==1){
echo "Pending";
}
else if($num['availability']==2){
  echo "Available";
  }
  else if($num['availability']==3){
    echo "Not Available";
    }
// echo $status['name'];?></p>


<!-- <button class="btn btn-outline-dark" type="submit"
data-toggle="modal" data-target="#BookingModal">Book Now</button>
</div> -->
<?php if($num['availability']==2){
    echo " <a href='./BookCar.php?car=$cId' class='btn btn-outline-dark' >Book Now</a>";
  }
  else {
    echo '<button class="btn btn-outline-dark" >Not Available</button>';
    }
?>


</div>
</div>
<div class="container pt-3">
  <div class="row">
    <div class="col card p-3">
          <!-- <div class="card-header"> -->
          <h3><b></b> <?php echo $num['car_number'];?>'s Description</h3>
          <!-- </div> -->
          <div class="card-body">
          <p><b></b> <?php echo $num['description'];?></p>
          </div>
    </div>
  </div>
</div>

</div>
<?php 
 }
}
include './Rating.php';
include 'Footer.php';
?>