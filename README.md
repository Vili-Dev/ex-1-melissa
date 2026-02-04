# Gestion de Contacts - Application CRUD en PHP

Application web simple de gestion de contacts permettant de **Creer**, **Lire**, **Modifier** et **Supprimer** des contacts (CRUD). Projet pedagogique realise dans le cadre de la formation DWWM.

---

## Technologies utilisees

| Technologie | Utilisation |
|-------------|-------------|
| **PHP 7+** | Langage serveur pour la logique metier |
| **MySQL** | Base de donnees relationnelle |
| **PDO** | Extension PHP pour la connexion securisee a MySQL |
| **HTML5** | Structure des pages web |
| **WampServer** | Environnement de developpement local (Apache + MySQL + PHP) |

---

## Prerequis

Avant de commencer, assurez-vous d'avoir installe :

1. **WampServer** (ou XAMPP/MAMP selon votre OS)
   - Telechargement : https://www.wampserver.com/

2. **Un navigateur web** (Chrome, Firefox, Edge...)

3. **Un editeur de code** (VS Code recommande)

---

## Installation pas a pas

### Etape 1 : Telecharger le projet

Placez le dossier `ex-1-melissa` dans le repertoire `www` de WampServer :

```
C:\wamp64\www\ex-1-melissa\
```

### Etape 2 : Demarrer WampServer

1. Lancez WampServer
2. Attendez que l'icone devienne **verte** (tous les services sont actifs)

### Etape 3 : Creer la base de donnees

1. Ouvrez **phpMyAdmin** : http://localhost/phpmyadmin
2. Cliquez sur "Nouvelle base de donnees"
3. Nommez-la `gestion_contacts`
4. Cliquez sur "Creer"

### Etape 4 : Creer la table contacts

Dans phpMyAdmin, selectionnez la base `gestion_contacts`, puis allez dans l'onglet **SQL** et executez :

