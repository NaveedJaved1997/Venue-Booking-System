<!-- footer -->
<div class="container-fluid fixed-bottom footer">
<div class="row">
  <div class="col-12">
      <div class="card bg-dark text-white">
        <div class="card-body">
          <h5 style="display: inline;">Copyright &copy; 2021</h5>
          <a href="#Top"><i class="fa fa-arrow-up fa-2x"
          style="float:right; color:white;" aria-hidden="true"></i></a>
        </div>
      </div>
 </div>
</div>
 </div>

    <script src="../Includes/jquery/jquery.min.js"></script> 
    <script src="../Includes/bootstrap/js/bootstrap.min.js"></script>
    <script>
        // $('#myModal').on('shown.bs.modal', function () {
        // $('#myInput').trigger('focus')
        // })
        
          // Dismis Previous Modal
          $("#register-btn").click(function(){
            $("#LoginModal").modal('hide');
            $("#LoginModal").fadeOut(1000);
          });

          $("#login-btn").click(function(){
            $("#RegisterModal").modal('hide');
            $("#RegisterModal").fadeOut(1000);
          });

          //Current Active Nav Link            
    </script>   
</body>
</html>