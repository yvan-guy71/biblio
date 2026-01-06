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
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .book-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }
        .book-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .book-title {
            font-size: 1.2em;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
        }
        .book-author {
            color: #ddd;
            margin-bottom: 10px;
        }
        .book-description {
            color: #ccc;
            font-size: 0.9em;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            line-clamp: 3;
            overflow: hidden;
        }
        .book-details {
            color: #bbb;
            font-size: 0.8em;
            margin-bottom: 15px;
        }
        .book-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .btn-edit, .btn-delete {
            padding: 8px 16px;
            border: none;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-edit {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
        }
        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
        }
        .btn-delete {
            background: linear-gradient(135deg, #f44336, #da190b);
            color: white;
        }
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(244, 67, 54, 0.3);
        }
        .btn-add {
            background: linear-gradient(135deg, #2196F3, #0b7dda);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 20px auto;
        }
        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);
        }
        .actions-container {
            text-align: center;
            margin-top: 30px;
        }
        footer {
            margin-top: 40px;
            clear: both;
        }
        h3 {
            color: #fff;
        }
        nav ul li a {
            color: white;
        }
        a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php include 'inc/header.php'; ?>
    <h1>Listes de livres</h1>
    <div class="books-grid">
        <?php
        $sql = "SELECT * FROM livres";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="book-card fade-in">';
                if (!empty($row['image'])) {
                    echo '<img src="images/' . htmlspecialchars($row['image']) . '" alt="Image du livre" class="book-image">';
                } else {
                    echo '<div class="book-image" style="background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #fff;">Pas d\'image</div>';
                }
                echo '<div class="book-title">' . htmlspecialchars($row['titre']) . '</div>';
                echo '<div class="book-author">Par ' . htmlspecialchars($row['auteur']) . '</div>';
                echo '<div class="book-description">' . htmlspecialchars($row['description']) . '</div>';
                echo '<div class="book-details">';
                echo '<strong>Éditeur:</strong> ' . htmlspecialchars($row['maison_edition']) . '<br>';
                echo '<strong>Exemplaires:</strong> ' . htmlspecialchars($row['nombre_exemplaire']);
                echo '</div>';
                echo '<div class="book-actions">';
                echo '<a href="index.php?page=edit&id=' . $row['id'] . '" class="btn-edit"><i class="fas fa-edit"></i> Modifier</a>';
                echo '<a href="index.php?page=delete&id=' . $row['id'] . '" class="btn-delete" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce livre ?\')"><i class="fas fa-trash"></i> Supprimer</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="book-card"><p>Aucun livre trouvé</p></div>';
        }
        ?>
    </div>
    <div class="actions-container">
        <a href="index.php?page=add" class="btn-add"><i class="fas fa-plus"></i> Ajouter un Livre</a>
        <br><br>
        <a href="index.php?page=gestion_users" class="btn-add"><i class="fas fa-users"></i> Gérer les Utilisateurs</a>
    </div>
<?php include 'inc/footer.php'; ?>
</body>
</html>
