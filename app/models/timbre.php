<?php
class Timbre
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function ajouter($data)
    {
        $sql = "INSERT INTO timbre 
            (nom, date_creation, couleurs, pays_origine, image_principale, images_supplementaires, etat, tirage, dimensions, certifie)
            VALUES (:nom, :date_creation, :couleurs, :pays_origine, :image_principale, :images_supplementaires, :etat, :tirage, :dimensions, :certifie)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nom' => $data['nom'],
            ':date_creation' => $data['date_creation'],
            ':couleurs' => $data['couleurs'],
            ':pays_origine' => $data['pays_origine'],
            ':image_principale' => $data['image_principale'],
            ':images_supplementaires' => $data['images_supplementaires'],
            ':etat' => $data['etat'],
            ':tirage' => $data['tirage'],
            ':dimensions' => $data['dimensions'],
            ':certifie' => $data['certifie']
        ]);
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM timbre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
