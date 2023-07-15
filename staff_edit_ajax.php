<?php 
	include 'config.php';

	if(isset($_POST['id'])) {
		//Fetch data based on staff id
		$stmt = $pdo->prepare("SELECT NAME FROM STAFFS WHERE STAFFID = ".$_POST['staff_id']." ORDER BY STAFFID");
		$stmt->execute();
		$result = $stmt->fetch();

		echo json_encode($result);
	}
?>