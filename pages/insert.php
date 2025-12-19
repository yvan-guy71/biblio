<?php 
include 'inc/check_admin.php';
// DB included by index.php

$auteur = mysqli_real_escape_string($con, $_POST['Auteur'] ?? '');
$titre = mysqli_real_escape_string($con, $_POST['Titre'] ?? '');
$description = mysqli_real_escape_string($con, $_POST['Description'] ?? '');
$maison_edition = mysqli_real_escape_string($con, $_POST['Maison_edition'] ?? '');
$nombre_exemplaire = mysqli_real_escape_string($con, $_POST['Nombre_exemplaire'] ?? '');

// Handle image upload if present, otherwise check POST
$image = '';
if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
    $image = basename($_FILES['Image']['name']);
    move_uploaded_file($_FILES['Image']['tmp_name'], "images/$image");
} elseif (isset($_POST['Image'])) {
    $image = mysqli_real_escape_string($con, $_POST['Image']);
}

$sql = "INSERT INTO livres (auteur, titre, description, maison_edition, nombre_exemplaire, image) VALUES ('$auteur', '$titre', '$description', '$maison_edition', '$nombre_exemplaire', '$image')";
if ($con->query($sql) === TRUE) {
    header("Location: index.php?page=list"); exit();
} else {
    echo "Erreur: " . $sql . "<br>" . $con->error;
} 
?>
