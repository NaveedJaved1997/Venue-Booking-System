<?php
$page_title = "Dashboard | Online Venue Booking System";
include'./Dashboard-nav.php';
$logedin_vendor = $_SESSION["userId"];
if((!empty($_SESSION['userId'])) && ($_SESSION['userRole'] == 2)){
?>
<!-- Page content holder -->
<div class="page-content p-3" id="content">
  		<!-- Toggle button -->
  		<button id="sidebarCollapse" type="button" class="btn btn-dark bg-dark rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

  <!-- content -->
  	<h1 class="display-4 text-white">Dashboard</h1>
    <div id="carbon-block"></div>

  		<p class="lead text-white mb-0">Everything at a glanace. <i class="fa fa-smile-o" aria-hidden="true"></i></p>
  	<div class="separator"></div>
	  <div class="container-fluid">
	  </div>
  		<div class="row text-white">
				<div class="col-sm-12 mb-sm-3 col-md-5 p-2 m-md-3 ml-md-5 shadow card bg-danger">
				<p><a class="text-white" href="./CarRequests.php">Car Requests</a></p>
				<?php
				// $find = "SELECT * FROM users WHERE id = '" . $logedin_vendor . "' LIMIT 1 ";
				// $res = mysqli_query($connection, $find);
				// $row = mysqli_fetch_assoc($res);
				//Show cars requests
			$sql = "SELECT COUNT(id) FROM bookings WHERE item='car' AND vendor_id = '" . $logedin_vendor . "'";
			$result = mysqli_query($connection, $sql);
			// $sr=0;
			while ($num = mysqli_fetch_array($result)) {
				//test 2    
				// $sql2 = "SELECT status.id, status.name FROM status RIGHT JOIN bookings ON bookings.status= status.id WHERE bookings.id = '" . $num["id"] . "' ";
				// $res = mysqli_query($connection, $sql2);
				// $status = mysqli_fetch_assoc($res);
			//   $sr++;
					?>
				<p><i class="fa fa-cart-plus fa-2x" aria-hidden="true"></i>
				<span class="float-right"><b><?php echo $num['0']; ?></b></span></p>
				</div>

				<div class="col-sm-12 mb-sm-3 col-md-5 p-2 m-md-3 ml-md-5 shadow card bg-info">
				<p><a class="text-white" href="./VenueRequests.php">Venue Requests</a></p>
				<?php }
				// $find = "SELECT * FROM users WHERE id = '" . $logedin_vendor . "' LIMIT 1 ";
				// $res = mysqli_query($connection, $find);
				// $row = mysqli_fetch_assoc($res);
				//Show Venues
				$sql = "SELECT COUNT(id) FROM bookings WHERE item='venue' AND vendor_id = '" .$logedin_vendor . "'";
				$result = mysqli_query($connection, $sql);
				// $sr=0;
				while ($num = mysqli_fetch_array($result)) {
					//test 2    
					// $sql2 = "SELECT status.id, status.name FROM status RIGHT JOIN bookings ON bookings.status= status.id WHERE bookings.id = '" . $num["id"] . "' ";
					// $res = mysqli_query($connection, $sql2);
					// $status = mysqli_fetch_assoc($res);
					// $sr++;
				?>
				<p><i class="fa fa-cart-plus fa-2x" aria-hidden="true"></i>
				<span class="float-right"><b><?php echo $num['0'];?></b></span></p>
				</div>
				
				<div class="col-sm-12 mb-sm-3 col-md-5 p-2 m-md-3 ml-md-5 shadow card bg-success">
				<p><a class="text-white" href="./Venues.php">Total Venues</a></p>
				<?php }
				//Show Venues
				$sql = "SELECT COUNT(id) FROM venues WHERE vendor_id = '" . $logedin_vendor . "'";
				$result = mysqli_query($connection, $sql);
				// $sr=0;
				while ($num = mysqli_fetch_array($result)) {
				// $sr++;
				?>
				<p><i class="fa fa-h-square fa-2x" aria-hidden="true"></i>
				<span class="float-right"><b><?php echo  $num['0']; ?></b></span></p>
				</div>
				<div class="col-sm-12 mb-sm-3 col-md-5 p-2 m-md-3 ml-md-5 shadow card bg-secondary">
				<p><a class="text-white" href="./Cars.php">Total Cars</a></p>
				<?php }
				//Show Cars
				$sql = "SELECT COUNT(id) FROM cars WHERE vendor_id = '" . $logedin_vendor . "'";
				$result = mysqli_query($connection, $sql);
				// $sr=0;
				while ($num = mysqli_fetch_array($result)) {
				// $sr++;
				?>
				<p><i class="fa fa-car fa-2x" aria-hidden="true"></i>
				<span class="float-right"><b><?php echo  $num['0']; ?></b></span></p>
				</div>
				<?php }?>
  		</div>
</div>
<!-- End content -->
<?php
}
else{
	echo "<div class='container text-white p-3 pt-5'>
	<div class='row'>
	<div class='col-md-6 offset-md-3'>
	<h3><b>ERROR! </b> You Are Not Allowd To View This Page.</h3>
	</div></div></div>";
}
?>