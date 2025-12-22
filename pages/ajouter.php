<?php
include '../inc/check_admin.php';
// DB inclu index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f0f8ff57 ;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            color: #fff;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="number"], textarea, input[type="file"] {
            background-color: #fcf9f98f;
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include '../inc/header.php'; ?>
    <h1>Enrégistrer un livre</h1>
    <form action="index.php?page=insert" method="post" enctype="multipart/form-data">
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
<?php include '../inc/footer.php'; ?>
</body>
</html>

