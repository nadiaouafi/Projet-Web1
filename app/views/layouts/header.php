<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Catalogue des Enchères - Stampee</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <div class="logo">
            <img src="../img/logo_fonce.webp" alt="Logo Stampee">

        </div>

        <nav>
            <ul>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="enchere.html">Enchères</a></li>
                <li><a href="connexion.html">Connexion</a></li>
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
            <img src="img/img_hero.jpg" alt="Timbres anciens sur fond vintage">

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