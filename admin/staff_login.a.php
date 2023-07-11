<?php
session_start();
include("../conn.php");
if(isset($_POST["submit"])){

    $staff_id = $_POST["staff_id"];
    $staff_password = $_POST["password"];

    // Prepare the SELECT statement
    $query = "SELECT *
              FROM STAFFS
              WHERE staffid = :staff_id
              AND password = :staff_password";
    $statement = oci_parse($dbconn, $query);

    // Bind the parameter value
    oci_bind_by_name($statement, ':staff_id', $staff_id);
    oci_bind_by_name($statement, ':staff_password', $staff_password);

    // Execute the statement
    oci_execute($statement);

    if ($row = oci_fetch_assoc($statement)) {
        // Login successful
        $_SESSION['staffid'] = $row['STAFFID'];
        $_SESSION['role'] = $row['ROLE'];
        $_SESSION['firstname'] = $row['FIRSTNAME'];
        $_SESSION['lastname'] = $row['LASTNAME'];
        $_SESSION['password'] = $row['PASSWORD'];
       header("Location: ..\index-adm.php");
    } else {
        // Login failed
        echo "<script>alert('Invalid username or password! Please try again!');
        window.location.href = '../login.php';
        </script>";
    }

} else {
    echo "<script>alert('Please try again!');
    window.history.back();
    </script>";
}
?>
