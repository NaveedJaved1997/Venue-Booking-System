<?php
$page_title = "Manage Venues | Online Venue Booking System";
include './Dashboard-nav.php';
//Find Current user
$logedin_vendor = $_SESSION["userId"];
if((!empty($_SESSION['userId'])) && ($_SESSION['userRole'] == 1)){
 //Approve Venue
 if (isset($_GET['approvedVenueId'])) {
    $approvedVenueId = $_GET['approvedVenueId'];
    $find = "SELECT * FROM venues WHERE  id = $approvedVenueId";
    $oldStatus = mysqli_query($connection, $find);
    $findOldStatus = mysqli_fetch_assoc($oldStatus);

    //find vendor details
    $sql = "SELECT * FROM users WHERE role=2 AND id= '".$findOldStatus['vendor_id']."' LIMIT 1";
    $res = mysqli_query($connection, $sql);
    $vendor = mysqli_fetch_assoc($res);
    
    if($findOldStatus['venue_status'] ==3){
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Venue</i> is Already Rejected.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['venue_status'] ==2){
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Venue</i> is Already Approved.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['venue_status'] ==1){
    $sql = "UPDATE venues SET venue_status = '2' WHERE  id = $approvedVenueId";
    $result = mysqli_query($connection, $sql);
    if($result){
            //send email
            $name=$vendor['name'];
            $msg='Your Venue is Successfully Approved. Now You Can Sig-in at Online Venue Booking System and Start Work. BEST WISHES. THANK YOU! for Choosing Us.';
            $email=$vendor['email'];
        
            $to = $email;
            $subject = "OVBS: Venue Approval.";
            $body = "Hi, $name, $msg.";
            $headers = "From: teamzafhnofficial@gmail.com";
            
            mail($to, $subject, $body, $headers);

    echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>Success!</b><i> Venue .</i> is Approved</p>
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
  
    //Reject Venue
    if (isset($_GET['rejectedVenueId'])) {
      $rejectedVenueId = $_GET['rejectedVenueId'];
      $find = "SELECT * FROM venues WHERE  id = $rejectedVenueId";
      $oldStatus = mysqli_query($connection, $find);
      $findOldStatus = mysqli_fetch_assoc($oldStatus);
    
      if($findOldStatus['venue_status'] ==3){
          echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
          <p class="p-2"><b>ERROR!</b> This <i>Venue</i> is Already Rejected.</p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>';
      }
      else if($findOldStatus['venue_status'] ==2){
          echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
          <p class="p-2"><b>ERROR!</b> This <i>Venue</i> is Already Approved Cannot Reject Now.</p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>';
      }
      else if($findOldStatus['venue_status'] ==1){
      $sql = "UPDATE venues SET venue_status = '3' WHERE  id = $rejectedVenueId";
      $result = mysqli_query($connection, $sql);
      if($result){
      echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
      <p class="p-2"><b>Success!</b><i> Venue</i> is Rejected Successfully.</p>
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
 if (isset($_GET['deleteVenueId'])) {
    $deleteVenueId = $_GET['deleteVenueId'];
    $find = "SELECT * FROM venues WHERE  id = $deleteVenueId";
    $oldStatus = mysqli_query($connection, $find);
    $findOldStatus = mysqli_fetch_assoc($oldStatus);
  
    if($findOldStatus['venue_status'] ==1){
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Venue </i> is Still in Pending List.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['venue_status'] ==2 || $findOldStatus['venue_status'] ==3){
    $sql = "DELETE FROM venues WHERE  id = $deleteVenueId";
    $result = mysqli_query($connection, $sql);
    if($result){
    echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>Success!</b><i> Venue </i> is Deleted Successfully.</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        </div>';
    } else {
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
    <h1 class="display-4 text-white">Manage Venues</h1>
    <div id="carbon-block"></div>

    <div class="separator"></div>

    <div class="row text-white">
        <div class="col-lg-12">
            <div class="container-fluid">
                <div class="row">
                <div class="card col p-0">
                  <div class="card-header bg-dark">
                  Venues Details
                  </div>
                    <div class="col p-0">
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
                <th>Address</th>
                <th>Description</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php
            //Show Venues
             //Pagination set page limt, get page 
             $limit = 7;
             if (isset($_GET["page"])) {
               $page  = $_GET["page"];
             } else {
               $page = 1;
             };
             $start_from = ($page - 1) * $limit;
            $sql = "SELECT * FROM venues WHERE venue_status=1 ORDER BY id ASC LIMIT $start_from, $limit";
            $result = mysqli_query($connection, $sql);

            //pagination test
            // $query= "SELECT * FROM venues";
            // $queryResults=mysqli_query($connection, $query);
            // $totalRecords = mysqli_num_rows($queryResults);
            // $pageCount= ceil(($totalRecords/6));

            $sr=1;
            while ($num = mysqli_fetch_assoc($result)) {
                //test 2    
                // $sql2 = "SELECT status.id, status.name FROM status RIGHT JOIN venues ON venues.venue_status= status.id WHERE venues.id = '" . $num["id"] . "' ";
                // $res = mysqli_query($connection, $sql2);
                // $status = mysqli_fetch_assoc($res);
                
            ?>
                <tr>
                    <td><?php echo $sr;?></td>
                    <td><?php echo $num['name']; ?></td>
                    <td><?php echo $num['address']; ?></td>
                    <td><?php echo $num['description']; ?></td>
                    <td><?php echo $num['price']; ?></td>
                    <td><?php
                     if($num['venue_status']==1){
                      echo "Pending";
                      }
                      else if($num['venue_status']==2){
                          echo "Approved";
                          }
                      else if($num['venue_status']==3){
                          echo "Rejected";
                          }
                      else if($num['venue_status']==4){
                              echo "Cancelled";
                              }
                    //  echo $status['name']; ?></td>
                    <td>
                    <a class="text-success" id="approvedVenueId" name="approvedVenueId" type="submit"
                    href="./Venues.php?approvedVenueId=<?php echo $num['id']; ?>" onclick="return confirm('Are you sure to Approve ?');">
                    <i class="fa fa-check" aria-hidden="true">Approve</i></a>
                    <a class="text-danger" name="rejectedVenueId" id="rejectedVenueId" type="submit"
                    href="./Venues.php?rejectedVenueId=<?php echo $num['id']; ?>" onclick="return confirm('Do you really want to Reject ?');">
                    <i class="fa fa-times" aria-hidden="true">Reject</i></a>
                    </td>

                </tr>
            <?php
            $sr++;
            }
            ?>
        </tbody>
    </table>
             <div class="col-12 pt-1">
         <?php
        //Pagination Print Page Number
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from venues WHERE venue_status=1");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='Venues.php?page=" . $i . "'>" . $i . "</a></li>";
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
                <th>Address</th>
                <th>Description</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php
            //Show Venues
             //Pagination set page limt, get page 
             $limit = 7;
             if (isset($_GET["page"])) {
               $page  = $_GET["page"];
             } else {
               $page = 1;
             };
             $start_from = ($page - 1) * $limit;
            $sql = "SELECT * FROM venues WHERE venue_status=2 ORDER BY id ASC LIMIT $start_from, $limit";
            $result = mysqli_query($connection, $sql);
            
            $sr=1;
            while ($num = mysqli_fetch_assoc($result)) {
                //test 2    
                // $sql2 = "SELECT status.id, status.name FROM status RIGHT JOIN venues ON venues.venue_status= status.id WHERE venues.id = '" . $num["id"] . "' ";
                // $res = mysqli_query($connection, $sql2);
                // $status = mysqli_fetch_assoc($res);
            ?>
                <tr>
                    <td><?php echo $sr; ?></td>
                    <td><?php echo $num['name']; ?></td>
                    <td><?php echo $num['address']; ?></td>
                    <td><?php echo $num['description']; ?></td>
                    <td><?php echo $num['price']; ?></td>
                    <td><?php
                     if($num['venue_status']==1){
                      echo "Pending";
                      }
                      else if($num['venue_status']==2){
                          echo "Approved";
                          }
                      else if($num['venue_status']==3){
                          echo "Rejected";
                          }
                      else if($num['venue_status']==4){
                              echo "Cancelled";
                              }
                    //  echo $status['name']; ?></td>
                    
                    <td>
                        <a class="text-danger" name="deleteVenueId" id="deleteVenueId" type="submit" href="./Venues.php?deleteVenueId=<?php echo $num['id']; ?>" onclick="return confirm('Do you really want to Delete ?');">
                        <i class="fa fa-trash" aria-hidden="true">Delete</i></a>
                    </td>

                </tr>
            <?php
            $sr++;
            }
            ?>
        </tbody>
    </table>
    <div class="col-12 pt-1">
         <?php
        //Pagination Print Page Number
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from venues WHERE venue_status=2");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='Venues.php?page=" . $i . "'>" . $i . "</a></li>";
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
                <th>Address</th>
                <th>Description</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php
            //Show Venues
             //Pagination set page limt, get page 
             $limit = 7;
             if (isset($_GET["page"])) {
               $page  = $_GET["page"];
             } else {
               $page = 1;
             };
             $start_from = ($page - 1) * $limit;
            $sql = "SELECT * FROM venues WHERE venue_status=3 ORDER BY id ASC LIMIT $start_from, $limit";
            $result = mysqli_query($connection, $sql);
            
            $sr=1;
            while ($num = mysqli_fetch_assoc($result)) {
                //test 2    
                // $sql2 = "SELECT status.id, status.name FROM status RIGHT JOIN venues ON venues.venue_status= status.id WHERE venues.id = '" . $num["id"] . "' ";
                // $res = mysqli_query($connection, $sql2);
                // $status = mysqli_fetch_assoc($res);
            ?>
                <tr>
                    <td><?php echo $sr; ?></td>
                    <td><?php echo $num['name']; ?></td>
                    <td><?php echo $num['address']; ?></td>
                    <td><?php echo $num['description']; ?></td>
                    <td><?php echo $num['price']; ?></td>
                    <td><?php
                     if($num['venue_status']==1){
                      echo "Pending";
                      }
                      else if($num['venue_status']==2){
                          echo "Approved";
                          }
                      else if($num['venue_status']==3){
                          echo "Rejected";
                          }
                      else if($num['venue_status']==4){
                              echo "Cancelled";
                              }
                    //  echo $status['name']; ?></td>
                    <td>
                        <a class="text-danger" name="deleteVenueIdId" id="deleteVenueIdId" type="submit" href="./Venues.php?deleteVenueId=<?php echo $num['id']; ?>" onclick="return confirm('Do you really want to Delete ?');">
                        <i class="fa fa-trash" aria-hidden="true">Delete</i></a>
                    </td>

                </tr>
            <?php
            $sr++;
            }
            ?>
        </tbody>
    </table>
    <div class="col-12 pt-1">
         <?php
        //Pagination Print Page Number
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from venues WHERE venue_status=3");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='Venues.php?page=" . $i . "'>" . $i . "</a></li>";
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