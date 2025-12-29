<?php
include 'inc/check_admin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
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
        .btn-promote {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn-promote:hover {
            background-color: #45a049;
        }
        .btn-demote {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn-demote:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <h1>Gestion des Utilisateurs</h1>
    <div style="overflow-x: auto;">
    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Statut Admin</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT id, nom, prenom, email, is_admin FROM lecteurs";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . ($row['is_admin'] ? 'Admin' : 'Utilisateur') . "</td>";
                echo "<td>";
                if ($row['is_admin']) {
                    echo "<a href='index.php?page=demote_user&id=" . $row['id'] . "' class='btn-demote'>Rétrograder</a>";
                } else {
                    echo "<a href='index.php?page=promote_user&id=" . $row['id'] . "' class='btn-promote'>Promouvoir</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Aucun utilisateur trouvé</td></tr>";
        }
        ?>
        </tbody>
    </table>
    </div>
    <br>
    <a href="index.php?page=list" class="btn-add">Retour à la Gestion des Livres</a>
    <style>
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
    </style>
<?php include 'inc/footer.php'; ?>
</body>
</html>