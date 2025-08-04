<?php

$DB_HOST = "localhost";
$DB_NAME = "root";
$DB_PASS = "";
$DB_DB = "db_eform";
$con = new mysqli($DB_HOST, $DB_NAME, $DB_PASS, $DB_DB);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


?>
 
