<?php
include 'inc/check_admin.php';
include 'connexion.php';
include 'connexion.php';
$id = $_GET['id'];
$sql = "DELETE FROM livres WHERE id = $id";
$result = $con->query($sql);
if ($con->query($sql) === TRUE) {
    echo "Livre supprimé avec succès";
    header("Location: liste.php");
} else {
    echo "Erreur lors de la suppression du livre: " . $con->error;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression du Livre</title>
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <h1>Suppression du livre</h1>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    ?>
    <form action="suppression.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <p>Êtes-vous sûr de vouloir supprimer le livre "<?php echo $row['titre']; ?>" par <?php echo $row['auteur']; ?>?</p>
    <button type="submit" value="Supprimer">Supprimer</button>
    <button><a href="liste.php">Annuler</a></button>
    </form>
    <?php
        }
    } else {
        echo "Aucun livre trouvé";
    }
    ?>
<?php include 'inc/footer.php'; ?>
</body>
</html>