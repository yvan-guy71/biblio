<?php
require_once 'inc/connexion.php';

$email = 'armellesage66@gmail.com';
$password = '12062003'; // Mot de passe simple pour test

$hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO lecteurs (prenom, nom, email, password, is_admin) VALUES ('Admin', 'Biblio', '$email', '$hash', 1) ON DUPLICATE KEY UPDATE password='$hash', is_admin=1";

if ($con->query($sql) === TRUE) {
    echo "Admin créé/mis à jour. Email: $email, Password: $password";
} else {
    echo "Erreur: " . $con->error;
}
?>