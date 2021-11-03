<?php
// if(isset($_GET['date'])){
//   $date = $_GET['date'];
// }
// //set cookie
// $cookieName = 'CancelBooking';
// $cookieValue = $date; 
// setcookie($cookieName, $cookieValue, time() + (86400), "/"); // 86400 = 1 day

$page_title = "Book A Car | Online Venue Booking System";

include './Header.php';
$userRole= "";
if(!empty($_SESSION["userRole"])){
  $userRole= $_SESSION["userRole"];
}
    // $connection  = new mysqli('localhost', 'root', '', 'test_database');
if(isset($_GET['date'])){
    $date = $_GET['date'];
    $car = $_GET['car'];
    $stmt = $connection ->prepare("select * from bookings where date = ? AND item_id = ?");
    $stmt->bind_param('ss', $date, $car);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['timeslot'];
            }
            $stmt->close();
        }
    }
}
if(isset($_GET['date'])){
    $date = $_GET['date'];
}

//Find Current user 
$client = '';
if(!empty($_SESSION["userId"])){
  $client = $_SESSION["userId"];
}

if(isset($_POST['submit'])){
    $client = $client;
    $vendor = $_POST['vendor_id'];
    $timeslot = $_POST['timeslot'];
    $car = $_POST['car'];

    $stmt = $connection ->prepare("select * from bookings where date = ? AND timeslot=? AND item_id = ?");
    $stmt->bind_param('ssi', $date, $timeslot, $car);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            $msg = "<div class='alert alert-danger'>Already Booked</div>";
        }else{
            // $stmt = $connection ->prepare("INSERT INTO bookings (timeslot, date, item, item_id, vendor_id, client_id)
            // VALUES (?,?,?,?,?,?)");
            // $stmt->bind_param('sssiii', $timeslot, $date, 'car', $car , $vendor, $client);
            // $stmt->execute();
            // $msg = "<div class='alert alert-success'>Booking Successfull</div>";
            // $bookings[] = $timeslot;
            // $stmt->close();
            // $connection ->close();

            //checkk if the user is loged in
            if(empty($_SESSION["userId"])){
                echo ' <div class="page-height">';
                echo '<div class="alert alert-warning alert-dismissible fade show mt-2 p-1" role="alert">
                <p class="p-2"><b>ERROR!</b> Please <i>Login Account </i> for booking.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>';
                    echo '<a class="p-3 mt-3" href="./BookCar.php">Return to Booking Page</a>
                    </div>';
              }
              //check if the user is client
              else if($userRole!=3){
                     echo ' <div class="page-height">';
                  echo '<div class="alert alert-warning alert-dismissible fade show mt-2 p-1" role="alert">
                  <p class="p-2"><b>ERROR!</b> Please <i>Login With A Client Account </i> for booking.</p>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                  </div>';
                      echo '<a class="p-3 mt-3" href="./BookCar.php">Return to Booking Page</a>
                      </div>';  
              } else{
                  // datestamp
                  date_default_timezone_set("Asia/Karachi");
                  $day = date('d');
                  $month = date('m');
                  $year = date('Y');
                  $h = date('H');
                  $m = date('i');
                  $s = date('s');
                  $temp=mktime($h, $m, $s, $month, $day+1, $year);
                  $var = date("Y-m-d H:i:s", $temp);
                  //insert query
                  $sql = "INSERT INTO bookings (item, date, client_id, item_id, vendor_id, timeslot, booked_on)
                  VALUES ('car', '$date', '$client', '$car', '$vendor', '$timeslot', '$var')";
                  $result = mysqli_query($connection,$sql);
                  // echo 'C: '.$client .'V: ' .$vendor.'T:' .$timeslot. 'D:' . $date. 'Ven'. $car;
                  if ($result) {
                    $bookings[] = $timeslot;
                      
                    echo '        <div class="page-height">';
                          echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
                          
                          <p class="p-2"><b>Success!</b> Booking Request has been sent. <i></i></p>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                              </div>';
                              echo '<a class="p-3 mt-3" href="./Index.php">Return Home</a>
                              </div>';
                              echo "<script>
                              setTimeout(function(){
                                  var url = './Payments.php?item=car&item_id=$car&date=$date&timeslot=$timeslot';
                                  $(location).attr('href',url);
                              }, 3000); 
                              </script>";
                  }
                  else{
                          echo '<div class="page-height">';
                          echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
                          <p class="p-2"><b>ERROR!</b> Somehow an <i>Error.</i> occured.</p>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                          </div>';
                              echo '<a class="p-3 mt-3" href="./Index.php">Return Home</a>
                              </div>';
                  }
              }


        }
    }
}


$duration = 720;
$cleanup = 0;
$start = "09:00";
$end = "21:00";

function timeslots($duration, $cleanup, $start, $end){
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();
    
    for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval)){
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if($endPeriod>$end){
            break;
        }
        
        $slots[] = $intStart->format("g:iA")." - ". $endPeriod->format("g:iA");
        
    }
    
    return $slots;
}
?>

<!-- <!doctype html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title> -->

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css"> -->
  <!-- </head> -->

  <body>
    <div class="container mt-3">
        <h3 class="text-center">Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h3><hr>
        <div class="row">
<div class="col-md-12">
   <?php echo(isset($msg))?$msg:""; ?>
