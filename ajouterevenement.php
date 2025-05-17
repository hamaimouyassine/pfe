<?php
session_start();
include 'db_connect.php';

// Vérification du rôle
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'responsable')) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_evenement = $_POST['date_evenement'];
    $idclub = $_POST['idclub'];
    $photo = $_POST['photo'];

    // Formatage de la date
    $date_evenement = date('Y-m-d H:i:s', strtotime($date_evenement));

    // Insertion dans la base de données
    $stmt = $conn->prepare("INSERT INTO evenement (titre, description, date_evenement, idclub, photo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $titre, $description, $date_evenement, $idclub, $photo);
    $stmt->execute();

    // Redirection selon le rôle
    if ($_SESSION['role'] === 'admin') {
        header("Location: dashboard.php");
    } else {
        header("Location: dashboaredrespo.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Événement</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input, textarea, select, button {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input[type="datetime-local"], input[type="text"], select {
            width: 100%;
        }

        textarea {
            resize: vertical;
            min-height: 150px;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .btn-container {
            display: flex;
            justify-content: center;
        }

        .btn-container button {
            width: 50%;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Ajouter un Événement</h1>
    <form method="POST">
        <div class="form-group">
            <label for="titre">Titre de l'Événement</label>
            <input type="text" name="titre" id="titre" placeholder="Titre de l'événement" required>
        </div>

        <div class="form-group">
            <label for="description">Description de l'Événement</label>
            <textarea name="description" id="description" placeholder="Description détaillée" required></textarea>
        </div>

        <div class="form-group">
            <label for="date_evenement">Date et Heure</label>
            <input type="datetime-local" name="date_evenement" id="date_evenement" required>
        </div>

        <div class="form-group">
            <label for="idclub">Club Associé</label>
            <select name="idclub" id="idclub" required>
                <?php
                $result = $conn->query("SELECT idclub, nomclub FROM info_clubs");
                while ($club = $result->fetch_assoc()) {
                    echo "<option value='{$club['idclub']}'>{$club['nomclub']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="photo">URL de la Photo</label>
            <input type="text" name="photo" id="photo" placeholder="https://exemple.com/photo.jpg" required>
        </div>

        <div class="btn-container">
            <button type="submit" name="submit">Ajouter l'Événement</button>
        </div>
    </form>
</div>

</body>
</html>
