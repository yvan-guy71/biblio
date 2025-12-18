<?php
include 'connexion.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <h1>Enrégistrer un livre</h1>
    <form action="insert.php" method="post">
        <label for="Auteur">Auteur:</label><br>
        <input type="text" name="Auteur" required><br>
        <label for="Titre">Titre:</label><br>
        <input type="text" name="Titre"><br>
        <label for="Description">Description:</label><br>
        <textarea type="text" name="Description"></textarea><br>
        <label for="Maison d'édition">Maison d'édition:</label><br>
        <input type="text" name="Maison_edition"><br>
        <label for="Nombre d'exemplaires">Nombre d'exemplaires:</label><br>
        <input type="number" name="Nombre_exemplaire"><br><br>
        <label for="Image">Image:</label><br>
        <input type="file" name="Image" accept=".jpg,.jpeg,.png,.avif,image/jpeg,image/png,image/avif"><br><br>
        <button type="submit" value="Ajouter">Enrégistrer</button>
    </form>
<?php include 'inc/footer.php'; ?>
</body>
</html>

