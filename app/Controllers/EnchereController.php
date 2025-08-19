<?php
require_once __DIR__ . '/../models/timbre.php';

class EnchereController
{
    private $enchere;
    private $pdo;



    public function __construct($pdo)
    {


        $this->pdo = $pdo;
        if (session_status() === PHP_SESSION_NONE) session_start();
    }


    public function index()
    {
        session_start();
        if (!isset($_SESSION['membre_id'])) {
            header('Location: /connexion');
            exit;
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM Enchere WHERE archivee = 0");
        $enchere = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $membre_id = $_SESSION['membre_id'];
        $stmt2 = $pdo->prepare("SELECT * FROM Membre WHERE id = :id");
        $stmt2->execute(['id' => $membre_id]);
        $profil = $stmt2->fetch(PDO::FETCH_ASSOC);

        require '../app/views/auth/home.php';
    }

    public function ajouter()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $date_creation = $_POST['date_creation'] ?? null;
            $couleurs = $_POST['couleurs'] ?? '';
            $pays_origine = $_POST['pays_origine'] ?? '';
            $image_principale = $_POST['image_principale'];
            $images_supplementaires = $_POST['images_supplementaires'];
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

            // Ajouter le timbre dans la base
            $this->enchere->ajouter(
                $nom,
                $date_creation,
                $couleurs,
                $pays_origine,
                $image_principale,
                $images_supplementaires,
                $etat,
                $tirage,
                $dimensions,
                $certifie
            );

            header("Location: /Projet_web1/stampee/index.php?action=listeEncheres");
            exit();
        }

        require __DIR__ . '/../views/auth/Enchere/ajouter-timbre.php';
    }

    public function listeTimbres()
    {
        $stmt = $this->pdo->query("SELECT * FROM Timbre");
        $timbres = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/auth/Enchere/timbre.php';
    }

    public function details($id)
    {
        $timbre = $this->enchere->getById($id);
        if (!$timbre) {
            echo "Timbre introuvable.";
            exit;
        }
        require __DIR__ . '/../views/encheres/details.php';
    }
}
