<?php
$host = "tcp:societe-mini-projet.database.windows.net,1433";  // Azure SQL Server host
$db_name = "societe";  // Database name
$username = "eya";  // Username
$password = "azerty123@";
$conn = new PDO("sqlsrv:server=$host;Database=$db_name;Encrypt=true;TrustServerCertificate=false", $username, $password);

$query = "SELECT ID_region, libelle FROM region";
$stmt = $conn->query($query);
$regions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Régions</title>
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
            width: 100%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }

        table td {
            background-color: #f9f9f9;
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
        <h1>Liste des Régions</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la Région</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($regions as $region): ?>
                    <tr>
                        <td><?= htmlspecialchars($region['ID_region']); ?></td>
                        <td><?= htmlspecialchars($region['libelle']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../client/list.php">Retour à la liste des clients</a>
    </div>
</body>
</html>
