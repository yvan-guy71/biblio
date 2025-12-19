<?php
session_start();
include '../inc/connexion.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id  = (int) $_SESSION['user_id'];
$livre_id = isset($_POST['livre_id']) ? (int) $_POST['livre_id'] : 0;

if ($livre_id <= 0) {
    // pas d'id valide => retour
    header('Location: wishlist.php');
    exit();
}

// préparer et vérifier la requête
$del = $con->prepare('DELETE FROM liste_lecture WHERE id_lecteur = ? AND id_livre = ?');
if ($del === false) {
    // erreur de préparation -> log et retour
    error_log('Prepare failed: ' . $con->error);
    header('Location: wishlist.php');
    exit();
}

$del->bind_param('ii', $user_id, $livre_id);
if (!$del->execute()) {
    // erreur d'exécution -> log et retour
    error_log('Execute failed: ' . $del->error);
    $del->close();
    header('Location: wishlist.php');
    exit();
}

// vérifier si une ligne a été affectée
if ($del->affected_rows > 0) {
    // suppression réussie
    $del->close();
    header('Location: wishlist.php');
    exit();
} else {
    // aucune ligne supprimée -> possible mismatch (user_id / livre_id)
    $del->close();
    // optionnel : enregistrer message en session pour affichage
    $_SESSION['flash'] = 'Aucune entrée trouvée pour suppression.';
    header('Location: wishlist.php');
    exit();
}
?>
