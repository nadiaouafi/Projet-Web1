<?php
$baseUrl = '/Projet_web1/stampee/app/public/';
?>

<?php
require_once __DIR__ . '/../../../../config/Database.php';

$pdo = Database::getInstance();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'] ?? '';
    $description = $_POST['description'] ?? '';

    // --- Image principale ---
    if (!empty($_FILES['image_principale']['name'])) {
        $targetDir = __DIR__ . "/../../../public/img/";
        $fileName = basename($_FILES["image_principale"]["name"]);
        $targetFile = $targetDir . $fileName;

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (move_uploaded_file($_FILES["image_principale"]["tmp_name"], $targetFile)) {
            // chemin relatif pour stocker en BD
            $imagePath = "img/" . $fileName;
        } else {
            $message = "Erreur lors de l’upload de l’image principale.";
        }
    }

    // --- Images supplémentaires ---
    $imagesSupp = [];
    if (!empty($_FILES['images_supplementaires']['name'][0])) {
        $targetDirSupp = __DIR__ . "/../../../public/details/";
        if (!is_dir($targetDirSupp)) {
            mkdir($targetDirSupp, 0777, true);
        }

        foreach ($_FILES['images_supplementaires']['name'] as $key => $file) {
            $fileName = basename($file);
            $targetFile = $targetDirSupp . $fileName;

            if (move_uploaded_file($_FILES['images_supplementaires']['tmp_name'][$key], $targetFile)) {
                $imagesSupp[] = "details/" . $fileName;
            }
        }
    }

    $message = "Timbre ajouté avec succès !";
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

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            display: inline-block;
            margin: 20px auto;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
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
                </ul>
            </nav>

            <div class="language-selector">
                <select aria-label="langue" name="langue">
                    <option value="en">En</option>
                    <option value="fr" selected>Fr</option>
                </select>
            </div>

        </header>



        <h2>Ajouter un Timbre</h2>
        <?php if (!empty($_SESSION['success'])): ?>
            <p style="color:green"><?= $_SESSION['success'];
                                    unset($_SESSION['success']); ?></p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label>Nom :</label><br>
            <input type="text" name="nom" required><br><br>

            <label>Année de création :</label><br>
            <input type="number" name="date_creation" min="1800" max="2099"><br><br>

            <label>Couleurs :</label><br>
            <input type="text" name="couleurs"><br><br>

            <label>Pays d'origine :</label><br>
            <input type="text" name="pays_origine"><br><br>

            <label>Image principale :</label><br>
            <input type="file" name="image_principale"><br><br>

            <label>Images supplémentaires :</label><br>
            <input type="file" name="images_supplementaires[]" multiple><br><br>

            <label>État :</label><br>
            <select name="etat" required>
                <option value="Parfaite">Parfaite</option>
                <option value="Excellente">Excellente</option>
                <option value="Bonne">Bonne</option>
                <option value="Moyenne">Moyenne</option>
                <option value="Endommagé">Endommagé</option>
            </select><br><br>

            <label>Tirage :</label><br>
            <input type="number" name="tirage"><br><br>

            <label>Dimensions :</label><br>
            <input type="text" name="dimensions"><br><br>

            <label>prix :</label><br>
            <input type="text" name="prix"><br><br>

            <label>Certifié :</label>
            <input type="checkbox" name="certifie"><br><br>

            <button type="submit">Ajouter</button>
        </form>