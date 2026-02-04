pour le html



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Contacts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter un Contact</h1>
        
        <form action="traitement.php" method="POST">
            
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input 
                    type="text" 
                    id="nom" 
                    name="nom" 
                    placeholder="Entrez le nom du contact" 
                    required
                >
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Entrez l'adresse email" 
                    required
                >
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone :</label>
                <input 
                    type="tel" 
                    id="telephone" 
                    name="telephone" 
                    placeholder="Entrez le numéro de téléphone" 
                    required
                >
            </div>

            <button type="submit">Ajouter le Contact</button>
        </form>
    </div>
</body>
</html>
