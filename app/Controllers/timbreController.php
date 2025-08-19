<?php
require_once __DIR__ . '/../../config/config.php';

class TimbreController
{

    public function ajouter()
    {
        session_start();
        if (!isset($_SESSION['membre_id'])) {
            header("Location: /Projet_web1/stampee/app/views/auth/connexion.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $date_creation = $_POST['date_creation'];
            $couleurs = $_POST['couleurs'];
            $pays_origine = $_POST['pays_origine'];
            $etat = $_POST['etat'];
            $tirage = $_POST['tirage'];
            $dimensions = $_POST['dimensions'];
            $certifie = isset($_POST['certifie']) ? 1 : 0;

            // Upload image principale
            $image_principale = null;
            if (!empty($_FILES['image_principale']['name'])) {
                $image_principale = "uploads/" . basename($_FILES['image_principale']['name']);
                move_uploaded_file(
                    $_FILES['image_principale']['tmp_name'],
                    __DIR__ . "/../../public/" . $image_principale
                );
            }

            // Images supplémentaires en JSON
            $images_supplementaires = [];
            if (!empty($_FILES['images_supplementaires']['name'][0])) {
                foreach ($_FILES['images_supplementaires']['name'] as $index => $fileName) {
                    $path = "uploads/" . basename($fileName);
                    move_uploaded_file(
                        $_FILES['images_supplementaires']['tmp_name'][$index],
                        __DIR__ . "/../../public/" . $path
                    );
                    $images_supplementaires[] = $path;
                }
            }

            try {
                $db = new Database();
                $pdo = $db->getConnection();

                $stmt = $pdo->prepare("INSERT INTO Timbre 
                    (nom, date_creation, couleurs, pays_origine, image_principale, images_supplementaires, etat, tirage, dimensions, certifie) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->execute([
                    $nom,
                    $date_creation,
                    $couleurs,
                    $pays_origine,
                    $image_principale,
                    json_encode($images_supplementaires),
                    $etat,
                    $tirage,
                    $dimensions,
                    $certifie
                ]);

                $_SESSION['success'] = "✅ Timbre ajouté avec succès !";
                header("Location: /Projet_web1/stampee/app/views/auth/Enchere/timbre.php");
                exit;
            } catch (PDOException $e) {
                echo "❌ Erreur : " . $e->getMessage();
            }
        }

        // Charger la vue
        require __DIR__ . "/app/views/auth/Enchere/ajouter-timbre.php";
    }
}
