<?php
session_start();
include './Includes/db_connect.php';

if(isset($_POST['upload_btn'])){

    
    $image = $_FILES['imageupload']['name'];
    //chnage name test
    //1st
    // $newfilename= date('dmYHis').str_replace(" ", "", basename($_FILES["imageupload"]["name"]));

    // 2nd
    $temp = explode(".", $_FILES["imageupload"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    // echo $temp[1];
    // echo $newfilename;
    // $target = './Includes/uploads/'.basename($_FILES['imageupload']['name']);
    // 3rd
    // $filename   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
    // $extension  = pathinfo( $_FILES["imageupload"]["name"], PATHINFO_EXTENSION ); // jpg
    // $basename   = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg
    // $source       = $_FILES["imageupload"]["tmp_name"];
    // $destination  = "$target{$basename}";
    
    // 4th
    // $filename = $_FILES["imageupload"]["name"];
	// $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	// $file_ext = substr($filename, strripos($filename, '.')); // get file name
	// $filesize = $_FILES["imageupload"]["size"];


    // $without_extension = pathinfo($filename, PATHINFO_FILENAME);

    $sql = "INSERT INTO images (name)
	VALUES ('$newfilename')";
	$result = mysqli_query($connection,$sql);

    if(copy($_FILES['imageupload']['tmp_name'], "./Includes/uploads/" .$newfilename)){
		echo '        <div class="page-height">';
        echo '<div class="col card alert-success mt-2 p-1">
        
        <p class="p-2"><b>Success!</b> Image Updated. <i>again.</i></p>
            </div>';
            echo '<a class="p-3 mt-3" href="./Index.php">Return Home</a>
             </div>';
    }
    else{
		echo '        <div class="page-height">';
        echo '<div class="col card alert-danger mt-2 p-1">
        <p class="p-2"><b>ERROR!</b> Somehow an <i>Error.</i> occured.</p>
            </div>';
            echo '<a class="p-3 mt-3" href="./Index.php">Return Home</a>
            </div>';

	}

	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Includes/bootstrap/css/bootstrap.min.css">
    <title>Image test</title>
</head>
<body>
    <div class="container pt-5">
        <div class="card col-6 offset-3 p-0">
            <div class="card-header">
            Image upload test
            </div>

            <div class="card-body">
                <form action="#" method="post" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="imageupload"  class="form-group" required>
                <button type="submit" name="upload_btn" class="btn btn-outline-success form-group"> Upload</button>
                </form>
            </div>
        </div>
    </div>

    <!-- show image -->
    <div class="container pt-5">
        <div class="card col-6 offset-3 p-0">
            <div class="card-header">
            Show Image Here
            </div>
            <div class="card-body">

    <?php
    $sql = "SELECT * FROM images ";
    $result = mysqli_query($connection, $sql);

    while ($num = mysqli_fetch_assoc($result)) {
        
    ?>
            <img src="./Includes/uploads/<?php echo $num['name']?>"
            alt="<?php echo $num['id']?>">
            </div>
        </div>
    </div>
<?php
}
?>
</body>
</html>