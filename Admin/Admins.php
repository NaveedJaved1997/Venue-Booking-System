<?php
$page_title = "Manage Admins | Online Venue Booking System";
include './Dashboard-nav.php';
//Find Current user
$logedin_user = '';
if(!empty($_SESSION["userID"])){
    $logedin_user = $_SESSION["userID"];
}
if((!empty($_SESSION['userId'])) && ($_SESSION['userRole'] == 1)){
 //Approve user
 if (isset($_GET['approveduserId'])) {
  $approveduserId = $_GET['approveduserId'];
  $find = "SELECT * FROM users WHERE  id = $approveduserId";
  $oldStatus = mysqli_query($connection, $find);
  $findOldStatus = mysqli_fetch_assoc($oldStatus);
  
  if($findOldStatus['status'] ==3){
      echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
      <p class="p-2"><b>ERROR!</b> This <i>user</i> is Already Rejected.</p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button></div>';
  }
  else if($findOldStatus['status'] ==2){
      echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
      <p class="p-2"><b>ERROR!</b> This <i>user</i> is Already Approved Cannot Cancel Now.</p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button></div>';
  }
  else if($findOldStatus['status'] ==1){
              // echo '<script> alert("cancel id = "); alert("'.$approveduserId.'");</script>';
  $sql = "UPDATE users SET status = '2' WHERE  id = $approveduserId";
  $result = mysqli_query($connection, $sql);
        //send email
        $name=$findOldStatus['name'];
        $msg='Your Account is Successfully Approved. Now You Can Sig-in at Online Venue Booking System. THANK YOU!';
        $email=$findOldStatus['email'];
    
        $to = $email;
        $subject = "OVBS: Account Approval.";
        $body = "Hi, $name, $msg.";
        $headers = "From: teamzafhnofficial@gmail.com";
        
        mail($to, $subject, $body, $headers);
  if($result){
  echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
  <p class="p-2"><b>Success!</b><i> user .</i> is Approved</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div>';
  } else {
  // echo '<script> alert("Error Occured"); </script>';
  echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
  <p class="p-2"><b>ERROR!</b> Somehow an <i>Error</i> occured.</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div>';
}
  }
  else{
      echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
  <p class="p-2"><b>ERROR!</b> Somehow an <i>Error</i> occured.</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
  
  </div>';
  }          
}

  //Reject user
  if (isset($_GET['rejecteduserId'])) {
    $rejecteduserId = $_GET['rejecteduserId'];
    $find = "SELECT * FROM users WHERE  id = $rejecteduserId";
    $oldStatus = mysqli_query($connection, $find);
    $findOldStatus = mysqli_fetch_assoc($oldStatus);
  
    if($findOldStatus['status'] ==3){
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>user</i> is Already Rejected.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['status'] ==2){
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>user</i> is Already Approved Cannot Cancel Now.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['status'] ==1){
                // echo '<script> alert("cancel id = "); alert("'.$rejecteduserId.'");</script>';
    $sql = "UPDATE users SET status = '3' WHERE  id = $rejecteduserId";
    $result = mysqli_query($connection, $sql);
    if($result){
    echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>Success!</b><i> user</i> is Rejected Successfully.</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        </div>';
    } else {
    // echo '<script> alert("Error Occured"); </script>';
    echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>ERROR!</b> Somehow an <i>Error</i> occured.</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    
    </div>';
}
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>ERROR!</b> Somehow an <i>Error</i> occured.</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    
    </div>';
    }
            
}

 //Delete user
 if (isset($_GET['DeleteuserId'])) {
  $DeleteuserId = $_GET['DeleteuserId'];
  $find = "SELECT * FROM users WHERE  id = $DeleteuserId";
  $oldStatus = mysqli_query($connection, $find);
  $findOldStatus = mysqli_fetch_assoc($oldStatus);

  if($findOldStatus['status'] ==1){
      echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
      <p class="p-2"><b>ERROR!</b> This <i>user</i> is Still in Pending List.</p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button></div>';
  }
  else if($findOldStatus['status'] ==2 || $findOldStatus['status'] ==3){
              // echo '<script> alert("cancel id = "); alert("'.$DeleteuserId.'");</script>';
 if($DeleteuserId == 1){
  echo '<div class="alert alert-warning alert-dismissible fade show mt-2 p-1" role="alert">
  <p class="p-2"><b>Sorry!</b> This is <i>SuperUser</i> You are not Allowed to Delete It.</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div>';
 }
 else{
  $sql = "DELETE FROM users WHERE  id = $DeleteuserId";
  $result = mysqli_query($connection, $sql);
  if($result){
  echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
  <p class="p-2"><b>Success!</b><i> user</i> is Deleted Successfully.</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
      </div>';
  } else {
  // echo '<script> alert("Error Occured"); </script>';
  echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
  <p class="p-2"><b>ERROR!</b> Somehow an <i>Error</i> occured.</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
  
  </div>';
}   
 }

  }
  else{
      echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
  <p class="p-2"><b>ERROR!</b> Somehow an <i>Error</i> occured.</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
  
  </div>';
  }
          
}


?>
<!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-dark bg-dark rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

    <!-- content -->
    <h1 class="display-4 text-white">Manage Admins</h1>
    <div id="carbon-block"></div>

    <div class="separator"></div>
    <div class="row text-white">
        <div class="col-lg-12">
            <div class="container-fluid">
                <div class="row">
                <div class="card col-12 p-0">
                <div class="card-header bg-dark">
                Manage Admins 
                <a class="text-white" href="" data-toggle="modal" data-target="#AddAdminMondal">[Add New Admin]</a>
                </div>
                <div class="card-body p-0">

                <div class="">
                    <nav class="">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Pending</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Approved</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Rejected</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  <div class="card">
                <table class="table table-bordered">
                <thead class="thead-light text-white">
                    <tr>
                        <th>Sr#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Show Pending requests
                    $limit = 7;
                    if (isset($_GET["page"])) {
                      $page  = $_GET["page"];
                    } else {
                      $page = 1;
                    };
                    $start_from = ($page - 1) * $limit;  
                    $sql = "SELECT * FROM users WHERE status=1 AND role=1 ORDER BY id ASC LIMIT $start_from, $limit";
                    $result = mysqli_query($connection, $sql);
                    $sr=1;
                    if(mysqli_num_rows($result)<1){
                      echo '<tr>
                      <td colspan="5"><b>No Result Found</b></td>
                      </tr>';
                    }
                    
                    else{

                    
                    while ($num = mysqli_fetch_assoc($result)) {
                     
                    ?>
                        <tr>
                            <td><?php echo $sr; ?></td>
                            <td><?php echo $num['name']; ?></td>
                            <td><?php echo $num['email']; ?></td>
                            <td><?php echo $num['date_of_birth']; ?></td>
                            <td>
                              <a class="text-success" id="approveduserId" name="approveduserId" type="submit"
                              href="./Admins.php?approveduserId=<?php echo $num['id']; ?>" onclick="return confirm('Are you sure to Approve ?');">
                              <i class="fa fa-check" aria-hidden="true">Approve</i></a>
                              <a class="text-danger" name="rejecteduserId" id="rejecteduserId" type="submit"
                              href="./Admins.php?rejecteduserId=<?php echo $num['id']; ?>" onclick="return confirm('Do you really want to Reject ?');">
                              <i class="fa fa-times" aria-hidden="true">Reject</i></a>
                             </td>
                        </tr>
                    <?php
                $sr++;    
                }
              }
                    ?>
                </tbody>
            </table>
            <div class="col-12 pt-1">
                    <?php
        //Pagination Print Page Number
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from users WHERE role=1 AND status=1 ");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='Admins.php?page=" . $i . "'>" . $i . "</a></li>";
        }
        echo $pagLink . "</ul>";
        ?>
         </div>
