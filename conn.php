<?php
$user = "parker";
$password = "parking123$";
$host = "localhost/XE";
$dbconn = oci_connect($user, $password, $host);

if(!$dbconn){
    $error = oci_error();
    trigger_error(htmlentities($error['message']. ENT_QUOTES), E_USER_ERROR);
}
else{
   
}
?>