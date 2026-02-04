<?php
require_once 'db.php';

// On récupère l'ID depuis l'URL
$id = $_GET['id'];

// On cherche le contact avec cet ID
$sql = "SELECT * FROM contacts WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du contact</title>
</head>
<body>
    <h1>Détail du contact</h1>

    <?php if ($contact) : ?>
        <p><strong>Nom :</strong> <?php echo $contact['nom']; ?></p>
        <p><strong>Prénom :</strong> <?php echo $contact['prenom']; ?></p>
        <p><strong>Email :</strong> <?php echo $contact['email']; ?></p>
    <?php else : ?>
        <p>Contact introuvable.</p>
    <?php endif; ?>

    <a href="index.php">Retour à la liste</a>
</body>
</html>