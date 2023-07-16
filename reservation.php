<?php 
<<<<<<< HEAD
=======

>>>>>>> 1d48e4f6eb1700fbfd215962f8bd8f5dba47f036
include('config.php');
//  'iqbal dapat tak';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reservation Application</title>

  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Car Park</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

  <!--Start sidebar-wrapper-->
  <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
      <a href="index.php">
        <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        <h5 class="logo-text">Dash Carpark</h5>
      </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
        <a href="index.php">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li>
        <a href="parking_lot.php">
          <i class="zmdi zmdi-format-list-bulleted"></i> <span>Reservations</span>
        </a>
      </li>
    </ul>
  </div>
<!--End sidebar-wrapper-->

<!--Start topbar header-->

<header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top">
      <ul class="navbar-nav mr-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link toggle-menu" href="javascript:void();">
            <i class="icon-menu menu-icon"></i>
          </a>
        </li>
      </ul>
  
      <ul class="navbar-nav align-items-center right-nav-link">
        <?php echo "Hello "." ".$_SESSION['firstname'] ?>

        <li class="nav-item">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
            <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-right">
            <li class="dropdown-item user-details">
              <a href="javaScript:void();">
                <div class="media">
                  <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                </div>
              </a>
            </li>
            <li class="dropdown-divider"></li>
              <li class="dropdown-item">
                <a href="profile.php">
                  <i class="fa fa-user"></i> Profile
                </a>
              </li>
            <li class="dropdown-item">
              <a href="logout.php">  
                <i class="fa fa-sign-out"></i> Logout
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
<!--End topbar header-->

<!--Start Row-->
<div class="clearfix"></div>
	
    <div class="content-wrapper">
      <div class="container-fluid">
  
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Parking Details</div>
              <hr>
              <div class="reservation-container">
              <?php
              // Get the selected lot from the query string
              $lot = $_GET['lot'];
              $reservation_id = [];

              var_dump($lot);
              var_dump($reservation_id);

              $stmt = $pdo->prepare("SELECT RESERVATIONID AS RESERVATIONID FROM RESERVATIONS");
              $stmt->execute();
              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

              // Data from the database
              foreach ($rows as $row) {
                  $reservation_id[] = ['reservation_id' => $row['RESERVATIONID']];
              }
              ?>

              <h3>Reserve Parking Lot <?php echo $lot; ?></h3>

              <form action="work/reservation.w.php" method="post">
                  <input type="hidden" class="form-control" id="parkingid" name="parkingid" value="<?php echo $lot; ?>" required>
                  <input type="hidden" class="form-control" id="reservationid" name="reservationid" required>

                  <div class="form-group">
                      <label for="duration">Duration:</label>
                      <input type="number" class="form-control" id="duration" placeholder="Days" name="duration" required>
                  </div>

                  <div class="form-group">
                      <label for="date">Date:</label>
                      <input type="date" class="form-control" id="reservation_date" name="reservation_date" value="<?php echo $lot ?>" required>
                  </div>

                  <div class="form-group">
                      <label for="totalcost">Total Cost:</label>
                      <div id="totalCostPlaceholder"></div>
                  </div>

                  <!-- Calculation Button -->
                  <td>
                      <div class="calculatecost">
                          <div class="form-group">
                            <button type="button" class="btn btn-light px-4" id="calculateTotal">Calculate</button>
                          </div>
                      </div>

                  <!-- Submit Button -->
                  <div class="form-group">
                      <a href="checkout.php"><button type="submit" class="btn btn-light px-5">ADD TO CART</button></a>
                  </div>
              </form>
              </div>


              <div class="form-group">                         
                <?php 
                $stmt = $pdo->prepare("SELECT DURATION
                                      FROM RESERVATIONS
                                      JOIN CUSTOMERS 
                                      USING(CUSTOMERID)
                                      WHERE CUSTOMERID = :customerid");
                    
                $stmt->bindParam(':customerid', $_SESSION['customerid']);
                $stmt->bindParam(':duration', $_SESSION['duration']);
                $stmt->execute();?>
              </div>

                <!-- <input type="hidden" name="lot" value="<?php echo $slotnum; ?>"> -->
                <?php 
                  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($rows as $row)            
                ?>
                <tr>
                <td>
                <!-- Form Totalcost Calculate Duration -->
                <?php               
                $duration = $row['DURATION'];
                $totalcost = $duration * 50;
                ?>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>      
      <!--End Row-->

    <!--start overlay-->
      <div class="overlay toggle-menu"></div>
    <!--end overlay-->

    </div>
    <!-- End container-fluid-->
    
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
    <!--Start footer-->
    <footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2018 Dashtreme Admin
        </div>
      </div>
    </footer>
	<!--End footer-->

   
  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
 <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
	
  <script>
    // Calculate total cost
    document.getElementById('calculateTotal').addEventListener('click', function() {
      var duration = document.getElementById('duration').value;
      var totalCost = duration * 50;
      document.getElementById('totalCostPlaceholder').innerHTML = 'RM ' + totalCost;
    });
  </script>

  <!--style start-->
  <style>
    hr {
        border: none;
        border-top: 2px solid #ccc;
        margin: 20px 0;
    }

    .reservation-container {
        max-width: 400px;
        margin: 0 auto;
    }

    h3 {
        font-family: Arial, sans-serif;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="date"] {
        width: 100%;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .btn-reserve {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        font-size: 18px;
        cursor: pointer;
    }

    .btn-reserve:hover {
        background-color: #45a049;
    }
  </style>
<!--End style-->

</body>
</html>