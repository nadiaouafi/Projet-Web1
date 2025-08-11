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
            <img src="/Projet_web1/stampee/app/public//img/logo_fonce.webp" alt="Logo Stampee">

        </div>

        <?php $baseUrl = '/Projet_web1/stampee/'; ?>
        <nav>
            <ul>
                <li><a href="<?= $baseUrl ?>app/views/auth/index.php">Accueil</a></li>
                <li><a href="<?= $baseUrl ?>app/views/auth/enchere.php">Enchères</a></li>
                <li><a href="<?= $baseUrl ?>app/views/auth/connexion.php">Connexion</a></li>
            </ul>
        </nav>>

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

            <!-- Canada 1851 -->
            <article class="carte">
                <div class="fiche-timbre">
                    <h2>Canada 1851 – One Penny Red</h2>
                    <p><strong>Timbre classique – Reine Victoria</strong></p>

                    <img src="/Projet_web1/stampee/app/public/img/redpenny.jpg" alt="reine victoria">
                    <div class="infos">

                        <p class="prix">Enchère actuelle : 35 $</p>

                    </div>
                    <div class="boutons">
                        <a href="components/encherir.html" class="btn ">Encherir</a>
                        <a href="components/detailspenny.html" class="btn">Détails</a>

                    </div>
                </div>
            </article>

            <!-- Mauritius Post Office -->
            <article class="carte">
                <div class="fiche-timbre">
                    <h2>Mauritius Post Office 1847</h2>
                    <p><strong>Timbre mythique – Mention « Post Office » originale</strong></p>

                    <img src="/Projet_web1/stampee/app/public/img/Maurice.jpeg" alt="">

                    <div class="infos">

                        <p class="prix">Enchère actuelle : 85$</p>

                    </div>
                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="components/DetailsMauritus.html" class="btn ">Détails</a>

                    </div>

                </div>
            </article>

            <!-- Penny Black -->
            <article class="carte">
                <div class="fiche-timbre">
                    <h2>Penny Black 1840</h2>
                    <p><strong>Premier timbre postal au monde – Un symbole de l’histoire philatélique</strong></p>

                    <img src="/Projet_web1/stampee/app/public/img/Penny_black.jpg" alt="Penny Black">
                    <div class="infos">

                        <p class="prix">Enchère actuelle : 75$</p>

                    </div>
                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>

                        <a href="components/detailsPennyblack.html" class="btn ">Détails</a>

                    </div>

                </div>
            </article>

            <!-- Jenny Inversé -->
            <article class="carte">
                <div class="fiche-timbre">
                    <h2>Inverted Jenny 1918</h2>
                    <p><strong>L’un des plus célèbres timbres à erreur d’impression des États-Unis.</strong></p>

                    <img src="/Projet_web1/stampee/app/public/img/InvertedJenny.jpeg" alt="">
                    <div class="infos">

                        <p class="prix">Enchère actuelle : 35$</p>

                    </div>
                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="components/detailsInvertedJenny.html" class="btn">Détails</a>

                    </div>

                </div>
            </article>

            <!-- Dragon Large 1878 -->
            <article class="carte">
                <div class="fiche-timbre">
                    <h2>Dragon Large 1878</h2>
                    <p><strong>Premier timbre impérial chinois émis sous les Qing</strong></p>

                    <img src="/Projet_web1/stampee/app/public/img/chine.jpg" alt="">
                    <div class="infos">

                        <p class="prix">Enchère actuelle : 92$</p>

                    </div>
                    <div class="boutons">

                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="components/detailsChine.html" class="btn">Détails</a>
                    </div>
                </div>
            </article>


            <!-- Cérès 1870 -->
            <article class="carte">
                <div class="fiche-timbre">
                    <h2>Cérès 1870 – 25 centimes bleu</h2>
                    <p><strong>Réimpression de la série classique après la guerre franco-prussienne</strong></p>

                    <img src="/Projet_web1/stampee/app/public/img/ceres1.jpg" alt="">
                    <div class="infos">

                        <p class="prix">Enchère actuelle : 62$</p>

                    </div>
                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="components/details.Ceres.html" class="btn">Détails</a>

                    </div>

                </div>
            </article>

            <!-- Leopald II --->
            <article class="carte">
                <div class="fiche-timbre">
                    <h2>Belgique 1878 – 5F Brun Rouge, Léopold II</h2>
                    <p><strong>Avec certificat du Kaiser – OBP/COB 37</strong></p>

                    <img src="/Projet_web1/stampee/app/public/img/leopoldII.jpg" alt="Timbre Léopold II 1878">

                    <div class="infos">

                        <p class="prix">Enchère actuelle : 500 $</p>
                    </div>

                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="components/DétailsLéopoldII.html" class="btn">Détails</a>
                    </div>
                </div>
            </article>

            <!-- Umberto I -->
            <article class="carte">
                <div class="fiche-timbre">
                    <h2>Italie 1879 – 25c Umberto I</h2>
                    <p><strong>MN**H – Centrage parfait – Certificat Caffaz</strong></p>

                    <img src="/Projet_web1/stampee/app/public/img/Italie.jpg" alt="Timbre Italie Umberto I 25c 1879">

                    <div class="infos">

                        <p class="prix">Enchère actuelle : 800 $</p>
                    </div>

                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="components/detailsItalie.html" class="btn">Détails</a>
                    </div>
                </div>
            </article>

            <!-- Reine Elisabeth II -->
            <article class="carte">
                <div class="fiche-timbre">
                    <h2>Reine Elisabeth II 3d de 1955</h2>
                    <p><strong>Royaume-Uni 00291a reine Elisabeth II 3d de 1955</strong></p>

                    <img src="/Projet_web1/stampee/app/public/img/reine-elisabeth II.webp" alt="">
                    <div class="infos">

                        <p class="prix">Enchère actuelle : 70$</p>

                    </div>
                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="components/details.Ceres.html" class="btn">Détails</a>

                    </div>

                </div>
            </article>


            <!-- Pays-Bas -->
            <article class="carte">
                <div class="fiche-timbre">
                    <h2>Pays-Bas 1927 – NVPH R32</h2>
                    <p><strong>Roue à trois fentes à quatre côtés</strong></p>

                    <img src="/Projet_web1/stampee/app/public/img/paysbas.jpg" alt="Pays-Bas 1927 NVPH R32">

                    <div class="infos">

                        <p class="prix">Enchère actuelle : 250 $</p>
                    </div>

                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="components/Detailspaysbas.html" class="btn">Détails</a>
                    </div>
                </div>
            </article>


            <!-- Hôtel de ville -->
            <article class="carte">
                <div class="fiche-timbre">
                    <h2>Timbre Hôtel de ville</h2>
                    <p><strong>Timbre Hôtel de ville de Termonde renversé</strong></p>

                    <img src="/Projet_web1/stampee/app/public/img/hotel_de_ville.jpg" alt="">

                    <div class="infos">

                        <p class="prix">Enchère actuelle : 250 $</p>
                    </div>

                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="components/Detailspaysbas.html" class="btn">Détails</a>
                    </div>
                </div>
            </article>

            <!-- Pays-Bas -->
            <article class="carte">
                <div class="fiche-timbre">
                    <h2>Belgique 1861 </h2>
                    <p><strong>Belgique 1861 - Leopold I - Médaillon 10</strong></p>

                    <img src="/Projet_web1/stampee/app/public/img/Belgique_1849.jpg" alt="">

                    <div class="infos">

                        <p class="prix">Enchère actuelle : 250 $</p>
                    </div>

                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="components/Detailspaysbas.html" class="btn">Détails</a>
                    </div>
                </div>
            </article>


    </main>


    <!-- Section Coup De Coeur -->

    <section class="coup-de-coeur">
        <h2>Le coup de cœur de Lord Stampee</h2>

        <div class="container">


            <article class="carte">
                <div class="fiche-timbre">
                    <h2>CHYPRE 1880-1910 SELECTION</h2>
                    <img src="/Projet_web1/stampee/app/public/img/coupdecoeur1.webp" alt="CHYPRE 1880-1910 SELECTION">

                    <div class="infos">

                        <p class="prix">Enchère actuelle : 50 $</p>
                    </div>

                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="#" class="btn">Détails</a>
                    </div>
                </div>
            </article>




            <article class="carte">
                <div class="fiche-timbre">
                    <h2>CANADA 1852 #4</h2>


                    <img src="/Projet_web1/stampee/app/public/img/coupdecoeur2.webp" alt="CANADA 1852 #4">

                    <div class="infos">

                        <p class="prix">Enchère actuelle : 20 $</p>
                    </div>

                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="#" class="btn">Détails</a>
                    </div>
                </div>
            </article>

            <article class="carte">
                <div class="fiche-timbre">
                    <h2>CHYPRE 1880-1910 SELECTION</h2>

                    <img src="/Projet_web1/stampee/app/public/img/coupdecoeur3.jpg" alt="Pays-Bas 1927 NVPH R32">

                    <div class="infos">

                        <p class="prix">Enchère actuelle : 250 $</p>
                    </div>

                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="#" class="btn">Détails</a>
                    </div>
                </div>
            </article>

            <article class="carte">
                <div class="fiche-timbre">
                    <h2>CANADA #200 -Roi George 1932</h2>


                    <img src="/Projet_web1/stampee/app/public/img/coupdecoeur4.jpg" alt="CANADA #200 -Roi George 1932">

                    <div class="infos">

                        <p class="prix">Enchère actuelle : 25 $</p>
                    </div>

                    <div class="boutons">
                        <a href="components/encherir.html" class="btn">Enchérir</a>
                        <a href="#" class="btn">Détails</a>
                    </div>
                </div>
            </article>
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