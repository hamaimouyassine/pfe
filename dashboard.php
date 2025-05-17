<?php
session_start();
include 'db_connect.php';

// Restrict to admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- For Icons -->
    <style>
        /* Global Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f6;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            font-size: 28px;
            color: #4CAF50;
            margin-bottom: 20px;
            text-align: center;
        }

        h2 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #333;
        }

        .top-nav {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .top-nav a, .top-nav button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-left: 10px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
            border: none;
        }

        .top-nav a:hover, .top-nav button:hover {
            background-color: #0056b3;
        }

        .table-container {
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        td {
            background-color: #f9f9f9;
            transition: background-color 0.3s;
        }

        td:hover {
            background-color: #f1f1f1;
        }

        .btn {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn:hover {
            background-color: #218838;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .search-container {
            margin-bottom: 20px;
            text-align: right;
        }

        .search-container input[type="text"] {
            padding: 8px;
            font-size: 14px;
            width: 250px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .search-container button {
            padding: 8px 12px;
            font-size: 14px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="top-nav">
        <a href="ajouterclub.php" class="btn"><i class="fas fa-plus"></i> Ajouter un club</a>
        <a href="ajouterevenement.php" class="btn"><i class="fas fa-calendar-plus"></i> Ajouter un événement</a>
        <!-- Formulaire de déconnexion -->
        <form method="POST" action="logout.php">
            <button type="submit" name="logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
        </form>
    </div>

    <h1>Dashboard Administrateur</h1>

    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Rechercher...">
        <button onclick="searchTable()">🔍</button>
    </div>

    <!-- Clubs Section -->
    <h2>Liste des Clubs</h2>
    <div class="table-container">
        <?php
        $result = $conn->query("SELECT * FROM info_clubs");

        if ($result->num_rows > 0): ?>
            <table id="clubsTable">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Responsable</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                    // Get the responsible person from the `responsable` table
                    $responsable_query = $conn->prepare("SELECT full_name FROM responsable WHERE id_responsable = ?");
                    $responsable_query->bind_param("i", $row['responsable_id']);
                    $responsable_query->execute();
                    $responsable_result = $responsable_query->get_result();
                    $responsable = $responsable_result->fetch_assoc();
                    ?>
                    <tr>
                        <td><?= $row['idclub'] ?></td>
                        <td><?= htmlspecialchars($row['nomclub']) ?></td>
                        <td><?= htmlspecialchars($responsable['full_name']) ?></td>
                        <td>
                            <a href="modifierclub.php?idclub=<?= $row['idclub'] ?>" class="btn"><i class="fas fa-edit"></i> Modifier</a>
                            <a href="supprimerclub.php?idclub=<?= $row['idclub'] ?>" class="btn btn-danger" onclick="return confirm('Supprimer ce club ?');"><i class="fas fa-trash"></i> Supprimer</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Aucun club trouvé.</p>
        <?php endif; ?>
    </div>

    <!-- Events Section -->
    <h2>Liste des Événements</h2>
    <div class="table-container">
        <?php
        $event_result = $conn->query("SELECT * FROM evenement");

        if ($event_result->num_rows > 0): ?>
            <table id="eventsTable">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                <?php while ($event = $event_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $event['id_evenement'] ?></td>
                        <td><?= htmlspecialchars($event['titre']) ?></td>
                        <td><?= htmlspecialchars($event['description']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($event['date_evenement'])) ?></td>
                        <td>
                            <a href="modifierevenement.php?id_evenement=<?= $event['id_evenement'] ?>" class="btn"><i class="fas fa-edit"></i> Modifier</a>
                            <a href="supprimerevenement.php?id_evenement=<?= $event['id_evenement'] ?>" class="btn btn-danger" onclick="return confirm('Supprimer cet événement ?');"><i class="fas fa-trash"></i> Supprimer</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Aucun événement trouvé.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    function searchTable() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const clubsTable = document.getElementById('clubsTable');
        const eventsTable = document.getElementById('eventsTable');
        const clubRows = clubsTable.getElementsByTagName('tr');
        const eventRows = eventsTable.getElementsByTagName('tr');

        // Filter clubs
        for (let i = 1; i < clubRows.length; i++) {
            const cells = clubRows[i].getElementsByTagName('td');
            let found = false;
            for (let j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().includes(searchInput)) {
                    found = true;
                    break;
                }
            }
            clubRows[i].style.display = found ? '' : 'none';
        }

        // Filter events
        for (let i = 1; i < eventRows.length; i++) {
            const cells = eventRows[i].getElementsByTagName('td');
            let found = false;
            for (let j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().includes(searchInput)) {
                    found = true;
                    break;
                }
            }
            eventRows[i].style.display = found ? '' : 'none';
        }
    }
</script>

</body>
</html>
