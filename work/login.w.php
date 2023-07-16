<?php
include('../config.php');

if(isset($_POST["login"])){

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare the SELECT statement
    $stmt = $pdo->prepare("SELECT * FROM CUSTOMERS WHERE EMAIL = '" . $email . "' AND password = '" . $password . "'");
		$stmt->execute();
    $row = $stmt->fetch();

    if ($row) {
        // Login successful
        $_SESSION['customerid'] = $row['CUSTOMERID'];
        $_SESSION['firstname'] = $row['FIRSTNAME'];
        $_SESSION['lastname'] = $row['LASTNAME'];
        $_SESSION['phonenum'] = $row['PHONENUM'];
        $_SESSION['email'] = $row['EMAIL'];
        $_SESSION['password'] = $row['PASSWORD'];
       header("Location: ../index.php");
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