<?php
include("../config.php");

if(isset($_POST["save"])){
	$id = $_POST['id'];
	$name = $_POST['name'];

	$stmt = $pdo->prepare("UPDATE STAFFS 
	                      SET NAME = '" . $name . 
						  "' WHERE STAFFID = " . $id . "");
	$statement = oci_parse($dbconn, $query);

	// Bind the parameter value
	oci_bind_by_name($statement, ':name', $name);
	oci_bind_by_name($statement, ':staffid', $staffid);
	oci_bind_by_name($statement, ':password', $password);

	// Execute the statement
	$result = oci_execute($statement);
	if (!$result) {
			$error = oci_error($statement);
			die("Statement execution failed: " . $error['message']);
	} else {
			$_SESSION['name'] = $name;
			$_SESSION['staffid'] = $staffid;
			$_SESSION['password'] = $password; 

			echo "<script>alert('Update successful!'); setTimeout(function(){ window.location.href = '../profile-adm.php'; }, );</script>";
			// exit();
    }
} else {
    echo "fail";
}
?>
