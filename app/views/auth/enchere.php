<?php
$baseUrl = '/Projet_web1/stampee/app/public/';
?>
<?php
require_once __DIR__ . '/../../../config/Database.php';

use Stampee\Config\Database;

$pdo = Database::getInstance();

$query = $pdo->query("SELECT * FROM timbre");
$timbres = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->query("SELECT * FROM timbre ORDER BY RAND() LIMIT 4");
$coupsDeCoeur = $query->fetchAll(PDO::FETCH_ASSOC);

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
            <img src="/Projet_web1/stampee/app/public//img/logo_fonce.webp" alt="Logo Stampee">

        </div>

        <?php $baseUrl = '/Projet_web1/stampee/'; ?>
        <nav>
            <ul>
                <li><a href="<?= $baseUrl ?>app/views/auth/index.php">Accueil</a></li>
                <li><a href="<?= $baseUrl ?>app/views/auth/enchere.php">Enchères</a></li>
                <li><a href="<?= $baseUrl ?>app/views/auth/connexion.php">Connexion</a></li>
                <li><a href="index.php?page=ajouter-timbre">Ajouter un timbre</a></li>
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
        <div class="hero">
            <img src="/Projet_web1/stampee/app/public/img/img_hero.jpg" alt="Timbres anciens sur fond vintage">

            <div class="hero-text max-width60 min-width50">
                <h1>L'art du timbre. La passion de l’enchère.</h1>
                <p>Découvrez des trésors philatéliques venus du monde entier.</p>


                <form class="hero-searchbar" method="POST" action="catalogue?catalogue=public-actif">
                    <input
                        aria-label="Recherche de timbres"
                        name="filtres[recherche]"
                        placeholder="Recherchez un timbre..."
                        type="search">
                    <button type="submit" aria-label="Lancer la recherche">
                        <svg role="img" class="svg-icon search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.9 19.7">
                            <title>Icône de loupe</title>
                            <desc>Icône représentant une loupe pour effectuer une recherche</desc>
                            <g class="search-path" fill="none" stroke="#000" stroke-width="2px">
                                <path stroke-linecap="square" d="M18.5 18.3l-5.4-5.4" />
                                <circle cx="8" cy="8" r="7" />
                            </g>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>





    <main class="contenu-principal">




        <aside class="filtres">
            <h2>Filtres</h2>

            <form id="formFiltres">

                <!-- Filtrer par pays -->
                <label for="filtrePays">Pays :</label>
                <select id="filtrePays" name="pays">
                    <option value="">-- Tous les pays --</option>
                    <option value="Royaume-Uni">Royaume-Uni</option>
                    <option value="Etats-Unis">États-Unis</option>
                    <option value="France">France</option>
                    <option value="Australie">Australie</option>
                    <option value="Belgique">Belgique</option>
                    <option value="Canada">Canada</option>
                    <option value="Maurice">Île Maurice</option>
                    <option value="Autres">Autres</option>
                </select>

                <!-- Filtrer par année -->
                <label for="filtreAnnee">Année :</label>
                <select id="filtreAnnee" name="annee">
                    <option value="">-- Choisir une année --</option>
                    <option value="avant1900">Avant 1900</option>
                    <option value="1900-1950">1900 - 1950</option>
                    <option value="1950-2000">1950 - 2000</option>
                    <option value="apres2000">Après 2000</option>
                </select>

                <!-- Filtrer par prix -->
                <div class="filter-item">

                    <label for="prix" class="filter-name">Prix</label>
                    <div class="filter-content filter-price-wrapper">
                        <div class="filter-price-field">
                            <span>Min</span>
                            <input type="number" class="input-min" name="prix_min" aria-label="prix minimum" placeholder="0">
                        </div>
                        <div class="filter-price-field">
                            <span>Max</span>
                            <input type="number" class="input-max" name="prix_max" aria-label="prix maximum" placeholder="1000">
                        </div>
                    </div>
                </div>

                <!-- Filtrer par couleur -->
                <div class="filter-item">

                    <label for="couleur" class="filter-name">Couleur dominante</label>
                    <div class="filter-content">
                        <select name="couleur" aria-label="Filtres couleur">
                            <option value="">-- Choisir une couleur --</option>
                            <option value="rouge">Rouge</option>
                            <option value="jaune">Jaune</option>
                            <option value="bleu">Bleu</option>
                            <option value="vert">Vert</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                </div>

                <!-- Filtrer par état -->
                <label for="filtreEtat">État :</label>
                <select id="filtreEtat" name="etat">
                    <option value="">-- Tous les états --</option>
                    <option value="neuf">Neuf</option>
                    <option value="bon">Bon</option>
                    <option value="use">Usé</option>
                </select>

                <!-- Certification -->
                <div class="filter-item">

                    <label for="certification" class="filter-name">Certification</label>
                    <div class="filter-content">
                        <select name="certification" aria-label="Filtres certification">
                            <option value="">-- Certification --</option>
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="boutons-filtres">
                    <button type="submit">Appliquer</button>
                    <button type="reset">Réinitialiser</button>
                </div>

            </form>
        </aside>


        <section class="catalogue" aria-live="polite">
            <h1 class="sr-only">Catalogue des enchères</h1>
            <?php
            require_once __DIR__ . '/../../../config/Database.php';



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


    <!-- Section Coup De Coeur -->

    <section class="coup-de-coeur">
        <h2>Le coup de cœur de Lord Stampee</h2>

        <div class="container">


            <?php
            require_once __DIR__ . '/../../../config/Database.php';



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
                <img src="/Projet_web1/stampee/app/public//img/logo_clair.webp" alt="Logo Stampee">

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