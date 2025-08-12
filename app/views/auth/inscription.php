<?php
$baseUrl = '/Projet_web1/stampee/app/public/';
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
                <li><a href="<?= $baseUrl ?>app/views/auth/index.php">Accueil</a></li>
                <li><a href="<?= $baseUrl ?>app/views/auth/enchere.php">Enchères</a></li>
                <li><a href="<?= $baseUrl ?>app/views/auth/connexion.php">Connexion</a></li>
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
        <h1>Inscription</h1>
        <form action="register_process.php" method="POST">

            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" required>

            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Votre nom" required>

            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="Votre e-mail" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>

            <label for="confirm-password">Confirmez le mot de passe</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Répétez le mot de passe" required>


            <button type="submit" class="boutons">S'inscrire</button>
            <p class="form-link">Déjà inscrit ? <a href="connexion.php">Connectez-vous</a></p>
        </form>
    </main>
    <footer class="footer-stampee">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="/Projet_web1/stampee/app/public/img/logo_clair.webp" alt="Logo Stampee">

            </div>

            <div class="footer-col">
                <h3>À propos</h3>
                <p>
                    Lord Stampee vient d’une famille de passionnés de philatélie depuis des générations.
                    Sa passion pour les timbres rares et précieux l'a amené à rassembler l'une des collections
                    les plus impressionnantes du monde.
                </p>
                <a href="#">En savoir plus</a>
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