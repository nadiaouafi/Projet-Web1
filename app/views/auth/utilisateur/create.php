<?php
header('Content-Type: application/json');


$pdo = new PDO("mysql:host=localhost;dbname=stampee;charset=utf8", "root", "");


$data = json_decode(file_get_contents("php://input"), true);

if (!$data['prenom'] || !$data['nom'] || !$data['email'] || !$data['password']) {
    echo json_encode(["succes" => false, "message" => "Tous les champs sont obligatoires."]);
    exit;
}


$stmt = $pdo->prepare("INSERT INTO utilisateurs (prenom, nom, email, password) VALUES (?, ?, ?, ?)");
$succes = $stmt->execute([
    $data['prenom'],
    $data['nom'],
    $data['email'],
    password_hash($data['password'], PASSWORD_DEFAULT)
]);

if ($succes) {
    echo json_encode(["succes" => true, "message" => "Utilisateur créé avec succès."]);
} else {
    echo json_encode(["succes" => false, "message" => "Erreur lors de la création."]);
}
