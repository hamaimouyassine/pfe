<?php
session_start();
include 'db_connect.php';

// Vérification d'accès admin ou responsable
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'responsable')) {
    header("Location: login.php");
    exit();
}

// Vérifier si l'ID de l'événement est fourni
if (isset($_GET['id_evenement'])) {
    $event_id = $_GET['id_evenement'];

    // Préparer et exécuter la suppression de l'événement dans la base de données
    $stmt = $conn->prepare("DELETE FROM evenement WHERE id_evenement = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();

    // Redirection vers le dashboard approprié après la suppression
    if ($_SESSION['role'] === 'admin') {
        header("Location: dashboard.php");
    } else if ($_SESSION['role'] === 'responsable') {
        header("Location: dashboaredrespo.php");
    }
    exit();
} else {
    echo "Événement introuvable.";
}
?>
