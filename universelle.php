<?php
include 'db_connect.php';
include 'login.php';
session_start();
// Requête pour récupérer les détails du club
$sql = "SELECT * FROM info_clubs WHERE idclub = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$club = $stmt->get_result()->fetch_assoc();

// Récupérer les activités du club depuis la table 'activites'
$activites = [];
$act_stmt = $conn->prepare("SELECT titre FROM activites WHERE idclub = ?");
$act_stmt->bind_param("i", $id);
$act_stmt->execute();
$result = $act_stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $activites[] = $row['titre'];
}

// Vérifier si le club existe
if (!$club) {
    echo "<h2>Club non trouvé.</h2>";
    exit;
}
?>