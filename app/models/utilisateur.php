<?php
class Utilisateur
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function inscrire($prenom, $nom, $email, $mot_de_passe)
    {
        // Hachage du mot de passe
        $hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (:pseudo, :email, :mot_de_passe)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mot_de_passe' => $hash
        ]);
    }

    public function connecter($email, $mot_de_passe)
    {
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $user;
        }
        return false;
    }

    public function getAll()
    {
        $sql = "SELECT id, prenom, nom, email, date_creation FROM utilisateurs";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