</div>
<!-- <?php $timeslots = timeslots($duration, $cleanup, $start, $end); 
    foreach($timeslots as $ts){
?>
<div class="col-4 offset-2">
    <div class="form-group">
       <?php if(in_array($ts, $bookings)){ ?>
       <button class="btn btn-danger"><?php echo $ts; ?></button>
       <?php }else{ ?>
       <button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
       <?php }  ?>
    </div>
</div>
<?php } ?> -->
</div>
    </div>

    <!-- modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Booking for: <span id="slot"></span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <?php 
                $query = "SELECT vendor_id FROM cars WHERE id = '".$car."' LIMIT 1";
                $res = mysqli_query($connection, $query);
                $vendor = mysqli_fetch_assoc($res);
                ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                            <input type="hidden" name="car" value="<?php echo $_GET['car'];?>">
                            <input type="hidden" name="vendor_id" value="<?php echo $vendor['vendor_id'];?>">
                            
                            <div class="form-group">
                                    <label for="">Date</label>
                                    <input readonly type="text" class="form-control" id="date" name="date" value="<?php echo date('m/d/Y', strtotime($date)); ?>">
                                </div>
                               <div class="form-group">
                                    <label for="">Time Slot</label>
                                    <input readonly type="text" class="form-control" id="timeslot" name="timeslot">
                                </div>

                                <!-- <div class="form-group">
                                    <label for="">Name</label>
                                    <input required type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input required type="email" class="form-control" name="email">
                                </div> -->
                                <div class="form-group pull-right">
                                    <button name="submit" type="submit" class="btn btn-success">Book</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </div>

        <!-- car data here -->
        <?php




//Book a hall
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
        echo '<a class="p-3 mt-3" href="./BookCar.php">Return to Booking Page</a>
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
          echo '<a class="p-3 mt-3" href="./BookCenue.php">Return to Booking Page</a>
          </div>';  
  }

  else {
$id = $_POST['car_id'];
$date = $_POST['findcar'];
$details = $_POST['bookingdetails'];
//echo $details;

//Find Vendor
$find = "SELECT * FROM cars WHERE id = '" . $id . "' LIMIT 1 ";
$res = mysqli_query($connection, $find);
$row = mysqli_fetch_assoc($res);
$vendor = $row['vendor_id'];

//check if same date car exists
$checkquery = "SELECT * FROM bookings WHERE date = '".$date."' AND item = 'car' AND item_id= '".$id."' LIMIT 1";
$checkqueryResults = mysqli_query($connection, $checkquery);
// $test = mysqli_fetch_assoc($checkqueryResults);
// echo $test['id']. "-". $test['date'] . "-" . $test['item']. "-" . $test['item_id'];
if(mysqli_num_rows($checkqueryResults)==1){
  echo '<div class="page-height">';
  echo '<div class="alert alert-warning alert-dismissible fade show mt-2 p-1" role="alert">
  <p class="p-2"><b>ERROR!</b> This car is already registered for <i> "'.$date.'" </i> Please Change Date.</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
  </div>';
      echo '<a class="p-3 mt-3" href="./Halls.php">Return to Halls Page</a>
      </div>';
} 
else{
//insert query
$sql = "INSERT INTO bookings (item, details, date, client_id, item_id, vendor_id)
VALUES ('car', '$details', '$date', '$client', '$id', '$vendor')";
$result = mysqli_query($connection,$sql);
if ($result) {
        echo '        <div class="page-height">';
        echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
        
        <p class="p-2"><b>Success!</b> Booking Request has been sent. <i></i></p>
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
        echo '<div class="page-height">';
        echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> Somehow an <i>Error.</i> occured.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        </div>';
            echo '<a class="p-3 mt-3" href="./Index.php">Return Home</a>
            </div>';
}
}

}
}


//get hall details
        if (isset($_GET['car'])) {
        $vid = mysqli_real_escape_string($connection, $_GET['car']);
        @$vdate =  mysqli_real_escape_string($connection, $_GET['date']);
        //SELECT cars.id, cars.name, cars.price, cars.car_status FROM cars LEFT JOIN car_status ON cars.car_status= car_status.id

        // $sql2 = "SELECT availability.id, availability.name FROM availability RIGHT JOIN cars ON cars.availability = availability.id WHERE cars.id = '" . $vid . "' ";
        // $res = mysqli_query($connection, $sql2);
        // $status = mysqli_fetch_assoc($res);
       
        $sql = "SELECT * FROM cars WHERE cars.id = '".$vid."' ";
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
        <form id="findcarform" action="./ShowDetails.php" method="post">
          <input type="hidden" name="car_id" id="car_id" value="<?php echo $num['id'];?>">
          <label for="findcar">Select Date: </label>
          <input class="form-control" type="date" name="findcar" id="findcar" required value="<?php echo $vdate?>">
          <label class="pt-1" for="bookingdetails">Enter Details</label>
          <textarea class="form-control" name="bookingdetails" id="bookingdetails" cols="10" rows="1"></textarea>
          <button type="submit" class="btn btn-outline-dark form-control mt-2"
          id="checkcar">Add Book</button>
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
<?php echo $num['name'];?>
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
// echo $status['name'];
?></p>
<!-- <p><b>Address</b>: <?php echo $num['address'];?> </p> -->


<!-- <button class="btn btn-outline-dark" type="submit"
data-toggle="modal" data-target="#BookingModal">Book Now</button> -->
<p><b>Slots: </b> </p>
<?php $timeslots = timeslots($duration, $cleanup, $start, $end); 
    foreach($timeslots as $ts){
?>
<div class="col">
    <div class="form-group">
       <?php if(in_array($ts, $bookings)){ ?>
       <button class="btn btn-danger"><?php echo $ts; ?></button>
       <?php }else{ ?>
       <button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
       <?php }  ?>
    </div>
</div>
<?php } ?>

</div>


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
 }}
 include './Rating.php';

?>
        <!-- car data here -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
    <script>
$(".book").click(function(){
    var timeslot = $(this).attr('data-timeslot');
    $("#slot").html(timeslot);
    $("#timeslot").val(timeslot);
    $("#myModal").modal("show");
});
</script>  
</body>

</html>

<?php include './Footer.php';?>