<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Includes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Includes/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Includes/css/style.css">
    <title>Vendors: Add Venue</title>
</head>

<body>
        <!-- Add Venue Modal -->
        <div class="modal fade" id="AddVenueMondal" tabindex="-1" role="dialog" aria-labelledby="AddVenueMondalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="AddVenueMondalLabel">Add A New Venue</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="#" method="post">
                      <label for="venue-name">Venue Name</label>
                      <input class="form-control" type="text" id="venue-name" name="venue-name" required>
                      <label for="venue-address">Venue Address</label>
                      <input class="form-control" type="text" id="venue-address" name="venue-address" required>
                      <label for="venue-stime">Venue Time</label>
                      <input class="form-control" type="time" id="venue-stime" name="venue-stime" required>
                      <label for="venue-etime">Venue Time</label>
                      <input class="form-control" type="time" id="venue-etime" name="venue-etime" required>
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal">Add</button>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

    <!-- navbar -->
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="#">OVBS</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="../Home.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Bookings.html">Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../About.html">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Contact.html">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.html">Vendors</a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- show venue -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 offset-2 mt-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <a class="text-white" href="" data-toggle="modal" data-target="#AddVenueMondal">[Add New Venue]</a>
                    </div>
                    <!-- <div class="card-body"> -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Taj Mahal</td>
                                    <td>abc road, near g point</td>
                                    <td>12:00PM - 03:00PM</td>
                                    <th>
                                        <a href="">Edit</a>
                                        <a href="">Delete</a>
                                    </th>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>A+ Marque</td>
                                    <td>abc road, near g point</td>
                                    <td>04:00PM - 07:00PM</td>
                                    <th>
                                        <a href="">Edit</a>
                                        <a href="">Delete</a>
                                    </th>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Sultan Grand</td>
                                    <td>abc road, near g point</td>
                                    <td>08:00PM - 11:00PM</td>
                                    <th>
                                        <a href="">Edit</a>
                                        <a href="">Delete</a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    <!-- </div> -->
                </div>          
            </div>
        </div>
    </div>

    <script src="../Includes/jquery/jquery.min.js"></script>
    <script src="../Includes/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>