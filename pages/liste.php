<?php
// DB included by index.php
include '../inc/check_admin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste des livres</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
            color: white;
        }
        th {
            color: black;
            background-color: #f2f2f2;
        }
        td a {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 5px;
        }
        .btn-edit {
            background-color: #4CAF50;
        }
        .btn-edit:hover {
            background-color: #45a049;
        }
        .btn-delete {
            background-color: #f44336;
        }
        .btn-delete:hover {
            background-color: #da190b;
        }
        .btn-add {
            background-color: #2196F3;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }
        .btn-add:hover {
            background-color: #0b7dda;
        }
        nav ul li a {
            color: white;
        }
    </style>
</head>
<body>
    <?php include './inc/header.php'; ?>
    <h1>Listes de livres</h1>
    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Auteur</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Maison d'édition</th>
            <th>Nombre d'exemplaires</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM livres";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['auteur']) . "</td>";
                echo "<td>" . htmlspecialchars($row['titre']) . "</td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>" . htmlspecialchars($row['maison_edition']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nombre_exemplaire']) . "</td>";
                echo "<td>";
                if (!empty($row['image'])) {
                    echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='Image' width='100'>";
                } else {
                    echo "Pas d'image";
                }
                echo "</td>";
                echo "<td>";
                echo "<a href='index.php?page=edit&id=" . $row['id'] . "' class='btn-edit'>Modifier</a> ";
                echo "<a href='index.php?page=delete&id=" . $row['id'] . "' class='btn-delete'>Supprimer</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Aucun livre trouvé</td></tr>";
        }
        ?>
    </table><br>
    <a href="index.php?page=add" class="btn-add">Ajouter un Livre</a>
    <br><br>
    <a href="index.php?page=gestion_users" class="btn-add">Gérer les Utilisateurs</a>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: black;
        }
    </style>
<?php include './inc/footer.php'; ?>
</body>
</html>
