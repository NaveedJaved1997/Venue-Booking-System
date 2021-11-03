<?php
$page_title = "Cars | Online Venue Booking System";
include 'Header.php'; 
?>

<div class="container ">
<div class="row">
<?php 
//Pagination set page limt, get page 
$limit = 9;
if (isset($_GET["page"])) {
	$page  = $_GET["page"];
} else {
	$page = 1;
};
$start_from = ($page - 1) * $limit;

 $sql = "SELECT * FROM cars WHERE car_status = 2 ORDER BY id ASC LIMIT $start_from, $limit";
 $result = mysqli_query($connection, $sql);

 while ($num = mysqli_fetch_assoc($result)) {
  
?>

<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
    <div class="card mt-1 mb-1">
    
    <?php 
        //  get image
        // $images = "SELECT * FROM images WHERE id='".$num['image']."' LIMIT 1";
        // $res_image = mysqli_query($connection, $images);
        // $img = mysqli_fetch_assoc($res_image);
        if ($num['image'] >0) {
 
    ?>
    <div>
    <!-- <img class="card-img" src="./Includes/media/Default-venue.jpg" alt="" srcset=""> -->
    <img class="card-img" src="./Includes/uploads/<?php echo $num['image']; ?>"
    width="250px" height="250px">
    </div>
    <?php 
    }
    else{

        ?>
        <div>
    <img class="card-img" src="./Includes/media/Default-car.jpg" alt="" srcset=""
    width="250px" height="250px">
    </div>
    <?php }?>
    <div class="card-footer">
    <a class="text-dark" href="ShowCarDetails.php?car=<?php echo $num["id"] ?>" type="button"><?php echo $num['car_number'];?></a>
    <p><b>Price: </b>Rs. <?php echo $num["price"] ?></p>
    </div>
    </div>
</div>
<?php } ?>
</div>
<?php
        //Pagination Print Page Number
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from cars WHERE car_status = 2 ");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='Cars.php?page=" . $i . "'>" . $i . "</a></li>";
        }
        echo $pagLink . "</ul>";
        ?>
</div>
<?php
include 'Footer.php';
?>
