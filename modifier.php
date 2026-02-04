<?php
require_once 'db.php';

// On récupère le contact à modifier
$id = $_GET['id'];
$sql = "SELECT * FROM contacts WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un contact</title>
</head>
<body>
    <h1>Modifier le contact</h1>

    <form method="POST" action="traitement_modifier.php">
        <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">

        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" 
               value="<?php echo $contact['nom']; ?>" required>
        <br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" 
               value="<?php echo $contact['prenom']; ?>" required>
        <br><br>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" 
               value="<?php echo $contact['email']; ?>" required>
        <br><br>

        <button type="submit">Enregistrer les modifications</button>
    </form>

    <a href="index.php">Annuler</a>
</body>
</html>