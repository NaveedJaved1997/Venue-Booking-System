<?php
include 'Header.php'
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <div class="card mt-1">
                    <table class="table">
                        <thead class="bg-primary">
                            <th><a class="text-white" href="./Dashboard.php">Dashboard</a></th>
                        </thead>
                       <tr>
                           <td><a href="./Settings.php">Settings</a></td>
                       </tr>
                        <tr>
                           <td><a class="text-danger" href="./Logout.php">Logout</a></td>
                       </tr>
                    </table>
                </div>
            </div>
            <div class="col bg-info text-white">
                <?php echo '<h1>Wellcome '. $_SESSION["username"]. '</h1>'; ?>
                <h5>Some Data Here.</h5>
                <h6>Some Data Here.</h6>
                <p>Some Data Here.</p>

            </div>
        </div>
    </div>

    <script src="./Includes/jquery/jquery.min.js"></script> 
    <script src="./Includes/bootstrap/js/bootstrap.min.js"></script>   
</body>
</html>