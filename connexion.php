<?php
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$db = getenv('DB_NAME') ?: 'book_store';

$con = mysqli_init();
$con->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);  // Désactiver la vérification SSL pour PlanetScale
$con->real_connect($host, $user, $password, $db);

if ($con->connect_error) {
    die("Erreur de connexion: " . $con->connect_error);
}
else {
    //echo "connexion reussi";
}

