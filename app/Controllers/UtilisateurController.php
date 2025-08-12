<?php
require_once __DIR__ . '/../views/auth/connexion.php';
require_once __DIR__ . '/../models/Utilisateur.php';
require_once __DIR__ . '/../views//auth/utilisateur/utilisateur.php';


class UtilisateurController
{
    private $utilisateur;

    public function __construct($pdo)
    {
        $this->utilisateur = new Utilisateur($pdo);
    }

    public function afficherConnexion()
    {
        require_once __DIR__ . '/../views/auth/connexion.php';
    }

    public function afficherInscription()
    {
        require_once __DIR__ . '/../views/auth/inscription.php';
    }




    public function afficherUtilisateurs()
    {
        require_once __DIR__ . '/../Models/Utilisateur.php';
        $model = new Utilisateur($this->utilisateur);
        $utilisateurs = $model->getAll(); // On récupère la liste
        require __DIR__ . '/../../views/utilisateur/utilisateur.php'; // On affiche la vue
    }
}
