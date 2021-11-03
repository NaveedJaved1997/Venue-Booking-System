<?php
session_start();
include'../Includes/db_connect.php';
?>
<!Doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>
	<?php 
    if($page_title==null || $page_title ==''){
      echo " Online Venue Booking System";
    }
    else{
      echo $page_title;
    }
    ?></title>

<link rel="stylesheet" href="../Includes/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../Includes/css/core.css">
    <link rel="stylesheet" href="../Includes/bootstrap/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
	<script src="../Includes/bootstrap/js/bootstrap.min.js"></script>
    <script src="../Includes/js/core.js"></script>
</head>
<body>

	<!-- Vertical navbar -->
	<div class="vertical-nav bg-dark" id="sidebar">
  		<div class="py-4 px-3 mb-4 bg-dark">
      		<div class="media-body">
        		<h4 class="font-weight-white text-white mb-0">WELLCOME</h4>
        		<h5 class="font-weight-grey text-white mb-0">
				<?php 
				if(!empty($_SESSION["userId"])){
				echo $_SESSION["userName"];
				}
 ?>
</h5>
      		</div>
  		</div>


  		<ul class="nav flex-column bg-dark mb-0">
		  <li class="nav-item">
      			<a href="../Index.php" class="nav-link text-light font-italic bg-dark">
                	<i class="fa fa-home mr-3 text-primary fa-fw"></i>
                		Home
            	</a>
    		</li>	
		  <li class="nav-item">
      			<a href="./Dashboard.php" class="nav-link text-light font-italic bg-dark">
                	<i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                		Dashboard
            	</a>
    		</li>
        <li class="nav-item">
            <a href="./Venues.php" class="nav-link text-light font-italic">
                  <i class="fa fa-h-square mr-3 text-primary fa-fw"></i>
                  Manage Venues
              </a>
        </li>
        <li class="nav-item">
            <a href="./Cars.php" class="nav-link text-light font-italic">
                  <i class="fa fa-car mr-3 text-primary fa-fw"></i>
                  Manage Cars
              </a>
        </li>
		<li class="nav-item">
            <a href="./VenueRequests.php" class="nav-link text-light font-italic">
                  <i class="fa fa-calendar-check-o mr-3 text-primary fa-fw"></i>
                  Manage Venue Requests
              </a>
       		 </li>
		<li class="nav-item">
            <a href="./CarRequests.php" class="nav-link text-light font-italic">
                  <i class="fa fa-calendar-check-o mr-3 text-primary fa-fw"></i>
                  Manage Car Requests
              </a>
       		 </li>
    		<li class="nav-item">
      			<a href="./Profile.php" class="nav-link text-light font-italic">
                	<i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                	Profile
            	</a>
    		</li>
    		<li class="nav-item">
      			<a href="./ChnagePassword.php" class="nav-link text-light font-italic">
                	<i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                	Change Password
            	</a>
    		</li>
    		<li class="nav-item">
      			<a href="./Logout.php" class="nav-link text-light font-italic">
                	<i class="fa fa-sign-out mr-3 text-primary fa-fw"></i>
                	Logout
            	</a>
    		</li>
  		</ul>
	</div>
<!-- End vertical navbar -->
