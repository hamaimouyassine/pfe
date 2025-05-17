<?php
session_start();
include 'db_connect.php';

// Vérification de la session pour l'accès au dashboard
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'responsable') {
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    // Détruire toutes les variables de session
    session_unset(); 
    
    // Détruire la session
    session_destroy(); 

    // Vérification pour voir si la session est détruite
    if (!isset($_SESSION['email'])) {
        // Rediriger vers home.php après la déconnexion
        header("Location: home.php");
        exit(); // Assurez-vous que le script ne continue pas après la redirection
    }
}

// Récupérer l'idclub du responsable via la table "responsable"
$responsable_email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT idclub FROM responsable WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $responsable_email);
$stmt->execute();
$result = $stmt->get_result();
$respo_data = $result->fetch_assoc();

if (!$respo_data) {
    echo "<p style='color:red; text-align:center;'>Aucun club associé à ce responsable.</p>";
    exit();
}

$idclub = $respo_data['idclub'];

// Récupérer les informations du club
$club_stmt = $conn->prepare("SELECT * FROM info_clubs WHERE idclub = ?");
$club_stmt->bind_param("i", $idclub);
$club_stmt->execute();
$club_result = $club_stmt->get_result();
$club = $club_result->fetch_assoc();

if (!$club) {
    echo "<p style='color:red; text-align:center;'>Club introuvable.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Responsable</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        h1 { text-align: center; color: #007BFF; }
        .top-nav { display: flex; justify-content: flex-end; margin-bottom: 20px; gap: 10px; }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 5px; color: white; background: #28a745; }
        .btn-danger { background: #dc3545; }
        .btn-blue { background: #007BFF; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #007BFF; color: white; }
    </style>
</head>
<body>

<div class="container">
    <div class="top-nav">
        <a href="ajouterevenement.php?idclub=<?= $idclub ?>" class="btn btn-blue">Ajouter un événement</a>
        <form method="POST" action="dashboaredrespo.php">
            <button type="submit" name="logout" class="btn btn-danger">Déconnexion</button>
        </form>
    </div>

    <h1>Dashboard du Responsable</h1>

    <h2>Mon Club</h2>
    <table>
        <tr><th>Nom</th><th>Description</th><th>Vision</th><th>Actions</th></tr>
        <tr>
            <td><?= htmlspecialchars($club['nomclub']) ?></td>
            <td><?= htmlspecialchars($club['description']) ?></td>
            <td><?= htmlspecialchars($club['vision']) ?></td>
            <td>
                <a href="modifierclub.php?idclub=<?= $idclub ?>" class="btn">Modifier</a>
                <a href="supprimerclub.php?idclub=<?= $idclub ?>" class="btn btn-danger" onclick="return confirm('Supprimer ce club ?');">Supprimer</a>
            </td>
        </tr>
    </table>

    <h2>Événements de mon Club</h2>
    <?php
    // Récupérer les événements du club
    $event_stmt = $conn->prepare("SELECT * FROM evenement WHERE idclub = ? ORDER BY date_evenement DESC");
    $event_stmt->bind_param("i", $idclub);
    $event_stmt->execute();
    $event_result = $event_stmt->get_result();

    if ($event_result->num_rows > 0): ?>
        <table>
            <tr><th>Titre</th><th>Description</th><th>Date</th><th>Actions</th></tr>
            <?php while ($event = $event_result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($event['titre']) ?></td>
                    <td><?= htmlspecialchars($event['description']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($event['date_evenement'])) ?></td>
                    <td>
                        <a href="modifierevenement.php?id_evenement=<?= $event['id_evenement'] ?>" class="btn">Modifier</a>
                        <a href="supprimerevenement.php?id_evenement=<?= $event['id_evenement'] ?>" class="btn btn-danger" onclick="return confirm('Supprimer cet événement ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align:center;">Aucun événement trouvé pour ce club.</p>
    <?php endif; ?>
</div>

</body>
</html>
