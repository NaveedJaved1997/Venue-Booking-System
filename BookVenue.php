<?php
$page_title = "Book Venue | Online Venue Booking System";
include './Header.php';
date_default_timezone_set("Asia/Karachi");
function build_calendar($month, $year, $venue) {
    include './Includes/db_connect.php';
    // $connection  = new mysqli('localhost', 'root', '', 'test_database');
    // for venues
    $stmt = $connection ->prepare("SELECT * FROM venues WHERE venue_status=2 AND availability=2 ");
    $venues = "";
    $first_venue = 0;
    $i = 0;
    $v = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                if($i==0){
                    $first_venue = $row['id'];
                }
                $venues .= "<option class='form-control' value='".$row['id']."'>".$row['name']."</option>";
                $v[] =  $row['id'];
                $i++;
            }
            $stmt->close();
        }
    }

    if($venue != 0){
        $first_venue = $venue;

    }

    // for bookings dates    
    $stmt = $connection ->prepare("SELECT * FROM bookings WHERE MONTH(date) = ? AND YEAR(date) = ? AND item_id = ?");
    $stmt->bind_param('ssi', $month, $year, $first_venue);
    $slot = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['date'];
                $slot[] = $row['timeslot'];
            }
            
            $stmt->close();
        }
    }

    
     // Create array containing abbreviations of days of week.
     $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

     // What is the first day of the month in question?
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

     // How many days does this month contain?
     $numberDays = date('t',$firstDayOfMonth);

     // Retrieve some information about the first day of the
     // month in question.
     $dateComponents = getdate($firstDayOfMonth);

     // What is the name of the month in question?
     $monthName = $dateComponents['month'];

     // What is the index value (0-6) of the first day of the
     // month in question.
     $dayOfWeek = $dateComponents['wday'];

     // Create the table tag opener and day headers
     
    $datetoday = date('Y-m-d');
    

    $calendar = "<table class='table table-bordered table-sm table-responsive-lg mb-5'>";
    $calendar .= "<center><h2 class='mt-3'>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-xs btn-dark' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
    
    $calendar.= " <a class='btn btn-xs btn-dark' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
    
    if(date('m') <= date('m', mktime(0,0,0, $month+4))){
        $calendar.= "<a class='btn btn-xs btn-dark' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></center><br>";        
    }
    else{
        $calendar.= "<a class='btn btn-xs btn-dark text-white' >Next Month</a></center><br>";
    }


          //venues here
          $calendar .= "<form  id='venue_select_form'>
          <div class='row'>
              <div class='col-6 offset-3'>
              <center>
              <label class='form-lable'><b>Choose a Hall | Venue</b></label></center>
              <select class='form-control mb-1' name='venue' id='venue_select'>
              ".$venues."
              </select>
              <input type='hidden' name='month' value=".$month.">
              <input type='hidden' name='year' value=".$year.">
            <!-- <input type='hidden' name='venue' value=".$v[0]."> -->
              </div>
          </div>
          </form>";
        
      $calendar .= "<tr>";


     // Create the calendar headers

     foreach($daysOfWeek as $day) {
          $calendar .= "<th  class='header bg-light'>$day</th>";
     } 

     // Create the rest of the calendar

     // Initiate the day counter, starting with the 1st.

     $currentDay = 1;

     $calendar .= "</tr><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

     if ($dayOfWeek > 0) { 
         for($k=0;$k<$dayOfWeek;$k++){
                $calendar .= "<td  class='empty'></td>"; 

         }
     }
    
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while ($currentDay <= $numberDays) {

          // Seventh column (Saturday) reached. Start a new row.

          if ($dayOfWeek == 7) {

               $dayOfWeek = 0;
               $calendar .= "</tr><tr>";

          }
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          $date = "$year-$month-$currentDayRel";
          
            $dayname = strtolower(date('l', strtotime($date)));
            $eventNum = 0;
            $today = $date==date('Y-m-d')? "today" : "";
           

           //yesterday 
            if($date<date('Y-m-d')){
            $calendar.="<td class='alert-danger'><h4 style='color:#212529'>$currentDay</h4><button class='btn btn-danger btn-xs'>Not Available</button>";
            }
            //today
            else if($date==date('Y-m-d')){
                $totalbookings = checkSlots($connection , $date, $venue);
                if($totalbookings == 2){
                    $calendar.="<td class='$today alert-warning'>
                    <h4 style='color:#212529'>$currentDay</h4>
                     <a class='btn btn-danger btn-xs text-white m-1'>All Booked</a>";
                }
                else{
                    $calendar.="<td class='alert-warning'><h4 style='color:#212529'>$currentDay</h4>
                    <a href='book.php?date=".$date."&venue=".$venue."' class='btn btn-warning btn-xs text-white m-1'>Book Now</a>";
                }

                }
          
        //  elseif(in_array($date, $bookings)){
           
        //      $calendar.="<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Already Booked</button>";
        //  }
         else{
            $totalbookings = checkSlots($connection , $date, $venue);
            if($totalbookings == 2){
                $calendar.="<td class='$today alert-danger'>
                <h4 style='color:#212529'>$currentDay</h4>
                 <a class='btn btn-danger btn-xs text-white m-1'>All Booked</a>";
            }
            else{
                $calendar.="<td class='$today'>
                <h4>$currentDay</h4>
                 <a href='book.php?date=".$date."&venue=".$venue."' class='btn btn-success btn-xs m-1'>Book Now</a>";
            }
            // $calendar.="<td class='$today'>
            // <h4>$currentDay</h4>
            //  <a href='book.php?date=".$date."' class='btn btn-success btn-xs m-1'>Book Now</a>";
         }
            
            
           
            
          $calendar .="</td>";
          // Increment counters
 
          $currentDay++;
          $dayOfWeek++;

     }
     
     

     // Complete the row of the last week in month, if necessary

     if ($dayOfWeek != 7) { 
     
          $remainingDays = 7 - $dayOfWeek;
            for($l=0;$l<$remainingDays;$l++){
                $calendar .= "<td class='empty'></td>"; 

         }

     }
     
     $calendar .= "</tr>";

     $calendar .= "</table>";

     echo $calendar;

}
    //check slots
    function checkSlots($connection , $date, $venue){
    $stmt = $connection ->prepare("SELECT * FROM bookings WHERE date = ? AND item_id = ?");
    $stmt->bind_param('ss', $date, $venue);
    $totalbookings =0;
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $totalbookings++;
            }
            
            $stmt->close();
        }
}
return $totalbookings;
}
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"> -->
    <!-- <style>
       @media only screen and (max-width: 760px),
        (min-device-width: 802px) and (max-device-width: 1020px) {

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;

            }
            
            

            .empty {
                display: none;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }



            /*
		Label the data
		*/
            td:nth-of-type(1):before {
                content: "Sunday";
            }
            td:nth-of-type(2):before {
                content: "Monday";
            }
            td:nth-of-type(3):before {
                content: "Tuesday";
            }
            td:nth-of-type(4):before {
                content: "Wednesday";
            }
            td:nth-of-type(5):before {
                content: "Thursday";
            }
            td:nth-of-type(6):before {
                content: "Friday";
            }
            td:nth-of-type(7):before {
                content: "Saturday";
            }


        }

        /* Smartphones (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            body {
                padding: 0;
                margin: 0;
            }
        }

        /* iPads (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
            body {
                width: 495px;
            }
        }

        @media (min-width:641px) {
            table {
                table-layout: fixed;
            }
            td {
                width: 33%;
            }
        }
        
        .row{
            margin-top: 20px;
        }
        
        .today{
            background:yellow;
        }
        
        
        
    </style> -->
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                     $dateComponents = getdate();
                     if(isset($_GET['month']) && isset($_GET['year'])){
                         $month = $_GET['month']; 			     
                         $year = $_GET['year'];
                     }else{
                         $month = $dateComponents['mon']; 			     
                         $year = $dateComponents['year'];
                     }
                     if(isset($_GET['venue'])){
                        $venue = $_GET['venue'];
                        // echo $venue;
                        
                     }
                     else{
                         $venue = 1;
                     }
                    echo build_calendar($month,$year, $venue);
                ?>
            </div>
        </div>
    </div>
</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
$("#venue_select").change(function(){
    $("#venue_select_form").submit();
});

$("#venue_select option[value='<?php echo $venue;?>']").attr('selected', 'selected');
</script>
</html>

<?php include './Footer.php';?>
