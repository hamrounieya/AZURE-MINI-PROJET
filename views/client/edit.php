<?php
$host = "tcp:societe-mini-projet.database.windows.net,1433";  // Azure SQL Server host
$db_name = "societe";  // Database name
$username = "eya";  // Username
$password = "azerty123@";
$conn = new PDO("sqlsrv:server=$host;Database=$db_name;Encrypt=true;TrustServerCertificate=false", $username, $password);

$id = $_GET['id'] ?? null;
if ($id) {
    $query = "SELECT * FROM client WHERE ID_client = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $ID_region = $_POST['ID_region'];
    $query = "UPDATE client SET nom = ?, prenom = ?, age = ?, ID_region = ? WHERE ID_client = ?";
    $stmt = $conn->prepare($query);
    if ($stmt->execute([$nom, $prenom, $age, $ID_region, $_POST['id']])) {
        header('Location: list.php');
        exit();
    } else {
        echo "Error updating client.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Client</title>
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
            color: #333;
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
        <h1>Modifier un Client</h1>
        <?php if ($client): ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($client['ID_client']) ?>">
                <label for="nom">Nom:</label>
                <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($client['nom']) ?>" required>

                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($client['prenom']) ?>" required>

                <label for="age">Âge:</label>
                <input type="number" name="age" id="age" value="<?= htmlspecialchars($client['age']) ?>" required>

                <label for="ID_region">Région:</label>
                <select id="ID_region" name="ID_region" required>
                <?php
                $regions = $conn->query("SELECT ID_region, libelle FROM region");
                while ($region = $regions->fetch(PDO::FETCH_ASSOC)) {
                    $selected = $region['ID_region'] == $client['ID_region'] ? 'selected' : '';
                    echo "<option value='{$region['ID_region']}' $selected>{$region['libelle']}</option>";
                }
                ?>
                </select>

                <button type="submit">Mettre à jour</button>
            </form>
        <?php else: ?>
            <p>Client introuvable.</p>
        <?php endif; ?>
        <a href="list.php">Retour à la liste</a>
    </div>
</body>
</html>
