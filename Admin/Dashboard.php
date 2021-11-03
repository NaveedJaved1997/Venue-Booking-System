<?php
$page_title = "Dashboard | Online Venue Booking System";
include'./Dashboard-nav.php';
$logedin_admin = '';
if(!empty($logedin_admin)){
	$logedin_admin = $_SESSION["userId"];
}
if((!empty($_SESSION['userId'])) && ($_SESSION['userRole'] == 1)){
	


?>
<!-- Page content holder -->
<div class="page-content p-5" id="content">
  		<!-- Toggle button -->
  		<button id="sidebarCollapse" type="button" class="btn btn-dark bg-dark rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

  <!-- Demo content -->
  	<h1 class="display-4 text-white">Dashboard</h1>
    <div id="carbon-block"></div>

  		<p class="lead text-white mb-0">Everything at a glanace. <i class="fa fa-smile-o" aria-hidden="true"></i></p>
  	<div class="separator"></div>
	  <div class="container-fluid">
	  </div>
  		<div class="row text-white">
				<div class="col-sm-12 mb-sm-3 mb-sm-3 col-md-5 p-2 m-md-3 ml-md-5 shadow card bg-danger">
				<p><a class="text-white" href="./Clients.php">Total Clients</a></p>
				<?php
				$find = "SELECT COUNT(id) FROM users WHERE role=3 ";
				$res = mysqli_query($connection, $find);
				$row = mysqli_fetch_array($res);
				// $sr=0;
			// while ($row = mysqli_fetch_assoc($res)) {

			//   $sr++;
				// }
					?>
				<p><i class="fa fa-users fa-2x" aria-hidden="true"></i>
				<span class="float-right"><b><?php echo $row["0"]; ?></b></span></p>
				</div>

				<div class="col-sm-12 mb-sm-3 col-md-5 p-2 m-md-3 ml-md-5 shadow card bg-info">
				<p><a class="text-white" href="./Vendors.php">Total Vendors</a></p>
				<?php
				$find = "SELECT COUNT(id) FROM users WHERE role=2 ";
				$res = mysqli_query($connection, $find);
				$row = mysqli_fetch_array($res);
			// 	$sr=0;
			// while ($row = mysqli_fetch_assoc($res)) {

			//   $sr++;
			// 	}
					?>				
				<p><i class="fa fa-users fa-2x" aria-hidden="true"></i>
				<span class="float-right"><b><?php echo $row["0"]; ?></b></span></p>
				</div>
				
				<div class="col-sm-12 mb-sm-3 col-md-5 p-2 m-md-3 ml-md-5 shadow card bg-success">
				<p><a class="text-white" href="./Venues.php">Total Venues</a></p>
				<?php
				//Show Venues
				$sql = "SELECT COUNT(id) FROM venues ";
				$res = mysqli_query($connection, $sql);
				$row = mysqli_fetch_array($res);
				// $sr=0;
				// while ($num = mysqli_fetch_assoc($result)) {
				// $sr++;
				// }
				?>
				<p><i class="fa fa-h-square fa-2x" aria-hidden="true"></i>
				<span class="float-right"><b><?php echo $row["0"]; ?></b></span></p>
				</div>
				<div class="col-sm-12 mb-sm-3 col-md-5 p-2 m-md-3 ml-md-5 shadow card bg-secondary">
				<p><a class="text-white" href="./Cars.php">Total Cars</a></p>
				<?php
				//Show Cars
				$sql = "SELECT COUNT(id) FROM cars";
				$res = mysqli_query($connection, $sql);
				$row = mysqli_fetch_array($res);
				// $sr=0;
				// while ($num = mysqli_fetch_assoc($result)) {
				// $sr++;
				// }
				?>
				<p><i class="fa fa-car fa-2x" aria-hidden="true"></i>
				<span class="float-right"><b><?php echo $row["0"]; ?></b></span></p>
				</div>
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