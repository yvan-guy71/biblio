<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <?php
include 'inc/check_admin.php';
// Database connection is already established in index.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $auteur = mysqli_real_escape_string($con, $_POST['Auteur']);
    $titre = mysqli_real_escape_string($con, $_POST['Titre']);
    $description = mysqli_real_escape_string($con, $_POST['Description']);
    $maison_edition = mysqli_real_escape_string($con, $_POST['maison_edition']);
    $nombre_exemplaire = mysqli_real_escape_string($con, $_POST['nombre_exemplaire']);
    $image = $_POST['image'];

    $sql = "UPDATE livres SET auteur='$auteur', titre='$titre', description='$description', maison_edition='$maison_edition', nombre_exemplaire='$nombre_exemplaire', image='$image' WHERE id=$id";

    if ($con->query($sql) === TRUE) {
        echo "Livre mis à jour avec succès";
        header("Location: index.php?page=list");
    } else {
        echo "Erreur lors de la mise à jour du livre: " . $con->error;
    }
}
// Connection closed in index.php (or let it close automatically)
?>
<?php include 'inc/footer.php'; ?>
</body>
</html>
