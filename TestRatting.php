<?php
include './TestRattingProcess.php';?>

<!DOCTYPE html>
<html>
<head>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<!-- <link rel="stylesheet" href="css/style.css"> -->
	<!-- <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'> -->
	<link rel="stylesheet" href="./Includes/bootstrap/css/bootstrap.min.css">
	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
	<!-- <link rel='stylesheet' href='https://raw.githubusercontent.com/kartik-v/bootstrap-star-rating/master/css/star-rating.min.css'> -->
<style>
/* * {
  margin: 0;
  padding: 0;
} */
/* body { */
  /* display: flex;
  min-height: 100vh;
  align-items: center;
  justify-content: center;
  background: #ffe400; */
/* } */
.rating-css {
	height: auto;
  /* height: 250px;
  width: 400px; */
  /* background: #101012; */
  /* border: 4px solid #838383; */
  /* padding: 20px; */
}
.rating-css div {
  color: #ff9f00;
  /* font-size: 30px; */
  /* font-family: sans-serif; */
  /* font-weight: 800; */
  text-align: center;
  /* text-transform: uppercase;
  padding: 20px 0; */
}
.rating-css input {
  display: none;
}
.rating-css input + label {
  font-size: 40px;
  text-shadow: 1px 1px 0 #ffe400;
  cursor: pointer;
}
.rating-css input:checked + label ~ label {
  color: #838383;
}
.rating-css label:active {
  transform: scale(0.8);
  transition: 0.3s ease;
}

</style>
</head>
<body>
<div class="container-fluid card bg-light">
<div class="col-md-6 offset-3 ">
	<h3><b>Rating & Reviews</b></h3>
	<div class="row">
	
		<div class="col-md-6">
			<h5 align="center"><b><?php echo round($AVGRATE,1);?></b> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i>
			</h5>
			<p><?=$Total;?> ratings and <?=$Total_review;?> reviews</p>
		</div>
		<div class="col-md-6">
			<?php
			while($db_rating= mysqli_fetch_array($rating)){
			?>
				<h5 align="center"><?=$db_rating['rating'];?> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i> Total <?=$db_rating['Total'];?></h5>
				
				
			<?php	
			}
				
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">	
		<?php
			while($db_review= mysqli_fetch_array($review)){
		?>
				<h6><?=$db_review['rating'];?> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i> by <span style="font-size:14px;"><?=$db_review['name'];?></span></h6>
				<p><?=$db_review['remark'];?></p>
				<hr>
		<?php	
			}
				
		?>
		</div>
	</div>
	</div>		
</div>
<!-- End Container -->

<div class="container-fluid">
	<div class="card col-md-6 offset-3 mb-5">
	<div class="card-header">
	Add Your Review
	</div>
	<form action="./TestRattingProcess.php" method="POST" enctype="multipart/form-data">

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
	<!-- <div id="rating_div" style="display: inline-block;">
				<div class="star-rating">
					<span class="fa fa-star-o" data-rating="1" style="font-size:20px;"></span>
					<span class="fa fa-star-o" data-rating="2" style="font-size:20px;"></span>
					<span class="fa fa-star-o" data-rating="3" style="font-size:20px;"></span>
					<span class="fa fa-star-o" data-rating="4" style="font-size:20px;"></span>
					<span class="fa fa-star-o" data-rating="5" style="font-size:20px;"></span>
					<input type="hidden" name="whatever3" class="rating-value" value="1">
				</div>
	</div> -->

	<input type="hidden" name="demo_id" id="demo_id" value="1">
<div>
<textarea class="form-control" rows="1" placeholder="Write your review here..." name="remark" id="remark" required></textarea><br>
<input class="form-control-file" type="file" name="" id="">
<br>
<p><button  class="btn btn-outline-dark" name="addReview" id="addReview">Submit</button></p>
	</div>
	</form>
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="./Includes/jquery/jquery.min.js"></script> 
    <script src="./Includes/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="js/index.js"></script> -->

<script>

// 	$('#addReview').click(function(e){
// 	e.preventDefault();
// 	$r1 = $('#rating1');
// 	$r2 = $('#rating2');
// 	$r3 = $('#rating3');
// 	$r4 = $('#rating4');
// 	$r5 = $('#rating5');
// 	if($r1.prop("checked", true)){

// 		alert("1");
// 	}
// 	else if($r2.prop("checked", true)){

// 	alert("2");
// 	}
// 	else if($r3.prop("checked", true)){

// 	alert("3");
// 	}
// 	else if($r4.prop("checked", true)){

// 	alert("4");
// 	}
// 	else if($r5.prop("checked", true)){

// 	alert("5");
// }

// 	});
</script>
</body>
</html>