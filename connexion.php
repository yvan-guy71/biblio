<?php
$database_url = getenv('DATABASE_URL') ?: 'mysql://root:@localhost:3306/book_store';  // Défaut local

// Analyser l'URL pour extraire les composants
$url_parts = parse_url($database_url);
$host = $url_parts['host'] ?? 'localhost';
$user = $url_parts['user'] ?? 'root';
$password = $url_parts['pass'] ?? '';
$db = ltrim($url_parts['path'] ?? '/book_store', '/');  // Supprimer le '/' initial
$port = $url_parts['port'] ?? 3306;

$con = mysqli_init();
$con->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);
$con->real_connect($host, $user, $password, $db, $port);

if ($con->connect_error) {
    die("Erreur de connexion: " . $con->connect_error);
} else {
    // echo "Connexion réussie";
}

// Vérifier si la colonne is_admin existe