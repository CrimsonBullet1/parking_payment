<?php
include("../conn.php");
if(isset($_POST["submit"])){

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
   
    // Check if the user with the same email already exists
    $query = "SELECT COUNT(*) 
              FROM CUSTOMERS 
              WHERE EMAIL = :email";
    $statement = oci_parse($dbconn, $query);
    oci_bind_by_name($statement, ':email', $email);
    
    oci_execute($statement);
    $row = oci_fetch_assoc($statement);

        if ($row['COUNT'] > 0) {
            echo "<script>alert('User with the same email already exists!<br> Please try again with a different email.');
            window.history.back();
            </script>";
       } 
       else {
          $query = "INSERT INTO CUSTOMERS(FIRSTNAME,LASTNAME,EMAIL,PASSWORD,PHONENUM) 
              VALUES (:firstname,:lastname,:email,:password,:phone)";
          $statement = oci_parse($dbconn, $query);

          // Bind the parameter value
          oci_bind_by_name($statement, ':firstname', $firstname);
          oci_bind_by_name($statement, ':lastname', $lastname);
          oci_bind_by_name($statement, ':email', $email);
          oci_bind_by_name($statement, ':password', $password);
          oci_bind_by_name($statement, ':phone', $phone);

            // Execute the statement
            if (oci_execute($statement)) {
                echo "<script>alert('Successfully registered! Try login at Login Page!');
                window.location.href = '../login.php';
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
    window.location.href = '../login.php';
    </script>";
}
?>