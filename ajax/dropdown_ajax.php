<?php 
	include '../config.php';

	if(isset($_POST['id'])) {
		//Fetch data based on staff id
		$stmt = $pdo->prepare("SELECT NAME FROM STAFFS WHERE STAFFID = ".$_POST['id']." ORDER BY STAFFID");
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $result;
	}
?>