<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du livre</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .book-details-container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }
        .book-details-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            gap: 30px;
            align-items: flex-start;
        }
        .book-image-section {
            flex: 0 0 300px;
            text-align: center;
        }
        .book-image {
            width: 100%;
            max-width: 250px;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .book-info-section {
            flex: 1;
        }
        .book-title {
            font-size: 2.5em;
            font-weight: 700;
            color: #fff;
            margin-bottom: 10px;
            text-align: center;
        }
        .book-author {
            font-size: 1.3em;
            color: #ddd;
            margin-bottom: 20px;
            text-align: center;
        }
        .book-description {
            color: #ccc;
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .book-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }
        .detail-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }
        .detail-label {
            font-weight: 600;
            color: #fff;
            margin-bottom: 5px;
        }
        .detail-value {
            color: #ddd;
        }
        .book-actions {
            text-align: center;
        }
        .primary-btn {
            display: inline-block;
            padding: 15px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-size: 1.1em;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            border: none;
            cursor: pointer;
        }
        .primary-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        .no-book {
            text-align: center;
            color: #fff;
            font-size: 1.5em;
            margin-top: 50px;
        }
        @media (max-width: 768px) {
            .book-details-card {
                flex-direction: column;
                padding: 20px;
                gap: 20px;
            }
            .book-image-section {
                flex: none;
            }
            .book-title {
                font-size: 2em;
            }
            .book-details-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="book-details-container">
<?php 
// DB included by index.php
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
        echo "<div class='book-details-card fade-in'>";
        echo "<div class='book-image-section'>";
        if (!empty($row['image'])) {
            echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='Image du livre' class='book-image'>";
        } else {
            echo "<div class='book-image' style='background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #fff; height: 300px; border-radius: 15px;'>Pas d'image</div>";
        }
        echo "</div>";
        echo "<div class='book-info-section'>";
        echo "<h1 class='book-title'>" . htmlspecialchars($row['titre']) . "</h1>";
        echo "<div class='book-author'>Par " . htmlspecialchars($row['auteur']) . "</div>";
        echo "<div class='book-description'>" . htmlspecialchars($row['description']) . "</div>";
        echo "<div class='book-details-grid'>";
        echo "<div class='detail-item'>";
        echo "<div class='detail-label'><i class='fas fa-building'></i> Maison d'édition</div>";
        echo "<div class='detail-value'>" . htmlspecialchars($row['maison_edition']) . "</div>";
        echo "</div>";
        echo "<div class='detail-item'>";
        echo "<div class='detail-label'><i class='fas fa-copy'></i> Nombre d'exemplaires</div>";
        echo "<div class='detail-value'>" . htmlspecialchars($row['nombre_exemplaire']) . "</div>";
        echo "</div>";
        echo "</div>";
        echo "<div class='book-actions'>";
        echo "<form method='post' action='index.php?page=add_to_list'>";
        echo "<input type='hidden' name='livre_id' value='" . (int)$row['id'] . "'>";
        echo "<button class='primary-btn' type='submit'><i class='fas fa-plus'></i> Ajouter à ma liste</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<div class='no-book'>Aucun livre trouvé</div>";
}
?>
    </div>
<?php include 'inc/footer.php'; ?>
</body>
</html>
