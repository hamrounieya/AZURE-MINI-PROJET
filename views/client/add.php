<?php

$host = "tcp:societe-mini-projet.database.windows.net,1433";  // Azure SQL Server host
$db_name = "societe";  // Database name
$username = "eya";  // Username
$password = "azerty123@";


try {
    $conn = new PDO(
        "sqlsrv:server=" . $host . ";Database=" . $db_name . ";Encrypt=true;TrustServerCertificate=false",
        $username,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
    die();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $ID_region = $_POST['ID_region'];

    
    $query = "INSERT INTO client (nom, prenom, age, ID_region) VALUES (:nom, :prenom, :age, :ID_region)";
    $stmt = $conn->prepare($query);

    try {
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':age' => $age,
            ':ID_region' => $ID_region
        ]);
        
        header('Location: list.php');
        exit();
    } catch (PDOException $e) {
        echo "Error adding client: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Client</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6b6bff, #a2a2ff);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input, select, button {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter un Client</h1>
        <form action="add.php" method="POST">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="age">Âge:</label>
            <input type="number" id="age" name="age" required>

            <label for="ID_region">Région:</label>
            <select id="ID_region" name="ID_region" required>
            <?php
                $regionsQuery = "SELECT ID_region, libelle FROM region";
                $regionsStmt = $conn->query($regionsQuery);
                while ($region = $regionsStmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"{$region['ID_region']}\">{$region['libelle']}</option>";
                }
                ?>
            </select>

            <button type="submit">Ajouter</button>
        </form>
        <a href="list.php">Retour à la liste</a>
    </div>
</body>
</html>
