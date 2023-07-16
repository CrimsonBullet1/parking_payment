<?php
	include("../config.php");

	if(isset($_POST['id'])) {
		$id = $_POST['id'];

		// Delete row from table STAFF
		$stmt = $pdo->prepare("DELETE FROM STAFFS WHERE STAFFID =" . $id . "");
		$stmt->execute();
	}
?>