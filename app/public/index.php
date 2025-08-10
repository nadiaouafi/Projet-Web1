<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Controllers/authController.php';

$action = $_GET['action'] ?? 'connexion';

$controller = new AuthController($pdo);

if ($action === 'inscription') {
    $controller->inscription();
} else {
    $controller->connexion();
}
