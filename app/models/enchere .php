<?php
require_once __DIR__ . '/path/to/Database.php';
require_once __DIR__ . '/path/to/models/enchere.php';

class Enchere
{
    private PDO $pdo;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Ajouter une enchère sur un timbre existant
    public function ajouter($idTimbre, $idMembre, $montant)
    {
        $sql = "INSERT INTO Enchere (idTimbre, date_enchere)
                VALUES (:idTimbre, :idMembre, :montant, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':idTimbre' => $idTimbre,
            ':idMembre' => $idMembre,
            ':montant'  => $montant
        ]);
    }

    // Récupérer toutes les enchères
    public function getAll()
    {
        $sql = "SELECT e.*, t.nom AS timbre_nom, m.nom AS membre_nom
                FROM Enchere e
                JOIN Timbre t ON e.idTimbre = t.idTimbre
                JOIN Membre m ON e.idMembre = m.idMembre
                ORDER BY e.date_enchere DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer toutes les enchères d’un timbre
    public function getEncheresByTimbre($idTimbre)
    {
        $sql = "SELECT e.*, m.nom AS membre_nom
                FROM Enchere e
                JOIN Membre m ON e.idMembre = m.idMembre
                WHERE e.idTimbre = :idTimbre
                ORDER BY e.date_enchere DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':idTimbre' => $idTimbre]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer la meilleure enchère pour un timbre
    public function getMaxEnchere($idTimbre)
    {
        $sql = "SELECT MAX(montant) as max_montant 
                FROM Enchere 
                WHERE idTimbre = :idTimbre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':idTimbre' => $idTimbre]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getCoupsDeCoeur($limit = 4)
    {
        $sql = "SELECT * FROM Timbre ORDER BY RAND() LIMIT :limit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
