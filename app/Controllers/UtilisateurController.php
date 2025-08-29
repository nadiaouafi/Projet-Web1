<?php

require_once __DIR__ . '/../models/Utilisateur.php';

class UtilisateurController
{
    private $utilisateur;

    public function __construct($pdo)
    {
        $this->utilisateur = new Utilisateur($pdo);
    }

    // Affiche tous les utilisateurs
    public function index()
    {
        $utilisateurs = $this->utilisateur->getAll(); // récupère tous les utilisateurs
        require __DIR__ . '/../views/auth/utilisateur/utilisateur.php';
    }


    // Gère l’inscription
    public function inscription()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];

            if ($this->utilisateur->inscrire($prenom, $nom, $email, $mot_de_passe)) {
                header("Location: index.php?action=utilisateurs"); // après inscription → liste
                exit();
            } else {
                echo "Erreur lors de l'inscription.";
            }
        } else {
            include 'app/views/auth/inscription.php';
        }
    }

    // Affiche le formulaire de connexion
    public function afficherConnexion()
    {
        require __DIR__ . '/../views/auth/connexion.php';
    }

    // Affiche le formulaire d'inscription
    public function afficherInscription()
    {
        require __DIR__ . '/../views/auth/inscription.php';
    }
}
