<?php 
// session_start();
Include '../Includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Includes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Includes/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Includes/css/style.css">
    <script src="../Includes/jquery/jquery.min.js"></script> 
    <script src="../Includes/bootstrap/js/bootstrap.min.js"></script>
    <title>Vendors Home Page</title>
</head>
<body id="Top">

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
        <form action="./Login.php" method="post">
          <label for="vendor_email">Email: </label>
          <input class="form-control" type="email" name="vendor_email" id="vendor_email" required>
          <label for="vendor_pwd">Password</label>
          <input class="form-control" type="password" name="vendor_pwd" id="vendor_pwd" required>   
          <button type="submit" class="btn btn-outline-dark form-control mt-2">Log-in</button>
          <p class="pt-1">New vendor <b><a id="vregister-btn" href="./Register.html" data-toggle="modal" data-target="#VRegisterModal">Register</a></b> Here. <b>OR</b> Forgot Password ? <b><a  href="../ForgetPassword.php">Click</a></b> Here.</p>
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
        <form action="./Register.php" method="post">
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

<!-- navbar -->
  <nav class="navbar navbar-expand-sm navbar-light bg-light">
      <a class="navbar-brand" href="#">Vendors Login</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
              <!-- <li class="nav-item active">
                  <a class="nav-link" href="./Index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="./Bookings.php">Bookings</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="./Halls.php">Halls</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="./Cars.php">Cars</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./About.php">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Contact.php">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Vendors.php">Vendors</a>
          </li> -->
          </ul>
          <?php
          if (!empty($_SESSION['vendorname'])) {
          ?>
           <ul class="navbar-nav mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" style="list-style: none;">
                      <?php
                     echo $_SESSION["vendorname"];
                      ?>
                    </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="./Dashboard.php">Dashboard</a>
                    <a class="dropdown-item" href="./Settings.php">Settings</a>
                    <a class="dropdown-item text-danger" href="./Logout.php">Logout</a>
                </div>
            </li>
        </ul>
        <?php
                      }
      else{
          echo '<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#VLoginModal">Log-in</button>';
          }
        ?>
      </div>
  </nav>
