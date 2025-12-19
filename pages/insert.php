<?php 
include '../inc/check_admin.php';
include '../inc/connexion.php';
$auteur = mysqli_real_escape_string($con, $_POST['Auteur']);
$titre = mysqli_real_escape_string($con, $_POST['Titre']);
$description = mysqli_real_escape_string($con, $_POST['Description']);
$maison_edition = mysqli_real_escape_string($con, $_POST['Maison_edition']);
$nombre_exemplaire = mysqli_real_escape_string($con, $_POST['Nombre_exemplaire']);
$image = $_POST['Image'];
        //echo $auteur, $titre, $description;
$sql = "INSERT INTO livres (auteur, titre, description, maison_edition, nombre_exemplaire, image) VALUES ('$auteur', '$titre', '$description', '$maison_edition', '$nombre_exemplaire', '$image')";
if ($con->query($sql) === TRUE) {
    header("Location: liste.php"); exit();
} else {
    echo "Erreur: " . $sql . "<br>" . $con->error;
} 
