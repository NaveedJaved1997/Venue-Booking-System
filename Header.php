<?php session_start();
include './Includes/db_connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./Includes/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./Includes/font-awesome/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Old+Standard+TT" />
  <link rel="stylesheet" href="./Includes/css/style.css">
  <!-- <link rel="stylesheet" href="style.css"> -->
  <title><?php
          if ($page_title == null || $page_title == '') {
            echo " Online Venue Booking System";
          } else {
            echo $page_title;
          }
          ?>
  </title>
</head>

<body id="Top">

  <!-- Login Modal -->
  <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content shadow-lg">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title" id="LoginModalLabel">Log-in</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="text-white" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="./Login.php" method="post">
            <label for="user_email">Email: </label>
            <input class="form-control" type="email" name="user_email" id="user_email" required>
            <label for="user_pwd">Password</label>
            <input class="form-control" type="password" name="user_pwd" id="user_pwd" required>
            <button type="submit" class="btn btn-outline-dark form-control mt-2">Log-in</button>
            <p class="pt-1">New User <b><a id="register-btn" href="./Register.html" data-toggle="modal" data-target="#RegisterModal">Register</a></b> Here. <b>OR</b> Forgot Password ? <b><a href="./ForgetPassword.php">Click</a></b> Here.</p>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Register Modal -->
  <div class="modal fade" id="RegisterModal" tabindex="-1" role="dialog" aria-labelledby="RegisterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content shadow-lg">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title" id="RegisterModalLabel">Register</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="text-white" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="./Register.php" method="post">
            <label for="user_name">Name: </label>
            <input class="form-control" type="text" name="user_name" id="user_name" required>
            <label for="user_email">Email: </label>
            <input class="form-control" type="email" name="user_email" id="user_email" required>
            <label for="user_pwd">Password</label>
            <input class="form-control" type="password" name="user_pwd" id="user_pwd" required>
            <label for="user_dob">Date of Birth</label>
            <input class="form-control" type="date" name="user_dob" id="user_dob" required>

            <button type="submit" class="btn btn-outline-dark form-control mt-2">Register</button>
            <p class="pt-1">Already Have An Account <b><a id="login-btn" data-toggle="modal" data-target="#LoginModal" href="./Login.html">Log-In</a></b> Here.</p>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- navbar -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
    <a class="navbar-brand" href="./Index.php">
      <img class="logo" src="./Includes/media/logo.png" alt="">
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php
                              if (strpos($page_title, 'Home') !== false) {
                                echo "active";
                              }
                              ?>" href="./Index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link
                  <?php
                  if (strpos($page_title, 'Book Venue') !== false) {
                    echo "active";
                  }
                  ?>" href="./BookVenue.php">Book Venue</a>
        </li>
        <li class="nav-item">
          <a class="nav-link
                  <?php
                  if (strpos($page_title, 'Book A Car') !== false) {
                    echo "active";
                  }
                  ?>" href="./BookCar.php">Book Car</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link
                  <?php
                  if (strpos($page_title, 'Bookings') !== false) {
                    echo "active";
                  }
                  ?>" href="./Bookings.php">Bookings</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link
                  <?php
                  if (strpos($page_title, 'Hall') !== false) {
                    echo "active";
                  }
                  ?>" href="./Halls.php">Halls</a>
        </li>
        <li class="nav-item">
          <a class="nav-link 
                  <?php
                  if (strpos($page_title, 'Cars') !== false) {
                    echo "active";
                  }
                  ?>" href="./Cars.php">Cars</a>
        </li>
        <li class="nav-item">
          <a class="nav-link 
                <?php
                if (strpos($page_title, 'About') !== false) {
                  echo "active";
                }
                ?>" href="./About.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link
                <?php
                if (strpos($page_title, 'Contact') !== false) {
                  echo "active";
                }
                ?>" href="./Contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link 
              <?php
              if (strpos($page_title, 'Vendors') !== false) {
                echo "active";
              }
              ?>" href="./Vendors.php">Vendors</a>
        </li>
      </ul>
      <?php
      //for client
      if (!empty($_SESSION['userRole'])) {
        if ($_SESSION['userRole'] == 3) {
      ?>
          <ul class="navbar-nav mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                echo $_SESSION["userName"];
                ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                <a class="dropdown-item" href="./Dashboard.php">Dashboard</a>
                <a class="dropdown-item" href="./Profile.php">Settings</a>
                <a class="dropdown-item text-danger" href="./Logout.php">Logout</a>
              </div>
            </li>
          </ul>
        <?php
        }
      //fo vendor
      else if ($_SESSION['userRole'] == 2) {
        ?>
          <ul class="navbar-nav mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                echo $_SESSION["userName"];
                ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                <a class="dropdown-item" href="./Vendors/Dashboard.php">Dashboard</a>
                <a class="dropdown-item" href="./Vendors/Profile.php">Settings</a>
                <a class="dropdown-item text-danger" href="./Vendors/Logout.php">Logout</a>
              </div>
            </li>
          </ul>
        <?php
        }
      //for admin
      else if ($_SESSION['userRole'] == 1) {
        ?>
          <ul class="navbar-nav mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                echo $_SESSION["userName"];
                ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                <a class="dropdown-item" href="./Admin/Dashboard.php">Dashboard</a>
                <a class="dropdown-item" href="./Admin/Profile.php">Settings</a>
                <a class="dropdown-item text-danger" href="./Admin/Logout.php">Logout</a>
              </div>
            </li>
          </ul>
      <?php
      } 
    }else {
        echo '<button type="button" class="btn btn-outline-white" data-toggle="modal" data-target="#LoginModal">Log-in</button>';
      }
      ?>
    </div>
  </nav>