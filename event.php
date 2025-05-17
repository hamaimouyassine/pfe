<?php
include 'db_connect.php';
include 'login.php';
include 'eventfiltre.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Événements | FSBM CLUBS</title>
  <meta name="description" content="Découvrez les événements organisés par les clubs de la FSBM.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
  <link href="navbar.css" rel="stylesheet">
  <link href="footer.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    
/* ----------------------------start footer---------------------------- */
.form-container {
  width: 350px;
  height: 400px;
  background-color: #fff;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  border-radius: 10px;
  box-sizing: border-box;
  padding: 20px 30px;
}

.title {
  text-align: center;
  font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
        "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
  margin: 10px 0 30px 0;
  font-size: 28px;
  font-weight: 800;
}

.form {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 18px;
  margin-bottom: 15px;
}

.input {
  border-radius: 20px;
  border: 1px solid #c0c0c0;
  outline: 0 !important;
  box-sizing: border-box;
  padding: 12px 15px;
}

.page-link {
  text-decoration: underline;
  margin: 0;
  text-align: end;
  color: #747474;
  text-decoration-color: #747474;
}
.form-btn:active {
  box-shadow: none;
}
.modal {
  display: none; /* hidden by default */
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.5);
  justify-content: center;
  align-items: center;
  z-index: 999;
}
</style>
  
</head>
<body>
<nav>
        <ul>
            <p class="test">FSBM-CLUBS</p>
        <li class="hidePhone"><a href="Home.php">Accueil </a></li>
        <li class="hidePhone"><a href="about-us.php">About-us</a></li>
        <li class="hidePhone"><a href="clubs.php">Clubs</a></li>
        <li class="hidePhone"><a href="event.php">évènements</a></li>
        <li><button id="openModalBtn" class="hidePhone">connexion</button></li>
        <li class="menu-btn" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="30px"viewBox="0 -960 960 960" width="30px" fill="#2c2c2c"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
        <ul class="sidebar">
            <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" fill="#2c2c2c"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li><a href="Home.php">Accueil</a></li>
            <li><a href="about-us.php">About-us</a></li>
            <li><a href="clubs.php">Nos Clubs</a></li>
            <li><a href="event.php">évènements</a></li>
            <button id="openModalBtn">connexion</button>
        </ul>
    </nav>
<script>
    function showSidebar(){
    const sidebar = document.querySelector('.sidebar')
    sidebar.style.display = 'flex'
    }
    function hideSidebar(){
    const sidebar = document.querySelector('.sidebar')
    sidebar.style.display = 'none'
    }
</script>

