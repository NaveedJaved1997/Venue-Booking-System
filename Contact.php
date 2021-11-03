<?php 
$page_title = "Contact | Online Venue Booking System";
Include 'Header.php';

//email - send query
if(isset($_POST['contactUs'])){
    $name=$_POST['fname'];
    $msg=$_POST['msg'];
    $email=$_POST['email'];
    $sub=$_POST['subject'];

    $to = "njgujjar345@gmail.com";
    $subject = $sub;
    $body = "Hi, i am $name. $msg. From: $email";
    $headers = "From: teamzafhnofficial@gmail.com";
    
    if (mail($to, $subject, $body, $headers)) {
        echo '<div class="alert alert-success alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>Success!</b> Your Query is sent.<i> Your query will be answered in 48 hours. THANK YOU!</i></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button> </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
        <p class="p-2"><b>ERROR!</b> Somehow an <i>Error occured.</i></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';

    }
}

?>
<style>
  .heading { line-height: 1.5;
  font-weight: 400;
  font-family: "Poppins", Arial, sans-serif;
  color: #000; }
</style>
<div class="container-fluid bg-light">   
<div class="container  pt-1 pb-3">
    <div>
        <h4 class="venues-head">Contact US</h4>
    </div>

            <div class="container">
            <div class="row">
            <div class="card col-sm-12 col-md-6 col-lg-7 p-0"style="background-color:#e8edf0;">
                <div class="">
                    <h3 class="heading p-2 pl-3 pb-0">Send Your Queries | Suggestions</h3>
                </div>
                <div class="card-body">
                    <form action="./Contact.php" method="POST">
                    <label for="fname">FULL NAME</label>
                        <input class="form-control mb-1" type="text" name="fname" id="fname" placeholder="Enter Your Name *" required>
                        <label for="email">EMAIL ADDRESS</label>
                        <input class="form-control mb-1" type="email" name="email" id="email" placeholder="Enter Your Email *" required>
                        <label for="subject">SUBJECT</label>
                        <input class="form-control mb-1" type="text" name="subject" id="subject" placeholder="Enter Your Subject *" required>
                        <label for="msg">MESSAGE</label>
                        <textarea class="form-control mb-1" name="msg" id="msg" cols="20" rows="6" placeholder="Write Your Message *" required></textarea>
                        <button class="form-control btn btn-outline-dark" type="submit"
                        id="contactUs" name="contactUs">Send</button>
                    </form>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-5 m-0 p-0 " style="height:560px;">
            <!-- <div class="card-header bg-secondary text-white">
            GPS Location
            </div> -->
                <div class="w-100 h-100 m-0 p-0 ">
                <iframe class="w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d4636.773283877829!2d73.97501381797102!3d31.707243392785273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x3918c3331008f699%3A0x67d30b4abd01648!2sHamza%20Computers%20Shop%20%23%2058%2C%20Stadium%20Rd%2C%20Sheikhupura%2C%20Punjab%2C%20Pakistan!3m2!1d31.7073412!2d73.975614!5e0!3m2!1sen!2s!4v1619263979208!5m2!1sen!2s"
                allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            </div>
            </div>
<div class="container">

            <div class="row p-3 mt-5">
        <!-- <div class="col-sm-12"> -->
            <!-- <h4 class="">Contact Details</h4> -->
      <!-- <div> -->
      <div class="col-sm-6 col-md-3 text-center" >
        <i class="fa fa-map-marker fa-4x bg-dark text-white rounded-circle p-3"></i> <p>Sheikhupura Stadium, Punjab, Pakistan</p>
        </div>
        <div class="col-sm-6 col-md-3 text-center" >
       <i class="fa fa-envelope fa-4x bg-dark text-white rounded-circle p-3"></i> <p> <a href="mailto:contact@ovbs.com">contact@ovbs.com</a> </p>
        </div>
        <div class="col-sm-6 col-md-3 text-center" >
       <i class=" fa fa-phone fa-4x bg-dark text-white rounded-circle p-3"></i> <p> <a href="tel://+923451234567">+92 345 123 4567</a></p>
        </div>
        <div class="col-sm-6 col-md-3 text-center" >
        <i class="fa fa-globe fa-4x bg-dark text-white rounded-circle p-3"></i>
                    <p><a href="./Index.php">Online Venue Booking System</a></p>
        </div>
      <!-- </div>           -->
            </div>

            <!-- <div class="col-sm-12 col-md-3 m-0 p-0 text-center m-sm-3">
            <h4>Want to Ask or Suggest Somthing ?</h4>
            <h5>Fill The Form and Press SEND Button. </h5>
            </div> -->
            <!-- </div> -->
            </div>
</div>
</div>
<?php
include 'Footer.php';
?>