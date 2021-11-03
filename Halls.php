<?php
$page_title = "Halls | Online Venue Booking System";
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

 $sql = "SELECT * FROM venues WHERE venue_status = 2 ORDER BY id ASC LIMIT $start_from, $limit";
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
        //rating
        $query = mysqli_query($connection, "SELECT AVG(rating) as AVGRATE from reviews WHERE item='venue' AND item_id = '".$num['id']."'");
        $row = mysqli_fetch_array($query);
        $AVGRATE = $row['AVGRATE'];
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
    <img class="card-img" src="./Includes/media/Default-venue.jpg" alt="" srcset=""
    width="250px" height="250px">
    </div>
    <?php }?>
    <div class="card-footer">
    <a class="text-dark" href="ShowDetails.php?venue=<?php echo $num["id"] ?>" type="button"><?php echo $num['name'];?></a>
   
    <h6 class="p-1"><b><?php echo round($AVGRATE, 1); ?></b> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i></h6>
    </div>
    </div>
</div>
<?php } ?>

</div>
<?php
        //Pagination Print Page Number
        $result_db = mysqli_query($connection, "SELECT COUNT(id) from venues WHERE venue_status = 2 ");
        $row_db = mysqli_fetch_array($result_db);
        $total_records = $row_db[0];
        $total_pages = ceil($total_records / $limit);
        /* echo  $total_pages; */
        $pagLink = "<ul class='pagination'>";
        $pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link text-dark'
        href='Halls.php?page=" . $i . "'>" . $i . "</a></li>";
        }
        echo $pagLink . "</ul>";
        ?>
</div>
<?php
include 'Footer.php';
?>

                                  
                          

                       