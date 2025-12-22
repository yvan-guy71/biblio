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
    <title>Ma Liste de Lecture</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        th, td {
            padding: 8px 12px;
            text-align: left;
            color: white;
            border: 2px solid #fff;
        }
        th {
            color: black;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?php include 'inc/header.php'; ?>
<h1 style="text-align:center;margin-top:18px">Ma Liste de Lecture</h1>
<?php if (empty($wishlist_books)): ?>
    <p style="text-align:center">Votre liste est vide.</p>
<?php else: ?>
    <table style="width:90%;margin:20px auto; border-collapse:collapse; border: 2px solid #fff; color: #fff;">
        <tr><th>Titre</th><th>Auteur</th><th>Date emprunt</th><th>Date retour</th><th>Action</th></tr>
        <?php foreach ($wishlist_books as $book): ?>
            <tr>
                <td><?php echo htmlspecialchars($book['titre']); ?></td>
                <td><?php echo htmlspecialchars($book['auteur']); ?></td>
                <td><?php echo htmlspecialchars($book['date_emprunt'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($book['date_retour'] ?? ''); ?></td>
                <td>
                    <form method="post" action="index.php?page=remove_from_list" style="display:inline;background:none;box-shadow:none;padding:0;margin:0;">
                        <input type="hidden" name="livre_id" value="<?php echo (int)$book['livre_id']; ?>">
                        <button type="submit" style="background:red;padding:5px 10px;">Retirer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<?php include 'inc/footer.php'; ?>
</body>
</html>
