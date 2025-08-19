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

        $sql = "INSERT INTO utilisateurs (prenom, nom, email, mot_de_passe, date_inscription ) 
            VALUES (:prenom, :nom, :email, :mot_de_passe, NOW())";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':prenom' => $prenom,
            ':nom' => $nom,
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
        $stmt = $this->pdo->query(
            "SELECT idUtilisateurs, prenom, nom, email, date_inscription FROM utilisateurs"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