</div>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  <div class="card">
                <table class="table table-bordered">
                <thead class="thead-light text-white">
                    <tr>
                        <th>Sr#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Show users approved requests
                    $limit = 7;
                    if (isset($_GET["page"])) {
                      $page  = $_GET["page"];
                    } else {
                      $page = 1;
                    };
                    $start_from = ($page - 1) * $limit;        
                    $sql = "SELECT * FROM users WHERE status=2 AND role=1 ORDER BY id ASC LIMIT $start_from, $limit";
                    $result = mysqli_query($connection, $sql);
                    $sr=1;
                    if(mysqli_num_rows($result)<=0){
                      echo '<tr>
                      <td colspan="5"><b>No Result Found</b></td>
                      </tr>';
                    }
                    
                    else{
                    while ($num = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $sr; ?></td>
                            <td><?php echo $num['name']; ?></td>
                            <td><?php echo $num['email']; ?></td>
                            <td><?php echo $num['date_of_birth']; ?></td>
                            <td>
                                <a class="text-danger" id="DeleteuserId" name="DeleteuserId" type="submit"
                                href="./Admins.php?DeleteuserId=<?php echo $num['id']; ?>" onclick="return confirm('Are you sure to Delete this user ?');" >
                                <i class="fa fa-trash" aria-hidden="true"> Delete</i>
                                 </a>
                            </td>
                        </tr>
                    <?php
                $sr++;    
                }
              }
                    ?>
                </tbody>
            </table>
            <div class="col-12 pt-1">
                    <?php
        //Pagination Print Page Number
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from users WHERE role=1 AND status=2 ");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='Admins.php?page=" . $i . "'>" . $i . "</a></li>";
        }
        echo $pagLink . "</ul>";
        ?>
         </div>
