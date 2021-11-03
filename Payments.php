<?php 
 $page_title = "Payment | Online Venue Booking System";
include './Header.php';
if(isset($_GET['item'])){
   $item = $_GET['item'];
   $itemId = $_GET['item_id'];
   $date = $_GET['date'];
   $slot = $_GET['timeslot'];
   $name='';
//    echo $item, $itemId, $date;
    //for booking details
    $findQuery = "SELECT * FROM bookings WHERE item= '".$item."' AND item_id = '".$itemId."' AND date = '".$date."' AND timeslot = '".$slot."' LIMIT 1";
    $findQueryResults = mysqli_query($connection, $findQuery);
     $row = mysqli_fetch_assoc($findQueryResults); 
    //for Item details
    $item = $item .'s';
    // echo $item;
    $ItemQuery = "SELECT * FROM $item WHERE id = '".$row['item_id']."' LIMIT 1";
    $ItemQueryResults = mysqli_query($connection, $ItemQuery);
    $ItemDetails = mysqli_fetch_assoc($ItemQueryResults);
    // $ItemDetails['price'];
    if(strpos($item, 'car') !== false){
        $name = $ItemDetails['car_number'];
        $item = "car";
    }
    else if(strpos($item, 'venue') !== false){
        $name = $ItemDetails['name'];
        $item = "venue";
    }   
?>
    <div class="container p-3">
        <div class="card p-0  col-lg-6 offset-lg-3">
            <div class="card-header bg-dark text-white">
            Payment
            </div>
            <div class="card-body">
            <div class="card-img-top">
            <img class="card-img col-6 offset-3 p-1" src="./Includes/media/easypaisa.png" alt="" srcset="">
            </div>
            <p class="text-danger pt-2">Plaese pay Amount of: <b><?php echo  $ItemDetails['price'];?></b>  at EasyPaisa Account: <b>0345XXXXXXX</b>
            for booking of : <i><?php echo  $name;?></i> . <b><i>THANK YOU!</i></b></p>
            </div>
            <div class="border p-3">
            <form class="" action="./Payments.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="item" value="<?php echo $item;?>">
            <input type="hidden" name="itemId" value="<?php echo $itemId;?>">
            <input type="hidden" name="client_id" value="<?php echo $row['client_id'];?>">
            <input type="hidden" name="vendor_id" value="<?php echo $row['vendor_id'];?>">
            <input type="hidden" name="date" value="<?php echo $date;?>">
            <input type="hidden" name="timeslot" value="<?php echo $slot;?>">
            <label for="imageupload">Please Upload Screenshot</label>
            <input class="form-control-file" type="file" name="imageupload" id="imageupload" required>
            <button class="btn btn-outline-dark mt-2" name="paymentSend" type="submit">Submit</button>
            </form>
            </div>
        </div>
    </div>
<?php
}

//send payment ss
if(isset($_POST['paymentSend'])){
    $item = $_POST['item'];
    $itemId = $_POST['itemId'];
    $clientId = $_POST['client_id'];
    $vendorId = $_POST['vendor_id'];
    $date = $_POST['date'];
    $slot = $_POST['timeslot'];
    // echo "item: ". $item. " and  itemid: ". $itemId;
    // echo "client id : " . $clientId . " and  Vendor ID: " . $vendorId;
    if( $_FILES['imageupload']['name']){
        $image = $_FILES['imageupload']['name'];
        $temp = explode(".", $_FILES["imageupload"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
    
        // $sql = "INSERT INTO images (name)
        // VALUES ('$newfilename')";
        // $result = mysqli_query($connection,$sql);
    
        // if(
        //     copy($_FILES['imageupload']['tmp_name'], "./Includes/uploads/" .$newfilename)
        //     ){
            // $findnewImageid = "SELECT * FROM images WHERE name = '".$newfilename."' LIMIT 1";
            // $findnewImage = mysqli_query($connection, $findnewImageid);
            // $Imageresults = mysqli_fetch_assoc($findnewImage);
            // $imageId = $Imageresults['id'];
            // // echo $imageId;
    
            $paymentQuery = "INSERT INTO payments (item, item_id, client_id, vendor_id, image, date, timeslot)
            VALUES ('$item', '$itemId', '$clientId', '$vendorId', '$newfilename', '$date', '$slot')";
            $payments = mysqli_query($connection, $paymentQuery);
            if($payments){
                copy($_FILES['imageupload']['tmp_name'], "./Includes/uploads/" .$newfilename);
                echo '<div class="page-height"> <div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
                <p class="p-2"><b>Success!</b> Payment Proof is Uploaded. <i></i></p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div></div>';
              echo "<script>
              setTimeout(function(){
                  var url = './index.php';
                  $(location).attr('href',url);
              }, 3000); 
              </script>";
            }
            else{
                echo '<div class="page-height"><div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
            <p class="p-2"><b>ERROR!</b> Somehow an <i>Error.</i> occured.</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div></div>';
            }
    }


        
    }
    // else{
    //     echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
    //     <p class="p-2"><b>ERROR!</b> Somehow an <i>Error.</i> occured.</p>
    //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //     <span aria-hidden="true">&times;</span>
    //   </button>
    //     </div>';
	// }
	// }
?>

<?php include './Footer.php';?>