<?php
require_once __DIR__ . '/../../../../config/Database.php';

use Stampee\Config\Database;

$pdo = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEnchere = (int)($_POST['idEnchere'] ?? 0);
    $idTimbre  = (int)($_POST['idTimbre'] ?? 0);
    $montant   = (float)($_POST['montant'] ?? 0);

    if ($idEnchere <= 0 || $idTimbre <= 0 || $montant <= 0) {
        die(" Données invalides.");
    }

    // Vérifier que l’enchère existe et est active
    $stmt = $pdo->prepare("
        SELECT e.date_fin, COALESCE(MAX(o.montant), e.prix) AS meilleur_montant
        FROM Enchere e
        LEFT JOIN Offre o ON e.idEnchere = o.enchere_id
        WHERE e.idEnchere = :idEnchere AND e.idTimbre = :idTimbre
        GROUP BY e.idEnchere
    ");
    $stmt->execute(['idEnchere' => $idEnchere, 'idTimbre' => $idTimbre]);
    $enchere = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$enchere) {
        die(" Enchère introuvable.");
    }

    // Vérifier si l'enchère est encore ouverte
    if (strtotime($enchere['date_fin']) < time()) {
        die("Cette enchère est déjà terminée.");
    }

    // Vérifier montant > meilleur montant
    if ($montant <= $enchere['meilleur_montant']) {
        die("Votre offre doit être supérieure à la mise actuelle (" . $enchere['meilleur_montant'] . " $).");
    }

    // Insérer l’offre
    $stmtInsert = $pdo->prepare("
        INSERT INTO Offre (enchere_id, idTimbre, montant, date_offre)
        VALUES (:enchere_id, :idTimbre, :montant, NOW())
    ");
    $stmtInsert->execute([
        'enchere_id' => $idEnchere,
        'idTimbre'   => $idTimbre,
        'montant'    => $montant
    ]);

    // Redirection
    header("Location: enchere.php?success=1");
    exit;
} else {
    die(" Choisi une autre methode.");
}
