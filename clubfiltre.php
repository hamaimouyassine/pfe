<?php
// Inclure la connexion à la base de données
include 'db_connect.php'; // Connexion à la base de données
session_start();

$message = ''; // Variable de message

// Processus de connexion
if (isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
    $mdp = $_POST['mdp'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($mdp === $user['mdp']) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['full_name'] = $user['full_name'];
            $message = "✅ Connexion réussie. Bienvenue " . htmlspecialchars($user['full_name']) . " !";
        } else {
            $message = "❌ Mot de passe incorrect.";
        }
    } else {
        $message = "❌ Aucun utilisateur trouvé avec cet email.";
    }

    $stmt->close();
}

// Récupérer les clubs triés par topic
$sql = "SELECT * FROM info_clubs ORDER BY topics, nomclub";
$result = $conn->query($sql);

// Organiser les clubs par topic
$clubs_by_topic = [];

while ($row = $result->fetch_assoc()) {
    $topic = $row['topics'];
    $clubs_by_topic[$topic][] = $row;
}

// Fermeture de la connexion
$conn->close();
?>