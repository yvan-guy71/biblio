<?php
$database_url = getenv('DATABASE_URL');
if (!$database_url) {
    die("DATABASE_URL non défini.");
}

$url_parts = parse_url($database_url);
$host = $url_parts['host'];
$user = $url_parts['user'];
$password = $url_parts['pass'];
$db = ltrim($url_parts['path'], '/');
$port = $url_parts['port'];

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur PDO : " . $e->getMessage());
}
?>
