<?php
  include ("conn.php");
  //  session_start();

  //  if (!isset($_SESSION['user'])) {
  //   header("Location: login.php");
  //   exit();
  //  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Admin Page</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
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
        <a href="index-adm.php">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li>
        <a href="staff_register.php">
          <i class="zmdi zmdi-account-circle"></i> <span>Staff Registration</span>
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
      <li class="nav-item">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
          <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item user-details">
            <a href="javaScript:void();">
              <div class="media">
                <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                <div class="media-body">
                <!-- <h6 class="mt-2 user-title">Sarajhon Mccoy</h6>
                <p class="user-subtitle">mccoy@example.com</p> -->
                
                </div>
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

<div class="clearfix"></div>
  <div class="content-wrapper">
    <div class="container-fluid">

      <!--Start Dashboard Content-->
      <div class="card mt-3">
        <div class="card-content">
          <div class="row row-group m-0">
            <?php 
              $query = "SELECT COUNT(*) AS TOTAL FROM RESERVATIONS";
              $stmt = oci_parse($dbconn, $query);
              oci_define_by_name($stmt, "TOTAL", $total_reserve);
              oci_execute($stmt);
            ?>
            <div class="col-12 col-lg-6 col-xl-6 border-light">
              <div class="card-body">
                <h5 class="text-white mb-0"><?php while(oci_fetch($stmt)) {echo $total_reserve;} ?> <span class="float-right"><i class="fa fa-car"></i></span></h5>
                <div class="progress my-3" style="height:3px;"></div>
                <p class="mb-0 text-white small-font">Total Reservations</p>
              </div>
            </div>
            <?php 
              $query = "SELECT SUM(TOTALCOST) AS TOTAL FROM RESERVATIONS";
              $stmt = oci_parse($dbconn, $query);
              oci_define_by_name($stmt, "TOTAL", $total_revenue);
              oci_execute($stmt);
            ?>
            <div class="col-12 col-lg-6 col-xl-6 border-light">
              <div class="card-body">
                <h5 class="text-white mb-0">RM <?php while(oci_fetch($stmt)) {echo $total_revenue;} ?> <span class="float-right"><i class="fa fa-usd"></i></span></h5>
                <div class="progress my-3" style="height:3px;"></div>
                <p class="mb-0 text-white small-font">Total Revenue</p>
              </div>
            </div>
          </div>
        </div>
      </div>  
	  
      <div class="row">
        <div class="col-12 col-lg-8 col-xl-12">
          <div class="card">
            <div class="card-header">Monthly Sales Projection</div>
            <div class="card-body">
              <div class="chart-container-1">
                <canvas id="chart1"></canvas>
              </div>
            </div>
        
            <div class="row m-0 row-group text-center border-top border-light-3">
              <div class="col-12 col-lg-6">
                <div class="p-3">
                  <h5 class="mb-0">45.87M</h5>
                  <small class="mb-0">Lowest Sales</small>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="p-3">
                  <h5 class="mb-0">15:48</h5>
                  <small class="mb-0">Highest Sales</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--End Row-->
	
      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
            <div class="card-header">Reservations</div>
            <div class="table-responsive">
              <?php 
                $query = "SELECT * FROM RESERVATIONS";
                $stmt = oci_parse($dbconn, $query);
                if(oci_execute($stmt)) {
              ?>
              <table class="table align-items-center table-flush table-borderless">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Duration</th>
                    <th>Total</th>
                    <th>Customer</th>
                    <th>Staff</th>
                    <th>Parking Slot</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    while($rows = oci_fetch_row($stmt)) {

                  ?>
                  <tr>
                    <td><?php echo $rows[0]; ?></td>
                    <td><?php echo $rows[1]; ?></td>
                    <td><?php echo $rows[2]; ?></td>
                    <td><?php echo $rows[3]; ?></td>
                    <td><?php echo $rows[4]; ?></td>
                    <td><?php echo $rows[5]; ?></td>
                  </tr>
                  <?php 
                      } 
                    } 
                    else {
                      $e = oci_error($stmt);
                      print htmlentities($e['message']);
                      print "\n<pre>\n";
                      print htmlentities($e['sqltext']);
                      printf("\n%".($e['offset']+1)."s", "^");
                      print  "\n</pre>\n";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--End Row-->

      <!--End Dashboard Content-->
	  
      <!--start overlay-->
        <div class="overlay toggle-menu"></div>
      <!--end overlay-->
    </div>
    <!-- End container-fluid-->
  </div>
  <!--End content-wrapper-->

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
</div>
<!--End wrapper-->

<!-- Bootstrap core JavaScript-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- simplebar js -->
<script src="assets/plugins/simplebar/js/simplebar.js"></script>
<!-- sidebar-menu js -->
<script src="assets/js/sidebar-menu.js"></script>
<!-- loader scripts -->
<script src="assets/js/jquery.loading-indicator.js"></script>
<!-- Custom scripts -->
<script src="assets/js/app-script.js"></script>
<!-- Chart js -->

<script src="assets/plugins/Chart.js/Chart.min.js"></script>

<!-- Index js -->
<script src="assets/js/index.js"></script>

</body>
</html>
