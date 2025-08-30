<?php
session_start();
require_once __DIR__ . '/../../../../config/Database.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['idUtilisateur'])) {
    // Redirige vers la page de connexion si pas connecté
    header('Location: /Projet_web1/stampee/app/views/auth/connexion.php');
    exit;
}

use Stampee\Config\Database;

$pdo = Database::getInstance();
$idUtilisateur = $_SESSION['idUtilisateur'];

// Récupère les informations de l'utilisateur
$stmt = $pdo->prepare("SELECT idUtilisateurs, prenom, nom, email, date_inscription, adresse, telephone FROM utilisateurs WHERE idUtilisateurs = :id");
$stmt->execute(['id' => $idUtilisateur]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Stampee</title>
    <link rel="stylesheet" href="/Projet_web1/stampee/app/public/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .profil {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        p {
            font-size: 16px;
            margin: 8px 0;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="profil">
        <?php if ($user): ?>
            <h2>Bienvenue, <?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?></h2>
            <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Date d'inscription :</strong> <?= htmlspecialchars($user['date_inscription']) ?></p>
            <p><strong>Adresse :</strong> <?= htmlspecialchars($user['adresse'] ?? 'Non renseignée') ?></p>
            <p><strong>Téléphone :</strong> <?= htmlspecialchars($user['telephone'] ?? 'Non renseigné') ?></p>

            <a href="home.php?action=home">Retour à l'accueil</a>
        <?php else: ?>
            <p>Aucun profil trouvé.</p>
            <a href="connexion.php">Se connecter</a>
        <?php endif; ?>
    </div>

</body>

</html>