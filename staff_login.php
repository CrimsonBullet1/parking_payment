<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<meta name="description" content=""/>
<meta name="author" content=""/>
<title>Staff Login</title>
<!-- loader-->
<link href="assets/css/pace.min.css" rel="stylesheet"/>
<script src="assets/js/pace.min.js"></script>
<!--favicon-->
<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
<!-- Bootstrap core CSS-->
<link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
<!-- animate CSS-->
<link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
<!-- Icons CSS-->
<link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
<!-- Custom Style-->
<link href="assets/css/app-style.css" rel="stylesheet"/>
</head>

<body class="bg-theme bg-theme1">

  <!-- start loader -->
  <div id="pageloader-overlay" class="visible incoming">
    <div class="loader-wrapper-outer">
      <div class="loader-wrapper-inner" >
        <div class="loader"></div>
      </div>
    </div>
  </div>
  <!-- end loader -->

  <!-- Start wrapper-->
 <div id="wrapper">

	  <div class="card card-authentication1 mx-auto my-4">
		  <div class="card-body">
		    <div class="card-content p-2">
		 	    <div class="text-center">
		 		    <img src="assets/images/logo-icon.png" alt="logo icon">
		 	    </div>
		      <div class="card-title text-uppercase text-center py-3">Staff Login</div>
		      <form action="admin/staff_login.a.php" method="post">
			      <div class="form-group">
			        <label for="exampleInputEmailId" class="sr-only">Staff ID</label>
			        <div class="position-relative has-icon-right">
				        <input type="text" name="staff_id" id="exampleInputEmailId" class="form-control input-shadow" placeholder="Enter Your ID" required>
				        <div class="form-control-position">
					        <i class="fa fa-id-card-o"></i>
				        </div>
			        </div>
			      </div>
			      <div class="form-group">
			        <label for="exampleInputPassword" class="sr-only">Password</label>
			        <div class="position-relative has-icon-right">
				        <input type="password" name="password" id="exampleInputPassword" class="form-control input-shadow" placeholder="Enter Password" required>
				        <div class="form-control-position">
					        <i class="icon-lock"></i>
				        </div>
			        </div>
			      </div>
			      <button type="submit" name="submit"class="btn btn-light btn-block waves-effect waves-light">Sign In</button><br>
                  <div class="back">
                     <button type="button" class="btn btn-light btn-block waves-effect waves-light" onclick="window.location.href = 'login.php'">Back</button>
                  </div>
                </form>
		    </div>
		  </div>
    </div>
    
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

	</div>
  <!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  
</body>
</html>
