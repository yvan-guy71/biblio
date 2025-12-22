<?php
$host = "mysql.railway.internal";
$user = "root";
$pass = "eNMpAFcSpfTxvsTcejAPNJKzpZEPRmyf";
$dbname= "book_store";
$port = 3306;


$con = new mysqli($host, $user, $pass, $dbname, $port);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    // echo "connected successfully";
}
?>