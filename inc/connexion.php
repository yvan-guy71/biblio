<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname= "book_store";

$con = new mysqli($host, $user, $pass, $dbname);
if ($con->connect_error) {
    //die("Connection failed: " . $con->connect_error);
} else {
    //echo "connected successfully";
}
?>