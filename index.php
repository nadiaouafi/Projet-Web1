<?php
session_start();

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/app/Controllers/authController.php';
require_once __DIR__ . '/app/Controllers/UtilisateurController.php';
require_once __DIR__ . '/app/models/Utilisateur.php';
require_once __DIR__ . '/app/Controllers/EnchereController.php';
require_once __DIR__ . '/app/Controllers/timbreController.php';


// Connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=stampee;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Instanciation du modèle
$utilisateurModel = new Utilisateur($pdo);


// Instanciation des contrôleurs
$authController = new AuthController($utilisateurModel);
$utilisateurController = new UtilisateurController($pdo);
$controller = new TimbreController();
$enchereController = new EnchereController($pdo);

// Récupération de l'action
$action = $_GET['action'] ?? 'home';


switch ($action) {
    case 'liste-utilisateurs':
        $utilisateurController->index(); // AfficheR la liste des utilisateurs
        break;

    case 'connexion':
        $utilisateurController->afficherConnexion(); // Formulaire de connexion
        break;

    case 'inscription':
        $utilisateurController->afficherInscription(); // Formulaire d'inscription
        break;


    case 'home':
        require __DIR__ . '/app/views/auth/home.php';
        break;

        $action = $_GET['action'] ?? 'utilisateurs';

        if ($action === 'utilisateurs') {
            $controller->index();
        } elseif ($action === 'inscription') {
            $controller->inscription();
        }

    default:
        http_response_code(404);
        echo "<h1>Page non trouvée</h1>";
        echo "<a href='?action=home'>Retour à l'accueil</a>";
        break;
}


$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'ajouter':
        $controller = new timbreController();
        $controller->ajouter();
        break;
    default:
        echo "";
        break;
}



if (isset($_GET['route'])) {
    $route = $_GET['route'];
    switch ($route) {
        case 'ajouter-timbre':
            require __DIR__ . '/app/views/auth/Enchere/ajouter-timbre.php';
            break;
        case 'liste-timbres':
            require __DIR__ . '/app/views/auth/Enchere/timbre.php';
            break;
        case 'accueil':
        default:
            require __DIR__ . '/app/views/auth/home.php';
            break;
    }
}
