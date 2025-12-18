<?php
// Si Railway fournit DATABASE_URL, on l'utilise
$database_url = getenv('DATABASE_URL');

if ($database_url) {
    $url_parts = parse_url($database_url);
    $host = $url_parts['host'];
    $user = $url_parts['user'];
    $password = $url_parts['pass'];
    $db = ltrim($url_parts['path'], '/');
    $port = $url_parts['port'];
} else {
    // Sinon on utilise les variables Railway classiques
    $host = getenv("DB_HOST") ?: "localhost";
    $user = getenv("DB_USER") ?: "root";
    $password = getenv("DB_PASSWORD") ?: "";
    $db = getenv("DB_NAME") ?: "book_store";
    $port = getenv("DB_PORT") ?: 3306;
}

$con = mysqli_init();
$con->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);
$con->real_connect($host, $user, $password, $db, $port);

if ($con->connect_error) {
    die("Erreur de connexion: " . $con->connect_error);
}
?>
