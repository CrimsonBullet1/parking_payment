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

<!-- Edit Modal -->
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute; will-change: transform; top: 0px; right: 0px; transform: translate3d(-20px, 20px, 0px);">&times;</button>
        <h5 class="modal-title">Edit Staff Info</h5>
      </div>
      <div class="modal-body">
        <!-- Form -->
				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        <h5 class="modal-title">Delete Staff</h5>
      </div>
      <div class="modal-body">
        <!-- Form -->

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
            <div class="card-header">Staff List
							<div class="card-action">
								<div class="dropdown">
									<a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" aria-expanded="false">
			  						<i class="icon-options"></i>
			 						</a>
									<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(14px, 19px, 0px);">
										<a class="dropdown-item" href="staff_register.php">Register New Staff</a>
										<a type="button" class="dropdown-item" data-toggle="modal" data-target="#editModal">Edit Staff</a>
										<a type="button" class="dropdown-item" data-toggle="modal" data-target="#delModal">Delete Staff</a>
									</div>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<?php 
								$query = "SELECT STAFFID, ROLE, NAME FROM STAFFS ORDER BY STAFFID";
								$stmt = oci_parse($dbconn, $query);
								if(oci_execute($stmt)) {
							?>
							<table id="editable_table" class="table table-hover align-items-center table-flush table-borderless" style="text-align: center;">
								<thead>
									<tr>
										<th>Staff ID</th>
										<th>Role</th>
										<th>Name</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										while($rows = oci_fetch_row($stmt)) {

									?>
									<tr>
										<td><?php echo $rows[0]; ?></td>
										<?php 
											if($rows[1] == 1) {
												echo "<td>Admin</td>";
											}
											else if($rows[1] == 2) {
												echo "<td>Staff</td>";
											}
										?>
										<td><?php echo $rows[2]; ?></td>
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

<!-- Modal Style -->
<style>
	.modal, h5.modal-title{
		color: black;
	}
</style>

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
