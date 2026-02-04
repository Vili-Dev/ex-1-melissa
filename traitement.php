<?php

require_once 'db.php';

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];

$sql = "INSERT INTO contacts (nom, prenom, email) VALUES (:nom, :prenom, :email)";
$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email
]);

echo "Contact enregistré avec succès !";
?>