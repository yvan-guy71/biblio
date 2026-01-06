<?php
// DB included by index.php
if (empty($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit();
}
$user_id = (int) $_SESSION['user_id'];

$query = "
    SELECT
        l.id AS livre_id,
        l.titre,
        l.auteur,
        ll.date_emprunt,
        ll.date_retour
    FROM liste_lecture ll
    JOIN livres l ON ll.id_livre = l.id
    WHERE ll.id_lecteur = ?
    ORDER BY ll.date_emprunt DESC
";
$stmt = $con->prepare($query);
if ($stmt === false) {
    die('Erreur préparation requête : ' . htmlspecialchars($con->error));
}
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$wishlist_books = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Liste de Lecture</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .wishlist-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .wishlist-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }
        .wishlist-title {
            font-size: 1.2em;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
        }
        .wishlist-author {
            color: #ddd;
            margin-bottom: 10px;
        }
        .wishlist-dates {
            color: #bbb;
            font-size: 0.9em;
            margin-bottom: 15px;
        }
        .wishlist-actions {
            text-align: center;
        }
        .btn-remove {
            background: linear-gradient(135deg, #f44336, #da190b);
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-remove:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(244, 67, 54, 0.3);
        }
        .empty-wishlist {
            text-align: center;
            color: #fff;
            font-size: 1.2em;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<?php include 'inc/header.php'; ?>
<h1 style="text-align:center;margin-top:18px">Ma Liste de Lecture</h1>
<?php if (empty($wishlist_books)): ?>
    <div class="empty-wishlist">Votre liste est vide.</div>
<?php else: ?>
    <div class="wishlist-grid">
        <?php foreach ($wishlist_books as $book): ?>
            <div class="wishlist-card fade-in">
                <div class="wishlist-title"><?php echo htmlspecialchars($book['titre']); ?></div>
                <div class="wishlist-author">Par <?php echo htmlspecialchars($book['auteur']); ?></div>
                <div class="wishlist-dates">
                    <strong>Emprunté le:</strong> <?php echo htmlspecialchars($book['date_emprunt'] ?? 'N/A'); ?><br>
                    <strong>Retour prévu:</strong> <?php echo htmlspecialchars($book['date_retour'] ?? 'N/A'); ?>
                </div>
                <div class="wishlist-actions">
                    <form method="post" action="index.php?page=remove_from_list" style="display:inline;">
                        <input type="hidden" name="livre_id" value="<?php echo (int)$book['livre_id']; ?>">
                        <button type="submit" class="btn-remove" onclick="return confirm('Êtes-vous sûr de vouloir retirer ce livre de votre liste ?')"><i class="fas fa-times"></i> Retirer</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php include 'inc/footer.php'; ?>
</body>
</html>
