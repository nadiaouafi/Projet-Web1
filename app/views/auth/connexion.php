<?php
$baseUrl = '/Projet_web1/stampee/app/public/';
?>

<?php
session_start();
require_once __DIR__ . '/../../../config/Database.php';

use Stampee\Config\Database;

$erreurs = [];

$pdo = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $utilisateurs = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateurs && password_verify($password, $utilisateurs['mot_de_passe'])) {

            $_SESSION['utilisateurs_id'] = $utilisateurs['id'];
            $_SESSION['nom'] = $utilisateurs['nom'];

            header("Location: enchere.php");
            exit;
        } else {
            $erreurs[] = "Email ou mot de passe incorrect.";
        }
    } catch (Exception $e) {
        $erreurs[] = "Erreur serveur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Stampee</title>
    <link rel="stylesheet" href="<?= $baseUrl ?>css/style.css">
    <script src="/js/auth.js"></script>
</head>

<body>
    <header>
        <div class="logo">
            <img src="/Projet_web1/stampee/app/public/img/logo_fonce.webp" alt="Logo Stampee">

        </div>

        <?php $baseUrl = '/Projet_web1/stampee/'; ?>
        <nav>
            <ul>
                <li><a href="<?= $baseUrl ?>app/views/auth/home.php">Accueil</a></li>
                <li><a href="<?= $baseUrl ?>app/views/auth/enchere.php">Enchères</a></li>
                <li><a href="<?= $baseUrl ?>app/views/auth/connexion.php">Connexion</a></li>
                <li><a href="index.php?action=liste-utilisateurs">liste des utilisateurs</a></li>
            </ul>
        </nav>


        <div class="language-selector">
            <select aria-label="langue" name="langue">
                <option value="en">En</option>
                <option value="fr" selected>Fr</option>
            </select>
        </div>

    </header>

    <?php if (!empty($erreurs)): ?>
        <ul style="color:red;">
            <?php foreach ($erreurs as $e) echo "<li>$e</li>"; ?>
        </ul>
    <?php endif; ?>

    <main class="form-container">
        <h1>Connexion</h1>
        <form id="formConnexion" class="validation" action="connexion.php" method="POST">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="Votre e-mail" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>

            <button type="submit" class="boutons">Se connecter</button>
            <p class="form-link">Pas encore de compte ? <a href="inscription.php">Inscrivez-vous</a></p>
        </form>
    </main>

    <footer class="footer-stampee">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="/Projet_web1/stampee/app/public/img/logo_clair.webp" alt="Logo Stampee">

            </div>


            <div class="footer-col">
                <h3>FAQ</h3>
                <ul>
                    <li><a href="#">Comment créer son compte ?</a></li>
                    <li><a href="#">Comment placer une offre ?</a></li>
                    <li><a href="#">Comment créer une enchère ?</a></li>
                    <li><a href="#">Comment trouver une enchère ?</a></li>
                    <li><a href="#">Comment suivre une enchère ?</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Mon compte</h3>
                <ul>
                    <li><a href="#">Inscription</a></li>
                    <li><a href="#">Connexion</a></li>
                    <li><a href="#">Protection des données</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Contact</h3>
                <ul>
                    <li><a href="#">Qui sommes-nous ?</a></li>
                    <li><a href="#">S'inscrire à notre infolettre</a></li>
                    <li><a href="#">Nous contacter</a></li>
                    <li><a href="#">Termes et conditions</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 Stampee </p>
        </div>
    </footer>
</body>

</html>