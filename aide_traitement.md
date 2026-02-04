<?php
// Vérifier que la requête est en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Récupérer et nettoyer les données
    $nom = isset($_POST['nom']) ? htmlspecialchars(trim($_POST['nom'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $telephone = isset($_POST['telephone']) ? htmlspecialchars(trim($_POST['telephone'])) : '';
    
    // Valider les données
    $erreurs = [];
    
    // Vérifier que le nom n'est pas vide
    if (empty($nom)) {
        $erreurs[] = "Le nom est requis.";
    }
    
    // Vérifier que l'email est valide
    if (empty($email)) {
        $erreurs[] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'email n'est pas valide.";
    }
    
    // Vérifier que le téléphone n'est pas vide
    if (empty($telephone)) {
        $erreurs[] = "Le téléphone est requis.";
    }
    
    // Si pas d'erreurs, traiter les données
    if (empty($erreurs)) {
        // Inclure la connexion à la base de données
        include 'db.php';
        
        // Préparer et exécuter la requête INSERT
        $sql = "INSERT INTO contacts (nom, email, telephone) VALUES (:nom, :email, :telephone)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':telephone' => $telephone
        ]);
        
        // Afficher le message de succès
        echo "<!DOCTYPE html>";
        echo "<html lang='fr'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Succès</title>";
        echo "<style>";
        echo "body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; background-color: #f4f4f4; }";
        echo ".container { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }";
        echo ".success { color: #4CAF50; text-align: center; }";
        echo "button { width: 100%; padding: 12px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; margin-top: 20px; }";
        echo "button:hover { background-color: #45a049; }";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<h1 class='success'>✓ Contact ajouté avec succès !</h1>";
        echo "<p><strong>Nom :</strong> " . $nom . "</p>";
        echo "<p><strong>Email :</strong> " . $email . "</p>";
        echo "<p><strong>Téléphone :</strong> " . $telephone . "</p>";
        echo "<button onclick=\"window.location.href='index.php'\">Ajouter un autre contact</button>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
        
    } else {
        // Afficher les erreurs
        echo "<!DOCTYPE html>";
        echo "<html lang='fr'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Erreurs</title>";
        echo "<style>";
        echo "body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; background-color: #f4f4f4; }";
        echo ".container { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }";
        echo ".error { color: #d32f2f; }";
        echo "ul { color: #d32f2f; }";
        echo "button { width: 100%; padding: 12px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; margin-top: 20px; }";
        echo "button:hover { background-color: #45a049; }";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<h1 class='error'>✗ Erreurs détectées</h1>";
        echo "<ul>";
        foreach ($erreurs as $erreur) {
            echo "<li>" . $erreur . "</li>";
        }
        echo "</ul>";
        echo "<button onclick=\"window.history.back()\">Retour au formulaire</button>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }
    
} else {
    // Rediriger vers index.php si la méthode n'est pas POST
    header('Location: index.php');
    exit();
}
?>
