<?php
include './Includes/db_connect.php';
//Find Current user 
$client = '';
if(!empty($_SESSION["userid"])){
  $client = $_SESSION["userid"];
}
if(isset($_POST['addReview'])){
   
// if(!empty($_POST['rating'])) {
// // Counting number of checked checkboxes.
// $checked_count = count($_POST['rating']);
// echo "You have selected following option: <br/>";
// // Loop to store and display values of individual checked checkbox.

// foreach($_POST['rating'] as $selected) {

// echo "<p>".$selected ."</p>";
// }
// }
// else{
// echo "<b>Please Select Atleast One Option.</b>";
// }

    $review_rating = mysqli_real_escape_string($connection,$_POST['rating']);
    $review_text =  mysqli_real_escape_string($connection,$_POST['remark']);
    $review_img = 1;
    $review_user_id= $client;
    if($review_rating){
        echo $review_rating. '</br>';
        echo $review_text. '</br>';
        echo $review_user_id. '</br>';
    }
}

//Geting Rating and reviews
$query = mysqli_query($connection,"SELECT AVG(rating) as AVGRATE from venue_rating ");
$row = mysqli_fetch_array($query);
$AVGRATE=$row['AVGRATE'];
$query = mysqli_query($connection,"SELECT count(rating) as Total from venue_rating");
$row = mysqli_fetch_array($query);
$Total=$row['Total'];
$query = mysqli_query($connection,"SELECT count(remark) as Totalreview from  venue_rating");
$row = mysqli_fetch_array($query);
$Total_review=$row['Totalreview'];
$review = mysqli_query($connection,"SELECT remark,rating,name from venue_rating limit 4 ");
$rating = mysqli_query($connection,"SELECT count(*) as Total,rating from venue_rating group by rating ");
?>