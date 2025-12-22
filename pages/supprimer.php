<?php
include '../inc/check_admin.php';
// Database connection is already established in index.php

$id = 0;
if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
} elseif (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
    if ($id > 0) {
        $sql = "DELETE FROM livres WHERE id = $id";
        if ($con->query($sql) === TRUE) {
            echo "Livre supprimé avec succès";
            header("Location: index.php?page=list");
            exit();
        } else {
            echo "Erreur lors de la suppression du livre: " . $con->error;
        }
    } else {
        echo "ID invalide.";
    }
}

// Fetch book details for confirmation
$book = null;
if ($id > 0) {
    $sql = "SELECT * FROM livres WHERE id = $id";
    $result = $con->query($sql);
    if ($result && $result->num_rows > 0) {
        $book = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression du Livre</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include '../inc/header.php'; ?>
    <h1>Suppression du livre</h1>
    <?php if ($book): ?>
        <form action="index.php?page=delete" method="post">
            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
            <input type="hidden" name="confirm" value="yes">
            <p>Êtes-vous sûr de vouloir supprimer le livre "<?php echo htmlspecialchars($book['titre']); ?>" par <?php echo htmlspecialchars($book['auteur']); ?>?</p>
            <button type="submit" value="Supprimer">Supprimer</button>
            <a href="index.php?page=list"><button type="button">Annuler</button></a>
        </form>
    <?php else: ?>
        <p>Aucun livre trouvé ou ID invalide.</p>
        <a href="index.php?page=list">Retour à la liste</a>
    <?php endif; ?>
    <?php include '../inc/footer.php'; ?>
</body>
</html>
