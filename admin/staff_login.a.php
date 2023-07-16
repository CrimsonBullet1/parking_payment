<?php
	include("../config.php");
	if(isset($_POST["submit"])){

		$id = $_POST["staff_id"];
		$password = $_POST["password"];

		// Prepare the SELECT statement
		$stmt = $pdo->prepare("SELECT * FROM STAFFS WHERE STAFFID = " . $id . " AND password = '" . $password . "'");
		$stmt->execute();
		$row = $stmt->fetch();

		if ($row) {
				// Login successful
				$_SESSION['ID'] = $row['STAFFID'];
				$_SESSION['ROLE'] = $row['ROLE'];
				$_SESSION['NAME'] = $row['NAME'];
				$_SESSION['PASSWORD'] = $row['PASSWORD'];
				header("Location: ../index-adm.php");
		} else {
				// Login failed
				echo "<script>alert('Invalid username or password! Please try again!');
				window.location.href = '../staff_login.php';
				</script>";
		}

	} else {
			echo "<script>alert('Please try again!');
			window.history.back();
			</script>";
	}
?>
