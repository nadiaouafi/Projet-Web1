<?php

class EnchereController
{
    private PDO $pdo;
    private $timbreModel;



    public function __construct()
    {


        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {
        if (!isset($_SESSION['membre_id'])) {
            header('Location: /connexion');
            exit;
        }

        $stmt2 = $this->pdo->prepare("SELECT * FROM Membre WHERE id = :id");
        $stmt2->execute(['id' => $_SESSION['membre_id']]);
        $profil = $stmt2->fetch(PDO::FETCH_ASSOC);

        $coupsDeCoeur = $this->timbreModel->getCoupsDeCoeur(4);

        require __DIR__ . '/../views/auth/home.php';
    }

    public function ajouter()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $date_creation = $_POST['date_creation'] ?? null;
            $couleurs = $_POST['couleurs'] ?? '';
            $pays_origine = $_POST['pays_origine'] ?? '';
            $etat = $_POST['etat'] ?? '';
            $tirage = $_POST['tirage'] ?? null;
            $dimensions = $_POST['dimensions'] ?? '';
            $certifie = isset($_POST['certifie']) ? 1 : 0;

            // --- Image principale ---
            $image_principale = $_FILES['image_principale']['name'];
            $tmp_name = $_FILES['image_principale']['tmp_name'];
            move_uploaded_file($tmp_name, __DIR__ . '/../public/img/' . $image_principale);

            // --- Images supplémentaires ---
            $images_supplementaires = [];
            if (!empty($_FILES['images_supplementaires']['name'][0])) {
                foreach ($_FILES['images_supplementaires']['name'] as $key => $imgName) {
                    $tmp = $_FILES['images_supplementaires']['tmp_name'][$key];
                    move_uploaded_file($tmp, __DIR__ . '/../public/details/' . $imgName);
                    $images_supplementaires[] = $imgName;
                }
            }

            // Sauvegarde via le modèle
            $this->timbreModel->ajouter(
                $nom,
                $date_creation,
                $couleurs,
                $pays_origine,
                $image_principale,
                json_encode($images_supplementaires),
                $etat,
                $tirage,
                $dimensions,
                $certifie
            );

            header("Location: /Projet_web1/stampee/index.php?action=listeTimbres");
            exit();
        }

        require __DIR__ . '/../views/auth/Enchere/ajouter-timbre.php';
    }

    public function listeTimbres($id)

    {
        $timbres = $this->timbreModel->getAll();

        require __DIR__ . '/../views/auth/Enchere/timbre.php';
    }

    public function detail($id)
    {
        $timbre = $this->timbreModel->getById($id);

        if (!$timbre) {
            echo "Timbre introuvable avec l’ID $id.";
            return;
        }

        require __DIR__ . "/../views/auth/Enchere/detailEnchere.php";
    }


    public function coupsDeCoeur()
    {
        $timbre = $this->timbreModel->getCoupsDeCoeur(4);
        require __DIR__ . '/../views/auth/home.php';
    }


    public function catalogue()
    {
        $filters = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filters['pays']       = $_POST['pays'] ?? '';
            $filters['annee']      = $_POST['annee'] ?? '';
            $filters['prix_min']   = $_POST['prix_min'] ?? '';
            $filters['prix_max']   = $_POST['prix_max'] ?? '';
            $filters['couleur']    = $_POST['couleur'] ?? '';
            $filters['etat']       = $_POST['etat'] ?? '';
            $filters['certifie']   = $_POST['certification'] ?? '';
        }

        $timbres = $this->timbreModel->searchWithFilters($filters);

        require __DIR__ . '/../views/auth/Enchere/enchere.php';
    }
}
