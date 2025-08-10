<?php
class Utilisateur
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function inscrire($pseudo, $email, $mot_de_passe)
    {
        $hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO Utilisateurs (pseudo, email, mot_de_passe) VALUES (?, ?, ?)");
        return $stmt->execute([$pseudo, $email, $hash]);
    }

    public function connecter($email, $mot_de_passe)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $user;
        }
        return false;
    }
}
