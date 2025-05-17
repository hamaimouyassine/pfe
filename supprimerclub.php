<?php
session_start();
include 'db_connect.php';

// Admin or Responsable access check
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'responsable')) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['idclub'])) {
    $club_id = $_GET['idclub'];

    // Si l'utilisateur est un responsable, on vérifie qu'il ne supprime que son propre club
    if ($_SESSION['role'] === 'responsable' && $club_id != $_SESSION['idclub']) {
        header("Location: dashboard.php"); // Redirection si le responsable essaie de supprimer un autre club
        exit();
    }

    // Suppression du club dans la base de données
    $stmt = $conn->prepare("DELETE FROM info_clubs WHERE idclub = ?");
    $stmt->bind_param("i", $club_id);
    $stmt->execute();

    // Redirection après suppression selon le rôle
    if ($_SESSION['role'] === 'admin') {
        header("Location: dashboard.php"); // Admin redirection
    } else if ($_SESSION['role'] === 'responsable') {
        header("Location: dashboaredrespo.php"); // Responsable redirection
    }
    exit();
}
?>
