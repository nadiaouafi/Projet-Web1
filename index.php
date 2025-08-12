<?php
session_start();

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Controllers/UtilisateurController.php';
require_once __DIR__ . '/../app/Models/Utilisateur.php';

// Connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=stampee;charset=utf8', 'root', '');

// Instanciation du modèle
$utilisateurModel = new Utilisateur($pdo);

// Instanciation des contrôleurs
$authController = new AuthController($utilisateurModel);
$utilisateurController = new UtilisateurController($pdo);

// Gestion des paramètres
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/inscription' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller->afficherInscription();
} elseif ($uri === '/inscription' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->inscription();
} elseif ($uri === '/connexion' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller->afficherConnexion();
} elseif ($uri === '/connexion' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->connexion();
} elseif ($uri === '/profil') {
    $controller->profil();
} elseif ($uri === '/deconnexion') {
    $controller->deconnexion();
} else {
    http_response_code(404);
    echo "Page non trouvée";
}
