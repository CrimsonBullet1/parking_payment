<?php
session_start();
include("../conn.php");

if(isset($_POST["save"])){

    $custemerid = $_SESSION['customerid'];
    $firstname  = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenum = $_POST['phonenum'];
    $email = $_POST['email'] ;
    $password = $_POST['password'] ;

    // Prepare the SELECT statement
    $query = "UPDATE CUSTOMERS
              SET firstname = :firstname,
                   lastname = :lastname,
                   phonenum = :phonenum,
                   email = :email,
                   password = :password
                   WHERE customerid = :customerid";
    $statement = oci_parse($dbconn, $query);

    // Bind the parameter value
    oci_bind_by_name($statement, ':firstname', $firstname);
    oci_bind_by_name($statement, ':lastname', $lastname);
    oci_bind_by_name($statement, ':phonenum', $phonenum);
    oci_bind_by_name($statement, ':email', $email);
    oci_bind_by_name($statement, ':password', $password);
    oci_bind_by_name($statement, ':customerid', $custemerid);

    // Execute the statement
    $result = oci_execute($statement);
    if (!$result) {
        $error = oci_error($statement);
        die("Statement execution failed: " . $error['message']);
    }
    else if($result){
        $newquery = "SELECT *
    FROM CUSTOMERS
    WHERE customerid = :customerid";

   $newstatement = oci_parse($dbconn, $newquery);

   // Bind the parameter value
   oci_bind_by_name($newstatement, ':customerid', $customerid);

// Execute the statement
$result = oci_execute($newstatement);

if ($row = oci_fetch_assoc($newstatement)) {
// Login successful
$_SESSION['customerid'] = $row['CUSTOMERID'];
$_SESSION['firstname'] = $row['FIRSTNAME'];
$_SESSION['lastname'] = $row['LASTNAME'];
$_SESSION['phonenum'] = $row['PHONENUM'];
$_SESSION['email'] = $row['EMAIL'];
$_SESSION['password'] = $row['PASSWORD'];

header("Location: ../profile.php");
} 
    }

    else {
        // Login failed
        echo "<script>alert('Invalid username or password! Please try again!');
        // window.location.href = '../login.php';
        </script>";
    }
}
else{
    echo "fail";
}
?>