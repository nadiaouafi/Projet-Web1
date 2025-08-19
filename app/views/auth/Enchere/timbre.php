<?php
$baseUrl = '/Projet_web1/stampee/app/public/';
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
                <th>Certifié</th>
            </tr>

            <div class="actions">
                <a href="/Projet_web1/stampee/app/views/auth/Enchere/ajouter-timbre.php"> Ajouter un Timbre</a>

            </div>

            <?php if (!empty($timbres) && is_array($timbres)): ?>
                <?php foreach ($timbres as $t): ?>
                    <tr>
                        <td><?= htmlspecialchars($t['id']) ?></td>
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