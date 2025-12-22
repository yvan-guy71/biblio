
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { font-family: Arial, sans-serif; }
        .center-wrap { display:flex; align-items:center; justify-content:center; min-height:80vh; }
        .auth-card {
            width: 380px;
            background: #f5f7f9;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            padding: 18px;
        }
        .tabs { display:flex; gap:6px; margin-bottom:14px; }
        .tab-btn { flex:1; padding:10px 14px; border-radius:8px; border:1px solid #e1e6e6; background:#fff; cursor:pointer; font-weight:600 }
        .tab-btn.active { background:#163f2ffd; color:#fff; border-color:#163f2ffd }
        label { display:block; margin:12px 0 8px 0; font-size:0.95rem; color: rgba(250, 253, 250, 1) }
        input[type="text"], input[type="email"], input[type="password"] { width:100%; padding:7px; border-radius:6px; border:1px solid #d3dbe0; background: #ffffff6c; color: rgba(5, 5, 5, 1); }
        .forgot { display:block; margin:8px 0 12px 0; color:#2a6ea1; text-decoration:none; font-size:0.9rem }
        .primary-btn { width:100%; padding:12px; border-radius:8px; background:#163f2ffd; color:#fff; border:none; cursor:pointer; font-weight:600 }
        .msg { margin:10px 0; color: #080 }
        .error { margin:10px 0; color:#b00 }
        .profile-btn { padding:6px 12px; background:#fff; border-radius:6px; border:1px solid #eee; text-decoration:none; color:#163f2ffd }
        .hidden { display:none !important; }
        form { display:flex; flex-direction:column; gap:12px; padding: 20px; border-radius: 8px; box-shadow: 0 6px 18px rgba(0,0,0,0.06); }
        .auth-card { background-color: #163f2f69;}
        .register-box { background-color: #163f2f69; max-width: 100%;}
    </style>
</head>
<body>
    <?php include './inc/header.php'; ?>
    <?php
// messages par défaut
$message = '';
$error = '';


if (!empty($_SESSION['user_id'])) {
    header('Location: index.php?page=home');
    exit();
}

 // Inscription
    if (isset($_POST['register'])) {
        $prenom = trim($_POST['prenom'] ?? '');
        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Email invalide.';
        } elseif (strlen($password) < 6) {
            $error = 'Le mot de passe doit contenir au moins 6 caractères.';
        } else {
            // vérifier si l'email existe
            $stmt = $con->prepare('SELECT id FROM lecteurs WHERE email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $error = 'Cet email est déjà utilisé.';
                $stmt->close();
            } else {
                $stmt->close();
                $hash = password_hash($password, PASSWORD_DEFAULT);
                // Insert prenom, nom, email, password
                $ins = $con->prepare('INSERT INTO lecteurs (prenom, nom, email, password) VALUES (?, ?, ?, ?)');
                $ins->bind_param('ssss', $prenom, $nom, $email, $hash);
                if ($ins->execute()) {
                    $message = 'Inscription réussie. Vous pouvez maintenant vous connecter.';
                } else {
                    $error = 'Erreur lors de l\'inscription.';
                }
                $ins->close();
            }
        }
    }

    // Connexion
    if (isset($_POST['login'])) {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
            $error = 'Email ou mot de passe invalide.';
        } else {
            if ($hasIsAdmin) {
                $stmt = $con->prepare('SELECT id, prenom, nom, email, password, is_admin FROM lecteurs WHERE email = ? LIMIT 1');
            } else {
                $stmt = $con->prepare('SELECT id, prenom, nom, email, password FROM lecteurs WHERE email = ? LIMIT 1');
            }
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($row = $res->fetch_assoc()) {
                if (!$hasIsAdmin) $row['is_admin'] = 0;
                if (password_verify($password, $row['password'])) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['prenom'] = $row['prenom'] ?? '';
                    $_SESSION['nom'] = $row['nom'] ?? '';
                    $_SESSION['email'] = $row['email'] ?? '';
                    $_SESSION['is_admin'] = (int)($row['is_admin'] ?? 0);
                    header('Location: index.php?page=home');
                    exit();
                } else {
                    $error = 'Nom d\'utilisateur ou mot de passe incorrect.';
                }
            } else {
                $error = 'Nom d\'utilisateur ou mot de passe incorrect.';
            }
            $stmt->close();
        }
    }
    ?>
    <div class="center-wrap">
        <div class="auth-card" id="auth-left">
            <div class="tabs">
                <button type="button" class="tab-btn active" data-target="#login-box">Connexion</button>
                <button type="button" class="tab-btn" data-target="#register-box">Inscription</button>
            </div>
            <div id="login-box">
                <h3>Connexion</h3>
                <?php if ($message): ?><div class="msg"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
                <?php if ($error): ?><div class="error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
                <form method="post" action="index.php?page=login" autocomplete="off">
                        <div style="position: absolute; left: -9999px; top: auto; width:1px; height:1px; overflow:hidden;">
                            <input type="text" name="fake-username" autocomplete="username">
                            <input type="password" name="fake-password" autocomplete="current-password">
                        </div>
                        <label></label>
                        <input type="email" name="email" placeholder="Email ou Nom d'utilisateur" required autocomplete="email">
                        <label></label>
                        <input type="password" name="password" placeholder="Mot de passe" required autocomplete="current-password">
                        <a class="forgot" href="#">Mot de passe oublié ?</a>
                        <button class="primary-btn" type="submit" name="login">Connexion</button>
                    </form>
            </div>
            <div id="register-box" class="hidden">
                <h3>Inscription</h3>
                <form method="post" action="index.php?page=login" autocomplete="off">
                    <div style="position: absolute; left: -9999px; top: auto; width:1px; height:1px; overflow:hidden;">
                        <input type="text" name="fake-reg-username" autocomplete="username">
                        <input type="password" name="fake-reg-password" autocomplete="new-password">
                    </div>
                    <label></label>
                    <input type="text" name="prenom" placeholder="Prénom" required autocomplete="given-name">
                    <label></label>
                    <input type="text" name="nom" placeholder="Nom" required autocomplete="family-name">
                    <label></label>
                    <input type="email" name="email" placeholder="Email" required autocomplete="email">
                    <label></label>
                    <input type="password" name="password" placeholder="Mot de passe (min 6)" required autocomplete="new-password">
                    <button class="primary-btn" type="submit" name="register">S'inscrire</button>
                </form>
            </div>
</div>


    <script>
        function showTab(hash) {
            var targetId = '#login-box';
            if (hash === '#register' || hash === '#register-box') targetId = '#register-box';
            if (hash === '#login' || hash === '#login-box') targetId = '#login-box';
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('#login-box, #register-box').forEach(box => box.classList.add('hidden'));
            if (targetId === '#register-box') {
                document.querySelector('.tab-btn[data-target="#register-box"]').classList.add('active');
                document.querySelector('#register-box').classList.remove('hidden');
            } else {
                document.querySelector('.tab-btn[data-target="#login-box"]').classList.add('active');
                document.querySelector('#login-box').classList.remove('hidden');
            }
        }

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                var target = btn.dataset.target;
                history.replaceState(null, '', target.replace('#','') ? target : '#login');
                showTab(target);
            });
        });
        window.addEventListener('load', function() {
            var h = location.hash || '#login';
            showTab(h);
        });
    </script>
    </body>
    </html>
