<?php
include './Includes/db_connect.php';

// $select = "SELECT * FROM venues";
// $result = mysqli_query($connection, $select);
// while ($num = mysqli_fetch_assoc($result)) {
//     $vendor = "SELECT * FROM vendors WHERE id= '".$num['vendor_id']."'";
//     $vendorResults = mysqli_query($connection, $vendor);
//     $row = mysqli_fetch_assoc($vendorResults);
    
// echo 'id = '. $num['id'];
// echo '<br>'; 
// echo ' name = '. $num['name'];
// echo '<br>'; 
// echo ' address = '. $num['address'];
// echo '<br>'; 
// echo ' Vendor name = '. $row['name'];
// echo '<br>'; 
// echo '*************************************************************';
// echo '<br>'; 

// }
?>
<?php
        $vdate = '2021-05-08';
        
        $sql2 = "SELECT * FROM venues WHERE availability = 2";
        $res = mysqli_query($connection, $sql2);
        //$status = mysqli_fetch_assoc($res);
        ?>

        <?php
      
        // if ($check = mysqli_fetch_assoc($result)>0) {
            $isTrue=false;

            while ($num = mysqli_fetch_assoc($res)) {
                // $sql = "SELECT * FROM venue_bookings WHERE venue_id = '".$num['id']."'";
                $sql = "SELECT * FROM venue_bookings";
                $result = mysqli_query($connection, $sql);
                // $row = mysqli_fetch_assoc($result);
                
                //new test
                while ($row = mysqli_fetch_assoc($result)) {

                
                // if($row['venue_id'] != $num['id'] && $row['date'] = $vdate){
                    if($row['venue_id'] == $num['id']){
                        if($row['date'] == $vdate){
                           
                            // echo '<script> alert("id = false") </script>';
                            echo '********** record matched *********** </br>';
                            echo $row['venue_id'];
                            echo ' , ';
                            echo $num['id'];
                            echo 'name : '. $num['name'];
                            echo 'and';
                            echo $row['date'];
                            echo ', date ==';
                            echo $vdate;
                            echo '<br>';

                             $isTrue=false;
                             goto next;

                            
                        }
                        else{
                            $isTrue= true;
                            echo '-------------- record not matched ----------- </br>';
                            echo $row['venue_id'];
                            echo ' , ';
                            echo $num['id'];
                            echo $num['name'];
                            echo 'and';
                            echo $row['date'];
                            echo ', date ==';
                            echo $vdate;
                            echo '<br>';
                            

                        }
                }
                else if($row['venue_id'] != $num['id']){
                    $isTrue=true;
                        //    echo '<script> alert("'.$isTrue.'") </script>';
                       
                }
                else{
                    $isTrue=false;
                    
                }
            }
                // test lable 
                next:
                if($isTrue){
      
        ?>
                    <br>

<br><br>                    <tr>
                        <td id="venue_id" value="<?php echo $num["id"] ?>">
                        <?php echo $num['id']; ?></td>
                        <td><a id="showvenuedetails" href="ShowDetails.php?venue_id=<?php echo $num["id"] ?>" type="button">
                        <?php echo $num['name']; ?></a></td>
                        <td><?php echo $num['address']; ?></td>
                        <td><?php echo $num['price']; ?></td>
                    </tr>
        <?php
                }

        }

        ?>              
