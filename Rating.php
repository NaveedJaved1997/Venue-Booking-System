<?php
// error_reporting(E_ERROR);
// include './RatingProcess.php';
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
// $review_venue_id='';
// $review_car_id='';
$review_id = '';
$review_item='';
$from_id = '';
if(isset($_GET['car'])){
	$review_id = $_GET['car'];
	$review_item = 'car';
	// $review_id = $review_car_id;
	// $ratingTable = 'car_rating';
	$from_id = 'car_id';
}
else if($_GET['venue']){
	$review_id = $_GET['venue'];
	$review_item = 'venue';
	// $review_venue_id = $_GET['venue_id'];
	// $ratingTable = 'venue_rating';
	// $review_id = $review_venue_id;
	$from_id = 'venue_id';
}



// if(isset($_POST['addReview'])){   
//     $review_rating = mysqli_real_escape_string($connection,$_POST['rating']);
//     $review_text =  mysqli_real_escape_string($connection,$_POST['remark']);
//     $review_img = 1;
//     $review_user_id= $client;
//     $review_venue_id = mysqli_real_escape_string($connection, $_POST['venue_id']);
//     if($review_user_id){
//         echo $review_rating. '</br>';
//         echo $review_text. '</br>';
//         echo $review_user_id. '</br>';
//         echo $review_venue_id. '</br>';
//     }
// }

//Geting Rating and reviews
$query = mysqli_query($connection, "SELECT AVG(rating) as AVGRATE from reviews  WHERE item= '".$review_item."' AND item_id = '" . $review_id . "'");
$row = mysqli_fetch_array($query);
$AVGRATE = $row['AVGRATE'];
$query = mysqli_query($connection, "SELECT count(rating) as Total from reviews WHERE item= '".$review_item."' AND item_id = '" . $review_id . "'");
$row = mysqli_fetch_array($query);
$Total = $row['Total'];
$query = mysqli_query($connection, "SELECT count(remark) as Totalreview from  reviews WHERE item= '".$review_item."' AND item_id = '" . $review_id . "'");
$row = mysqli_fetch_array($query);
$Total_review = $row['Totalreview'];
//Pagination set page limt, get page 
$limit = 7;
if (isset($_GET["page"])) {
	$page  = $_GET["page"];
} else {
	$page = 1;
};
$start_from = ($page - 1) * $limit;
$review = mysqli_query($connection, "SELECT remark,rating, posted_by, image from reviews WHERE item= '".$review_item."' AND item_id = '" . $review_id . "'  ORDER BY id ASC LIMIT $start_from, $limit");
$rating = mysqli_query($connection, "SELECT count(*) as Total,rating from reviews WHERE item= '".$review_item."' AND item_id = '" . $review_id . "'  group by rating ");

?>


