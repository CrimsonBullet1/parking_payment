<?php
include("../config.php");

if(isset($_POST["save"])){
	$id = $_POST['id'];
	$name = $_POST['name'];

	$stmt = $pdo->prepare("UPDATE STAFFS SET NAME = '" . $name . "' WHERE STAFFID = " . $id . "");
	$stmt->execute();
	}
?>
