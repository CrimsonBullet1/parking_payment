<?php
	include("../config.php");

	if(isset($_POST['id'])) {
		$id = $_POST['id'];

		// Update table RESERVATIONS
		$stmt = $pdo->prepare("UPDATE RESERVATIONS SET FLAG = 1 WHERE RESERVATIONID =" . $id . "");
		$stmt->execute();
	}
?>