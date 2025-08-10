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
            $pseudo = $_POST['pseudo'];
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];

            if ($this->utilisateur->inscrire($pseudo, $email, $mot_de_passe)) {
                header("Location: index.php?action=connexion&inscription=ok");
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
        require __DIR__ . '/../views/auth/inscription.php';
    }

    public function connexion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];

            $user = $this->utilisateur->connecter($email, $mot_de_passe);
            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                header("Location: index.php");
            } else {
                echo "Email ou mot de passe incorrect.";
            }
        }
        require __DIR__ . '/../views/auth/connexion.php';
    }
}
