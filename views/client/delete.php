<?php

$host = "tcp:societe-mini-projet.database.windows.net,1433";  // Azure SQL Server host
$db_name = "societe";  // Database name
$username = "eya";  // Username
$password = "azerty123@";
$conn = new PDO("sqlsrv:server=$host;Database=$db_name;Encrypt=true;TrustServerCertificate=false", $username, $password);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM client WHERE ID_client = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    header('Location: list.php');
    exit();
}