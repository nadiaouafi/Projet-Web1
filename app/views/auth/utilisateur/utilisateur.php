<?php
$baseUrl = '/Projet_web1/stampee/app/public/';
?>
<?php
require_once __DIR__ . '/../../../../config/Database.php'; // chemin relatif vers ta classe Database
use Stampee\Config\Database;

$pdo = Database::getInstance(); // récupère l'objet PDO

$stmt = $pdo->query("SELECT * FROM utilisateurs");
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Stampee</title>
    <link rel="stylesheet" href="<?= $baseUrl ?>css/style.css">
    <script src="/js/auth.js"></script>
</head>

<body>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            display: inline-block;
            margin: 20px auto;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    </head>

    <body>


        <header>
            <div class="logo">
                <img src="/Projet_web1/stampee/app/public/img/logo_fonce.webp" alt="Logo Stampee">

            </div>

            <?php $baseUrl = '/Projet_web1/stampee/'; ?>
            <nav>
                <ul>
                    <li><a href="<?= $baseUrl ?>app/views/auth/home.php">Accueil</a></li>
                    <li><a href="<?= $baseUrl ?>app/views/auth/enchere.php">Enchères</a></li>
                    <li><a href="<?= $baseUrl ?>app/views/auth/connexion.php">Connexion</a></li>
                </ul>
            </nav>

            <div class="language-selector">
                <select aria-label="langue" name="langue">
                    <option value="en">En</option>
                    <option value="fr" selected>Fr</option>
                </select>
            </div>

        </header>

        <h2>Liste des utilisateurs</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date d'inscription</th>
            </tr>
            <?php if (!empty($utilisateurs)): ?>
                <?php foreach ($utilisateurs as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['idUtilisateurs']) ?></td>
                        <td><?= htmlspecialchars($u['prenom']) ?></td>
                        <td><?= htmlspecialchars($u['nom']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td><?= htmlspecialchars($u['date_inscription']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">Aucun utilisateur trouvé</td>
                </tr>
            <?php endif; ?>

            <a href="home.php?action=home">Retour à l'accueil</a>

    </body>

</html>