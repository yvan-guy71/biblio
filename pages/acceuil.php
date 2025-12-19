<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <?php
        session_start();
        include '../inc/connexion.php';
        $userDisplayName = '';
        if (!empty($_SESSION['user_id'])) {
            $uid = $_SESSION['user_id'];
            $s = $con->prepare('SELECT prenom, nom, email FROM lecteurs WHERE id = ? LIMIT 1');
            $s->bind_param('i', $uid);
            $s->execute();
            $r = $s->get_result();
            if ($row = $r->fetch_assoc()) {
                $userDisplayName = trim($row['prenom'] . ' ' . $row['nom']);
            }
            $s->close();
        }
    ?>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 30px;
            justify-items: center;
            margin: 40px auto;
        }
        .book-card {
            position: relative;
            display: block;
            color: #fff;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        .book-card img {
            display: block;
            margin: 0 auto 10px auto;
            border-radius: 5px;
            max-width: 150px;
            max-height: 200px;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
        .book-card img:hover {
            transform: scale(1.09);
            transition: transform 0.3s;
        }
        .book-card span {
            color: #fff;
            font-style: italic;
        }
        .titre {
            position: absolute;
            bottom: 0;
            left: 0;
            max-width: 200px;
            max-height: 100px;
            justify-content: center;
            text-align: center;
            width: 100px;
            background-color: #213331c2;
            padding: 8px 2px 2px 2px;
            font-size: 0.7rem;
            color: #fff;
            margin: 0;
            text-shadow: 1px 1px 3px #000;
            font-weight: 400;
            margin-bottom: 5px;
            border-radius: 2px;
            margin-left: 10px;
        }
        h2 {
            align-items: center;
            text-align: center;
            margin-top: 50px;
            color: #fff;
        }
        .underline {
            border-bottom: 1px solid #fff;
            width: 150px;
            margin: 10px auto 30px auto;
        }
        p {
            text-align: center;
            color: #fff;
            font-size: 1.1rem;
            flex-direction: column;
            margin: 10px auto;
            margin-top: 40px;
            max-width: 1000px;
            padding-bottom: 10px;
        }
        .contact {
            display: flex;
            text-align: center;
            color: #fff;
            font-size: 1.1rem;
            flex-direction: column;
            margin: 10px auto;
            margin-top: 20px;
            max-width: 800px;
            padding-bottom: 40px;
            flex: 1;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #213331;
        }
        .address {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<section>
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
    <h1>Bienvenue sur la meilleur Bibliothèque<br>numérique au monde</h1>
    <p>Ici vous pouvez trouver tous les livres que vous souhaitez</p>
    <form action="results.php" method="get">
        <input type="search" name="q" placeholder="Cherchez un livre..." required>
        <button type="submit">Rechercher</button>
    </form>
    <h2>Nos livres disponibles</h2>
    <div class="underline"></div>
<div class="grid-container">
    <?php
include '../inc/connexion.php';
$sql = "SELECT * FROM livres";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<a href='details.php?id=" . $row['id'] . "'>";
        echo "<div class='book-card'>";
        echo htmlspecialchars($row['image']) ? "<img src='../images/" . htmlspecialchars($row['image']) . "' alt='Image' width='120'>" 
        : "<span>No Image</span>";
        echo "<div class='titre'>" . htmlspecialchars($row['titre']) . "</div>";
        echo "</div>";
        echo "</a>";
        }
}
?>
</div>
</section>
<section id="about">
    <div class="about">
        <h2>A propos de nous</h2>
        <div class="underline"></div>
        <p>Bienvenue à la Bibliothèque Numérique, votre destination ultime pour explorer un vaste univers littéraire en ligne. Nous sommes dédiés à offrir un accès facile et pratique à une collection diversifiée de livres couvrant tous les genres et intérêts. Que vous soyez un passionné de romans, un amateur de sciences, ou un curieux en quête de nouvelles connaissances, notre bibliothèque numérique est conçue pour répondre à vos besoins. Plongez dans notre sélection soigneusement organisée, découvrez des auteurs émergents et classiques, et profitez de la commodité de lire où que vous soyez. Rejoignez-nous dans cette aventure littéraire et laissez-vous inspirer par le pouvoir des mots.</p>
    </div>
</section>
<section id="contact">
        <h2>Contactez-Nous</h2>
    <div class="contact">
        <div class="underline"></div>
        <div class="address">
        <p>123 Rue de la Bibliothèque, 75000 Lomé, Togo<br></p>
        <span>Téléphone : +33 1 23 45 67 89<br></span>
        </div>
    </div>
</section>
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');
    menuToggle.addEventListener('click', function() {
        menu.classList.toggle('open');
    });
    document.querySelectorAll('.menu a').forEach(link => {
        link.addEventListener('click', () => {
            menu.classList.remove('open');
        });
    });
</script>
<?php include '../inc/footer.php'; ?>
</body>
</html>
