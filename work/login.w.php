<?php
session_start();
include("../conn.php");

if(isset($_POST["login"])){

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare the SELECT statement
    $query = "SELECT *
              FROM CUSTOMERS
              WHERE email = :email
              AND password = :password";
    $statement = oci_parse($dbconn, $query);

    // Bind the parameter value
    oci_bind_by_name($statement, ':email', $email);
    oci_bind_by_name($statement, ':password', $password);

    // Execute the statement
    $result = oci_execute($statement);
    if (!$result) {
        $error = oci_error($statement);
        die("Statement execution failed: " . $error['message']);
    }

    if ($row = oci_fetch_assoc($statement)) {
        // Login successful
        $_SESSION['customerid'] = $row['CUSTOMERID'];
        $_SESSION['firstname'] = $row['FIRSTNAME'];
        $_SESSION['lastname'] = $row['LASTNAME'];
        $_SESSION['phonenum'] = $row['PHONENUM'];
        $_SESSION['email'] = $row['EMAIL'];
        $_SESSION['password'] = $row['PASSWORD'];
       header("Location: ..\index.php");
    } 
    else {
        // Login failed
        echo "<script>alert('Invalid username or password! Please try again!');
        window.location.href = '../login.php';
        </script>";
    }
}
else{
    echo "fail";
}
?>