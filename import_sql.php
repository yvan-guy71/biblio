<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "book_store";
$port = 3306;

if (getenv('DATABASE_URL')) {
    $url_parts = parse_url(getenv('DATABASE_URL'));
    $host = $url_parts['host'];
    $user = $url_parts['user'];
    $password = $url_parts['pass'];
    $db = ltrim($url_parts['path'], '/');
    $port = $url_parts['port'];
} elseif (getenv('MYSQLHOST')) {
    $host = getenv('MYSQLHOST');
    $user = getenv('MYSQLUSER');
    $password = getenv('MYSQLPASSWORD');
    $db = getenv('MYSQLDATABASE');
    $port = getenv('MYSQLPORT');
}

$con = new mysqli($host, $user, $password, $db, $port);
if ($con->connect_error) {
    die("Erreur de connexion: " . $con->connect_error);
}

// Charger le fichier SQL
$sql_file = 'book_store.sql';
if (!file_exists($sql_file)) {
    die("Fichier SQL introuvable.");
}
$sql = file_get_contents($sql_file);

// Exécuter les requêtes
if ($con->multi_query($sql)) {
    echo "Importation réussie 🚀";
} else {
    echo "Erreur d'importation : " . $con->error;
}

$con->close();
?>
