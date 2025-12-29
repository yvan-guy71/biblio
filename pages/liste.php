<?php
// DB included by index.php
include 'inc/check_admin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste des livres</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

        table {
            width: 100%;
            border-collapse: collapse;
        }
        footer {
        margin-top: 40px;  /* Ajoute de l'espace au-dessus du footer */
        clear: both; 
        }
        th, td {
            padding: 12px;
            text-align: left;
            color: white;
        }
        th {
            color: black;
            background-color: #f2f2f2;
        }
        td {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 5px;
        }
        tr {
            height: 50%;
        }
        h3 {
            color: #fff;
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
            width: 200px;
            margin: 0 auto;
        }
        .btn-add:hover {
            background-color: #0b7dda;
        }
        nav ul li a {
            color: white;
        }
        a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
            display: inline-block;
        }
    </style>
</head>
<body>
<?php include 'inc/header.php'; ?>
    <h1>Listes de livres</h1>
    <div style="overflow-y: auto; padding-bottom: 300px; margin-top: 20px;">
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
        <tbody>
        
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
            echo "<tr><td colspan='1'>Aucun livre trouvé</td></tr>";
        }
        ?>
    </table>
    </div>
    <div style="display: flex; padding-top: 20px; justify-content: center;">
    <a href="index.php?page=add" class="btn-add">Ajouter un Livre</a>
    <br><br>
    <a href="index.php?page=gestion_users" class="btn-add">Gérer les Utilisateurs</a>
    </div>
<?php include 'inc/footer.php'; ?>
</body>
</html>
