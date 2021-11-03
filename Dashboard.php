<?php
$page_title = "Dashboard | Online Venue Booking System";
include'./Dashboard-nav.php';
$logedin_user = $_SESSION["userId"];
?>
<!-- Page content holder -->
<div class="page-content p-3" id="content">
  		<!-- Toggle button -->
  		<button id="sidebarCollapse" type="button" class="btn btn-dark bg-dark rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

  <!--  content -->
  	<h1 class="display-4 text-white">Dashboard</h1>
    <div id="carbon-block"></div>

  		<p class="lead text-white mb-0">Everything at a glanace. <i class="fa fa-smile-o" aria-hidden="true"></i></p>
  	<div class="separator"></div>
	  <div class="container-fluid">
	  </div>
  		<div class="row text-white">
				<div class="col-sm-12 mb-sm-3 col-md-5 p-2 m-md-3 ml-md-5 shadow card bg-info">
				<p> <a class="text-white" href="./CarRequests.php">Total Requests for Cars</a> </p>
				<?php
				//Show Venues
				$sql = "SELECT * FROM bookings WHERE item='car' AND client_id = '" . $logedin_user . "'";
				$result = mysqli_query($connection, $sql);
				$sr=0;
				while ($num = mysqli_fetch_assoc($result)) {
				$sr++;
				}
				?>
				<p><i class="fa fa-car fa-2x" aria-hidden="true"></i>
				<span class="float-right"><b><?php echo $sr; ?></b></span></p>
				</div>

				<div class="col-sm-12 mb-sm-3 col-md-5 p-2 m-md-3 ml-md-5 shadow card bg-success">
				<p> <a class="text-white" href="./VenueRequests.php">Total Requests for Venues</a> </p>
				<?php
				//Show Venues
				$sql = "SELECT * FROM bookings WHERE item='venue' AND client_id = '" . $logedin_user . "'";
				$result = mysqli_query($connection, $sql);
				$sr=0;
				while ($num = mysqli_fetch_assoc($result)) {
				$sr++;
				}
				?>
				<p><i class="fa fa-h-square fa-2x" aria-hidden="true"></i>
				<span class="float-right"><b><?php echo $sr; ?></b></span></p>
				</div>
  		</div>
</div>

	
<!-- End content -->