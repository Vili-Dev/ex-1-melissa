<?php
// Configuration de la base de données
$host = 'localhost';
$db = 'gestion_contacts';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// DSN (Data Source Name) pour PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    // Créer une connexion PDO
    $pdo = new PDO($dsn, $user, $pass);
    
    // Définir les options d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Créer la table si elle n'existe pas
    $sql = "CREATE TABLE IF NOT EXISTS contacts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        telephone VARCHAR(20) NOT NULL,
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
