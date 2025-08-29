<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/timbre.php';

class HomeController
{
    public function index()
    {
        $db = new Database();
        $pdo = $db->getConnection();

        // Récupère tous les timbres
        $stmt = $pdo->query("SELECT idTimbre, nom, description, image_principale, prix FROM timbre");
        $timbres = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Récupère uniquement les coups de cœur
        $stmtCdc = $pdo->query("SELECT idTimbre, nom, image_principale, prix FROM timbre WHERE coup_de_coeur = 1");
        $coupsDeCoeur = $stmtCdc->fetchAll(PDO::FETCH_ASSOC);

        // Passe les données à la vue
        require __DIR__ . '/../views/auth/home.php';
    }
}
