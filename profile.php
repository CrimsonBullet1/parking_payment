<?php
   include('config.php');

   if (!isset($_SESSION['customerid'])) {
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
  <title>Customer Page</title>
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
        <h5 class="logo-text">Car Park</h5>
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

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="col-lg-12">
        <div class="card" >
          <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
              <li class="nav-item">
                <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></a>
              </li>
              <li class="nav-item">
                <a href="javascript:void();" data-target="#vehicle" data-toggle="pill" class="nav-link"><i class="icon-envelope-open"></i> <span class="hidden-xs">Vehicle</span></a>
              </li>
            </ul>
            <div class="tab-content p-3">
              <div class="tab-pane active" id="edit">
                <form id="editCust" enctype="multipart/form-data">
                  <div class="form-group row">
                    <input type="text" name="id" id="id" value="<?php echo $_SESSION['customerid']; ?>" hidden>
                    <label class="col-lg-3 col-form-label form-control-label">First name</label>
                    <div class="col-lg-9">
                      <input class="form-control" name="firstname" id="firstname" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                    <div class="col-lg-9">
                      <input class="form-control" name="lastname" id="lastname" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                    <div class="col-lg-9">
                      <input class="form-control" name="email" id="email" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Phone Number</label>
                    <div class="col-lg-9">
                      <input class="form-control" name="phonenum" id="phonenum" type="text">
                    </div>
                  </div>             
                  <div class="form-group row">
                    <label for="password" class="col-lg-3 col-form-label form-control-label">Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control input-shadow" placeholder="Insert Password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label"></label>
                    <div class="col-lg-9">
                      <input type="submit" name="submit" class="btn btn-primary">
                    </div>
                  </div>
                </form>

                <div class="form-group"></div>
                <div id="message" class="form-group">
                  <h5>Password must contain the following:</h5>
                  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                  <p id="number" class="invalid">A <b>number</b></p>
                  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                </div>
              </div>
              <div class="tab-pane" id="vehicle">
                <form id="editVehicle" enctype="multipart/form-data">
                  <div class="form-group row">
                    <input class="form-control" name="id" type="text" value="<?php echo $_SESSION['customerid']; ?>" hidden>
                    <?php 
                      $stmt = $pdo->prepare("SELECT VEHICLEID FROM VEHICLES WHERE CUSTOMERID=" . $_SESSION['customerid'] . "");
                      $stmt->execute();
                      $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
                      if($result[0] != null) {
                    ?>
                      <input class="form-control" name="vehicleId" id="vehicleId" type="text" value="<?php echo $result[0] ?>" hidden>
                    <?php
                      }
                    ?>
                    <label class="col-lg-3 col-form-label form-control-label">Vehicle Type</label>
                    <div class="col-lg-9">
                      <select class="form-control" name="vehicleType" id="vehicleType">
                        <option value="" selected disabled hidden>Choose Vehicle Type</option>
                        <option value="Car">Car</option>
                        <option value="Motorcycle">Motorcycle</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Vehicle Number</label>
                    <div class="col-lg-9">
                      <input class="form-control" name="vehicleNum" id="vehicleNum" type="text" placeholder="Enter Vehicle Number">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label"></label>
                    <div class="col-lg-9">
                      <input type="submit" name="save" class="btn btn-primary" value="Save">
                    </div>
                  </div>
                </form>
              </div>
            </div>
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

  <!-- Ajax calls -->
  <script>
    $(document).ready(function () {
      // Edit Profile
      $("#editCust").submit(function (event) {
        var id = $("#id").val();
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var email = $("#email").val();
        var phonenum = $("#phonenum").val();
        var password = $("#password").val();
        $.ajax({
          method: 'POST',
          url: 'ajax/edit_profile_ajax.php',
          data: {id:id,firstname:firstname,lastname:lastname,email:email,phonenum:phonenum,password:password},
          success: function(data) {
            alert("Profile data updated!");
          },
          error: function(data) {
            alert("Failed to update!");
          }
        });
      });

      // Edit Vehicle
      $("#editVehicle").submit(function (event) {
        var id = $("#id").val();
        var vehicleid = $("#vehicleId").val();
        var vehicletype = $("#vehicleType").val();
        var vehiclenum = $("#vehicleNum").val();
        $.ajax({
          method: 'POST',
          url: 'ajax/edit_vehicle_ajax.php',
          data: {id:id,vehicleid:vehicleid,vehicletype:vehicletype,vehiclenum:vehiclenum},
          success: function(data) {
            alert("Vehicle data updated!");
          },
          error: function(data) {
            alert("Failed to update!");
          }
        });
      });
    });
  </script>

  <!-- Ajax Form -->
  <script>
    $(document).ready(function () {
      var id = $('#id').val();
      $.ajax({
        method: 'POST',
        url: 'ajax/get_profile_ajax.php',
        data: {id:id},
        dataType: 'json',
        success: function(data) {
          $('#firstname').val(data[0].FIRSTNAME);
          $('#lastname').val(data[0].LASTNAME);
          $('#email').val(data[0].EMAIL);
          $('#phonenum').val(data[0].PHONENUM);
          $('#password').val(data[0].PASSWORD);
        },
        error: function(data) {
          console.log("Error in parsing data!");
        }
      });

      $.ajax({
        method: 'POST',
        url: 'ajax/get_vehicle_ajax.php',
        data: {id:id},
        dataType: 'json',
        success: function(data) {
          $('#vehicleType').val(data[0].VEHICLETYPE);
          $('#vehicleNum').val(data[0].VEHICLENUM);
        },
        error: function(data) {
          console.log("Error in parsing data!");
        }
      });
    });
  </script>

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

  <!-- Password validation scripts -->
	<script>
		var myInput = document.getElementById("password");
		var letter = document.getElementById("letter");
		var capital = document.getElementById("capital");
		var number = document.getElementById("number");
		var length = document.getElementById("length");

		// When the user clicks on the password field, show the message box
		myInput.onfocus = function() {
			document.getElementById("message").style.display = "block";
		}

		// When the user clicks outside of the password field, hide the message box
		myInput.onblur = function() {
			document.getElementById("message").style.display = "none";
		}

		// When the user starts to type something inside the password field
		myInput.onkeyup = function() {
			// Validate lowercase letters
			var lowerCaseLetters = /[a-z]/g;
			if(myInput.value.match(lowerCaseLetters)) {  
				letter.classList.remove("invalid");
				letter.classList.add("valid");
			} else {
				letter.classList.remove("valid");
				letter.classList.add("invalid");
			}
			
			// Validate capital letters
			var upperCaseLetters = /[A-Z]/g;
			if(myInput.value.match(upperCaseLetters)) {  
				capital.classList.remove("invalid");
				capital.classList.add("valid");
			} else {
				capital.classList.remove("valid");
				capital.classList.add("invalid");
			}

			// Validate numbers
			var numbers = /[0-9]/g;
			if(myInput.value.match(numbers)) {  
				number.classList.remove("invalid");
				number.classList.add("valid");
			} else {
				number.classList.remove("valid");
				number.classList.add("invalid");
			}
			
			// Validate length
			if(myInput.value.length >= 8) {
				length.classList.remove("invalid");
				length.classList.add("valid");
			} else {
				length.classList.remove("valid");
				length.classList.add("invalid");
			}
		}
	</script>

	<!-- Password validation styles -->
  <style>
		/* The message box is shown when the user clicks on the password field */
		#message {
			display:none;
			/* background: #f1f1f1; */
			color: #000;
			position: relative;
			padding: 20px;
			margin-top: 10px;
		}

		#message p {
			padding: 10px 35px;
			font-size: 18px;
		}

		/* Add a green text color and a checkmark when the requirements are right */
		.valid {
  		color: #1ad622;
		}

		.valid:before {
			position: relative;
			left: -35px;
			content: "✔";
		}

		/* Add a red text color and an "x" when the requirements are wrong */
		.invalid {
			color: #d90000;
		}

		.invalid:before {
			position: relative;
			left: -35px;
			content: "✖";
		}
	</style>
	
</body>
</html>
