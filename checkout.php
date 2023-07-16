<?php
  include ("config.php");
// PRINT_R($_SESSION);

  //  if (!isset($_SESSION['user'])) {
  //   header("Location: login.php");
  //   exit();
  //  }
  $query = "SELECT PARKINGID, TO_CHAR(RESERVATION_DATE, 'YYYY-MM-DD') AS RESERVATION_DATE FROM PARKING_LOTS LEFT JOIN RESERVATIONS USING(PARKINGID)";

  $statement = $pdo->prepare($query);

  // Data from the database
  $stmt = $pdo->prepare("SELECT PARKINGID, TO_CHAR(RESERVATION_DATE, 'YYYY-MM-DD') AS RESERVATION_DATE FROM PARKING_LOTS JOIN RESERVATIONS USING(PARKINGID)");
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach($rows as $row) 
  {
    $parkingLots[] = ['id' => $row['PARKINGID'], 'date' => $row['RESERVATION_DATE']];
  }
  // Get the current date
  $currentDate = date('Y-m-d');

  
  
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
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
  <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">Reservation Details</div>
          <div class="col-md-6" align="right">
            <button type="button" name="clear_cart" id="clear_cart" class="btn btn-warning btn-xs">Clear</button>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 col-lg-12">
              <div class="card">
                <div class="card-header">Confirmation
                  <div class="card-action">
                  </div>
                </div>
                <div class="table-responsive">
                    <?php
                      $stmt = $pdo->prepare("SELECT FIRSTNAME || ' ' || LASTNAME AS CUSTOMER_NAME,RESERVATIONID, SLOTNUM, DURATION, TOTALCOST, TO_CHAR(RESERVATION_DATE, 'DD Mon YYYY') AS RESERVEDATE, STATUS_PAYMENT, PARKINGID 
                      FROM RESERVATIONS 
                      JOIN CUSTOMERS USING(CUSTOMERID)
                      JOIN PARKING_LOTS USING(PARKINGID)
                      WHERE CUSTOMERID = :customerid 
                      ORDER BY RESERVATIONID ASC");
                        $stmt->bindValue(':customerid', $_SESSION['customerid']);
                        $stmt->execute();
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <table class="table align-items-center table-flush table-borderless">
                        <thead>
                          <tr>
                            <th>Reservation ID</th>
                            <th>Customer name</th>
                            <th>Parking Slot No</th>
                            <th>Date Reservations</th>
                            <th>Duration</th>
                            <th>Total</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                          <tbody>
                            <?php foreach ($rows as $row) : ?>
                            <?php if ($row['PARKINGID'] !== null) : ?>
                          
                            <tr>
                              <td><?php echo $row['RESERVATIONID'] ?></td>
                              <td><?php echo $row['CUSTOMER_NAME'] ?></td>
                              <td><?php echo $row['SLOTNUM'] ?></td>
                              <td><?php echo $row['RESERVEDATE'] ?></td>
                              <td><?php echo $row['DURATION'] ?> DAYS</td>
                              <td>RM <?php echo $row['TOTALCOST'] ?></td>
                              <?php
                                if($row['STATUS_PAYMENT'] == 1)
                                {
                                  ECHO"<td>SUCCESS</td>";
                                } 
                                elseif($row['STATUS_PAYMENT'] == 0 OR ($row['STATUS_PAYMENT'] == NULL))  
                                {
                                  ECHO"<td>PENDING</td>";
                                } 
                              ?>
                            </tr>

                            <?php endif; ?>
                            <?php endforeach; ?>

                            <?php if (empty($row['PARKINGID'])) : ?>
                            <tr>
                              <td colspan="4">You have not make any reservation parking.</td>
                              <td colspan="1"><button type="submit" class="btn btn-light btn-round px-5" style="background-color: #1ad622;" onclick="window.location.href = 'reservation.php';"><i class="fa fa-check"></i> Make A Reservation</button></td>
                            </tr>
                            <?php endif; ?>
                          </tbody>
                          </table>
                        </div>
                       </div>
                       </div>
                     </div>
                  </div>
                 </div>

   <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6" align="right">
            <button type="button" name="add_to_cart" id="add_to_cart" class="btn btn-success btn-xs">GO TO PAYMENT</button>
          </div>
        </div>

    </div> 
           

	  
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- simplebar js -->
<script src="assets/plugins/simplebar/js/simplebar.js"></script>
<!-- sidebar-menu js -->
<script src="assets/js/sidebar-menu.js"></script>
<!-- loader scripts -->
<script src="assets/js/jquery.loading-indicator.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!-- Custom scripts -->
<script src="assets/js/app-script.js"></script>
<!-- Chart js -->
<script src="assets/plugins/Chart.js/Chart.min.js"></script>
</body>
</html>

