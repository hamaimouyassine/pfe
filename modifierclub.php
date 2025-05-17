<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'responsable')) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['idclub'])) {
    echo "<div class='text-red-600 font-bold text-center mt-10'>ID de club manquant.</div>";
    exit();
}

$club_id = intval($_GET['idclub']);

// Récupération des données du club
$stmt = $conn->prepare("SELECT * FROM info_clubs WHERE idclub = ?");
$stmt->bind_param("i", $club_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='text-red-600 font-bold text-center mt-10'>Club non trouvé.</div>";
    exit();
}

$club = $result->fetch_assoc();
$responsable_id = $club['responsable_id'];

// Récupérer les infos du responsable s'il existe
$responsable = null;
if ($responsable_id) {
    $res_stmt = $conn->prepare("SELECT * FROM responsable WHERE id_responsable = ?");
    $res_stmt->bind_param("i", $responsable_id);
    $res_stmt->execute();
    $res_result = $res_stmt->get_result();
    $responsable = $res_result->fetch_assoc();
}

// Traitement du formulaire
if (isset($_POST['submit'])) {
    // Champs club
    $new_nomclub = $_POST['nomclub'];
    $new_description = $_POST['description'];
    $new_vision = $_POST['vision'];
    $new_logo_url = $_POST['logo_url'];
    $new_objectif = $_POST['objectif'];
    $new_website = $_POST['website'];
    $new_activites = $_POST['activites'];
    $new_facebook = $_POST['facebook'];
    $new_instagram = $_POST['instagram'];
    $new_linkedin = $_POST['linkedin'];
    $new_x_url = $_POST['x_url'];
    $new_topics = $_POST['topics'];

    // Champs responsable
    $new_full_name = $_POST['full_name'];
    $new_email = $_POST['email'];
    $new_mdp = $_POST['mdp'];

    // MAJ club
    $update_club = $conn->prepare("UPDATE info_clubs SET 
        nomclub=?, description=?, vision=?, logo_url=?, objectif=?, website=?, activites=?, 
        facebook=?, instagram=?, linkedin=?, x_url=?, topics=? WHERE idclub=?");
    $update_club->bind_param("ssssssssssssi",
        $new_nomclub, $new_description, $new_vision, $new_logo_url, $new_objectif,
        $new_website, $new_activites, $new_facebook, $new_instagram, $new_linkedin,
        $new_x_url, $new_topics, $club_id);
    $update_club->execute();

    // MAJ ou ajout du responsable
    if ($responsable) {
        $update_respo = $conn->prepare("UPDATE responsable SET full_name=?, email=?, mdp=? WHERE id_responsable=?");
        $update_respo->bind_param("sssi", $new_full_name, $new_email, $new_mdp, $responsable['id_responsable']);
        $update_respo->execute();
    } else {
        // Création nouveau responsable et lien avec le club
        $insert_respo = $conn->prepare("INSERT INTO responsable (full_name, email, mdp, idclub) VALUES (?, ?, ?, ?)");
        $insert_respo->bind_param("sssi", $new_full_name, $new_email, $new_mdp, $club_id);
        $insert_respo->execute();
        $new_respo_id = $conn->insert_id;

        $update_club_respo = $conn->prepare("UPDATE info_clubs SET responsable_id = ? WHERE idclub = ?");
        $update_club_respo->bind_param("ii", $new_respo_id, $club_id);
        $update_club_respo->execute();
    }

    // Redirection
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
    <title>Modifier Club & Responsable</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Modifier le Club</h1>

        <form method="POST" class="space-y-4">
            <!-- Club info -->
            <input class="w-full border p-2 rounded" type="text" name="nomclub" value="<?= htmlspecialchars($club['nomclub']) ?>" required>
            <textarea class="w-full border p-2 rounded" name="description" required><?= htmlspecialchars($club['description']) ?></textarea>
            <textarea class="w-full border p-2 rounded" name="vision"><?= htmlspecialchars($club['vision']) ?></textarea>
            <input class="w-full border p-2 rounded" type="text" name="logo_url" value="<?= htmlspecialchars($club['logo_url']) ?>">
            <textarea class="w-full border p-2 rounded" name="objectif"><?= htmlspecialchars($club['objectif']) ?></textarea>
            <input class="w-full border p-2 rounded" type="text" name="website" value="<?= htmlspecialchars($club['website']) ?>">
            <textarea class="w-full border p-2 rounded" name="activites"><?= htmlspecialchars($club['activites']) ?></textarea>
            <input class="w-full border p-2 rounded" type="text" name="facebook" value="<?= htmlspecialchars($club['facebook']) ?>">
            <input class="w-full border p-2 rounded" type="text" name="instagram" value="<?= htmlspecialchars($club['instagram']) ?>">
            <input class="w-full border p-2 rounded" type="text" name="linkedin" value="<?= htmlspecialchars($club['linkedin']) ?>">
            <input class="w-full border p-2 rounded" type="text" name="x_url" value="<?= htmlspecialchars($club['x_url']) ?>">
            <input class="w-full border p-2 rounded" type="text" name="topics" value="<?= htmlspecialchars($club['topics']) ?>">

            <!-- Responsable info -->
            <h2 class="text-xl font-bold pt-6">Responsable</h2>
            <input class="w-full border p-2 rounded" type="text" name="full_name" value="<?= htmlspecialchars($responsable['full_name'] ?? '') ?>" required>
            <input class="w-full border p-2 rounded" type="email" name="email" value="<?= htmlspecialchars($responsable['email'] ?? '') ?>" required>
            <input class="w-full border p-2 rounded" type="text" name="mdp" value="<?= htmlspecialchars($responsable['mdp'] ?? '') ?>" required>

            <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
