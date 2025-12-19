<?php
if (session_status() === PHP_SESSION_NONE) session_start();
// ensure DB connection available
if (!isset($con)) include __DIR__ . '/connexion.php';
$userDisplayName = '';
if (!empty($_SESSION['user_id'])) {
    $uid = (int)$_SESSION['user_id'];
    $s = $con->prepare('SELECT prenom, nom, email FROM lecteurs WHERE id = ? LIMIT 1');
    if ($s) {
        $s->bind_param('i', $uid);
        $s->execute();
        $r = $s->get_result();
        if ($row = $r->fetch_assoc()) {
            $userDisplayName = trim(($row['prenom'] ?? '') . ' ' . ($row['nom'] ?? '')) ?: ($row['email'] ?? '');
        }
        $s->close();
    }
}
?>
<header>
    <div class="container"><a href="../pages/acceuil.php"><strong>LibraNum</strong></a>
    <nav>
        <button class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </button>
        <ul id="menu" class="menu">
            <li><a href="../pages/acceuil.php">Accueil</a></li>
            <li><a href="#about">A propos</a></li>
            <li><a href="#contact">Contact</a></li>
            <?php if (!empty($userDisplayName)): ?>
                <li><a href="../pages/wishlist.php">Liste de souhaits</a></li>
                <li><a href="../pages/logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="login.php#login-box">Connexion</a></li>
                <li><a href="login.php#register">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    </div>
</header>
