<?php
	include("../config.php");

	if(isset($_POST['id'])) {
		$id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenum = $_POST['phonenum'];
    $password = $_POST['password'];

		// Update table CUSTOMERS
		$stmt = $pdo->prepare("UPDATE CUSTOMERS SET FIRSTNAME='" . $firstname . "', LASTNAME='" . $lastname . "', EMAIL='" . $email . "', PHONENUM='" . $phonenum . "', PASSWORD='" . $password . "' WHERE CUSTOMERID= " . $id . "");
		$stmt->execute();
	}
?>