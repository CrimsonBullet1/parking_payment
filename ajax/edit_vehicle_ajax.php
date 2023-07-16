<?php
	include("../config.php");

	if(isset($_POST['id']) && isset($_POST['vehicleid'])) {
		$id = $_POST['id'];
    $vehicleid = $_POST['vehicleid'];
    $vehicletype = $_POST['vehicletype'];
    $vehiclenum = $_POST['vehiclenum'];

		// Update table VEHICLES
		$stmt = $pdo->prepare("UPDATE VEHICLES SET VEHICLETYPE='" . $vehicletype . "', VEHICLENUM='" . $vehiclenum . "' WHERE VEHICLEID= " . $vehicleid . "");
		$stmt->execute();
	}
  else if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $vehicletype = $_POST['vehicletype'];
    $vehiclenum = $_POST['vehiclenum'];

    //Insert new row into VEHICLES
    $stmt = $pdo->prepare("INSERT INTO VEHICLES (VEHICLETYPE, VEHICLENUM, CUSTOMERID) VALUES('" . $vehicletype . "', '" . $vehiclenum . "', ". $id . ")");
		$stmt->execute();
  }
?>