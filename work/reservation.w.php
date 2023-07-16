<?php
session_start();
include("../conn.php");

if (isset($_POST["submit"])) {
    $parkingid = $_POST['parkingid'];
    $reservation_date = $_POST['reservation_date'];
    $duration = $_POST['duration'];
    $totalcost = $_POST['totalcost'];
    $slotnum = $_POST['slotnum'];

    $query = "SELECT COUNT(*)
              FROM PARKING_LOTS
              WHERE slotnum = :slotnum";
    $statement = oci_parse($dbconn, $query);
    oci_bind_by_name($statement, ':slotnum', $slotnum);
    oci_execute($statement);
    $row = oci_fetch_assoc($statement);

    if ($row['COUNT(*)'] > 0) {
        echo "<script>alert('Reserved!<br> Please try with a different Slot');
            window.history.back();
            </script>";
    } else {
        // Insert to Reservation
        $query = "INSERT INTO RESERVATIONS (PARKINGID, DURATION, TOTALCOST, RESERVATION_DATE) 
                  VALUES (:parkingid, :duration, :totalcost, :reservation_date)";

        $statement = oci_parse($dbconn, $query);

        // Bind the parameter value
        oci_bind_by_name($statement, ':parkingid', $parkingid);
        oci_bind_by_name($statement, ':duration', $duration);
        oci_bind_by_name($statement, ':totalcost', $totalcost);
        oci_bind_by_name($statement, ':reservation_date', $reservation_date);

        if (oci_execute($statement)) {
            $reservation_id = oci_last_insert_id($dbconn); // Get the generated reservation ID
            $_SESSION['reservation_id'] = $reservation_id; // Store it in the session for later use
            header("Location: ../checkout.php");
            exit(); // Add this line to stop executing further code after the redirect
        } else {
            $error = oci_error($statement);
            echo "Failed to insert data into RESERVATIONS table. Error: " . $error['message'];
        }
    }
} else {
    echo "<script>
        alert('Please try again!');
        </script>";
}
?>
