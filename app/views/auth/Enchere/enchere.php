<?php
session_start();
require_once __DIR__ . '/../../../../config/Database.php';

use Stampee\Config\Database;

$pdo = Database::getInstance();

// Récupérer tous les timbres
$stmt = $pdo->query("SELECT * FROM Timbre");
$timbres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Enchères - Stampee</title>
    <link rel="stylesheet" href="/Projet_web1/stampee/app/public/css/style.css">
</head>

<body>
    <header>
        <h1>Enchères de timbres</h1>
        <nav>
            <a href="home.php?action=home">Accueil</a>
            <a href="enchere.php">Enchères</a>
        </nav>
    </header>

    <main>
        <?php if (!empty($timbres)): ?>
            <?php foreach ($timbres as $t): ?>
                <?php
                // Récupérer la mise la plus haute pour ce timbre
                $stmtMax = $pdo->prepare("
                    SELECT MAX(o.montant) AS max_mise
                    FROM Offre o
                     JOIN Enchere e ON o.enchere_id = e.idEnchere
                    WHERE e.timbre_id = :idTimbre
                ");

                $stmtMax->execute(['idTimbre' => $t['idTimbre']]);
                $maxMise = $stmtMax->fetch(PDO::FETCH_ASSOC)['max_mise'] ?? 0;
                ?>
                <article class="timbre">
                    <h2><?= htmlspecialchars($t['nom']) ?></h2>
                    <p><?= htmlspecialchars($t['description'] ?? 'Pas de description') ?></p>
                    <img src="/Projet_web1/stampee/app/public/img/<?= htmlspecialchars($t['image_principale']) ?>" alt="<?= htmlspecialchars($t['nom']) ?>" width="200">
                    <p>Enchère actuelle : <?= $maxMise ?> $</p>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form action="encherir.php" method="POST">
                            <input type="hidden" name="timbre_id" value="<?= $t['id'] ?>">
                            <input type="number" name="montant" step="0.01" placeholder="Votre mise" required>
                            <button type="submit">Enchérir</button>
                        </form>
                    <?php else: ?>
                        <p><em>Connectez-vous pour enchérir.</em></p>
                    <?php endif; ?>
                </article>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun timbre disponible.</p>
        <?php endif; ?>


        <?php foreach ($encheres as $e): ?>
            <div class="carte-enchere">
                <h3><?= htmlspecialchars($e['timbre_nom']) ?></h3>
                <img src="<?= htmlspecialchars($e['image_principale']) ?>" alt="<?= htmlspecialchars($e['timbre_nom']) ?>" width="200">

                <p>Prix de départ : <?= number_format($e['prix_depart'], 2) ?> $</p>
                <p>Meilleure offre : <?= number_format($e['meilleur_montant'], 2) ?> $</p>
                <p>Se termine le : <?= htmlspecialchars($e['date_fin']) ?></p>

                <!-- Bouton pour encherir -->
                <form method="POST" action="encherir.php">
                    <input type="hidden" name="idEnchere" value="<?= $e['enchere_id'] ?>">
                    <input type="hidden" name="idTimbre" value="<?= $e['idTimbre'] ?>">

                    <label for="montant-<?= $e['enchere_id'] ?>">Votre offre :</label>
                    <input type="number" step="0.01" min="<?= $e['meilleur_montant'] + 1 ?>"
                        name="montant" id="montant-<?= $e['enchere_id'] ?>" required>

                    <button type="submit">Enchérir</button>
                </form>
            </div>
        <?php endforeach; ?>




    </main>
</body>

</html>