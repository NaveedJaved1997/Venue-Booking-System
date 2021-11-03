<?php
$page_title = "Manage Payments | Online Car Booking System";
include './Dashboard-nav.php';
//Find Current user
$logedin_vendor = $_SESSION["userId"];
if((!empty($_SESSION['userId'])) && ($_SESSION['userRole'] == 1)){
//Approve Payment
 if (isset($_GET['approvedPaymentId'])) {
    $approvedPaymentId = $_GET['approvedPaymentId'];
    $find = "SELECT * FROM payments WHERE  id = $approvedPaymentId";
    $oldStatus = mysqli_query($connection, $find);
    $findOldStatus = mysqli_fetch_assoc($oldStatus);
    
    if($findOldStatus['status'] ==3){
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Payment</i> is Already Rejected.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['status'] ==2){
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Payment</i> is Already Approved.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['status'] ==1){
    $sql = "UPDATE payments SET status = '2' WHERE  id = $approvedPaymentId";
    $result = mysqli_query($connection, $sql);
    if($result){
    echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>Success!</b><i> Payment</i> is Approved</p>
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
  
    //Reject Payment
    if (isset($_GET['rejectedPaymentId'])) {
      $rejectedPaymentId = $_GET['rejectedPaymentId'];
      $find = "SELECT * FROM payments WHERE  id = $rejectedPaymentId";
      $oldStatus = mysqli_query($connection, $find);
      $findOldStatus = mysqli_fetch_assoc($oldStatus);
    
      if($findOldStatus['status'] ==3){
          echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
          <p class="p-2"><b>ERROR!</b> This <i>Payment</i> is Already Rejected.</p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>';
      }
      else if($findOldStatus['status'] ==2){
          echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
          <p class="p-2"><b>ERROR!</b> This <i>Payment</i> is Already Approved Cannot Reject Now.</p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>';
      }
      else if($findOldStatus['status'] ==1){
      $sql = "UPDATE payments SET status = '3' WHERE  id = $rejectedPaymentId";
      $result = mysqli_query($connection, $sql);
      if($result){
      echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
      <p class="p-2"><b>Success!</b><i> Car</i> is Rejected Successfully.</p>
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
    </button></div>';
      }            
  }

 //Delete Payment
 if (isset($_GET['DeletedPaymentId'])) {
    $DeletedPaymentId = $_GET['DeletedPaymentId'];
    $find = "SELECT * FROM payments WHERE  id = $DeletedPaymentId";
    $oldStatus = mysqli_query($connection, $find);
    $findOldStatus = mysqli_fetch_assoc($oldStatus);
  
    if($findOldStatus['status'] ==1){
        echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> This <i>Payment </i> is Still in Pending List.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
    }
    else if($findOldStatus['status'] ==2 || $findOldStatus['status'] ==3){
    $sql = "DELETE FROM payments WHERE  id = $DeletedPaymentId";
    $result = mysqli_query($connection, $sql);
    if($result){
    echo '<div class="alert alert-info alert-dismissible fade show mt-2 p-1" role="alert">
    <p class="p-2"><b>Success!</b><i> Payment </i> is Deleted Successfully.</p>
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
    <h1 class="display-4 text-white">Manage Payments</h1>
    <div id="carbon-block"></div>

    <div class="separator"></div>

    <div class="row text-white">
        <div class="col-lg-12">
            <div class="container-fluid">
                <div class="row">
                <div class="card col p-0">
                  <div class="card-header bg-dark">
                  Payments Details
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
                <th>item</th>
                <th>Name / Number</th>
                <th>Date</th>
                <th>Time</th>
                <th>Price</th>
                <th>Status</th>
                <th>Show Image</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php
            //Show Pending Payments
             //Pagination set page limt, get page 
             $limit = 7;
             if (isset($_GET["page"])) {
               $page  = $_GET["page"];
             } else {
               $page = 1;
             };
             $start_from = ($page - 1) * $limit;
            $sql = "SELECT * FROM payments WHERE status=1 ORDER BY id ASC LIMIT $start_from, $limit";
            $result = mysqli_query($connection, $sql);

            $sr=1;
            while ($num = mysqli_fetch_assoc($result)) {
                //status   
                // $sql2 = "SELECT status.id, status.name FROM status RIGHT JOIN payments ON payments.status= status.id WHERE payments.id = '" . $num["id"] . "' ";
                // $res = mysqli_query($connection, $sql2);
                // $status = mysqli_fetch_assoc($res);
                //item
                $tempItem = $num['item'];
                $tempItem = $tempItem."s";
                $tempItemId = $num['item_id'];

                $pricequery = "SELECT * FROM $tempItem  WHERE id= $tempItemId LIMIT 1";
                $priceQueryRes = mysqli_query($connection, $pricequery);
                $price = mysqli_fetch_assoc($priceQueryRes);

                //Payment
                // $tempImageID = $num['image_id'];
                // $paymentQuery= "SELECT * FROM images WHERE id= $tempImageID";
                // $paymentQueryRes = mysqli_query($connection, $paymentQuery);
                // $payment = mysqli_fetch_assoc($paymentQueryRes);
                // if($price){
                //     echo "test Success";
                //     // echo $price['car_number'];

                // }
                // else{
                //     echo "error";
                // }
            ?>
            <!-- Show Image Modal -->
<div class="modal fade" id="ShowImageModal<?php echo $num['id']?>" tabindex="-1" role="dialog" 
aria-labelledby="ShowImageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="UpdateProfileModalLabel">Attached Payment Proof</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      <img class="rounded mt-5 card-img" src="../Includes/uploads/<?php echo $num['image']; ?>">
      </div>
    </div>
  </div>
</div>
<!-- Show Image Modal end -->

                <tr>
                    <td><?php echo $sr;?></td>
                    <td><?php echo $num['item']; ?></td>
                    <td><?php
                       if(strpos($tempItem, 'car') !== false){
                        $name = $price['car_number'];
                        
                    }
                    else if(strpos($tempItem, 'venue') !== false){
                        $name = $price['name'];
                        
                    }   
                    echo $name; ?></td>
                    <td><?php echo $num['date']; ?></td>
                    <td><?php echo $num['timeslot']; ?></td>
                    <td><?php echo $price['price']; ?></td>
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
                    //  echo $status['name']; ?></td>
                    <td>
                    <a href="" type="button"  data-toggle="modal" data-target="#ShowImageModal<?php echo $num['id'];?>">Show Image</a><br/>
                    </td>
                    <td>
                    <a class="text-success" id="approvedPaymentId" name="approvedPaymentId" type="submit"
                    href="./Payments.php?approvedPaymentId=<?php echo $num['id']; ?>" onclick="return confirm('Are you sure to Approve ?');">
                    <i class="fa fa-check" aria-hidden="true">Approve</i></a>
                    <a class="text-danger" name="rejectedPaymentId" id="rejectedPaymentId" type="submit"
                    href="./Payments.php?rejectedPaymentId=<?php echo $num['id']; ?>" onclick="return confirm('Do you really want to Reject ?');">
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
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from payments WHERE status=1");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='Payments.php?page=" . $i . "'>" . $i . "</a></li>";
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
                <th>item</th>
                <th>Name / Number</th>
                <th>Date</th>
                <th>Time</th>
                <th>Price</th>
                <th>Status</th>
                <th>Show Image</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php
            //Show Approved Payments
             //Pagination set page limt, get page 
             $limit = 7;
             if (isset($_GET["page"])) {
               $page  = $_GET["page"];
             } else {
               $page = 1;
             };
             $start_from = ($page - 1) * $limit;
            $sql = "SELECT * FROM payments WHERE status=2 ORDER BY id ASC LIMIT $start_from, $limit";
            $result = mysqli_query($connection, $sql);

            $sr=1;
            while ($num = mysqli_fetch_assoc($result)) {
                //status   
                // $sql2 = "SELECT status.id, status.name FROM status RIGHT JOIN payments ON payments.status= status.id WHERE payments.id = '" . $num["id"] . "' ";
                // $res = mysqli_query($connection, $sql2);
                // $status = mysqli_fetch_assoc($res);
                //item
                $tempItem = $num['item'];
                $tempItem = $tempItem."s";
                $tempItemId = $num['item_id'];

                $pricequery = "SELECT * FROM $tempItem  WHERE id= $tempItemId LIMIT 1";
                $priceQueryRes = mysqli_query($connection, $pricequery);
                $price = mysqli_fetch_assoc($priceQueryRes);

                //Payment
                // $tempImageID = $num['image_id'];
                // $paymentQuery= "SELECT * FROM images WHERE id= $tempImageID";
                // $paymentQueryRes = mysqli_query($connection, $paymentQuery);
                // $payment = mysqli_fetch_assoc($paymentQueryRes);
                // if($price){
                //     echo "test Success";
                //     // echo $price['car_number'];

                // }
                // else{
                //     echo "error";
                // }
            ?>
            <!-- Show Image Modal -->
<div class="modal fade" id="ShowApprovedImageModal<?php echo $num['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ShowApprovedImageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="UpdateProfileModalLabel">Attached Payment Proof</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      <img class="rounded mt-5 card-img" src="../Includes/uploads/<?php echo $num['image']; ?>">
      </div>
    </div>
  </div>
</div>
<!-- Show Image Modal end -->

                <tr>
                    <td><?php echo $sr;?></td>
                    <td><?php echo $num['item']; ?></td>
                    <td><?php
                       if(strpos($tempItem, 'car') !== false){
                        $name = $price['car_number'];
                        
                    }
                    else if(strpos($tempItem, 'venue') !== false){
                        $name = $price['name'];
                        
                    }   
                    echo $name; ?></td>
                    <td><?php echo $num['date']; ?></td>
                    <td><?php echo $num['timeslot']; ?></td>
                    <td><?php echo $price['price']; ?></td>
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
                    //  echo $status['name']; ?></td>
                     <td>
                    <a href="" type="button"  data-toggle="modal" data-target="#ShowApprovedImageModal<?php echo $num['id'];?>">Show Image</a><br/>
                    </td>
                    <td>
                        <a class="text-danger" name="DeletedPaymentId" id="DeletedPaymentId" type="submit" href="./Payments.php?DeletedPaymentId=<?php echo $num['id']; ?>" onclick="return confirm('Do you really want to Delete ?');">
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
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from payments WHERE status=2");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='Payments.php?page=" . $i . "'>" . $i . "</a></li>";
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
                <th>item</th>
                <th>Name / Number</th>
                <th>Date</th>
                <th>Time</th>
                <th>Price</th>
                <th>Status</th>
                <th>Show Image</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php
            //Show Rejected Payments
             //Pagination set page limt, get page 
             $limit = 7;
             if (isset($_GET["page"])) {
               $page  = $_GET["page"];
             } else {
               $page = 1;
             };
             $start_from = ($page - 1) * $limit;
            $sql = "SELECT * FROM payments WHERE status=3 ORDER BY id ASC LIMIT $start_from, $limit";
            $result = mysqli_query($connection, $sql);

            $sr=1;
            while ($num = mysqli_fetch_assoc($result)) {
                //status   
                // $sql2 = "SELECT status.id, status.name FROM status RIGHT JOIN payments ON payments.status= status.id WHERE payments.id = '" . $num["id"] . "' ";
                // $res = mysqli_query($connection, $sql2);
                // $status = mysqli_fetch_assoc($res);
                //item
                $tempItem = $num['item'];
                $tempItem = $tempItem."s";
                $tempItemId = $num['item_id'];

                $pricequery = "SELECT * FROM $tempItem  WHERE id= $tempItemId LIMIT 1";
                $priceQueryRes = mysqli_query($connection, $pricequery);
                $price = mysqli_fetch_assoc($priceQueryRes);

                //Payment
                // $tempImageID = $num['image_id'];
                // $paymentQuery= "SELECT * FROM images WHERE id= $tempImageID";
                // $paymentQueryRes = mysqli_query($connection, $paymentQuery);
                // $payment = mysqli_fetch_assoc($paymentQueryRes);
                // if($price){
                //     echo "test Success";
                //     // echo $price['car_number'];

                // }
                // else{
                //     echo "error";
                // }
            ?>
            <!-- Show Image Modal -->
<div class="modal fade" id="ShowRejectedImageModal<?php echo $num['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ShowRejectedImageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="UpdateProfileModalLabel">Attached Payment Proof</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      <img class="rounded mt-5 card-img" src="../Includes/uploads/<?php echo $num['image']; ?>">
      </div>
    </div>
  </div>
</div>
<!-- Show Image Modal end -->

                <tr>
                    <td><?php echo $sr;?></td>
                    <td><?php echo $num['item']; ?></td>
                    <td><?php
                       if(strpos($tempItem, 'car') !== false){
                        $name = $price['car_number'];
                        
                    }
                    else if(strpos($tempItem, 'venue') !== false){
                        $name = $price['name'];
                        
                    }   
                    echo $name; ?></td>
                    <td><?php echo $num['date']; ?></td>
                    <td><?php echo $num['timeslot']; ?></td>
                    <td><?php echo $price['price']; ?></td>
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
                    //  echo $status['name']; ?></td>
                               <td>
                    <a href="" type="button"  data-toggle="modal" data-target="#ShowRejectedImageModal<?php echo $num['id'];?>">Show Image</a><br/>
                    </td>
                    <td>
                        <a class="text-danger" name="DeletedPaymentId" id="DeletedPaymentId" type="submit" href="./Payments.php?DeletedPaymentId=<?php echo $num['id']; ?>" onclick="return confirm('Do you really want to Delete ?');">
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
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from payments WHERE status=3");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='Payments.php?page=" . $i . "'>" . $i . "</a></li>";
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