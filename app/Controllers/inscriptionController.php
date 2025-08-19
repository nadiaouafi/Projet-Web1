<?php
session_start();
require_once __DIR__ . '/../models/Utilisateur.php';

// Connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=stampee;charset=utf8', 'root', '');

// Récupérer les données du formulaire
$prenom = $_POST['prenom'] ?? '';
$nom = $_POST['nom'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm-password'] ?? '';

$errors = [];

// Vérification mot de passe
if ($password !== $confirm) {
    $errors[] = "Les mots de passe ne correspondent pas.";
}

if (empty($errors)) {
    $utilisateur = new Utilisateur($pdo);
    $success = $utilisateur->inscrire($prenom, $nom, $email, $password);

    if ($success) {
        $_SESSION['message'] = "Inscription réussie !";
        header("Location: ../../home.php"); // retour à la page d'accueil
        exit();
    } else {
        $errors[] = "Erreur lors de l'inscription, email déjà utilisé ?";
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: inscription.php"); // retour au formulaire
    exit();
}
