<?php

session_start();
include("../conn.php");

if(isset($_POST["btn-reserve"])){
// Get the form input values
    $slotnum = $_POST['slotnum'];
    $reservation_date = $_POST['reservation_date'];
// Retrieve other reservation details from $_POST
    
// Prepare the SELECT statement
    $query = "SELECT COUNT(*)
            FROM PARKING_LOTS
            LEFT JOIN RESERVATIONS ON PARKING_LOTS.parkingid = RESERVATIONS.parkingid
            WHERE slotnum = :slotnum
            AND reservation_date = :reservation_date";
    $statement = oci_parse($dbconn, $query);
    
// Process the reservation and save it to the database
oci_bind_by_name($statement, ':slotnum', $slotnum);
oci_bind_by_name($statement, ':reservation_date', $reservation_date);
oci_execute($statement);
$row = oci_fetch_assoc($statement);

        if ($row['COUNT'] > 0) {
            echo "<script>alert('Rserved!<br> Please try with a different Slot');
            window.history.back();
            </script>";
        } 
        else {
        $query = "INSERT INTO PARKING_LOTS(parkingid,slotnum) 
            VALUES (:parkingid,:slotnum) 
            AND 
            INSERT INTO RESERVATIONS(reservationid,duration,totalcost,reservation_date) 
            VALUES (:reservationid,:duration,:totalcost,:reservation_date);
        $statement = oci_parse($dbconn, $query)";

        // Bind the parameter value
        oci_bind_by_name($statement, ':parkingid', $parkingid);
        oci_bind_by_name($statement, ':slotnum', $slotnum);
        oci_bind_by_name($statement, ':reservationid', $reservationid);
        oci_bind_by_name($statement, ':duration', $duration);
        oci_bind_by_name($statement, ':totalcost', $totalcost);
        oci_bind_by_name($statement, ':reservation_date', $reservation_date);

            // Execute the statement
            if (oci_execute($statement)) {
                echo "<script>alert('Successfully Reserving!');
                window.location.href = '../parking_lot.php';
                </script>";
            } 
            else {
                $e = oci_error($statement);
            echo "Error: " . $e['message'];
            }
        }
        }
        else{
        echo "<script>alert('Please try again!');
        window.location.href = '../parking_lot.php';
        </script>";
        }
?>
