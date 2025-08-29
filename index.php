<?php
session_start();

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/app/Controllers/authController.php';
require_once __DIR__ . '/app/Controllers/UtilisateurController.php';
require_once __DIR__ . '/app/Controllers/EnchereController.php';
require_once __DIR__ . '/app/Controllers/timbreController.php';
require_once __DIR__ . '/app/models/Utilisateur.php';
require_once __DIR__ . '/app/models/timbre.php';



// Connexion PDO 
$pdo = new PDO('mysql:host=localhost;dbname=stampee;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Instanciation des modèles
$utilisateurModel = new Utilisateur($pdo);

// Instanciation des contrôleurs
$authController        = new AuthController($utilisateurModel);
$utilisateurController = new UtilisateurController($pdo);
$timbreController      = new TimbreController($pdo);
$enchereController     = new EnchereController();
$controller = new EnchereController();

// Récupération de l'action
$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'liste-utilisateurs':
        $utilisateurController->index();
        break;

    case 'connexion':
        $utilisateurController->afficherConnexion();
        break;

    case 'inscription':
        $utilisateurController->afficherInscription();
        break;

    case 'ajouter':
        $timbreController->ajouter();
        break;

    case 'listeTimbres':
        $enchereController->listeTimbres($id);
        break;

    case 'detailEnchere':
        if (isset($_GET['id'])) {
            $enchereController->detail($_GET['id']);
        } else {
            echo "ID manquant";
        }
        break;

    case 'home':
        require __DIR__ . '/app/views/auth/home.php';
        break;

    default:
        http_response_code(404);
        echo "<h1>Page non trouvée</h1>";
        echo "<a href='?action=home'>Retour à l'accueil</a>";
        break;


        $action = $_GET['action'] ?? 'liste';

        if ($action === 'detail' && isset($_GET['id'])) {
            $controller->detail($_GET['id']);
        } else {
            $controller->liste();
        }
}
