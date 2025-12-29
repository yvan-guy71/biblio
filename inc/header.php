<?php
if (session_status() === PHP_SESSION_NONE) session_start();
// ensure DB connection available
if (!isset($con)) include __DIR__ . '/connexion.php';
$userDisplayName = '';
if (!empty($_SESSION['user_id'])) {
    $uid = (int)$_SESSION['user_id'];
    $s = $con->prepare('SELECT prenom, nom, email, is_admin FROM lecteurs WHERE id = ? LIMIT 1');
    if ($s) {
        $s->bind_param('i', $uid);
        $s->execute();
        $r = $s->get_result();
        if ($row = $r->fetch_assoc()) {
            $userDisplayName = $row['prenom'] . ' ' . $row['nom'];
            $_SESSION['is_admin'] = $row['is_admin'];
        }
        $s->close();
    }
}
?>
<body>
<header>
       <h3><a href="index.php?page=home">LibraNum.</a>
    </h3>
    <div class="container"></div>
       <nav>       
          <ul id="menu" class="menu">
             <li><a href="index.php?page=home">Accueil</a></li>
             <li><a href="#about">A propos</a></li>
             <li><a href="#contact">Contact</a></li>
             <?php if (!empty($userDisplayName)): ?>
                <li><a href="index.php?page=wishlist">Liste de souhaits</a></li>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <li><a href="index.php?page=list">Gestion Livres</a></li>
                    <li><a href="index.php?page=add">Ajouter Livre</a></li>
                <?php endif; ?>
                <li><a href="index.php?page=logout">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="index.php?page=login#login-box">Connexion</a></li>
                <li><a href="index.php?page=login#register">Inscription</a></li>
            <?php endif; ?>
           </ul>
            <div class="menu-toggle" id="menu-toggle" onclick="toggleMenu()">
                <i class="fa-solid fa-bars"></i>
            </div>
        </nav>
    </div>
</header>
<script>
    function toggleMenu() {
        const menu = document.getElementById('menu');
        menu.classList.toggle('open');
    }

    window.addEventListener('scroll', function() {
        const menu = document.getElementById('menu');
        if (menu.classList.contains('open')) {
            menu.classList.remove('open');
        }
    });
</script>
