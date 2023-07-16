<?php
	include("../config.php");

	if(isset($_POST['id'])) {
		$id = $_POST['id'];

		// Delete row from table RESERVATIONS
		$stmt = $pdo->prepare("DELETE FROM RESERVATIONS WHERE RESERVATIONID =" . $id . "");
		$stmt->execute();
	}
?>