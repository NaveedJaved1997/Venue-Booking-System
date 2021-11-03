<?php
$page_title = "Bookings | Online Venue Booking System";
include 'Header.php';
?>
        <!-- Find Venue Search bar -->
        <div class="page-height">

<div class="container-fluid mt-1 mb-1">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Find Booking
                </div>
                <form id="findvenueform" action="Bookings.php" method="get">
                    
                    <div class="text-center p-1">
                    <label for="venue">
                    <i class="fa fa-h-square fa-2x" aria-hidden="true"></i></label>
                    <input type="radio" name="checkbooking" id="venue" value="venue" checked>
                    &emsp;
                    <label for="car">
                    <i class="fa fa-car fa-2x" aria-hidden="true"></i></label>
                    <input type="radio" name="checkbooking" id="car" value="car" <?php if(isset($_GET['checkbooking']) && $_GET['checkbooking']=='car'){echo 'checked';}; ?> >
                    </div>
                    <input class="form-control ml-2" style="display: inline-block; width: 75%;" 
                    type="date" name="findvenue" id="findvenue" value="<?php echo $_GET['findvenue']; ?>" >
                    <button id="checkvenue" name="checkvenue" type="submit" class="btn btn-outline-dark" style="width: 20%;">
                    Check</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="booking-error" class="col-sm-10 col-md-8 col-lg-4 offset-sm-1 offset-md-2 offset-lg-4 card alert-danger p-1">
    <p class="p-2"><b>ERROR!</b> Selected Date is <i>Passed.</i> Plese Select Correct New Date.</p>

