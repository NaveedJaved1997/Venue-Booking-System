
$(document).ready(function(){
  $("#booking-error").hide();
});

// Dismis Previous Modal / Login | Register - nav bar
$("#register-btn").click(function(){
  $("#LoginModal").modal('hide');
  $("#LoginModal").fadeOut(1000);
});

$("#vlogin-btn").click(function(){
  $("#VRegisterModal").modal('hide');
  $("#VRegisterModal").fadeOut(1000);
});
//Vendors page          
$("#vregister-btn").click(function(){
  $("#VLoginModal").modal('hide');
  $("#VLoginModal").fadeOut(1000);
});

$("#login-btn").click(function(){
  $("#RegisterModal").modal('hide');
  $("#RegisterModal").fadeOut(1000);
});

//Check old date in booking
$("#checkvenue").click(function(e) {
e.preventDefault();
var searchdate = $("#findvenue").val();
if(searchdate!=''){


var d = new Date();
d.setHours(0,0,0,0);

  if (Date.parse(searchdate)-Date.parse(new Date())<0) {
      // alert("ERROR! Plese Select Correct Date.");
      $("#booking-error").show();
  } else {
          $("#findvenueform").submit();
      }
    }
    else{ 
      alert('Please Select A Date');
      $("#findvenue").addClass("border-danger");
    }
    });
