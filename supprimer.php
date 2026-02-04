<?php
require_once 'db.php';

// On récupère l'ID du contact à supprimer
$id = $_GET['id'];

// On supprime le contact
$sql = "DELETE FROM contacts WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

echo "Contact supprimé avec succès !";
?>