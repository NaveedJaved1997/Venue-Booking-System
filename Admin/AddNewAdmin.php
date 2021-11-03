<?php
$page_title = "Add New Admin | Online Venue Booking System";
require '../Includes/db_connect.php';
include './Dashboard-nav.php';
if (isset($_POST['admin_name'])) {
	
	$uname = mysqli_real_escape_string($connection ,$_POST['admin_name']);
	$uemail = mysqli_real_escape_string($connection ,$_POST['admin_email']);
	$upwd = mysqli_real_escape_string($connection ,$_POST['admin_pwd']);
	$udob = mysqli_real_escape_string($connection ,$_POST['admin_dob']);
		//Check for email:
      $checkQuery = "SELECT email FROM users WHERE email= '".$uemail."'";
      $checkQueryResult=mysqli_query($connection, $checkQuery);
      $checkQueryrow = mysqli_fetch_assoc($checkQueryResult);
      if($checkQueryrow){
        echo '        <div class="page-height">';
        echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR! </b>This Email is <i>Already Registered.</i></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
          </div>';
          echo '</div>';
          echo '<script>
          setTimeout(function(){
              var url = "./Admins.php";
              $(location).attr("href",url);
          }, 3000); 
          </script>';
      }
      else{
        $sql = "INSERT INTO users (name, email, password, date_of_birth, status, role)
        VALUES ('$uname', '$uemail', '$upwd', '$udob', 1, 1)";
        $result = mysqli_query($connection,$sql);
        if ($result) {
              echo '        <div class="page-height">';
            echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>Success!</b><i> New Admin : "'.$uname.'"</i> is Added Successfully.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div></div>';
      echo '<script>
                  setTimeout(function(){
                      var url = "./Admins.php";
                      $(location).attr("href",url);
                  }, 3000); 
                  </script>';
        }
        else{
              echo '        <div class="page-height">';
            echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> Somehow an <i>Error</i> is occured.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div></div>';
      echo '<script>
                  setTimeout(function(){
                      var url = "./Admins.php";
                      $(location).attr("href",url);
                  }, 3000); 
                  </script>';
        }
      }
	}
