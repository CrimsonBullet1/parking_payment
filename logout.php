<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
    session_destroy();
    session_unset();
    header("Pragma: no-cache");
    header("Location: login.php"); 
    exit();
}
?>
