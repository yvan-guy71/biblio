<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du livre</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    p {
        font-size: 1.2rem;
        margin: 10px auto;
    }
    .affichage {
    color: #181313ff;
    width: 500px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f0f8ff57 ;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    text-align: left;
    gap: 10px;
    font-size: 1.3rem;
}
span {
    display: flex;
    font-weight: bold;
    justify-content: center;
    text-align: center;
    color: #fff
}
img {
    margin-left: 180px;
}
    </style>
</head>
<body>
    <?php include '../inc/header.php'; ?>
<?php 
include '../inc/connexion.php';
$userDisplayName = '';
if (!empty($_SESSION['prenom']) || !empty($_SESSION['nom'])) {
    $userDisplayName = trim(($_SESSION['prenom'] ?? '') . ' ' . ($_SESSION['nom'] ?? ''));
} elseif (!empty($_SESSION['email'])) {
    $userDisplayName = $_SESSION['email'];
}
$id = $_GET['id'];
$sql = "SELECT * FROM livres WHERE id = $id";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='affichage'>";
            echo "<strong>Titre : " . "</strong> ". htmlspecialchars($row['titre'])."<br>";
            echo "<strong>Auteur : </strong> ". htmlspecialchars($row['auteur']) . "<br><br>";
            echo "<strong>Description : </strong> ". htmlspecialchars($row['description']). "<br><br>";
            echo "<strong>Maison d'édition : </strong> ". htmlspecialchars($row['maison_edition']) . "<br><br>";
            echo "<strong>Nombre d'exemplaires : </strong> ". htmlspecialchars($row['nombre_exemplaire']) . "<br>";
            echo "<br>";
            echo "<img src='../images/" . htmlspecialchars($row['image']) . "' alt='Image' width='100' style='margin-top:10px;'><br>";
            echo "<form method=\"post\" action=\"add_to_list.php\" style=\"margin-top:10px;\">";
            echo "<input type=\"hidden\" name=\"livre_id\" value=\"" . (int)$row['id'] . "\">";
            echo "<button type=\"submit\">Ajouter à ma liste</button>";
            echo "</form>";
            echo "</div>";
    }
} else {
    echo "Aucun livre trouvé";
}
?>
<?php include '../inc/footer.php'; ?>
</body>
</html>
