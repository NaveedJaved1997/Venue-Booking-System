<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./Includes/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./Includes/font-awesome/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Old+Standard+TT" />
  <link rel="stylesheet" href="./Includes/css/style.css">
  <title>Ratting Process</title>
</head>

<body>
  <?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  include './Includes/db_connect.php';
  //Find Current user 
  $client = '';
  if (!empty($_SESSION["userId"])) {
    $client = $_SESSION["userId"];
  }
  // $review_item_id = null;
  if (isset($_POST['addReview'])) {
    if (!empty($_SESSION["userId"])) {
      $from_id=null;
      $review_item=null;
      $id=null;
      
      if(isset($_POST['car_id'])){
        // $insert_in= 'car_rating';
        // echo $insert_in;
        $from_id= 'car_id';
        $review_item = 'car';
        // echo $from_id;
        $id = mysqli_real_escape_string($connection, $_POST['car_id']);
        // echo $id;

      }
      else if (isset($_POST['venue_id'])){
        // $insert_in= 'venue_rating';
        $from_id='venue_id';
        $review_item = 'venue';
        $id = mysqli_real_escape_string($connection, $_POST['venue_id']);
      }
      
      $review_rating = mysqli_real_escape_string($connection, $_POST['rating']);
      $review_text =  mysqli_real_escape_string($connection, $_POST['remark']);
      $review_img = 50;
      $review_user_id = $client;
      // $review_item_id = $from_id;
      // echo $review_item_id;
      $VenueImageResults=50; 
      if($_FILES['imageupload']['name']){
        //Image 
      $image = $_FILES['imageupload']['name'];
      $temp = explode(".", $_FILES["imageupload"]["name"]);
      $newfilename = round(microtime(true)) . '.' . end($temp);
     
    //  $imageInsert = "INSERT INTO images (name)
    //         VALUES ('$newfilename')";
    //   $resImage = mysqli_query($connection, $imageInsert);
      // if (

        // ){
        // $findNewVenueImage = "SELECT * FROM images WHERE name = '" . $newfilename . "' LIMIT 1";
        // $VenueImage = mysqli_query($connection, $findNewVenueImage);
        // $VenueImageResults = mysqli_fetch_array($VenueImage);
        // $UpdateVenueImageId = "UPDATE venues SET image = '".$VenueImageResults['id']."' WHERE name = $vname";
        // $UpdateVenueImage = mysqli_query($connection, $UpdateVenueImageId);

        // echo '<script> alert("no error"); </script>';
      
            // else {
      //   echo '<script> alert("error occured in image upload"); </script>';
      // }
    // }
  // }
  // else{
  //   $VenueImageResults=50; 
  }
      $sql = "INSERT INTO reviews (remark, rating, posted_by, item, item_id, image)
    VALUES ('$review_text', '$review_rating', '$review_user_id', '$review_item', '$id', '$newfilename')";
      $result = mysqli_query($connection, $sql);
      if ($result) {
        copy($_FILES['imageupload']['tmp_name'], "./Includes/uploads/" . $newfilename);
        echo '  <div class="page-height">';
        echo '<div class="col card alert-success mt-2 p-1">
          <p class="p-2"><b>Success!</b> Review Added. <i>Successfully.</i></p>
              </div>';
        echo '<a class="p-3 mt-3" href="./Index.php">Go Home</a>
               </div>';
      } else {
        echo '        <div class="page-height">';
        echo '<div class="col card alert-danger mt-2 p-1">
          <p class="p-2"><b>ERROR!</b> Somehow an <i>Error.</i> occured.</p>
              </div>';
        echo '<a class="p-3 mt-3" href="./Index.php">Go Home</a>
              </div>';
      }
    } else {
      echo '        <div class="page-height">';
      echo '<div class="col card alert-info mt-2 p-1">
    <p class="p-2"><b>ERROR!</b> Please Login First.<i>To Add a Review.</i></p>
        </div>';
      echo '<a class="p-3 mt-3" href="./Index.php">Go Home</a>
        </div>';
    }
  }
  ?>
</body>
</html>