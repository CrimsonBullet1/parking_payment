<?php
session_start();
$username = "parker";
$password = "parking123$";

try {
  $pdo = new PDO('oci:dbname=localhost/XE', $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>