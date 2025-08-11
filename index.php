<?php
session_start();

require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Models/Utilisateur.php';


$pdo = new PDO('mysql:host=localhost;dbname=stampee;charset=utf8', 'root', '');

$authController = new AuthController($pdo);


$action = $_GET['action'] ?? 'connexion';

switch ($action) {
    case 'inscription':
        $authController->inscription();
        break;
    case 'connexion':
        $authController->connexion();
        break;
    case 'deconnexion':
        session_destroy();
        header('Location: index.php?action=connexion');
        exit();
    default:
        echo "Page non trouvée";
        break;
}
