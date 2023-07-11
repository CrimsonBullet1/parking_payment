<?php
	// if (!isset($_SESSION['user'])) {
	// 	header("Location: login.php");
	// 	exit();
	// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<meta name="description" content=""/>
<meta name="author" content=""/>
<title>Staff Registration</title>
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
		      <div class="card-title text-uppercase text-center py-3">Staff Registration</div>
		      <form action="work\staff_register.w.php" method="post">
			      <div class="form-group">
			        <label for="exampleInputName" class="sr-only">Name</label>
			        <div class="position-relative has-icon-right">
				        <input type="text" name="name" id="name" class="form-control input-shadow" title="Please enter your name" placeholder="Enter Your Name" required>
				        <div class="form-control-position">
					        <i class="icon-user"></i>
				        </div>
			        </div>
			      </div>
			      <div class="form-group">
			        <label for="exampleInputEmailId" class="sr-only">Staff ID</label>
			        <div class="position-relative has-icon-right">
				        <input type="number" name="id" id="id" class="form-control input-shadow" title="Please enter staff ID" placeholder="Enter Your Staff ID" required>
				        <div class="form-control-position">
					        <i class="fa fa-id-card-o"></i>
				        </div>
			        </div>
			      </div>
			      <div class="form-group">
			        <label for="exampleInputPassword" class="sr-only">Password</label>
			        <div class="position-relative has-icon-right">
				        <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control input-shadow" placeholder="Choose Password" required>
				        <div class="form-control-position">
					        <i class="icon-lock"></i>
				        </div>
			        </div>
			      </div>
			      <button type="submit" name="submit" class="btn btn-light btn-block waves-effect waves-light">Sign Up</button>
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
			color: #801919;
		}

		.invalid:before {
			position: relative;
			left: -35px;
			content: "✖";
		}
	</style>
</body>
</html>
