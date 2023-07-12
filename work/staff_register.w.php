<?php
	include("../conn.php");
	if(isset($_POST["submit"])) {

		$name = $_POST["name"];
		$id = $_POST["id"];
		$password = $_POST["password"];

		// Check if the user with the same staff id already exists
    $query = "SELECT COUNT(*) FROM STAFFS WHERE STAFFID = :id";
    $statement = oci_parse($dbconn, $query);
    oci_bind_by_name($statement, ':id', $id);
    
    oci_execute($statement);
    $row = oci_fetch_assoc($statement);

		if ($row['COUNT'] > 0) {
			echo "<script>alert('User with the same id already exists!');
			window.history.back();
			</script>";
		} 
		else {
			$query = "INSERT INTO STAFFS(STAFFID,ROLE,NAME,PASSWORD) VALUES (:id,2,:name,:password)";
			$statement = oci_parse($dbconn, $query);

			// Bind the parameter value
			oci_bind_by_name($statement, ':id', $id);
			oci_bind_by_name($statement, ':name', $name);
			oci_bind_by_name($statement, ':password', $password);

			// Execute the statement
			if (oci_execute($statement)) {
				echo "<script>alert('Staff successfully registered!');
				window.location.href = '../staff.php';
				</script>";
			} 
			else {
				$e = oci_error($statement);
				echo "Error: " . $e['message'];
			}
		}
	}
	else{
		echo "<script>alert('Please try again!');
		window.location.href = '../staff_register.php';
		</script>";
	}
?>