<?php
include 'inc/check_admin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .users-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .user-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }
        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }
        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2em;
            margin: 0 auto 15px;
        }
        .user-name {
            font-size: 1.2em;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
        }
        .user-email {
            color: #ddd;
            margin-bottom: 10px;
        }
        .user-status {
            color: #bbb;
            font-size: 0.9em;
            margin-bottom: 15px;
        }
        .user-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .btn-promote, .btn-demote {
            padding: 8px 16px;
            border: none;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-promote {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
        }
        .btn-promote:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
        }
        .btn-demote {
            background: linear-gradient(135deg, #f44336, #da190b);
            color: white;
        }
        .btn-demote:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(244, 67, 54, 0.3);
        }
        .btn-add {
            background: linear-gradient(135deg, #2196F3, #0b7dda);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 20px auto;
        }
        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);
        }
        .actions-container {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <h1>Gestion des Utilisateurs</h1>
    <div class="users-grid">
        <?php
        $sql = "SELECT id, nom, prenom, email, is_admin FROM lecteurs";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $initials = strtoupper(substr($row['prenom'], 0, 1) . substr($row['nom'], 0, 1));
                echo '<div class="user-card fade-in">';
                echo '<div class="user-avatar">' . $initials . '</div>';
                echo '<div class="user-name">' . htmlspecialchars($row['prenom'] . ' ' . $row['nom']) . '</div>';
                echo '<div class="user-email">' . htmlspecialchars($row['email']) . '</div>';
                echo '<div class="user-status">' . ($row['is_admin'] ? 'Administrateur' : 'Utilisateur') . '</div>';
                echo '<div class="user-actions">';
                if ($row['is_admin']) {
                    echo '<a href="index.php?page=demote_user&id=' . $row['id'] . '" class="btn-demote" onclick="return confirm(\'Êtes-vous sûr de vouloir rétrograder cet utilisateur ?\')"><i class="fas fa-user-minus"></i> Rétrograder</a>';
                } else {
                    echo '<a href="index.php?page=promote_user&id=' . $row['id'] . '" class="btn-promote" onclick="return confirm(\'Êtes-vous sûr de vouloir promouvoir cet utilisateur ?\')"><i class="fas fa-user-plus"></i> Promouvoir</a>';
                }
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="user-card"><p>Aucun utilisateur trouvé</p></div>';
        }
        ?>
    </div>
    <div class="actions-container">
        <a href="index.php?page=list" class="btn-add">Retour à la Gestion des Livres</a>
    </div>
<?php include 'inc/footer.php'; ?>
</body>
</html>