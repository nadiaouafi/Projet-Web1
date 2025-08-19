<?php
class AuthController
{
    private $utilisateur;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/Utilisateur.php';
        $this->utilisateur = new Utilisateur($pdo);
    }

    public function inscription()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // hachage

            if ($this->utilisateur->inscrire($prenom, $nom, $email, $mot_de_passe)) {
                header("Location: /Projet_web1/stampee/index.php?action=connexion&inscription=ok");
                exit();
            } else {
                echo "Erreur lors de l'inscription (email déjà utilisé ?).";
            }
        }
        require __DIR__ . '/../views/auth/inscription.php';
    }

    public function connexion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];

            // Connexion à la base de données
            $pdo = Database::getInstance();

            $stmt = $pdo->prepare("SELECT * FROM Membre WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $membre = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($membre && password_verify($mot_de_passe, $membre['mot_de_passe'])) {
                session_start();
                $_SESSION['membre_id'] = $membre['id'];
                $_SESSION['pseudo'] = $membre['pseudo'];

                // Redirection vers la page des enchères
                header('Location: /encheres');
                exit;
            } else {
                $error = "Email ou mot de passe incorrect";
                require '../app/views/auth/connexion.php';
            }
        } else {
            require '../app/views/auth/connexion.php';
        }
    }
}
