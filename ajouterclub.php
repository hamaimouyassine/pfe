<?php
session_start();
include 'db_connect.php';

// Admin access check
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = '';

if (isset($_POST['submit'])) {
    // Récupérer les informations du club
    $nomclub = $_POST['nomclub'];
    $description = $_POST['description'];
    $vision = $_POST['vision'];
    $logo_url = $_POST['logo_url'];
    $objectif = $_POST['objectif'];
    $website = $_POST['website'];
    $activites = $_POST['activites'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];
    $x_url = $_POST['x_url'];
    $topics = $_POST['topics'];

    // Récupérer les informations du responsable
    $responsable_full_name = $_POST['responsable_full_name'];
    $responsable_email = $_POST['responsable_email'];
    $responsable_mdp = password_hash($_POST['responsable_mdp'], PASSWORD_DEFAULT); // Hash du mot de passe

    // Commencer la transaction
    $conn->begin_transaction();

    try {
        // 1. Insertion du responsable dans la table users
        $stmt_responsable = $conn->prepare("INSERT INTO users (full_name, email, mdp) VALUES (?, ?, ?)");
        $stmt_responsable->bind_param("sss", $responsable_full_name, $responsable_email, $responsable_mdp);
        $stmt_responsable->execute();
        $responsable_id = $stmt_responsable->insert_id; // Récupérer l'ID du responsable ajouté

        // 2. Insertion du club dans la table info_clubs
        $stmt_club = $conn->prepare("INSERT INTO info_clubs 
            (nomclub, description, vision, logo_url, objectif, website, activites, responsable, 
            facebook, instagram, linkedin, x_url, topics) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt_club->bind_param("ssssssssssss", $nomclub, $description, $vision, $logo_url, $objectif,
            $website, $activites, $responsable_id, $facebook, $instagram, $linkedin, $x_url, $topics);
        $stmt_club->execute();

        // Commit de la transaction
        $conn->commit();

        $message = "✅ Club et responsable ajoutés avec succès.";
    } catch (Exception $e) {
        // En cas d'erreur, rollback
        $conn->rollback();
        $message = "❌ Erreur lors de l'ajout du club ou du responsable.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un nouveau club avec responsable</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #007BFF;
        }

        .form-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
        }

        input[type="text"],
        textarea,
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-top: 5px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            padding: 12px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            font-size: 16px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }

        @media (max-width: 600px) {
            input[type="text"],
            input[type="email"],
            input[type="password"],
            textarea {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<h2>Ajouter un nouveau club avec responsable</h2>

<?php if ($message): ?>
    <div class="message <?= strpos($message, '✅') !== false ? 'success' : 'error' ?>">
        <?= $message ?>
    </div>
<?php endif; ?>

<div class="form-container">
    <form method="POST">
        <h3>Informations sur le club</h3>
        <input type="text" name="nomclub" placeholder="Nom du club" required>
        <textarea name="description" placeholder="Description du club" required></textarea>
        <textarea name="vision" placeholder="Vision du club" required></textarea>
        <input type="text" name="logo_url" placeholder="URL du logo" required>
        <textarea name="objectif" placeholder="Objectifs du club" required></textarea>
        <input type="text" name="website" placeholder="Site web" required>
        <textarea name="activites" placeholder="Activités principales" required></textarea>
        <input type="text" name="facebook" placeholder="Lien Facebook" required>
        <input type="text" name="instagram" placeholder="Lien Instagram" required>
        <input type="text" name="linkedin" placeholder="Lien LinkedIn" required>
        <input type="text" name="x_url" placeholder="Lien X/Twitter" required>
        <input type="text" name="topics" placeholder="Thème du club" required>

        <h3>Informations sur le responsable</h3>
        <input type="text" name="responsable_full_name" placeholder="Nom complet du responsable" required>
        <input type="email" name="responsable_email" placeholder="Email du responsable" required>
        <input type="password" name="responsable_mdp" placeholder="Mot de passe du responsable" required>

        <button type="submit" name="submit">Ajouter le club et le responsable</button>
    </form>
</div>

</body>
</html>