<div class="bg-light">
	<div class="container p-1">
		<div class="col-sm-12 col-md-8 ">
			<h3 style="display: inline-block;">Rating & Reviews </h3>
			<h5 style="display: inline-block;"><a href="#" data-toggle="modal" data-target="#ReviewModal"> [Add Your Review]</a></h5>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<h5 align="center"><b><?php echo round($AVGRATE, 1); ?></b> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i>
					</h5>
					<p><?= $Total; ?> ratings and <?= $Total_review; ?> reviews</p>
				</div>
				<div class="col-sm-12 col-md-6">
					<?php
					while ($db_rating = mysqli_fetch_array($rating)) {
					?>
						<h5 align="center"><?= $db_rating['rating']; ?> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i> Total <?= $db_rating['Total']; ?></h5>


					<?php
					}

					?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- <p>
				<a class="" data-toggle="collapse" href="#showMoreReviews" role="button" aria-expanded="false" aria-controls="showMoreReviews">
				Show All Reviews
				</a>
				</p> -->

					<!-- <div class="collapse" id="showMoreReviews">
				<div class=""> -->


					<?php
					while ($db_review = mysqli_fetch_array($review)) {
						$sql = "SELECT * FROM users WHERE id= '" . $db_review['posted_by'] . "'  LIMIT 1";
						$result = mysqli_query($connection, $sql);
						$row = mysqli_fetch_assoc($result);
						if ($db_review['image']) {
							// $imageQuery = "SELECT * FROM images WHERE id= '" . $db_review['image_id'] . "'  LIMIT 1";
							// $imageQueryResult = mysqli_query($connection, $imageQuery);
							// $imageQueryRow = mysqli_fetch_assoc($imageQueryResult);

					?>
							<h6><?= $db_review['rating']; ?> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i> by <span style="font-size:14px;"><?= $row['name']; ?></span></h6>
							<p><a href="#"><img class="img-thumbnail" width="120px" src="./Includes/uploads/<?php echo $db_review['image'] ?>" alt=""></a> <?= $db_review['remark']; ?></p>
							<hr>
						<?php
						} else {
						?>
							<h6><?= $db_review['rating']; ?> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i> by <span style="font-size:14px;"><?= $row['name']; ?></span></h6>
							<p><?= $db_review['remark']; ?></p>
							<hr>
					<?php
						}
					}
					?>
					<!-- </div> -->
					<?php
					//Pagination Print Page Number
					$result_db = mysqli_query($connection, "SELECT COUNT(id) from reviews WHERE item= '".$review_item."' AND item_id = '" . $review_id . "'  ");
					$row_db = mysqli_fetch_array($result_db);
					$total_records = $row_db[0];
					$total_pages = ceil($total_records / $limit);
					if($total_pages>1){
					/* echo  $total_pages; */
					$pagLink = "<ul class='pagination'>";
					$pagLink .=" <li class='page-item'><a class='page-link text-dark'>Pages</a></li>";
					for ($i = 1; $i <= $total_pages; $i++) {
						$pagLink .= "<li class='page-item'><a class='page-link text-dark'
					href='ShowDetails.php?venue=" . $review_id . "&page=" . $i . "'>" . $i . "</a></li>";
					}
					echo $pagLink . "</ul>";}
					?>
					<!-- </div> -->
				</div>

			</div>
		</div>
	</div>
	<!-- End Container -->

	<!-- <div class="container-fluid bg-white p-1">
	<div class="card col-md-7 ml-5 mb-5">
	<div class="card-header bg-dark text-white">
	<h3>Add Your Review</h3> 
	</div>
	<form action="./RatingProcess.php" method="POST" enctype="multipart/form-data">

		<div class="rating-css p-1 pt-2">
		<div class="star-icon">
		<input type="radio" name="rating" id="rating1" value="1">
		<label for="rating1" class="fa fa-star"></label>
		<input type="radio" name="rating" id="rating2" value="2">
		<label for="rating2" class="fa fa-star"></label>
		<input type="radio" name="rating" id="rating3" value="3">
		<label for="rating3" class="fa fa-star"></label>
		<input type="radio" name="rating" id="rating4" value="4">
		<label for="rating4" class="fa fa-star"></label>
		<input type="radio" name="rating" id="rating5" value="5" checked>
		<label for="rating5" class="fa fa-star"></label>
		</div>
		</div>

	<input type="hidden" name="venue_id" id="venue_id" value="<?php $id = $_GET['venue_id'];
																echo $id; ?>">
<div>
<textarea class="form-control" rows="1" placeholder="Write your review here..." name="remark" id="remark" required></textarea><br>
<input class="form-control-file" type="file" name="" id="">
<br>
<p><button  class="btn btn-outline-dark" name="addReview" id="addReview">Submit</button></p>
	</div>
	</form>
</div>
</div> -->

	<!-- Add Review Modal -->
	<div class="modal fade" id="ReviewModal" tabindex="-1" role="dialog" aria-labelledby="ReviewModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content shadow-lg">
				<div class="modal-header bg-dark text-white">
					<h5 class="modal-title" id="ReviewModalLabel">Add Your Review</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="text-white" aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<form action="./RatingProcess.php" method="POST" enctype="multipart/form-data">

						<div class="rating-css p-1 pt-2">
							<div class="star-icon">
								<input type="radio" name="rating" id="rating1" value="1">
								<label for="rating1" class="fa fa-star"></label>
								<input type="radio" name="rating" id="rating2" value="2">
								<label for="rating2" class="fa fa-star"></label>
								<input type="radio" name="rating" id="rating3" value="3">
								<label for="rating3" class="fa fa-star"></label>
								<input type="radio" name="rating" id="rating4" value="4">
								<label for="rating4" class="fa fa-star"></label>
								<input type="radio" name="rating" id="rating5" value="5" checked>
								<label for="rating5" class="fa fa-star"></label>
							</div>
						</div>
						<input type="hidden" name="<?php echo $from_id;?>" id="<?php echo $from_id;?>" value="<?php echo $review_id;?>">
						<div>
							<textarea class="form-control" rows="1" placeholder="Write your review here..." name="remark" id="remark" required></textarea><br>
							<input type="hidden" name="size" value="1000000">
							<input type="file" class="form-control-file" name="imageupload" class="form-group">
							<br>
							<p><button class="btn btn-outline-dark" name="addReview" id="addReview">Submit</button></p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Add Review Modal -->