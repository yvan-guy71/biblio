<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include '../inc/header.php'; ?>
    <?php
include '../inc/check_admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $auteur = mysqli_real_escape_string($con, $_POST['Auteur']);
    $titre = mysqli_real_escape_string($con, $_POST['Titre']);
    $description = mysqli_real_escape_string($con, $_POST['Description']);
    $maison_edition = mysqli_real_escape_string($con, $_POST['maison_edition']);
    $nombre_exemplaire = mysqli_real_escape_string($con, $_POST['nombre_exemplaire']);
    
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/$image");
    } elseif (isset($_POST['existing_image'])) {
        $image = mysqli_real_escape_string($con, $_POST['existing_image']);
    }

    $sql = "UPDATE livres SET auteur='$auteur', titre='$titre', description='$description', maison_edition='$maison_edition', nombre_exemplaire='$nombre_exemplaire', image='$image' WHERE id=$id";

    if ($con->query($sql) === TRUE) {
        echo "Livre mis à jour avec succès";
        header("Location: index.php?page=list");
    } else {
        echo "Erreur lors de la mise à jour du livre: " . $con->error;
    }
}
?>
<?php include '../inc/footer.php'; ?>
</body>
</html>