</div>
  </div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  <div class="card">
                <table class="table table-bordered">
                <thead class="thead-light text-white">
                    <tr>
                        <th>Sr#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Show users rejected requests
                    $limit = 7;
                    if (isset($_GET["page"])) {
                      $page  = $_GET["page"];
                    } else {
                      $page = 1;
                    };
                    $start_from = ($page - 1) * $limit;
                    $sql = "SELECT * FROM users WHERE status=3 AND role=1 ORDER BY id ASC LIMIT $start_from, $limit";
                    $result = mysqli_query($connection, $sql);
                    $sr=1;
                    if(mysqli_num_rows($result)<1){
                      echo '<tr>
                      <td colspan="5"><b>No Result Found</b></td>
                      </tr>';
                    }
                    else{

                    
                    while ($num = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $sr; ?></td>
                            <td><?php echo $num['name']; ?></td>
                            <td><?php echo $num['email']; ?></td>
                            <td><?php echo $num['date_of_birth']; ?></td>
                            <td>
                            <a class="text-danger" id="DeleteuserId" name="DeleteuserId" type="submit"
                                href="./Admins.php?DeleteuserId=<?php echo $num['id']; ?>" onclick="return confirm('Are you sure to Delete this user ?');" >
                                <i class="fa fa-trash" aria-hidden="true"> Delete</i>
                                 </a>
                            </td>
                        </tr>
                    <?php
                $sr++;    
                }}
                    ?>
                </tbody>
            </table>
            <div class="col-12 pt-1">
                    <?php
        //Pagination Print Page Number
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from users WHERE role=1 AND status=3 ");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='Admins.php?page=" . $i . "'>" . $i . "</a></li>";
        }
        echo $pagLink . "</ul>";
        ?>
         </div>
</div>
  </div>
</div>
                    </div>

                </div>
                </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
    <!-- Add Admin Modal -->
    <div class="modal fade" id="AddAdminMondal" tabindex="-1" role="dialog" aria-labelledby="AddAdminMondal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="ChangePasswordModalLabel">Add New Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="AddNewAdmin.php" method="post" id="AddAdminMondal" enctype="multipart/form-data">
                        <!-- <input class="form-control" type="hidden" name="user_id" id="user_id"> -->
                        <label for="admin_name">Name: </label>
                        <input class="form-control" type="text" name="admin_name" id="admin_name" 
                        placeholder="Enter Admin Name" required>
                        <label for="admin_email">Email: </label>
                        <input class="form-control" type="email" name="admin_email" id="admin_email" 
                        placeholder="Enter Admin Email" required>
                        <label for="admin_pwd">Password</label>
                        <input class="form-control" type="password" name="admin_pwd" id="admin_pwd" 
                        placeholder="Enter Admin Password" required>   
                        <label for="admin_dob">Date of Birth</label>
                        <input class="form-control" type="date" name="admin_dob" id="admin_dob" 
                        placeholder="Enter Admin Date of Birth" required>
                        <button id="add_car_btn" type="submit" class="btn btn-outline-dark form-control mt-2">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Add Admin Modal -->
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