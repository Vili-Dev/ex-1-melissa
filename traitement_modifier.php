<?php
require_once 'db.php';

// On récupère les données du formulaire
$id = $_POST['id'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];

// On met à jour le contact
$sql = "UPDATE contacts SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':id' => $id
]);

echo "Contact modifié avec succès !";
?>