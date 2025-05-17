<?php
session_start(); // Assurer que la session est démarrée

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

?>

