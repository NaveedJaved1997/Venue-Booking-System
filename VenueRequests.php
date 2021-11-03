<?php
$page_title = "Manage Requests | Online Venue Booking System";
include './Dashboard-nav.php';
//Find Current user
$logedin_user = '';
if(!empty($_SESSION["userId"])){
    $logedin_user = $_SESSION["userId"];
}

   //Cancel booking
 if (isset($_GET['cancelId'])) {
    $cancelId = $_GET['cancelId'];
    $find = "SELECT * FROM bookings WHERE  id = $cancelId";
    $oldStatus = mysqli_query($connection, $find);
    $findOldStatus = mysqli_fetch_assoc($oldStatus);
    if($findOldStatus['status'] ==4){
        echo '<div class="alert alert-warning alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Booking</i> is already been cancled.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['status'] ==3){
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Booking</i> is Already Rejected. Cannot cancel now.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['status'] ==2){
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Booking</i> is Already Approved Cannot Cancel Now.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['status'] ==1){
                // echo '<script> alert("cancel id = "); alert("'.$cancelId.'");</script>';
    $sql = "UPDATE bookings SET status = '4' WHERE  id = $cancelId";
    $result = mysqli_query($connection, $sql);
    if($result){
    echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>Success!</b><i> Booking</i> has been Cancled</p>
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
<div class="page-content p-3" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-dark bg-dark rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

    <!-- content -->
    <h1 class="display-4 text-white">Manage Requests</h1>
    <div id="carbon-block"></div>

    <div class="separator"></div>
    <div class="row text-white">
        <div class="col-lg-12">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                            Your Booking Requests
                             </div>
            <table class="table table-responsive-lg table-striped">
                <thead>
                    <tr>
                        <th class="d-none d-md-block">Sr#</th>
                        <!-- <th>Details</th> -->
                        <th>Date</th>
                        <th>Time</th>
                        <th>Venue</th>
                        <th>Vendor</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Show Bookings requests
            //Pagination set page limt, get page 
              $limit = 7;
              if (isset($_GET["page"])) {
                $page  = $_GET["page"];
              } else {
                $page = 1;
              };
              $start_from = ($page - 1) * $limit;
                    $sql = "SELECT * FROM bookings WHERE item='venue' AND client_id = '" . $logedin_user . "'ORDER BY id ASC LIMIT $start_from, $limit";
                    $result = mysqli_query($connection, $sql);
                    $sr=1;
                    while ($num = mysqli_fetch_assoc($result)) {
                        //test 2  || check for status  
                        // $sql2 = "SELECT status.id, status.name FROM status RIGHT JOIN bookings ON bookings.status= status.id WHERE bookings.id = '" . $num["id"] . "' ";
                        // $res = mysqli_query($connection, $sql2);
                        // $status = mysqli_fetch_assoc($res);

                        //test 3  || check for venue name
                        $venue = "SELECT * FROM venues WHERE  id = '" . $num['item_id'] . "' ";
                        $venueFind = mysqli_query($connection, $venue);
                        $venueName = mysqli_fetch_assoc($venueFind);

                        //test 4  || check for vendor name
                        $vendor = "SELECT * FROM users WHERE  id = '" . $num['vendor_id'] . "'";
                        $vendorFind = mysqli_query($connection, $vendor);
                        $vendorName = mysqli_fetch_assoc($vendorFind);

                        // Check for Payments
                        $paymentQuery = "SELECT * FROM payments WHERE item_id= '".$venueName["id"]."' AND date = '".$num["date"]."' AND timeslot = '".$num['timeslot']."' ";
                        $paymentQueryResult = mysqli_query($connection, $paymentQuery);
                        $payment = mysqli_fetch_assoc($paymentQueryResult);
                    ?>
                        <tr>
                            <td class="d-none d-md-block"><?php echo $sr; ?></td>
                            <!-- <td><?php echo $num['details']; ?></td> -->
                            <td><?php echo $num['date']; ?></td>
                            <td><?php echo $num['timeslot']; ?></td>
                            <td><?php echo $venueName['name']; ?></td>
                            <td><?php echo $vendorName['name']; ?></td>
                            <td><?php
                                if($payment['status']==0 || $payment['status'] == null){
                                ?>
                                <a class='text-primary' id='paymentId' name='paymentId' type='submit'
                                href='./Payments.php?item=venue&item_id=<?php echo $venueName['id']; ?>&date=<?php echo $num['date']; ?>&timeslot=<?php echo $num['timeslot'];?>'>
                                <i class='fa fa-money' aria-hidden='true'> Pay Now</i>
                                 </a>
                                <?php
                                    // echo '  <p class="text-warning">Not Payed</p>';
                                }
                                else if($payment['status']==1){
                                    echo '  <p class="text-info">In Process</p>';
                                }
                                else if($payment['status']==2){
                                    echo '  <p class="text-success">Payment Approved</p>';
                                }
                                else if($payment['status']==3){
                                    echo '  <p class="text-danger">Rejected</p>';
                                }

                            ?>
                            </td>
                            <td><?php
                             if($num['status']==1){
                                echo "Pending";
                                }
                                else if($num['status']==2){
                                  echo "Approved";
                                  }
                                  else if($num['status']==3){
                                    echo "Rejected";
                                    }
                                    else if($num['status']==4){
                                        echo "Cancelled";
                                        }
                            //  echo $status['name'];
                             ?></td>
                            <td>
                            <?php
                            date_default_timezone_set("Asia/Karachi");
                            $tempCurrentDate = date("Y-m-d h:i:sa");
                            // echo $tempCurrentDate;
                            if($num['booked_on'] >= $tempCurrentDate){

                            
                                ?> 
                                <a class="text-danger" id="cancelId" name="cancelId" type="submit"
                                href="./VenueRequests.php?cancelId=<?php echo $num['id']; ?>" onclick="return confirm('Are you sure to Cancel ?');" >
                                <i class="fa fa-times" aria-hidden="true">Cancel</i>
                                 </a>
                                
                                 <?php
                                    }
                                    else{
                                        echo ' <p class="text-info" ><i class="fa fa-times" aria-hidden="true">TimeOut</i></p>';
                                    }
                            ?>

                            </td>
                        </tr>
                    <?php
                $sr++;    
                }
                    ?>
                </tbody>
            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 pt-1">
                    <?php
        //Pagination Print Page Number
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from bookings WHERE item='venue' AND client_id = '" . $logedin_user . "'");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='VenueRequests.php?page=" . $i . "'>" . $i . "</a></li>";
        }
        echo $pagLink . "</ul>";
        ?>
                    </div>
        </div>
    </div>
    <!-- End content -->
