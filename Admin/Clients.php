<?php
$page_title = "Manage Clients | Online Venue Booking System";
include './Dashboard-nav.php';
//Find Current user
$logedin_user = '';
if(!empty($_SESSION["adminid"])){
    $logedin_user = $_SESSION["adminid"];
}
if((!empty($_SESSION['userId'])) && ($_SESSION['userRole'] == 1)){

 //Approve Client
 if (isset($_GET['approvedClientId'])) {
  $approvedClientId = $_GET['approvedClientId'];
  $find = "SELECT * FROM users WHERE  id = $approvedClientId";
  $oldStatus = mysqli_query($connection, $find);
  $findOldStatus = mysqli_fetch_assoc($oldStatus);
  
  if($findOldStatus['status'] ==3){
      echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
      <p class="p-2"><b>ERROR!</b> This <i>Client</i> is Already Rejected.</p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button></div>';
  }
  else if($findOldStatus['status'] ==2){
      echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
      <p class="p-2"><b>ERROR!</b> This <i>Client</i> is Already Approved Cannot Cancel Now.</p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button></div>';
  }
  else if($findOldStatus['status'] ==1){
              // echo '<script> alert("cancel id = "); alert("'.$approvedClientId.'");</script>';
  $sql = "UPDATE users SET status = '2' WHERE  id = $approvedClientId";
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
          //   echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
          //   <p class="p-2"><b>Success!</b> Your Query is sent.<i> Your query will be answered in 48 hours. THANK YOU!</i></p>
          //   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          //   <span aria-hidden="true">&times;</span>
          // </button> </div>';
        // } else {
        //     echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
        //     <p class="p-2"><b>ERROR!</b> Somehow an <i>Error occured.</i></p>
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //     <span aria-hidden="true">&times;</span>
        //   </button></div>';
        

  if($result){
  echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
  <p class="p-2"><b>Success!</b><i> Client .</i> is Approved</p>
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

  //Reject Client
  if (isset($_GET['rejectedClientId'])) {
    $rejectedClientId = $_GET['rejectedClientId'];
    $find = "SELECT * FROM users WHERE  id = $rejectedClientId";
    $oldStatus = mysqli_query($connection, $find);
    $findOldStatus = mysqli_fetch_assoc($oldStatus);
  
    if($findOldStatus['status'] ==3){
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Client</i> is Already Rejected.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['status'] ==2){
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Client</i> is Already Approved Cannot Cancel Now.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['status'] ==1){
                // echo '<script> alert("cancel id = "); alert("'.$rejectedClientId.'");</script>';
    $sql = "UPDATE users SET status = '3' WHERE  id = $rejectedClientId";
    $result = mysqli_query($connection, $sql);
    if($result){
    echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>Success!</b><i> Client</i> is Rejected Successfully.</p>
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

 //Delete Client
 if (isset($_GET['DeleteClientId'])) {
  $DeleteClientId = $_GET['DeleteClientId'];
  $find = "SELECT * FROM users WHERE  id = $DeleteClientId";
  $oldStatus = mysqli_query($connection, $find);
  $findOldStatus = mysqli_fetch_assoc($oldStatus);

  if($findOldStatus['status'] ==1){
      echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
      <p class="p-2"><b>ERROR!</b> This <i>Client</i> is Still in Pending List.</p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button></div>';
  }
  else if($findOldStatus['status'] ==2 || $findOldStatus['status'] ==3){
              // echo '<script> alert("cancel id = "); alert("'.$DeleteClientId.'");</script>';
  $sql = "DELETE FROM users WHERE  id = $DeleteClientId";
  $result = mysqli_query($connection, $sql);
  if($result){
  echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
  <p class="p-2"><b>Success!</b><i> Client</i> is Deleted Successfully.</p>
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


?>
<!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-dark bg-dark rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

    <!-- content -->
    <h1 class="display-4 text-white">Manage Clients</h1>
    <div id="carbon-block"></div>

    <div class="separator"></div>
    <div class="row text-white">
        <div class="col-lg-12">
            <div class="container-fluid">
                <div class="row">
                <div class="card col p-0">
                  <div class="card-header bg-dark">
                  Clients Details
                  </div>
                    <div class="col p-0">
                    <nav class="">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active <?php if (isset($_GET["pending"])) {echo "active";}?>" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-home" aria-selected="true">Pending</a>
    <a class="nav-item nav-link" <?php if (isset($_GET["approved"])) {echo "active";}?>id="nav-approved-tab" data-toggle="tab" href="#nav-approved" role="tab" aria-controls="nav-profile" aria-selected="false">Approved</a>
    <a class="nav-item nav-link" <?php if (isset($_GET["rejected"])) {echo "active";}?>id="nav-rejected-tab" data-toggle="tab" href="#nav-rejected" role="tab" aria-controls="nav-contact" aria-selected="false">Rejected</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active <?php if (isset($_GET["pending"])) {echo "active";}?>" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
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
                                //Pagination set page limt, get page 
              $limit = 7;
              if (isset($_GET["page"])) {
                $page  = $_GET["page"];
              } else {
                $page = 1;
              };
              $start_from = ($page - 1) * $limit;
                    $sql = "SELECT * FROM users WHERE status=1 AND role=3 ORDER BY id ASC LIMIT $start_from, $limit";
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
                              <a class="text-success" id="approvedClientId" name="approvedClientId" type="submit"
                              href="./Clients.php?approvedClientId=<?php echo $num['id']; ?>" onclick="return confirm('Are you sure to Approve ?');">
                              <i class="fa fa-check" aria-hidden="true">Approve</i></a>
                              <a class="text-danger" name="rejectedClientId" id="rejectedClientId" type="submit"
                              href="./Clients.php?rejectedClientId=<?php echo $num['id']; ?>" onclick="return confirm('Do you really want to Reject ?');">
                              <i class="fa fa-times" aria-hidden="true">Reject</i></a>
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
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from users WHERE role=3 AND status=1 ");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
            href='Clients.php?page=" . $i . "'>" . $i . "</a></li>";
        }
        echo $pagLink . "</ul>";
        ?>
         </div>


</div>
  </div>
  <div class="tab-pane fade <?php if (isset($_GET["approved"])) {echo "active";}?>" id="nav-approved" role="tabpanel" aria-labelledby="nav-approved-tab">
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
                    //Show approved users
            //Pagination set page limt, get page 
            $limit = 7;
            if (isset($_GET["page"])) {
              $page  = $_GET["page"];
            } else {
              $page = 1;
            };
            $start_from = ($page - 1) * $limit;

                    $sql = "SELECT * FROM users WHERE status=2 AND role=3 ORDER BY id ASC LIMIT $start_from, $limit";
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
                                <a class="text-danger" id="DeleteClientId" name="DeleteClientId" type="submit"
                                href="./Clients.php?DeleteClientId=<?php echo $num['id']; ?>" onclick="return confirm('Are you sure to Delete this Client ?');" >
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
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from users WHERE role=3 AND status=2 ");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='Clients.php?page=" . $i . "'>" . $i . "</a></li>";
        }
        echo $pagLink . "</ul>";
        ?>
         </div>


</div>
  </div>
  <div class="tab-pane fade <?php if (isset($_GET["rejected"])) {echo "active";}?>" id="nav-rejected" role="tabpanel" aria-labelledby="nav-rejected-tab">
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
                    //Show rejected users
                                //Pagination set page limt, get page 
              $limit = 7;
              if (isset($_GET["page"])) {
                $page  = $_GET["page"];
              } else {
                $page = 1;
              };
              $start_from = ($page - 1) * $limit;
                    $sql = "SELECT * FROM users WHERE status=3 AND role=3 ORDER BY id ASC LIMIT $start_from, $limit";
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
                            <a class="text-danger" id="DeleteClientId" name="DeleteClientId" type="submit"
                                href="./Clients.php?DeleteClientId=<?php echo $num['id']; ?>" onclick="return confirm('Are you sure to Delete this Client ?');" >
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
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from users WHERE role=3 AND status=3 ");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
            href='Clients.php?page=" . $i . "'>" . $i . "</a></li>";
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