<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de la recherche</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .result-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }
        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }
        .result-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .result-title {
            font-size: 1.2em;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
        }
        .result-author {
            color: #ddd;
            margin-bottom: 10px;
        }
        .result-description {
            color: #ccc;
            font-size: 0.9em;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            line-clamp: 3;
            overflow: hidden;
        }
        .btn-details {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .btn-details:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
        }
        .no-results {
            text-align: center;
            color: #fff;
            font-size: 1.2em;
            margin-top: 50px;
        }
        h3 {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
        }
        @media (max-width: 600px) {
            .results-grid {
                grid-template-columns: 1fr;
                padding: 0 10px;
            }
            .result-card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <?php include './inc/header.php'; ?>
<?php
// Connection already included in index.php

if (isset($_GET['q']) && !empty($_GET['q'])) {

    $recherche = mysqli_real_escape_string($con, $_GET['q']);

    $sql = "SELECT * FROM livres 
            WHERE titre LIKE '%$recherche%' 
               OR auteur LIKE '%$recherche%' 
               OR description LIKE '%$recherche%'";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {

        echo "<h3>Résultats pour : " . htmlspecialchars($recherche) . "</h3>";
        echo "<div class='results-grid'>";

        while ($row = $result->fetch_assoc()) {
            echo "<div class='result-card fade-in'>";
            if (!empty($row['image'])) {
                echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='Image du livre' class='result-image'>";
            } else {
                echo "<div class='result-image' style='background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #fff;'>Pas d'image</div>";
            }
            echo "<div class='result-title'>" . htmlspecialchars($row['titre']) . "</div>";
            echo "<div class='result-author'>Par " . htmlspecialchars($row['auteur']) . "</div>";
            echo "<div class='result-description'>" . htmlspecialchars($row['description']) . "</div>";
            echo "<a href='index.php?page=details&id=" . $row['id'] . "' class='btn-details'><i class='fas fa-info-circle'></i> Détails</a>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<div class='no-results'>Aucun livre trouvé pour : " . htmlspecialchars($recherche) . "</div>";
    }
} else {
    echo "<p style='text-align:center;'>Veuillez entrer un mot-clé pour rechercher.</p>";
}
?>
<?php include 'inc/footer.php'; ?>
</body>
</html>