<?php
	include("../config.php");

	if(isset($_POST['id']) && isset($_POST['name'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];

		// Update table STAFF
		$stmt = $pdo->prepare("UPDATE STAFFS SET NAME ='" . $name . "' WHERE STAFFID =" . $id . "");
		$stmt->execute();
	}
?>