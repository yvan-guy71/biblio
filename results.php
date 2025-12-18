<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de la recherche</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
.affichage {
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

.btn-details {
    justify-content: center;
    display: flex;
    width: 200px;
    margin: 10px auto 30px auto;
    padding: 10px 20px; 
    background-color: #007bffb0;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
}

.btn-details:hover {
    background-color: #0057b3b7;
}
span {
    display: flex;
    font-weight: bold;
    justify-content: center;
    text-align: center;
}
img {
    margin-top: 10px;
    margin-left: 180px;
}
</style>

</style>
</head>
<body>
    <?php include 'inc/header.php'; ?>
<?php
include 'connexion.php';

if (isset($_GET['q']) && !empty($_GET['q'])) {

    $recherche = mysqli_real_escape_string($con, $_GET['q']);

    $sql = "SELECT * FROM livres 
            WHERE titre LIKE '%$recherche%' 
               OR auteur LIKE '%$recherche%' 
               OR description LIKE '%$recherche%'";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {

        echo "<h2>Résultats pour : " . htmlspecialchars($recherche) . "</h2>";

        while ($row = $result->fetch_assoc()) {
            echo "<div class='affichage'>";
            echo "<strong>Titre : " . "</strong> ". htmlspecialchars($row['titre'])."<br>";
            echo "<strong>Auteur : </strong> ". htmlspecialchars($row['auteur']) . "<br><br>";
            echo "<strong>Description : </strong> ". htmlspecialchars($row['description']);
            echo "<br><br><span>Image <br></span>";
            echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='Image' width='100' style='margin-top:10px;'><br>";
            echo "</div>";
            echo '<a href="details.php?id=' . $row['id'] . '" class="btn-details">Détails du livre</a>';
        }
    } else {
        echo "<p style='text-align:center;'>Aucun livre trouvé pour : " . htmlspecialchars($recherche) . "</p>";
    }
} else {
    echo "<p style='text-align:center;'>Veuillez entrer un mot-clé pour rechercher.</p>";
}
?>
<?php include 'inc/footer.php'; ?>
</body>
</html>
