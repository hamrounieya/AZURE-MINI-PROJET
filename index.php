<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Mini Cloud</title>
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
            height: 100vh;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        p {
            font-size: 1.2em;
            margin-bottom: 30px;
            text-align: center;
        }

        .nav {
            display: flex;
            gap: 20px;
        }

        .nav a {
            text-decoration: none;
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1em;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
            transition: background 0.3s, transform 0.2s;
        }

        .nav a:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <h1>Bienvenue sur le Projet Mini Cloud !</h1>
    <p>Choisissez une option ci-dessous pour gérer les données :</p>
    
    <div class="nav">
        <a href="./views/client/list.php">Gérer les clients</a>
        <a href="./views/region/list.php">Consulter les régions</a>
    </div>
</body>
</html>
