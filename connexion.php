<?php
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$db = getenv('DB_NAME') ?: 'book_store';
$con = new mysqli($host, $user, $password, $db);

if ($con->connect_error) {
    die("erreur de connexion: " . $con->connect_error);
}
else {
    //echo "connexion reussi";
}

