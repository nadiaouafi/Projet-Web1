<?php
class Enchere
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function ajouter($nom, $date_creation, $couleurs, $pays_origine, $image_principale, $images_supplementaires, $etat, $tirage, $dimensions, $certifie)
    {
        $sql = "INSERT INTO Timbre 
            (nom, date_creation, couleurs, pays_origine, image_principale, images_supplementaires, etat, tirage, dimensions, certifie)
            VALUES (:nom, :date_creation, :couleurs, :pays_origine, :image_principale, :images_supplementaires, :etat, :tirage, :dimensions, :certifie)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nom' => $nom,
            ':date_creation' => $date_creation,
            ':couleurs' => $couleurs,
            ':pays_origine' => $pays_origine,
            ':image_principale' => $image_principale,
            ':images_supplementaires' => json_encode($images_supplementaires),
            ':etat' => $etat,
            ':tirage' => $tirage,
            ':dimensions' => $dimensions,
            ':certifie' => $certifie
        ]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Timbre ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM Timbre WHERE id = :id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $timbre = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($timbre) {
            // Convertir JSON des images supplémentaires en tableau
            $timbre['images_supplementaires'] = json_decode($timbre['images_supplementaires'], true) ?: [];
        }
        return $timbre;
    }
}
