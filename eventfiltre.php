<?php
include 'db_connect.php';
// Récupérer les topics distincts depuis la table `info_clubs`
$sqlTopics = "SELECT DISTINCT topics FROM info_clubs WHERE topics IS NOT NULL AND topics != ''";
$topicsResult = $conn->query($sqlTopics);  // Remplacer $db par $conn

// Récupérer les événements avec nom et logo du club, avec filtrage
$whereConditions = [];
$params = [];

// Filtrage par texte de recherche
if (!empty($_GET['search'])) {
    $whereConditions[] = "e.titre LIKE ?";
    $params[] = "%" . $_GET['search'] . "%";
}

// Filtrage par topic
if (!empty($_GET['topic'])) {
    $whereConditions[] = "i.topics = ?";
    $params[] = $_GET['topic'];
}

// Filtrage par date (passé ou futur)
if (!empty($_GET['date'])) {
    if ($_GET['date'] === 'future') {
        $whereConditions[] = "e.date_evenement > NOW()";
    } elseif ($_GET['date'] === 'past') {
        $whereConditions[] = "e.date_evenement < NOW()";
    }
}

// Construire la requête SQL avec les conditions de filtrage
$sql = "SELECT e.*, c.nomclub, c.logo_url, i.topics 
        FROM evenement e
        LEFT JOIN info_clubs c ON e.idclub = c.idclub
        LEFT JOIN info_clubs i ON e.idclub = i.idclub"; // Join avec info_clubs pour les topics

if (count($whereConditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $whereConditions);
}

$sql .= " ORDER BY e.date_evenement DESC";

// Préparer et exécuter la requête
$stmt = $conn->prepare($sql);  // Remplacer $db par $conn
if ($params) {
    $stmt->bind_param(str_repeat('s', count($params)), ...$params); // Pour lier les paramètres
}
$stmt->execute();
$events = $stmt->get_result();

// Si aucun événement n'est trouvé, afficher un message
if ($events->num_rows === 0) {
    $message = "❌ Aucun événement trouvé pour ce topic.";
} else {
    $message = ''; // Aucun message d'erreur si des événements sont trouvés
}
?>
