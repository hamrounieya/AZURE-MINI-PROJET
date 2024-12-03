<?php

$host = "tcp:societe-mini-projet.database.windows.net,1433";  // Azure SQL Server host
$db_name = "societe";  // Database name
$username = "eya";  // Username
$password = "azerty123@";
$conn = new PDO("sqlsrv:server=$host;Database=$db_name;Encrypt=true;TrustServerCertificate=false", $username, $password);


$clients = [];
$searchQuery = "";


if (isset($_GET['search'])) {
    
    $searchQuery = "%" . $_GET['search'] . "%"; 
    $sql = "SELECT c.ID_client, c.nom, c.prenom, c.age, r.libelle AS region 
            FROM client c 
            LEFT JOIN region r ON c.ID_region = r.ID_region 
            WHERE c.nom LIKE ? OR c.prenom LIKE ?";
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$searchQuery, $searchQuery]); 
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    
    $sql = "SELECT c.ID_client, c.nom, c.prenom, c.age, r.libelle AS region 
            FROM client c 
            LEFT JOIN region r ON c.ID_region = r.ID_region";
    
    $stmt = $conn->query($sql);
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6b6bff, #a2a2ff);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            gap: 3rem;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .df {
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        input[type="text"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            outline: none;
        }

        button, a {
            text-decoration: none;
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1em;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
            transition: background 0.3s, transform 0.2s;
            border: none;
            cursor: pointer;
        }

        button:hover, a:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        table {
            width: 80%;
            border-collapse: collapse;
            background: #fff;
            color: #333;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: #fff;
        }

        tr:hover {
            background: #f1f1f1;
        }
        .mt {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
        <h1>Liste des Clients</h1>
        <a href="add.php">Ajouter un client</a>

    <!-- Formulaire de recherche -->
    <form method="GET" action="">
        <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" placeholder="Rechercher par nom">
        <button type="submit">Rechercher</button>
        <a href="list.php">Effacer</a>
    </form>

    <table class="mt">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Âge</th>
                <th>Région</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clients)): ?>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client['ID_client']) ?></td>
                        <td><?= htmlspecialchars($client['nom']) ?></td>
                        <td><?= htmlspecialchars($client['prenom']) ?></td>
                        <td><?= htmlspecialchars($client['age']) ?></td>
                        <td><?= htmlspecialchars($client['region']) ?></td>
                        <td>
                            <a href="edit.php?action=editClient&id=<?= htmlspecialchars($client['ID_client']) ?>">Modifier</a>
                            <a href="delete.php?action=deleteClient&id=<?= htmlspecialchars($client['ID_client']) ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Aucun client trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
