<?php
session_start();
include("conn.php");

function getDataAdm(){

   $data['staffid'] = $_SESSION['staffid'];
   $data['role'] = $_SESSION['role'];    
   $data['name'] =  $_SESSION['name'];
   $data['password'] = $_SESSION['password'];

   return $data;
}
?>