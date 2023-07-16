<?php 
	include '../config.php';

	if(isset($_POST['staff_id'])) {
		//Fetch data based on staff id
		$stmt = $pdo->prepare("SELECT NAME FROM STAFFS WHERE STAFFID = ".$_POST['staff_id']." ORDER BY STAFFID");
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $result;
	}
	else if(isset($_POST['reserve_id'])) {
		//Fetch data based on reservation id
		$stmt = $pdo->prepare("SELECT FIRSTNAME || ' ' || LASTNAME AS NAME, SLOTNUM, TO_CHAR(RESERVATION_DATE, 'DD Mon YYYY') AS RESERVEDATE, DURATION, TOTALCOST FROM RESERVATIONS JOIN CUSTOMERS USING(CUSTOMERID) JOIN PARKING_LOTS USING(PARKINGID) WHERE RESERVATIONID = ".$_POST['reserve_id']."");
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($result);
	}
?>
