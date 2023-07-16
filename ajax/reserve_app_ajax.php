<?php
	include("../config.php");

	if(isset($_POST['id'])) {
		$id = $_POST['id'];

		// Fetch data from table RESERVATIONS
		$stmt = $pdo->prepare("SELECT PARKINGID FROM RESERVATIONS WHERE RESERVATIONID=" . $id . "");
		$stmt->execute();
		$row = $stmt->fetch();

		// Update table RESERVATIONS
		$stmt = $pdo->prepare("UPDATE RESERVATIONS SET FLAG = 1, STAFFID=" . $_SESSION['ID'] . " WHERE RESERVATIONID =" . $id . "");
		$stmt->execute();

		// Update table PARKING_LOTS
		$stmt = $pdo->prepare("UPDATE PARKING_LOTS SET STATUS = 'RESERVED' WHERE PARKINGID=" . $row['PARKINGID'] . "");
		$stmt->execute();
	}
?>