<!------------------------------end navbar------------------------------>
<main class="max-w-7xl mx-auto px-6 py-12">
<div class="relative w-full h-[60vh]">
    <!-- Image en fond -->
    <img src="event1.jpg" alt="Image de fond"
         class="w-full h-full object-cover absolute top-0 left-0 z-0" />

    <!-- Texte centré au milieu de l'image -->
    <div class="absolute inset-0 flex items-center justify-center z-10 bg-black bg-opacity-30">
      <h1 class="text-5xl font-extrabold text-white text-center" data-aos="fade-down">
        Événements des Clubs
      </h1>
    </div>
  </div>
  <br><br><br>
    <!-- Barre de recherche & filtres -->
    <form method="GET" class="flex flex-col md:flex-row md:items-center gap-4 mb-8">
      <input type="text" name="search" placeholder="Rechercher un événement..."
        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
        class="w-full md:w-2/3 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">

      <select name="topic" class="w-full md:w-auto px-4 py-2 border rounded-lg">
        <option value="">Filtrer par topic</option>
        <?php while($topic = $topicsResult->fetch_assoc()): ?>
          <option value="<?= htmlspecialchars($topic['topics']) ?>" <?= ($_GET['topic'] ?? '') === $topic['topics'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($topic['topics']) ?>
          </option>
        <?php endwhile; ?>
      </select>

      <select name="date" class="w-full md:w-auto px-4 py-2 border rounded-lg">
        <option value="">Filtrer par date</option>
        <option value="future" <?= ($_GET['date'] ?? '') === 'future' ? 'selected' : '' ?>>À venir</option>
        <option value="past" <?= ($_GET['date'] ?? '') === 'past' ? 'selected' : '' ?>>Passés</option>
      </select>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Filtrer</button>
    </form>

    <!-- Événements -->
    <div id="eventsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if ($events->num_rows === 0): ?>
    <p class="text-center text-red-600">❌ Aucun événement trouvé pour ce topic.</p>
<?php endif; ?>
  
    <?php while($event = $events->fetch_assoc()): ?>
        <div class="event-card bg-white rounded-2xl shadow-md hover:shadow-xl transition p-4" 
          data-id="<?= $event['id_evenement'] ?>"
          data-club="<?= $event['idclub'] ?>"
          data-date="<?= $event['date_evenement'] ?>"
          data-titre="<?= htmlspecialchars($event['titre']) ?>"
          data-description="<?= htmlspecialchars($event['description']) ?>"
          data-aos="zoom-in">

          <img 
            src="<?= htmlspecialchars($event['photo']) ?>" 
            alt="Photo de l'événement <?= htmlspecialchars($event['titre']) ?>" 
            class="w-full h-48 object-cover rounded-xl shadow-md hover:scale-105 transition-transform duration-300"
          />

          <div class="mt-4 space-y-2">
            <h2 class="text-xl font-semibold text-blue-700"><?= htmlspecialchars($event['titre']) ?></h2>
            <p class="text-sm text-gray-500"><?= date('d M Y', strtotime($event['date_evenement'])) ?></p>
            <p class="text-gray-700 text-sm"><?= nl2br(htmlspecialchars(substr($event['description'], 0, 100))) ?>...</p>

            <?php if (!empty($event['nomclub'])): ?>
            <div class="flex items-center gap-3 mt-3">
              <img src="<?= $event['logo_url'] ? htmlspecialchars($event['logo_url']) : 'default-logo.png' ?>"
                alt="Logo Club" class="w-10 h-10 rounded-full object-cover border">
              <span class="text-sm font-medium"><?= htmlspecialchars($event['nomclub']) ?></span>
            </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
</main>

  <!------------------------------start footer------------------------------>

  <footer class="footer">
    <div class="footer-container">
    <div class="footer-left">
        <h2>FSBM-CLUBS</h2>
        <p>
        FSBM Clubs offrent une variété d’organisations étudiantes conçues pour soutenir votre éducation. Découvrez des clubs qui correspondent à votre personnalité et à vos objectifs, qui vous aident à apprendre, à grandir et à vous connecter avec des pairs partageant les mêmes idées.
        </p>
        <button class="join-btn">Rejoignez-nous</button>
    </div>

    <div class="footer-right">
        <div class="footer-links">
        <ul>
        <li><a href="home.php">accueil </a></li>
            <li><a href="about-us.php">about us</a></li>
            <li><a href="clubs.php">clubs</a></li>
            <li><a href="event.php">évènements</a></li>
            <li><a href="clubs.php">rechercher</a></li>
        </ul>
        <ul>
            <li><a href="#">sécurité</a></li>
            <li><a href="#">nouvelles</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">ressources</a></li>
            <li><a href="#">Rejoignez-nous</a></li>
        </ul>
        </div>
    </div>
    </div>

    <div class="footer-bottom">
    <div class="social-icons">
        <span></span><span></span><span></span><span></span>
    </div>
    <p>©2025 FSBM-CLUBS Inc. et ses sociétés affiliées. Tous droits réservés.</p>
    </div>
</footer>

<!------------------------------end footer------------------------------>

  <script>
    AOS.init({ duration: 1000, once: true });

    function filterEvents() {
      let searchQuery = document.getElementById('searchInput').value.toLowerCase();
      let clubFilter = document.getElementById('clubFilter').value;
      let dateFilter = document.getElementById('dateFilter').value;
      let events = document.querySelectorAll('.event-card');

      events.forEach(event => {
        let title = event.getAttribute('data-titre').toLowerCase();
        let description = event.getAttribute('data-description').toLowerCase();
        let club = event.getAttribute('data-club');
        let eventDate = new Date(event.getAttribute('data-date'));
        let today = new Date();

        let matchSearch = title.includes(searchQuery) || description.includes(searchQuery);
        let matchClub = !clubFilter || club === clubFilter;
        let matchDate = false;

        if (dateFilter === 'future') matchDate = eventDate > today;
        if (dateFilter === 'past') matchDate = eventDate < today;
        if (!dateFilter) matchDate = true;

        if (matchSearch && matchClub && matchDate) {
          event.style.display = '';
        } else {
          event.style.display = 'none';
        }
      });
    }
  </script>

</body>
<!-- Modal Overlay -->
<div id="accountModal" class="modal">
  <div class="form-container">
    <p class="title">Connectez-vous</p>

    <?php if (!empty($message)): ?>
    <div style="margin: 20px auto; padding: 15px; max-width: 400px; text-align: center;
                background-color: #f8f9fa; border: 1px solid #ccc; border-radius: 8px;
                font-size: 16px; color: <?php echo str_contains($message, '✅') ? 'green' : 'red'; ?>">
        <?php echo $message; ?>
    </div>
    <?php endif; ?>

    <form class="form" action="" method="POST">
        <input class="input" type="email" name="email" placeholder="Email" required>
        <input class="input" type="password" name="mdp" placeholder="Mot de passe" required>
        <button class="form-btn" name="login" type="submit">Se connecter</button>
    </form>
  </div>
</div>

<script>
  const modal = document.getElementById("accountModal");
  const openBtn = document.getElementById("openModalBtn");

  openBtn.addEventListener("click", () => {
    modal.style.display = "flex";
  });

  window.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.style.display = "none";
    }
  });
</script>

</html>
