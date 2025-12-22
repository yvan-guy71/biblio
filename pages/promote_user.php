<?php
include '../inc/check_admin.php';
// DB included by index.php

if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];
    $sql = "UPDATE lecteurs SET is_admin = 1 WHERE id = $user_id";
    if ($con->query($sql) === TRUE) {
        header("Location: index.php?page=gestion_users");
        exit();
    } else {
        echo "Erreur lors de la promotion: " . $con->error;
    }
} else {
    echo "ID utilisateur manquant.";
}
?>