```sql
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Etape 5 : Tester l'application

Ouvrez votre navigateur et accedez a :

```
http://localhost/ex-1-melissa/
```

---

## Structure du projet

```
ex-1-melissa/
|
|-- db.php                    --> Connexion a la base de donnees
|-- index.php                 --> Page d'accueil (liste + formulaire d'ajout)
|-- detail.php                --> Affichage des details d'un contact
|-- modifier.php              --> Formulaire de modification
|-- traitement.php            --> Traitement de l'ajout (INSERT)
|-- traitement_modifier.php   --> Traitement de la modification (UPDATE)
|-- supprimer.php             --> Suppression d'un contact (DELETE)
|-- README.md                 --> Ce fichier
```

### Description de chaque fichier

#### db.php - Connexion a la base de donnees

Ce fichier etablit la connexion avec MySQL en utilisant PDO.

```php
<?php
$host = "localhost";
$dbname = "gestion_contacts";
$user = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
```

**Points cles :**
- `PDO` : PHP Data Objects, methode securisee pour se connecter a une BDD
- `try/catch` : Gestion des erreurs (si la connexion echoue, on affiche un message)
- `charset=utf8` : Permet d'afficher correctement les accents

#### index.php - Page principale

Affiche :
- Un formulaire pour ajouter un nouveau contact
- La liste de tous les contacts avec les liens Voir/Modifier/Supprimer

#### detail.php - Lecture d'un contact (READ)

Recupere l'ID du contact via l'URL (`$_GET['id']`) et affiche ses informations.

#### modifier.php - Formulaire de modification

Pre-remplit le formulaire avec les donnees actuelles du contact.

#### traitement.php - Ajout d'un contact (CREATE)

Recoit les donnees du formulaire (`$_POST`) et execute une requete `INSERT`.

#### traitement_modifier.php - Modification (UPDATE)

Recoit les nouvelles donnees et execute une requete `UPDATE`.

#### supprimer.php - Suppression (DELETE)

Recupere l'ID via l'URL et execute une requete `DELETE`.

---

## Fonctionnalites CRUD detaillees

### CREATE - Ajouter un contact

**Fichiers concernes :** `index.php` (formulaire) + `traitement.php` (traitement)

**Flux :**
1. L'utilisateur remplit le formulaire sur `index.php`
2. Les donnees sont envoyees en POST vers `traitement.php`
3. Une requete INSERT ajoute le contact en base

**Requete SQL :**
```sql
INSERT INTO contacts (nom, prenom, email) VALUES (:nom, :prenom, :email)
```

---

### READ - Lire les contacts

**Fichiers concernes :** `index.php` (liste) + `detail.php` (details)

**Pour la liste (index.php) :**
```sql
SELECT * FROM contacts
```

**Pour le detail (detail.php) :**
```sql
SELECT * FROM contacts WHERE id = :id
```

---

### UPDATE - Modifier un contact

**Fichiers concernes :** `modifier.php` (formulaire) + `traitement_modifier.php` (traitement)

**Flux :**
1. L'utilisateur clique sur "Modifier"
2. `modifier.php` affiche le formulaire pre-rempli
3. Apres soumission, `traitement_modifier.php` execute la mise a jour

**Requete SQL :**
```sql
UPDATE contacts SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id
```

---

### DELETE - Supprimer un contact

**Fichier concerne :** `supprimer.php`

**Flux :**
1. L'utilisateur clique sur "Supprimer"
2. Une confirmation JavaScript s'affiche
3. Si confirme, `supprimer.php` supprime le contact

**Requete SQL :**
```sql
DELETE FROM contacts WHERE id = :id
```

---

## Base de donnees

### Schema de la table `contacts`

| Colonne | Type | Description |
|---------|------|-------------|
| `id` | INT AUTO_INCREMENT | Identifiant unique (cle primaire) |
| `nom` | VARCHAR(100) | Nom du contact |
| `prenom` | VARCHAR(100) | Prenom du contact |
| `email` | VARCHAR(255) | Adresse email |
| `date_creation` | TIMESTAMP | Date d'ajout automatique |

### Requete SQL complete de creation

```sql
CREATE DATABASE IF NOT EXISTS gestion_contacts;
USE gestion_contacts;

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Donnees de test (optionnel)
INSERT INTO contacts (nom, prenom, email) VALUES
('Dupont', 'Marie', 'marie.dupont@email.com'),
('Martin', 'Jean', 'jean.martin@email.com'),
('Bernard', 'Sophie', 'sophie.bernard@email.com');
```

---

## Concepts DWWM abordes

Ce projet permet de pratiquer les competences suivantes du referentiel DWWM :

### Developpement cote serveur
- Connexion a une base de donnees avec PDO
- Requetes preparees (protection contre les injections SQL)
- Traitement des formulaires (methodes GET et POST)
- Structure MVC simplifiee (separation logique/affichage)

### Developpement cote client
- Formulaires HTML avec validation (`required`)
- Confirmation JavaScript avant suppression

### Base de donnees
- Creation de base et de table
- Operations CRUD (INSERT, SELECT, UPDATE, DELETE)
- Utilisation de cles primaires auto-incrementees

### Bonnes pratiques
- Utilisation de `require_once` pour eviter les inclusions multiples
- Gestion des erreurs avec try/catch
- Requetes preparees pour la securite

---

## Ameliorations possibles

Pour aller plus loin, vous pourriez :

1. **Ajouter du CSS** - Styliser l'interface avec Bootstrap ou CSS personnalise
2. **Validation PHP** - Verifier les donnees cote serveur avant insertion
3. **Pagination** - Gerer l'affichage si beaucoup de contacts
4. **Recherche** - Ajouter une barre de recherche
5. **Messages flash** - Afficher des messages de confirmation apres chaque action

---

## Ressources utiles

- [Documentation PHP officielle](https://www.php.net/manual/fr/)
- [Documentation PDO](https://www.php.net/manual/fr/book.pdo.php)
- [W3Schools PHP MySQL](https://www.w3schools.com/php/php_mysql_intro.asp)
- [OpenClassrooms - PHP et MySQL](https://openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql)

---

## Auteur

Projet realise dans le cadre de la formation **Developpeur Web et Web Mobile (DWWM)**.

---

## Licence

Projet a but pedagogique - Libre d'utilisation pour l'apprentissage.
