<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname= "book_store";
$port = 3306;

if (getenv('DATABASE_URL')) {
    $url_parts = parse_url(getenv('DATABASE_URL'));
    $host = $url_parts['host'];
    $user = $url_parts['user'];
    $pass = $url_parts['pass'];
    $dbname = ltrim($url_parts['path'], '/');
    $port = $url_parts['port'];
} elseif (getenv('MYSQLHOST')) {
    $host = getenv('MYSQLHOST');
    $user = getenv('MYSQLUSER');
    $pass = getenv('MYSQLPASSWORD');
    $dbname = getenv('MYSQLDATABASE');
    $port = getenv('MYSQLPORT');
}

$con = new mysqli($host, $user, $pass, $dbname, $port);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    // echo "connected successfully";
}
?>