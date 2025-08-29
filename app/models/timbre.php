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
            (nom, date_creation, couleurs, pays_origine, image_principale, images_supplementaires, etat, tirage, dimensions, certifie, prix, coup_de_coeur)
            VALUES (:nom, :date_creation, :couleurs, :pays_origine, :image_principale, :images_supplementaires, :etat, :tirage, :dimensions, :certifie, :prix, :coup_de_coeur)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nom' => $data['nom'],
            ':date_creation' => $data['date_creation'],
            ':couleurs' => $data['couleurs'],
            ':pays_origine' => $data['pays_origine'],
            ':image_principale' => $data['image_principale'],
            ':images_supplementaires' => $data['images_supplementaires'] ?? null,
            ':etat' => $data['etat'],
            ':tirage' => $data['tirage'],
            ':dimensions' => $data['dimensions'],
            ':certifie' => $data['certifie'],
            ':prix' => $data['prix'],
            ':coup_de_coeur' => $data['coup_de_coeur'] ?? 0
        ]);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM timbre WHERE idTimbre = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $timbre = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($timbre && !empty($timbre['images_supplementaires'])) {
            $timbre['images_supplementaires'] = json_decode($timbre['images_supplementaires'], true);
        }

        return $timbre;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM timbre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCoupsDeCoeur($limit = 4)
    {
        $sql = "SELECT * FROM timbre WHERE coup_de_coeur = 1 ORDER BY RAND() LIMIT :limit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($keyword)
    {
        $sql = "SELECT * FROM timbre 
            WHERE nom LIKE :keyword 
               OR pays_origine LIKE :keyword 
               OR couleurs LIKE :keyword";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['keyword' => "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchWithFilters($filters = [])
    {
        $sql = "SELECT * FROM timbre WHERE 1=1";
        $params = [];

        // Pays
        if (!empty($filters['pays'])) {
            $sql .= " AND pays_origine = :pays";
            $params['pays'] = $filters['pays'];
        }

        // Année
        if (!empty($filters['annee'])) {
            switch ($filters['annee']) {
                case 'avant1900':
                    $sql .= " AND date_creation < 1900";
                    break;
                case '1900-1950':
                    $sql .= " AND date_creation BETWEEN 1900 AND 1950";
                    break;
                case '1950-2000':
                    $sql .= " AND date_creation BETWEEN 1950 AND 2000";
                    break;
                case 'apres2000':
                    $sql .= " AND date_creation > 2000";
                    break;
            }
        }

        // Prix min / max
        if (!empty($filters['prix_min'])) {
            $sql .= " AND prix >= :prix_min";
            $params['prix_min'] = $filters['prix_min'];
        }
        if (!empty($filters['prix_max'])) {
            $sql .= " AND prix <= :prix_max";
            $params['prix_max'] = $filters['prix_max'];
        }

        // Couleur dominante
        if (!empty($filters['couleur'])) {
            $sql .= " AND couleurs LIKE :couleur";
            $params['couleur'] = "%" . $filters['couleur'] . "%";
        }

        // État
        if (!empty($filters['etat'])) {
            $sql .= " AND etat = :etat";
            $params['etat'] = $filters['etat'];
        }

        // Certification
        if ($filters['certifie'] === 'oui') {
            $sql .= " AND certifie = 1";
        } elseif ($filters['certifie'] === 'non') {
            $sql .= " AND certifie = 0";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
