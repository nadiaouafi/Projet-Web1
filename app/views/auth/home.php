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

<script>
    document.querySelector('.hero-searchbar').addEventListener('submit', function(e) {
        e.preventDefault(); // Empêcher le rechargement

        let keyword = this.querySelector('input[name="filtres[recherche]"]').value;

        fetch(`index.php?action=rechercher&q=${encodeURIComponent(keyword)}`)
            .then(res => res.json())
            .then(data => {
                let html = '';
                if (data.length === 0) {
                    html = "<p>Aucun timbre trouvé.</p>";
                } else {
                    data.forEach(timbre => {
                        html += `
                    <article class="carte">
                      <img src="app/public/img/${timbre.image_principale}" alt="${timbre.nom}">
                      <h3>${timbre.nom}</h3>
                      <p>${timbre.pays_origine} - ${timbre.etat}</p>
                      <a href="index.php?action=detail&id=${timbre.idTimbre}">Voir détail</a>
                    </article>
                  `;
                    });
                }
                document.querySelector('#resultats').innerHTML = html;
            })
            .catch(err => {
                console.error("Erreur AJAX :", err);
            });
    });
</script>


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

            </ul>
        </nav>

        <div class="language-selector">
            <select aria-label="langue" name="langue">
                <option value="en">En</option>
                <option value="fr" selected>Fr</option>
            </select>
        </div>


    </header>

    <section class="section-hero">
        <div class="hero"><img src="/Projet_web1/stampee/app/public/img/img_hero.jpg" alt="">


            <div class="hero-text max-width60 min-width50">
                <h1>L'art du timbre. La passion de l’enchère.</h1>
                <p>Découvrez des trésors philatéliques venus du monde entier.</p>


                <form class="hero-searchbar" method="POST" action="catalogue?catalogue=public-actif">
                    <input
                        aria-label="Recherche de timbres"
                        name="filtres[recherche]"
                        placeholder="Recherchez un timbre..."
                        type="search">
                    <button type="submit" aria-label="Lancer la recherche"> 🔍 </button>
                </form>

                <!-- Conteneur pour injecter les résultats -->
                <section id="resultats"></section>
            </div>
        </div>
    </section>

    <main class="contenu-principal">
        <section class="catalogue" aria-live="polite">
            <h1 class="sr-only">Catalogue des enchères</h1>

            <?php
            require_once __DIR__ . '/../../../config/Database.php';
            $pdo = Database::getInstance();
            $pdo = $db->getConnection();
            $stmt = $pdo->query("SELECT idTimbre, nom, description, image_principale, prix FROM timbre");
            $timbres = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php if (!empty($timbres)): ?>
                <?php foreach ($timbres as $t): ?>
                    <article class="carte">
                        <div class="fiche-timbre">
                            <h2><?= htmlspecialchars($t['nom']) ?></h2>
                            <p><strong><?= htmlspecialchars($t['description'] ?? 'Pas de description') ?></strong></p>

                            <img src="/Projet_web1/stampee/app/public/img/<?= htmlspecialchars($t['image_principale']) ?>"
                                alt="<?= htmlspecialchars($t['nom']) ?>">

                            <div class="infos">
                                <p class="prix">Enchère actuelle : <?= htmlspecialchars($t['prix' ?? '0']) ?> $</p>
                            </div>

                            <div class="boutons">
                                <a href="components/encherir.php?id=<?= $t['idTimbre'] ?>" class="btn">Enchérir</a>
                                <a href="app/views/Enchere/detailEnchere.php?id=<?= $t['idTimbre'] ?>" class="btn">Détails</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune enchère disponible pour le moment.</p>
            <?php endif; ?>
        </section>





    </main>

    </section>
    <section class="apropos">

        <picture><img src="/Projet_web1/stampee/app/public/img/lord-stampee.webp" alt="Lord Stampee"></picture>

        <h2 class="description">Apropos du lord Stampee ?</h2>
        <p>Lord Stampee vient d’une famille de passionnés de philatélie depuis des générations. Sa passion pour les timbres rares et précieux l'a amené à rassembler l'une des collections les plus impressionnantes du monde.</p>
        <p>Ses collections de timbres ont été les plus complètes connues pour l'époque classique (timbres émis avant 1900), avec une passion pour les émissions d'avant 1870. Elles ont notamment concerné les provinces canadiennes et la Confédération du Canada, la Suisse, la colonie du Cap, Ceylan, le Gambie, Maurice, l'Argentine et l'Uruguay. Pour l'histoire postale des États-Unis, sa collection est une référence pour les affranchissements dans l'Ouest du pays.</p>
        <a href="#">En savoir plus sur Lord Stampee et ses collections<i class="fa-solid fa-arrow-right"></i>
        </a>
        </div>
        </div>
    </section>

    <section class="coup-de-coeur">
        <h2>Le coup de cœur de Lord Stampee</h2>
        <div class="container">
            <?php
            require_once __DIR__ . '/../../../config/Database.php';
            $db = new Database();
            $pdo = $db->getConnection();


            // Coup de cœur
            $stmtCdc = $pdo->query("SELECT idTimbre, nom, image_principale, prix FROM timbre WHERE coup_de_coeur = 1");
            $coupsDeCoeur = $stmtCdc->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php if (!empty($coupsDeCoeur)): ?>
                <?php foreach ($coupsDeCoeur as $cdc): ?>
                    <article class="carte">
                        <div class="fiche-timbre">
                            <h2><?= htmlspecialchars($cdc['nom']) ?></h2>
                            <img src="/Projet_web1/stampee/app/public/img/<?= htmlspecialchars($cdc['image_principale']) ?>"
                                alt="<?= htmlspecialchars($cdc['nom']) ?>">

                            <div class="infos">
                                <p class="prix">Enchère actuelle : <?= htmlspecialchars($cdc['prix']) ?> $</p>
                            </div>

                            <div class="boutons">
                                <a href="components/encherir.php?id=<?= $cdc['idTimbre'] ?>" class="btn">Enchérir</a>
                                <a href="components/detail.php?id=<?= $cdc['idTimbre'] ?>" class="btn">Détails</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun coup de cœur pour le moment.</p>
            <?php endif; ?>
        </div>
    </section>










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