</div>
<?php
        $vdate='';
        if (isset($_GET['findvenue'])) {
        $vdate = mysqli_real_escape_string($connection, $_GET['findvenue']);
        $bookingChoice = mysqli_real_escape_string($connection, $_GET['checkbooking']);
        //        echo '<script> alert("'.$vdate.'") </script>';
            //for venues
       if($bookingChoice == 'venue'){
        $sql2 = "SELECT * FROM venues WHERE availability = 2";
        $res = mysqli_query($connection, $sql2);
        //$status = mysqli_fetch_assoc($res);
      
       
        ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2">
            <table class="table table-striped table-bordered">

        <?php
        echo '<thead class="bg-dark text-white">
                    <tr>
                        <th>Sr#</th>
                        <th>Venue</th>
                        <th>Address</th>
                        <th>Price</th>
                    </tr>
                </thead>';
        // if ($check = mysqli_fetch_assoc($result)>0) {
            $isTrue=false;
            $sr= 1 ;
            while ($num = mysqli_fetch_assoc($res)) {
                // $sql = "SELECT * FROM bookings WHERE item_id = '".$num['id']."'";
                //Pagination set page limt, get page 
                $limit = 10;
                if (isset($_GET["page"])) {
                    $page  = $_GET["page"];
                } else {
                    $page = 1;
                };
                $start_from = ($page - 1) * $limit;

                $sql = "SELECT * FROM bookings ORDER BY id ASC LIMIT $start_from, $limit";
                $result = mysqli_query($connection, $sql);
                // $row = mysqli_fetch_assoc($result);
                
                //new test

                while ($row = mysqli_fetch_assoc($result)) {

                
                // if($row['item_id'] != $num['id'] && $row['date'] = $vdate){
                    if($row['item_id'] == $num['id']){
                        if($row['date'] == $vdate){
                            $isTrue=false;
                            goto next;
                            // echo '<script> alert("id = false") </script>';

                        }
                        else{

                            // echo '<script> alert("id = true") </script>';
                            // echo '<script> alert("'.$row['item_id'].'") </script>';
                            // echo '<script> alert("'.$vdate.'") </script>';
                            // echo '<script> alert("'.$row['date'].'") </script>';

                            $isTrue= true;
                        }
                }
                else if($row['item_id'] != $num['id']){
                    $isTrue=true;
                //         //    echo '<script> alert("'.$isTrue.'") </script>';
                }
                else{
                    $isTrue=false;
                }
            }
                // lable test
                next:
                if($isTrue){

                
        ?>

                    <tr>
                        <td id="item_id" value="<?php echo $num["id"] ?>">
                        <?php echo $sr; ?></td>
                        <td><a id="showvenuedetails" href="ShowDetails.php?venue_id=<?php echo $num["id"] ?>&date=<?php echo $vdate?>" type="button">
                        <?php echo $num['name']; ?></a></td>
                        <td><?php echo $num['address']; ?></td>
                        <td><?php echo $num['price']; ?></td>
                    </tr>
        <?php
        
                }
                $sr++;
        }

        ?>               
            </table>
        </div>
        <div class="col-md-8 offset-md-2">
        
        <?php
					//Pagination Print Page Number
					// $result_db = mysqli_query($connection, "SELECT COUNT(id) from bookings ");
					// $row_db = mysqli_fetch_array($result_db);
					// $total_records = $row_db[0];
					// $total_pages = ceil($total_records / $limit);
					// if($total_pages>1){
					// /* echo  $total_pages; */
					// $pagLink = "<ul class='pagination'>";
					// $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
					// for ($i = 1; $i <= $total_pages; $i++) {
					// 	$pagLink .= "<li class='page-item'><a class='page-link text-dark'
					// href='Bookings.php?page=" . $i . "'>" . $i . "</a></li>";
					// }
					// echo $pagLink . "</ul>";}
					?>
    </div>
    </div>
</div>


<?php                 
}
else if($bookingChoice == 'car'){
    //Pagination set page limt, get page 
$limit = 10;
if (isset($_GET["page"])) {
	$page  = $_GET["page"];
} else {
	$page = 1;
};
$start_from = ($page - 1) * $limit;
    $sql2 = "SELECT * FROM cars WHERE availability = 2 ORDER BY id ASC LIMIT $start_from, $limit";
    $res = mysqli_query($connection, $sql2);

?>
<!-- for cars -->
<div class="container-fluid mt-1 mb-1">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2">
                <table class="table table-striped table-bordered">
                <thead class="bg-dark text-white">
                <tr>
                <th>Sr#</th>
                <th>Car Number</th>
                <th>Price</th>
                </tr>
                </thead>
                <tbody>
<?php
            $isTrue=false;
            $sr= 1 ;
            while ($num = mysqli_fetch_assoc($res)) {
                $sql = "SELECT * FROM bookings";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {

                    if($row['item_id'] == $num['id']){
                        if($row['date'] == $vdate){
                            $isTrue=false;
                            goto carnext;    
                            }
                            else{    
                                $isTrue= true;
                            }
                    }
                    else if($row['item_id'] != $num['id']){
                        $isTrue=true;
                                        }
                    else{
                        $isTrue=false;
                    }
                }
                carnext:
                if($isTrue){
              
?>
                    <tr>
                        <td id="item_id" value="<?php echo $num["id"] ?>">
                        <?php echo $sr; ?></td>
                        <td><a id="showcardetails" href="ShowCarDetails.php?car_id=<?php echo $num["id"] ?>&date=<?php echo $vdate?>" type="button">
                        <?php echo $num['car_number']; ?></a></td>
                        <td><?php echo $num['price']; ?></td>
                    </tr>
                <?php
                  }
                  $sr++;
                }
                ?>
                </tbody>
                </table>
            </div>
            <div class="col-md-8 offset-md-2">
            <?php
					//Pagination Print Page Number
					// $result_db = mysqli_query($connection, "SELECT COUNT(id) from bookings ");
					// $row_db = mysqli_fetch_array($result_db);
					// $total_records = $row_db[0];
					// $total_pages = ceil($total_records / $limit);
					// if($total_pages>1){
					// /* echo  $total_pages; */
					// $pagLink = "<ul class='pagination'>";
					// $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
					// for ($i = 1; $i <= $total_pages; $i++) {
					// 	$pagLink .= "<li class='page-item'><a class='page-link text-dark'
					// href='Bookings.php?checkbooking=car&findvenue='".."'&page=" . $i . "'>" . $i . "</a></li>";
					// }
					// echo $pagLink . "</ul>";}
					?>
        </div>
        </div>
    </div>
    <?php 
    }}
    ?>
</div>


<?php
include 'Footer.php';
?>