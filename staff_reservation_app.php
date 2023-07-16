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
  <script text="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
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
						<div class="media">
							<div class="avatar">
								<img src="https://via.placeholder.com/110x110" alt="user avatar">
							</div>
						</div>
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

<!-- Approve Modal -->
<div id="appModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute; will-change: transform; top: 0px; right: 0px; transform: translate3d(-20px, 20px, 0px);">&times;</button>
        <h5 class="modal-title">Approve</h5>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <div class="card-body">
          <form id="appForm" enctype="multipart/form-data">
            <div class="form-group">
              <?php
                $stmt = $pdo->prepare("SELECT RESERVATIONID FROM RESERVATIONS WHERE FLAG IS NULL OR FLAG = 0");
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
              ?>
              <label for="id">Reservation</label>
              <select name="id" id="app_id" class="form-control form-control-rounded">
                <option value="" selected disabled hidden>Choose Reservation</option>
                <?php 
                  foreach($rows as $row) {
                    echo "<option value='" . $row['RESERVATIONID'] . "'>" . $row['RESERVATIONID'] . "</option>";
                  }
                ?>
              </select>
            </div>
            <div class="form-group" id="app_name">
              <label for="name">Customer</label>
              <input type="text" class="form-control form-control-rounded" name="name" id="appName" placeholder="Name" disabled>
            </div>
						<div class="form-group" id="app_parking">
              <label for="name">Parking Lot</label>
              <input type="text" class="form-control form-control-rounded" name="parking" id="appParking" placeholder="Parking Lot" disabled>
            </div>
						<div class="form-group" id="app_date">
              <label for="name">Reservation Date</label>
              <input type="text" class="form-control form-control-rounded" name="date" id="appDate" placeholder="Reservation Date" disabled>
            </div>
						<div class="form-group" id="app_duration">
              <label for="name">Duration</label>
              <input type="text" class="form-control form-control-rounded" name="duration" id="appDuration" placeholder="Duration" disabled>
            </div>
						<div class="form-group" id="app_total">
              <label for="name">Total</label>
              <input type="text" class="form-control form-control-rounded" name="name" id="appTotal" placeholder="Total" disabled>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-light btn-round px-5" style="background-color: #1ad622;"><i class="fa fa-check"></i> Approve</button>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="edit_cls_button">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div id="delModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute; will-change: transform; top: 0px; right: 0px; transform: translate3d(-20px, 20px, 0px);">&times;</button>
        <h5 class="modal-title">Delete Reservation</h5>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <div class="card-body">
        <form id="delForm" enctype="multipart/form-data">
            <div class="form-group">
              <?php
                $stmt = $pdo->prepare("SELECT RESERVATIONID FROM RESERVATIONS");
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
              ?>
              <label for="id">Reservation</label>
              <select name="id" id="del_id" class="form-control form-control-rounded">
                <option value="" selected disabled hidden>Choose Reservation</option>
                <?php 
                  foreach($rows as $row) {
                    echo "<option value='" . $row['RESERVATIONID'] . "'>" . $row['RESERVATIONID'] . "</option>";
                  }
                ?>
              </select>
            </div>
            <div class="form-group" id="del_name">
              <label for="name">Customer</label>
              <input type="text" class="form-control form-control-rounded" name="name" id="delName" placeholder="Name" disabled>
            </div>
						<div class="form-group" id="del_parking">
              <label for="name">Parking Lot</label>
              <input type="text" class="form-control form-control-rounded" name="parking" id="delParking" placeholder="Parking Lot" disabled>
            </div>
						<div class="form-group" id="del_date">
              <label for="name">Reservation Date</label>
              <input type="text" class="form-control form-control-rounded" name="date" id="delDate" placeholder="Reservation Date" disabled>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-light btn-round px-5" style="background-color: #801919;"><i class="fa fa-trash"></i> Delete</button>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="clearfix"></div>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
            <div class="card-header">Reservation Application
							<div class="card-action">
								<div class="dropdown">
									<a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" aria-expanded="false">
			  						<i class="icon-options"></i>
			 						</a>
									<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(14px, 19px, 0px);">
										<a type="button" class="dropdown-item" data-toggle="modal" data-target="#appModal">Approve</a>
										<a type="button" class="dropdown-item" data-toggle="modal" data-target="#delModal">Delete</a>
									</div>
								</div>
							</div>
						</div>
						<div id="table" class="table-responsive">
							<?php 
								$stmt = $pdo->prepare("SELECT RESERVATIONID, DURATION, TOTALCOST, FIRSTNAME || ' ' || LASTNAME AS CUSTNAME, NAME, SLOTNUM, TO_CHAR(RESERVATION_DATE, 'DD Mon YYYY') AS RESERVEDATE, FLAG, STATUS_PAYMENT FROM RESERVATIONS JOIN CUSTOMERS USING(CUSTOMERID) LEFT JOIN STAFFS USING(STAFFID) JOIN PARKING_LOTS USING(PARKINGID) ORDER BY RESERVATIONID");
                $stmt->execute();
							?>
							<table id="editable_table" class="table table-hover align-items-center table-flush table-borderless" style="text-align: center;">
								<thead>
									<tr>
										<th>No</th>
										<th>Duration</th>
										<th>Total</th>
										<th>Customer Name</th>
										<th>Staff Name</th>
										<th>Parking Lot</th>
										<th>Reservation Date</th>
										<th>Approved</th>
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
                    <?php 
                      if($row["NAME"] == null) {
                        echo "<td >NOT ASSIGNED</td>";
                      }
                      else {
                        echo "<td>" . $row["NAME"] . "</td>";
                      }
                    ?>
                    <td><?php echo $row["SLOTNUM"]; ?></td>
                    <td><?php echo $row["RESERVEDATE"]; ?></td>
										<?php 
											if($row['FLAG'] == 1) {
												echo "<td style='color: #1ad622;'>&#10004;</td>";
                        if($row['STATUS_PAYMENT'] == 1) {
                          echo "<td style='color: #1ad622;'>PAID</td>";
                        }
                        else {
                          echo "<td style='color: #ecf545;'>PENDING</td>";
                        }
											}
											else {
												echo "<td style='color: #d90000'>&#10006;</td>";
                        echo "<td> - </td>";
											}
										?>
                  </tr>
									<?php 
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

