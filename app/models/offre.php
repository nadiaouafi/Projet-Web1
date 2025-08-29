<?php
class Offre
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Ajouter une offre (mise) d’un utilisateur
    public function ajouter($enchere_id, $membre_id, $montant)
    {
        $sql = "INSERT INTO Offre (enchere_id, membre_id, montant) 
                VALUES (:enchere_id, :membre_id, :montant)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':enchere_id' => $enchere_id,
            ':membre_id' => $membre_id,
            ':montant' => $montant
        ]);
    }

    // Récupérer toutes les offres pour une enchère
    public function getByEnchere($enchere_id)
    {
        $sql = "SELECT o.*, u.nom, u.prenom
                FROM Offre o
                JOIN utilisateurs u ON o.membre_id = u.idUtilisateurs
                WHERE o.enchere_id = :enchere_id
                ORDER BY o.date_offre DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':enchere_id' => $enchere_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtenir la meilleure offre
    public function getMaxOffre($enchere_id)
    {
        $sql = "SELECT MAX(montant) as max_montant
                FROM Offre
                WHERE enchere_id = :enchere_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':enchere_id' => $enchere_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
