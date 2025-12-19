<?php
include '../inc/check_admin.php';
include '../inc/connexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $auteur = $_POST['Auteur'];
    $titre = $_POST['Titre'];
    $description = $_POST['Description'];
    $maison_edition = $_POST['maison_edition'];
    $nombre_exemplaire = $_POST['nombre_exemplaire'];

    $sql = "DELETE FROM livres WHERE id=$id";
    if ($con->query($sql) === TRUE) {
        echo "Livre supprimé avec succès";
        header("Location: liste.php");
    } else {
        echo "Erreur lors de la suppression du livre: " . $con->error;
    }
}
$con->close();
?>
