<?php
session_start();


$page   = $_GET['page'] ?? null;
$action = $_GET['action'] ?? null;


$pages = [
    'home' => '/app/views/auth/home.php',
    'enchere' => '/app/views/auth/enchere.php',
    'connexion' => '/app/views/auth/connexion.php',
    'ajouter-timbre' => '/app/views/auth/Enchere/ajouter-timbre.php',
];


$actions = [
    'liste-utilisateurs' => '/app/views/auth/utilisateur/utilisateur.php',

];


if ($action && array_key_exists($action, $actions)) {
    require __DIR__ . $actions[$action];
} elseif ($page && array_key_exists($page, $pages)) {
    require __DIR__ . $pages[$page];
} else {

    require __DIR__ . '/app/views/auth/home.php';
}
