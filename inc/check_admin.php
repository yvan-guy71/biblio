<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['user_id']) || empty($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
     echo ("Accès refusé. Vous devez être administrateur pour accéder à cette page.");
    exit();
}
