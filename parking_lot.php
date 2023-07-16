<?php
  include 'config.php';


  if (!isset($_SESSION['customerid'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Parking Lot Reservation</title>
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
      <a href="index.html">
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
        <div class="col-lg-7">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Available Parking Spaces</div>
              <hr>
                <?php
                  $stmt = $pdo->prepare("SELECT PARKINGID, SLOTNUM, TO_CHAR(RESERVATION_DATE, 'DD Mon YYYY') AS RESERVATION_DATE FROM PARKING_LOTS LEFT JOIN RESERVATIONS USING(PARKINGID) ORDER BY PARKINGID");
                  $stmt->execute();
                  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  // Data from the database
                  foreach($rows as $row) {
                      $parkingLots[] = ['slotnum' => $row['SLOTNUM'], 'date' => $row['RESERVATION_DATE']];
                  }
                  
                  // Get the current date
                  $currentDate = date('Y-M-D');

                  // Display the parking lots
                  foreach ($parkingLots as $lot) {
                    $reserved = ($lot['date'] == $currentDate) ? 'reserved' : 'available';
                    $status = ($lot['date'] == $currentDate) ? 'Reserved' : 'Available';
                    $clickable = ($reserved == 'available') ? 'onclick="reserveParkingLot(' . $lot['slotnum'] . ')"' : '';            

                    echo '<div class="parking-lot ' . $reserved . '" ' . $clickable . '>';
                    echo '<span class="lot-number">' . $lot['slotnum'] . '</span>';
                    echo '<span class="lot-status">' . $status . '</span>';
                    echo '</div>';
                  }
                ?>

                    </div>
                  </div>
                </li>
              </ul>
            </div>
            
            <script>
                function reserveParkingLot(lotId) {
                    window.location.href = 'reservation.php?lot="' + lotId + '"';
                }          
            </script>
        
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
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>

  <style>
    .parking-lot {
      display: inline-block;
      width: 80px;
      height: 80px;
      margin: 10px;
      border-radius: 50%;
      font-family: Arial, sans-serif;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      cursor: pointer;
      position: relative;
    }

    .lot-number {
      position: absolute;
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .lot-status {
      position: absolute;
      bottom: 18px;
      left: 0;
      right: 0;
      font-size: 11px;
    }

    .reserved {
      background-color: #FF5A5A;
      color: white;

    }

    .available {
      background-color: #67D66E;
      color: white;
    }
  </style>
	
</body>
</html>