<!-- Modal Style -->
<style>
	.modal-content{
		background-color: #787572;
	}

  .modal-footer .btn {
    color: #fff;
    background-color: #666460;
  }
</style>

<!-- AJAX forms -->
<script>
  $(document).ready(function () {

		// Approve Reservation Data
    $("#appForm").submit(function (event) {
      var id = $("#app_id").val();
      $.ajax({
        method: 'POST',
        url: 'ajax/reserve_app_ajax.php',
        data: {id:id},
        success: function(data) {
          alert("Reservation approved!");
        },
        error: function(data) {
          alert("Failed to update!");
        }
      });
    });

    //Delete Reservation Data
    $("#delForm").submit(function (event) {
      var id = $("#del_id").val();
      $.ajax({
        method: 'POST',
        url: 'ajax/reserve_del_ajax.php',
        data: {id:id},
        success: function(data) {
          alert("Data deleted!");
        },
        error: function(data) {
          alert("Failed to delete!");
        }
      });
    });
  });
</script>

<!-- AJAX Form Trigger -->
<script>
  $(document).ready(function() {
    $('#app_id').change(function() {
      var reserve_id = $(this).val();
      $.ajax({
        method: 'POST',
				dataType: 'json',
        url: 'ajax/dropdown_ajax.php',
        data: {reserve_id:reserve_id},
        success: function(data) {
          $("#appName").val(data[0].NAME);
					$("#appParking").val(data[0].SLOTNUM);
					$("#appDate").val(data[0].RESERVEDATE);
					$("#appDuration").val(data[0].DURATION);
					$("#appTotal").val('RM ' + data[0].TOTALCOST);
        },
        error: function(data) {
          console.log("Error in parsing data!");
        }
      })
    });

    $('#del_id').change(function() {
      var reserve_id = $(this).val();
      $.ajax({
        method: 'POST',
				dataType: 'json',
        url: 'ajax/dropdown_ajax.php',
        data: {reserve_id:reserve_id},
        success: function(data) {
          $("#delName").val(data[0].NAME);
					$("#delParking").val(data[0].SLOTNUM);
					$("#delDate").val(data[0].RESERVEDATE);
        },
        error: function(data) {
          console.log("Error in parsing data!");
        }
      })
    })
  });
</script>

<!-- Clear Modal Form on Close -->
<script>
  $(document).ready(function() {
    $('[data-dismiss=modal]').on('click', function () {
      $('#editForm').trigger('reset');
      $('#delForm').trigger('reset');
    });
  });
</script>

<!-- Bootstrap core JavaScript-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
</body>
</html>
