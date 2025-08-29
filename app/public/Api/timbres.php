<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../app/Controllers/apitimbreController.php';

$pdo = new PDO("mysql:host=localhost;dbname=stampee;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$controller = new ApiTimbreController($pdo);

// Si ?id= existe → un seul timbre
if (isset($_GET['id'])) {
    $controller->getTimbre($_GET['id']);
} else {
    $controller->getTimbres();
}
