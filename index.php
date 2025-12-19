<?php
session_start();
// Include connection once for all pages
require_once 'inc/connexion.php';

// Define the page to load
$page = $_GET['page'] ?? 'home';

// Basic routing
switch ($page) {
    case 'home':
        $file = 'pages/acceuil.php';
        break;
    case 'list':
        $file = 'pages/liste.php';
        break;
    case 'add':
        $file = 'pages/ajouter.php';
        break;
    case 'login':
        $file = 'pages/login.php';
        break;
    case 'logout':
        $file = 'pages/logout.php';
        break;
    case 'wishlist':
        $file = 'pages/wishlist.php';
        break;
    case 'add_to_list':
        $file = 'pages/add_to_list.php';
        break;
    case 'remove_from_list':
        $file = 'pages/remove_from_list.php';
        break;
    case 'details':
        $file = 'pages/details.php';
        break;
    case 'edit':
        $file = 'pages/edit.php';
        break;
    case 'update':
        $file = 'pages/update.php';
        break;
    case 'delete':
        $file = 'pages/supprimer.php'; // or suppression.php?
        break;
    case 'insert':
        $file = 'pages/insert.php';
        break;
    case 'results':
        $file = 'pages/results.php';
        break;
    default:
        $file = 'pages/acceuil.php';
        break;
}

// Check if file exists before including
if (file_exists($file)) {
    // We include the file.
    // Note: The included files must NOT have session_start() or duplicate includes if we want to be clean,
    // but `require_once` handles the connection safely.
    // However, paths in included files (like `../inc/header.php`) will break because we are in root.
    // We need to fix those files.
    include $file;
} else {
    echo "<h1>Page not found</h1>";
}
?>