<?php
session_start();
include 'db_connect.php';

// Vérification d'accès
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'responsable')) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id_evenement'])) {
    $event_id = $_GET['id_evenement'];

    // Récupérer les détails de l'événement
    $stmt = $conn->prepare("SELECT * FROM evenement WHERE id_evenement = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        echo "Événement non trouvé.";
        exit();
    }

    // Mise à jour après soumission
    if (isset($_POST['submit'])) {
        $new_titre = $_POST['titre'];
        $new_description = $_POST['description'];
        $new_date_evenement = $_POST['date_evenement'];
        $new_photo = $_POST['photo'];

        // Format de date
        $new_date_evenement = date('Y-m-d H:i:s', strtotime($new_date_evenement));

        // Requête de mise à jour
        $update_stmt = $conn->prepare("UPDATE evenement SET titre = ?, description = ?, date_evenement = ?, photo = ? WHERE id_evenement = ?");
        $update_stmt->bind_param("ssssi", $new_titre, $new_description, $new_date_evenement, $new_photo, $event_id);
        $update_stmt->execute();

        // Redirection selon le rôle
        if ($_SESSION['role'] === 'admin') {
            header("Location: dashboard.php");
        } else {
            header("Location: dashboaredrespo.php");
        }
        exit();
    }
} else {
    echo "ID d'événement manquant.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'Événement</title>
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

        input, textarea, button {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
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
    <h1>Modifier l'Événement</h1>
    <form method="POST">
        <div class="form-group">
            <label for="titre">Titre de l'Événement</label>
            <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($event['titre']) ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" required><?= htmlspecialchars($event['description']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="date_evenement">Date et Heure</label>
            <input type="datetime-local" name="date_evenement" id="date_evenement"
                   value="<?= date('Y-m-d\TH:i', strtotime($event['date_evenement'])) ?>" required>
        </div>

        <div class="form-group">
            <label for="photo">URL de la Photo</label>
            <input type="text" name="photo" id="photo" value="<?= htmlspecialchars($event['photo']) ?>" required>
        </div>

        <div class="btn-container">
            <button type="submit" name="submit">Mettre à jour l'Événement</button>
        </div>
    </form>
</div>

</body>
</html>
