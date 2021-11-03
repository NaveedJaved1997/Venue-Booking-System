<?php
$page_title = "Manage Requests | Online Venue Booking System";
include './Dashboard-nav.php';
//Find Current user
$logedin_vendor = $_SESSION["userId"];
$find = "SELECT * FROM users WHERE id = '" . $logedin_vendor . "' LIMIT 1 ";
$res = mysqli_query($connection, $find);
$row = mysqli_fetch_assoc($res);

//Approve booking
if (isset($_GET['approvedBookingId'])) {
    $approvedBookingId = $_GET['approvedBookingId'];
    $find = "SELECT * FROM bookings WHERE  id = $approvedBookingId";
    $oldStatus = mysqli_query($connection, $find);
    $findOldStatus = mysqli_fetch_assoc($oldStatus);
    if ($findOldStatus['status'] == 4) {
        echo '<div class="alert alert-warning alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Booking</i> is cancled by User.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    } else if ($findOldStatus['status'] == 3) {
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Booking</i> is Already Rejected.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    } else if ($findOldStatus['status'] == 2) {
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Booking</i> is Already Approved Cannot Cancel Now.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    } else if ($findOldStatus['status'] == 1) {
        // echo '<script> alert("cancel id = "); alert("'.$approvedBookingId.'");</script>';
        $sql = "UPDATE bookings SET status = '2' WHERE  id = $approvedBookingId";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>Success!</b><i> Booking .</i> is Approved</p>
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
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>ERROR!</b> Somehow an <i>Error</i> occured.</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    
    </div>';
    }
}



//Reject booking
if (isset($_GET['rejectedBookingId'])) {
    $rejectedBookingId = $_GET['rejectedBookingId'];
    $find = "SELECT * FROM bookings WHERE  id = $rejectedBookingId";
    $oldStatus = mysqli_query($connection, $find);
    $findOldStatus = mysqli_fetch_assoc($oldStatus);
    if ($findOldStatus['status'] == 4) {
        echo '<div class="alert alert-warning alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Booking</i> is cancled by User.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    } else if ($findOldStatus['status'] == 3) {
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Booking</i> is Already Rejected.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    } else if ($findOldStatus['status'] == 2) {
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Booking</i> is Already Approved Cannot Cancel Now.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    } else if ($findOldStatus['status'] == 1) {
        // echo '<script> alert("cancel id = "); alert("'.$rejectedBookingId.'");</script>';
        $sql = "UPDATE bookings SET status = '3' WHERE  id = $rejectedBookingId";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>Success!</b><i> Booking</i> is Cancled Successfully.</p>
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
    } else {
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
                                New Booking Requests
                            </div>
                            <table class="table table-responsive-lg table-striped">
                                <thead>
                                    <tr>
                                        <th class="d-none d-md-block">Sr#</th>
                                        <!-- <th>Details</th> -->
                                        <th>Date</th>
                                        <th>Venue</th>
                                        <th>Client</th>
                                        <th>Payment</th>
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
                                    $sql = "SELECT * FROM bookings WHERE item='venue' AND vendor_id = '" . $row['id'] . "'ORDER BY id ASC LIMIT $start_from, $limit";
                                    $result = mysqli_query($connection, $sql);
                                    $sr = 1;
                                    while ($num = mysqli_fetch_assoc($result)) {
                                        //from bookings
                                        // $sql2 = "SELECT status.id, status.name FROM status RIGHT JOIN bookings ON bookings.status= status.id WHERE bookings.id = '" . $num["id"] . "' ";
                                        // $res = mysqli_query($connection, $sql2);
                                        // $status = mysqli_fetch_assoc($res);

                                        // Check for Venue name
                                        $venue = "SELECT * FROM venues WHERE  id = '" . $num['item_id'] . "'";
                                        $venueFind = mysqli_query($connection, $venue);
                                        $venueName = mysqli_fetch_assoc($venueFind);

                                        // Check for Client name
                                        $client = "SELECT * FROM users WHERE  id = '" . $num['client_id'] . "'";
                                        $clientFind = mysqli_query($connection, $client);
                                        $clientName = mysqli_fetch_assoc($clientFind);

                                        // Check for Payments
                                        $paymentQuery = "SELECT * FROM payments WHERE item_id= '".$venueName["id"]."' AND date = '".$num["date"]."'";
                                        $paymentQueryResult = mysqli_query($connection, $paymentQuery);
                                        $payment = mysqli_fetch_assoc($paymentQueryResult);
                                    ?>
                                        <tr>
                                            <td class="d-none d-md-block"><?php echo $sr; ?></td>
                                            <!-- <td><?php echo $num['details']; ?></td> -->
                                            <td><?php echo $num['date']; ?></td>
                                            <td><?php echo $venueName['name']; ?></td>
                                            <td><?php echo $clientName['name']; ?></td>
                                            <td><?php
                                            // echo $payment['date'] , $num['date'];
                                            //     if($payment['date'] != $num['date']){
                                                
                                            // }
                                            // else{
                                                if($payment['status']==0 || $payment['status'] == null){
                                                    echo '  <p class="text-warning">Not Payed</p>';
                                                }
                                                else if($payment['status']==1){
                                                    echo '  <p class="text-info">In Process</p>';
                                                }
                                                else if($payment['status']==2){
                                                    echo '  <p class="text-success">Approved</p>';
                                                }
                                                else if($payment['status']==3){
                                                    echo '  <p class="text-danger">Rejected</p>';
                                                }

                                            // }
                                            // echo $payment['status']; ?>
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
                                            // echo $status['name'];
                                             ?></td>
                                            <td>
                                                <a class="text-success" id="approvedBookingId" name="approvedBookingId" type="submit" href="./VenueRequests.php?approvedBookingId=<?php echo $num['id']; ?>" onclick="return confirm('Are you sure to Approve ?');">
                                                    <i class="fa fa-check" aria-hidden="true">Approve</i></a>
                                                <a class="text-danger" name="rejectedBookingId" id="rejectedBookingId" type="submit" href="./VenueRequests.php?rejectedBookingId=<?php echo $num['id']; ?>" onclick="return confirm('Do you really want to Reject ?');">
                                                    <i class="fa fa-times" aria-hidden="true">Reject</i></a>
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
                $result_db = mysqli_query($connection, "SELECT COUNT(id) from bookings WHERE item='venue' AND vendor_id = '" . $logedin_vendor . "'");
                $row_db = mysqli_fetch_array($result_db);
                $total_records = $row_db[0];
                $total_pages = ceil($total_records / $limit);
                /* echo  $total_pages; */
                $pagLink = "<ul class='pagination'>";
                $pagLink .= " <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
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

    <!-- Add Venue Modal -->
    <div class="modal fade" id="AddCarMondal" tabindex="-1" role="dialog" aria-labelledby="AddCarMondal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="ChangePasswordModalLabel">Add New Car</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="Cars.php" method="post" id="AddCarMondal">
                        <!-- <input class="form-control" type="hidden" name="user_id" id="user_id"> -->
                        <label for="car_num">Enter Car Number</label>
                        <input class="form-control" type="text" name="car_num" id="car_num">
                        <label for="car_price">Enter Car Price</label>
                        <input class="form-control" type="text" name="car_price" id="car_price">
                        <button id="add_car_btn" type="submit" class="btn btn-outline-dark form-control mt-2">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Add Venue Modal -->