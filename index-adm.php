<?php

  include ("config.php");

  if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit();
  }
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
        <a href="staff.php">
          <i class="zmdi zmdi-account-circle"></i> <span>Staff</span>
        </a>
      </li>

      <li>
        <a href="staff_reservation_app.php">
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
            <a href="profile-adm.php">
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
              $stmt = $pdo->prepare("SELECT COUNT(*) AS TOTAL FROM RESERVATIONS WHERE FLAG = 1");
              $stmt->execute();
              $total_reserve = $stmt->fetch(PDO::FETCH_COLUMN);
            ?>
            <div class="col-12 col-lg-6 col-xl-6 border-light">
              <div class="card-body">
                <h5 class="text-white mb-0"><?php echo $total_reserve; ?> <span class="float-right"><i class="fa fa-car"></i></span></h5>
                <div class="progress my-3" style="height:3px;"></div>
                <p class="mb-0 text-white small-font">Total Reservations</p>
              </div>
            </div>
            <?php 
              $stmt = $pdo->prepare("SELECT SUM(TOTALCOST) AS TOTAL FROM RESERVATIONS WHERE STATUS_PAYMENT = 1");
              $stmt->execute();
              $total_reserve = $stmt->fetch(PDO::FETCH_COLUMN);
            ?>
            <div class="col-12 col-lg-6 col-xl-6 border-light">
              <div class="card-body">
                <h5 class="text-white mb-0">RM 
                  <?php 
                    if($total_reserve == null) {
                      echo "0";
                    }
                    else {
                      echo $total_reserve;
                    } 
                  ?> 
                  <span class="float-right"><i class="fa fa-usd"></i></span>
                </h5>
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
            <div class="card-header">Sales Projection</div>
            <div class="card-body">
              <div class="chart-container-1">
                <canvas id="chart1"></canvas>
              </div>
            </div>
        
            <div class="row m-0 row-group text-center border-top border-light-3">
              <?php 
                $stmt = $pdo->prepare("SELECT MIN(TOTALCOST) AS MIN FROM RESERVATIONS WHERE STATUS_PAYMENT = 1");
                $stmt->execute();
                $min_revenue = $stmt->fetch(PDO::FETCH_COLUMN);
              ?>
              <div class="col-12 col-lg-4">
                <div class="p-3">
                  <h5 class="mb-0">RM 
                    <?php 
                      if($min_revenue == null) {
                        echo "0";
                      }
                      else {
                        echo $min_revenue;
                      } 
                    ?> 
                  </h5>
                  <small class="mb-0">Lowest Sales</small>
                </div>
              </div>
              <?php 
                $stmt = $pdo->prepare("SELECT MAX(TOTALCOST) AS MAX FROM RESERVATIONS WHERE STATUS_PAYMENT = 1");
                $stmt->execute();
                $max_revenue = $stmt->fetch(PDO::FETCH_COLUMN);
              ?>
              <div class="col-12 col-lg-4">
                <div class="p-3">
                  <h5 class="mb-0">RM 
                    <?php 
                      if($max_revenue == null) {
                        echo "0";
                      }
                      else {
                        echo $max_revenue;
                      } 
                    ?>
                  </h5>
                  <small class="mb-0">Highest Sales</small>
                </div>
              </div>
              <?php 
                $stmt = $pdo->prepare("SELECT ROUND(AVG(TOTALCOST)) AS AVG FROM RESERVATIONS WHERE STATUS_PAYMENT = 1");
                $stmt->execute();
                $avg_revenue = $stmt->fetch(PDO::FETCH_COLUMN);
              ?>
              <div class="col-12 col-lg-4">
                <div class="p-3">
                  <h5 class="mb-0">RM 
                    <?php 
                      if($avg_revenue == null) {
                        echo "0";
                      }
                      else {
                        echo $avg_revenue;
                      } 
                    ?>
                  </h5>
                  <small class="mb-0">Average Sales</small>
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
                $stmt = $pdo->prepare("SELECT RESERVATIONID, DURATION, TOTALCOST, FIRSTNAME || ' ' || LASTNAME AS CUSTNAME, NAME, PARKINGID, TO_CHAR(RESERVATION_DATE, 'DD Mon YYYY') AS RESERVEDATE FROM RESERVATIONS JOIN CUSTOMERS USING(CUSTOMERID) JOIN STAFFS USING(STAFFID) ORDER BY RESERVATIONID");
                $stmt->execute();
              ?>
              <table class="table table-striped align-items-center table-flush table-borderless" style="text-align: center;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Duration</th>
                    <th>Total</th>
                    <th>Customer Name</th>
                    <th>Staff Name</th>
                    <th>Parking Lot</th>
                    <th>Reservation Date</th>
                    <th>Payment Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($rows as $row) {
                  ?>
                  <tr>
                    <td><?php echo $row["RESERVATIONID"]; ?></td>
                    <td><?php echo $row["DURATION"]; ?> days</td>
                    <td>RM <?php echo $row["TOTALCOST"]; ?></td>
                    <td><?php echo $row["CUSTNAME"]; ?></td>
                    <td><?php echo $row["NAME"]; ?></td>
                    <td><?php echo $row["SLOTNUM"]; ?></td>
                    <td><?php echo $row["RESERVEDATE"]; ?></td>
                    <?php
                      if($row['STATUS_PAYMENT'] == 1) {
                          echo "<td style='color: #1ad622;'>PAID</td>";
                        }
                        else {
                          echo "<td style='color: #ecf545;'>PENDING</td>";
                      }
                    ?>
                  </tr>
                  <?php 
                    }
                    
                    if(empty($row["RESERVATIONID"])) {
                      echo "
                        <tr>
                          <td colspan='8'>No reservation data is available</td>
                        </tr>
                      ";
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

<!-- Display data in DB with Chart JS -->
<?php 
  $data1 = "";
  $data2 = "";

  $stmt = $pdo->prepare("SELECT EXTRACT(MONTH FROM RESERVATION_DATE) AS RESERVEDATE, SUM(TOTALCOST) AS TOTAL FROM RESERVATIONS WHERE STATUS_PAYMENT = 1 GROUP BY EXTRACT(MONTH FROM RESERVATION_DATE) ORDER BY 1");
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row) {
      switch($row['RESERVEDATE']) {
        case 1:
          $data1 = $data1 . '"Jan"' . ',';
          break;
        case 2:
          $data1 = $data1 . '"Feb"' . ',';
          break;
        case 3:
          $data1 = $data1 . '"Mar"' . ',';
          break;
        case 4:
          $data1 = $data1 . '"Apr"' . ',';
          break;
        case 5:
          $data1 = $data1 . '"May"' . ',';
          break;
        case 6:
          $data1 = $data1 . '"Jun"' . ',';
          break;
        case 7:
          $data1 = $data1 . '"Jul"' . ',';
          break;
        case 8:
          $data1 = $data1 . '"Aug"' . ',';
          break;
        case 9:
          $data1 = $data1 . '"Sep"' . ',';
          break;
        case 10:
          $data1 = $data1 . '"Oct"' . ',';
          break;
        case 11:
          $data1 = $data1 . '"Nov"' . ',';
          break;
        case 12:
          $data1 = $data1 . '"Dec"' . ',';
          break;
      }
      $data2 = $data2 . '"' . $row['TOTAL'] . '",';
    }

    $data1 = trim($data1,",");
    $data2 = trim($data2,",");
?>

<script>
  "use strict";

  var ctx = document.getElementById('chart1').getContext('2d');
		
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [<?php echo $data1; ?>],
        datasets: [{
          label: 'Sales',
          data: [<?php echo $data2; ?>],
          backgroundColor: '#fff',
          borderColor: "transparent",
          pointRadius :"0",
          borderWidth: 3
        }]
      },
    options: {
      maintainAspectRatio: false,
      legend: {
        display: false,
        labels: {
        fontColor: '#ddd',  
        boxWidth:40
        }
      },
      tooltips: {
        displayColors:false
      },	
      scales: {
        xAxes: [{
        ticks: {
          beginAtZero:true,
          fontColor: '#ddd'
        },
        gridLines: {
          display: true ,
          color: "rgba(221, 221, 221, 0.08)"
        },
        }],
         yAxes: [{
        ticks: {
          beginAtZero:true,
          fontColor: '#ddd'
        },
        gridLines: {
          display: true ,
          color: "rgba(221, 221, 221, 0.08)"
        },
        }]
       }

     }
    });
</script>

</body>
</html>
