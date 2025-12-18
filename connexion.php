<?php
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$db = getenv('DB_NAME') ?: 'book_store';

// Debug: Afficher les valeurs (supprimez après test)
echo "Host: $host, User: $user, DB: $db<br>";

$con = mysqli_init();
$con->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);
$con->real_connect($host, $user, $password, $db);

if ($con->connect_error) {
    die("Erreur de connexion: " . $con->connect_error);
}
else {
    //echo "connexion reussi";
}

