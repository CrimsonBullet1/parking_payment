<?php
	include("../config.php");

	if(isset($_POST['id'])) {
		$id = $_POST['id'];

		// Fetch table VEHICLES
		$stmt = $pdo->prepare("SELECT * FROM VEHICLES WHERE CUSTOMERID = " . $id . "");
		$stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
	}
?>