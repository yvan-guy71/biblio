<?php 
include 'inc/check_admin.php';
// Connection already included in index.php
$id = $_GET['id'];
$sql = "SELECT * FROM livres WHERE id = $id";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edition du livre</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    form {
        width: 400px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f0f8ff57 ;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        display: flex;
        flex-direction: column;
        gap: 10px;
        color: #fff;
    }
    input[type="text"], input[type="number"], textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    button {
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
    @media (max-width: 600px) {
        form {
            width: 90%;
            margin: 10px auto;
            padding: 15px;
        }
    }
</style>
<body>
    <?php include 'inc/header.php'; ?>
    <h1>Modifier le livre</h1>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    ?>
    <form action="index.php?page=update" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="existing_image" value="<?php echo $row['image']; ?>">
        <label for="Auteur">Auteur:</label><br>
        <input type="text" name="Auteur" value="<?php echo $row['auteur']; ?>" required><br>
        <label for="Titre">Titre:</label><br>
        <input type="text" name="Titre" value="<?php echo $row['titre']; ?>"><br>
        <label for="Description">Description:</label><br>
        <textarea type="text" name="Description"><?php echo $row['description']; ?></textarea><br>
        <label for="Maison d'édition">Maison d'édition:</label><br>
        <input type="text" name="maison_edition" value="<?php echo $row['maison_edition']; ?>"><br>
        <label for="Nombre d'exemplaires">Nombre d'exemplaires:</label><br>
        <input type="number" name="nombre_exemplaire" value="<?php echo $row['nombre_exemplaire']; ?>"><br><br>
        <label for="Image">Image:</label><br>
        <input type="file" name="image"><br><br>
        <button type="submit" value="Mettre à jour">Mettre à jour</button>
    </form>
    <?php
        }
    } else {
        echo "Aucun livre trouvé";
    }
    ?>

<?php include 'inc/footer.php'; ?>
</body>
</html>
