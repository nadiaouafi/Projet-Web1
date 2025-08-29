<?php
$baseUrl = '/Projet_web1/stampee/app/public/';
?>

<?php
require_once __DIR__ . '/../../../../config/Database.php';
require_once __DIR__ . "/../../../models/timbre.php";


$pdo = Database::getInstance();

// Utiliser ton modèle
$timbreModel = new Timbre($pdo);
$timbres = $timbreModel->getAll();
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
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
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

        <div class="actions">
            <a href="/Projet_web1/stampee/app/views/auth/Enchere/ajouter-timbre.php"> Ajouter un Timbre</a>

        </div>

        <h2>Liste des timbres</h2>
        <table border="1" cellpadding="5">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Année</th>
                <th>Couleurs</th>
                <th>Pays</th>
                <th>État</th>
                <th>Tirage</th>
                <th>Dimensions</th>
                <th>Prix</th>
                <th>Certifié</th>
            </tr>

            <?php if (!empty($timbres) && is_array($timbres)): ?>
                <?php foreach ($timbres as $t): ?>
                    <tr>
                        <td><?= htmlspecialchars($t['idTimbre']) ?></td>
                        <td><?= htmlspecialchars($t['nom']) ?></td>
                        <td><?= htmlspecialchars($t['date_creation']) ?></td>
                        <td><?= htmlspecialchars($t['couleurs']) ?></td>
                        <td><?= htmlspecialchars($t['pays_origine']) ?></td>
                        <td><?= htmlspecialchars($t['etat']) ?></td>
                        <td><?= htmlspecialchars($t['tirage']) ?></td>
                        <td><?= htmlspecialchars($t['dimensions']) ?></td>
                        <td><?= htmlspecialchars($t['prix']) ?></td>
                        <td><?= $t['certifie'] ? 'Oui' : 'Non' ?></td>
                    </tr>
                <?php endforeach; ?>

            <?php else: ?>
                <tr>
                    <td colspan="3">Aucun timbre trouvé</td>
                </tr>
            <?php endif; ?>
        </table>

        <div class="actions">

            <a href="/Projet_web1/stampee/app/views/auth/home.php"> Retour à l'accueil</a>
        </div>