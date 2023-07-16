<?php
include("../config.php");

if(isset($_POST["save"])){
	$id = $_POST['id'];
	$name = $_POST['name'];

	$stmt = $pdo->prepare("UPDATE STAFFS SET NAME = '" . $name . "' WHERE STAFFID = " . $id . "");
	$stmt->execute();

// 	if ($stmt) {
// 		$_SESSION['NAME'] = $name;
// 		echo "<script>alert('Update successful!'); setTimeout(function(){ window.location.href = '../profile-adm.php'; }, );</script>";
// 	} else {
// 		die("Statement failed to pass!");
//     }
// } else {
//     echo "Update failed!";
	}
?>
