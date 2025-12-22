<?php
include '../inc/check_admin.php';

if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];
    // Empêcher de se rétrograder soi-même
    if ($user_id == $_SESSION['user_id']) {
        echo "Vous ne pouvez pas vous rétrograder vous-même.";
        exit();
    }
    $sql = "UPDATE lecteurs SET is_admin = 0 WHERE id = $user_id";
    if ($con->query($sql) === TRUE) {
        header("Location: index.php?page=gestion_users");
        exit();
    } else {
        echo "Erreur lors de la rétrogradation: " . $con->error;
    }
} else {
    echo "ID utilisateur manquant.";
}
?>