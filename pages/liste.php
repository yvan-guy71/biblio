<?php
include '../inc/connexion.php';
include '../inc/check_admin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste des livres</title>
    <link rel="stylesheet" href="../style.css">
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
        }
        nav ul li a {
            color: white;
        }
    </style>
</head>
<body>
    <?php include '../inc/header.php'; ?>
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
                    echo "<img src='../images/" . htmlspecialchars($row['image']) . "' alt='Image' width='100'>";
                } else {
                    echo "Pas d'image";
                }
                echo "</td>";
                echo "<td>";
                echo "<a href='edit.php?id=" . $row['id'] . "'>Modifier</a> ";
                echo "<a href='supprimer.php?id=" . $row['id'] . "'>Supprimer</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Aucun livre trouvé</td></tr>";
        }
        ?>
    </table><br>
    <button><a href="../index.php">Ajouter un Livre</a></button>
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
<?php include '../inc/footer.php'; ?>
</body>
</html>
