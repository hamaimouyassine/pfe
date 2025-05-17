<?php
session_start();
include 'db_connect.php';

$message = '';

// Si déjà connecté, rediriger vers la bonne page
if (isset($_SESSION['email']) && isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'admin':
            header("Location: dashboard.php");
            exit();
        case 'responsable':
            header("Location: dashboaredrespo.php?idclub=" . $_SESSION['idclub']);
            exit();
        case 'user':
            header("Location: home-connect.php");
            exit();
    }
}

// Traitement de la connexion
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $mdp = trim($_POST['mdp']);
    $found = false;

    // Vérifier dans la table admin
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $admin_result = $stmt->get_result();

    if ($admin_result->num_rows > 0) {
        $admin = $admin_result->fetch_assoc();
        if ($mdp === $admin['mdp']) {
            $_SESSION['email'] = $admin['email'];
            $_SESSION['role'] = 'admin';
            $_SESSION['admin_name'] = $admin['full_name'];
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "❌ Mot de passe incorrect pour l'admin.";
            $found = true;
        }
    }
    $stmt->close();

    // Vérifier dans la table responsable
    if (!$found) {
        $stmt = $conn->prepare("SELECT * FROM responsable WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $respo_result = $stmt->get_result();

        if ($respo_result->num_rows > 0) {
            $respo = $respo_result->fetch_assoc();
            if ($mdp === $respo['mdp']) {
                $_SESSION['email'] = $respo['email'];
                $_SESSION['role'] = 'responsable';
                $_SESSION['full_name'] = $respo['full_name'];
                $_SESSION['id_responsable'] = $respo['id_responsable'];

                // Récupérer l'idclub via la table responsable (relation directe)
                $stmt2 = $conn->prepare("SELECT idclub FROM responsable WHERE email = ? LIMIT 1");
                $stmt2->bind_param("s", $email);
                $stmt2->execute();
                $club_result = $stmt2->get_result();
                $club = $club_result->fetch_assoc();

                if ($club) {
                    $_SESSION['idclub'] = $club['idclub'];
                    header("Location: dashboaredrespo.php?idclub=" . $club['idclub']);
                    exit();
                } else {
                    $message = "❌ Aucun club associé à ce responsable.";
                }
                $stmt2->close();
                $found = true;
            } else {
                $message = "❌ Mot de passe incorrect pour le responsable.";
                $found = true;
            }
        }
        $stmt->close();
    }

    // Vérifier dans la table utilisateur
    if (!$found) {
        $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user_result = $stmt->get_result();

        if ($user_result->num_rows > 0) {
            $user = $user_result->fetch_assoc();
            if ($mdp === $user['mdp']) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = 'user';
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['id_user'] = $user['id_user'];
                header("Location: home-connect.php");
                exit();
            } else {
                $message = "❌ Mot de passe incorrect pour l'utilisateur.";
            }
        } else {
            $message = "❌ Aucun compte trouvé avec cet email.";
        }
        $stmt->close();
    }
}
?>
