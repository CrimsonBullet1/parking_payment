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
    // $stid = "SELECT STAFFID FROM STAFFS";
    // $parse = oci_parse($dbconn, $stid);
    // $r = oci_execute($parse);

    // if (!$r) {
    //     $e = oci_error($parse);  // For oci_execute errors pass the statement handle
    //     print htmlentities($e['message']);
    //     print "\n<pre>\n";
    //     print htmlentities($e['sqltext']);
    //     printf("\n%".($e['offset']+1)."s", "^");
    //     print  "\n</pre>\n";
    // }
}
?>