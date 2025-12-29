<?php
include './inc/connexion.php';

$message = '';

if (empty($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit();
}

$user_id = (int)$_SESSION['user_id'];
$livre_id = isset($_POST['livre_id']) ? (int)$_POST['livre_id'] : 0;
if ($livre_id <= 0) {
    header('Location: index.php?page=home');
    exit();
}

$chk = $con->prepare('SELECT id_livre FROM liste_lecture WHERE id_lecteur = ? AND id_livre = ? LIMIT 1');
$chk->bind_param('ii', $user_id, $livre_id);
$chk->execute();
$chk->store_result();
if ($chk->num_rows > 0) {
    $chk->close();
    header('Location: index.php?page=details&id=' . $livre_id);
    exit();
}
$chk->close();

$ins = $con->prepare('INSERT INTO liste_lecture (id_livre, id_lecteur, date_emprunt, date_retour) VALUES (?, ?, NOW(), Now())');
$ins->bind_param('ii', $livre_id, $user_id);
if ($ins->execute()) {
    $ins->close();
    $message = "Livre ajoute au panier";
    header('Location: index.php?page=details&id=' . $livre_id);
    exit();
} else {
    $message = "Une erreur s'est produite lors de l'ajout du livre au panier";
    $ins->close();
    header('Location: index.php?page=details&id=' . $livre_id);
    exit();
}
?>
