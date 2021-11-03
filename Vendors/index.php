<?php
session_start();
if(!empty($_SESSION["vendorid"])){
     header('location:./Dashboard.php');
    // echo '<script>
    // setTimeout(function(){
    //     var url = "Dashboard.php";
    //     $(location).attr("href",url);
    // }, 3000); 
    // </script>';
    echo 'test sucess';
    }
else{
    //  header('location:./index.php');
}
$page_title = "Vendors | Online Venue Booking System";
// include '../Includes/db_connect.php';
include 'header.php';

?>
<div class="page-height">


    <div class="container pb-3">
        <h3 class="venues-head">Register with Us</h3>
        <p class="text-center">Reister Your Halls With Us and Make Your Business Done By Just Clicking. </p>
        <p class="text-center">
        <a href="" id="vlogin-btn"  type="button" class="" data-toggle="modal" data-target="#VLoginModal">Sign-In</a> or
        <a href="" id="vregister-btn" href="./Register.html" data-toggle="modal" data-target="#VRegisterModal">Register</a>
        </p>
    </div>

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
          <p>New vendor <b><a id="vregister-btn" href="./Register.html" data-toggle="modal" data-target="#VRegisterModal">Register</a></b> Here.</p>
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
</div>
<?php include '../Footer.php'; ?>