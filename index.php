<?php

require_once 'db.php';

$sql = "SELECT * FROM contacts";
$stmt = $pdo->query($sql);
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de Contacts</title>
</head>
<body>
    <h1>Ajouter un contact</h1>

    <form method="POST" action="traitement.php">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>
        <br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required>
        <br><br>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br><br>

        <button type="submit">Enregistrer</button>
    </form>

    <hr>

    <h2>Liste des contacts</h2>

<?php foreach ($contacts as $contact) : ?>
    <p>
        <?php echo $contact['prenom'] . " " . $contact['nom'] . " - " . $contact['email']; ?>
        - <a href="detail.php?id=<?php echo $contact['id']; ?>">Voir</a>
        - <a href="modifier.php?id=<?php echo $contact['id']; ?>">Modifier</a>
        - <a href="supprimer.php?id=<?php echo $contact['id']; ?>"
             onclick="return confirm('Es-tu sûr de vouloir supprimer ce contact ?');">
             Supprimer
          </a>
    </p>
<?php endforeach; ?>

</body>
</html>