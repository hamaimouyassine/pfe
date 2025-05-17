<?php
include 'db_connect.php';
include 'logout.php';
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
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { font-family: Arial, sans-serif;
    width: 100%; 
    background-color: #f5f5f5;
  }
    /* =================== Navbar ========================= */
nav {
  background-color: #f5f5f5;
  box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.1);
  padding: 10px 10%;
  margin: 5px 0px;
  width: 100%;
}

.test {
  color: #AF4631;
  font-size: 30px;
  font-weight: bolder;
  width: 100%;
  display: flex;
  justify-content: flex-start;
  margin-left: 25px;
}

nav ul {
  width: 100%;
  list-style: none;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}
nav button{
        margin-left: 30px;
        padding: 10px 12px;
        border: none;
        background-color: #007bff;
        color: white;
        font-size: 1rem;
        border-radius: 10px;
        cursor: pointer;
        width: max-content;
    }
nav li {
  height: 50px;
}

nav a {
  height: 100%;
  padding: 0 30px;
  display: flex;
  text-decoration: none;
  align-items: center;
  color: #2c2c2c;
  position: relative;
  width: max-content;
}

nav a:hover {
  color: #007bff;
  transition: 1ms;
}
nav a::after{
  content: "";
  position: absolute;
  height: 2.5px;
  width: 0;
  bottom: -6px;
  left: 0;
  background-color:#007bff;
  transition: 0.5s 0.05s;
}
nav a:hover::after,.navbar a:hover{
  color: #007bff;
  width: 100%;
}

nav li:first-child {
  margin-right: auto;
}

/* Sidebar */
.sidebar {
  position: fixed;
  top: 0;
  right: 0;
  height: 100vh;
  width: 250px;
  background-color: #e6e5e523;
  box-shadow: -10px 0 10px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(10px);
  z-index: 10;
  display: none;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
}

.sidebar li {
  width: 100%;
}

.menu-btn {
  display: none;
}

@media (max-width: 800px) {
  .hidePhone {
      display: none;
  }
  
  .input:focus {
      min-width: 250px;
  }
}

.menu-btn {
  display: block;
}

@media (min-width: 800px) {
  .menu-btn {
      display: none;
  }
}

@media (max-width: 400px) {
  .sidebar {
      width: 100%;
  }

  .input:focus {
      min-width: 120px;
  }
}
/* ----------------------------start footer---------------------------- */
/* =================== Footer ========================== */
.footer {
  background-color: #071C35;
  color: white;
  padding: 40px 20px 20px;
  font-family: Arial, sans-serif;
  margin-top: 100px;
  width: 100%;
}

.footer-container {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  max-width: 1200px;
  margin: auto;
}

.footer-left {
  flex: 1;
  min-width: 300px;
  margin-right: 40px;
}

.footer-left h2 {
  color: #1F73C2;
  margin-bottom: 10px;
}

.footer-left p {
  font-size: 14px;
  line-height: 1.6;
  margin-bottom: 20px;
}

.join-btn {
  background-color: #1F73C2;
  color: white;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  font-weight: bold;
  border-radius: 4px;
}

.footer-right {
  flex: 1;
  min-width: 250px;
}

.footer-links {
  display: flex;
  justify-content: space-between;
}

.footer-links ul {
  list-style: none;
  padding: 0;
}

.footer-links li {
  margin-bottom: 10px;
}

.footer-links a {
  color: white;
  text-decoration: none;
  font-size: 14px;
}

.footer-links a:hover {
  text-decoration: underline;
}

.footer-bottom {
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  margin-top: 30px;
  padding-top: 20px;
  text-align: center;
}

.social-icons {
  margin-bottom: 10px;
}

.social-icons span {
  display: inline-block;
  width: 25px;
  height: 25px;
  background-color: #1F73C2;
  margin: 0 5px;
  border-radius: 4px;
}
/* ----------------------------end footer---------------------------- */
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


.form-btn {
  padding: 10px 15px;
  font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
        "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
  border-radius: 20px;
  border: 0 !important;
  outline: 0 !important;
  background: #1F73C2;
  color: white;
  cursor: pointer;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
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
        <li class="hidePhone"><a href="home-connect.php">Accueil</a></li>
        <li class="hidePhone"><a href="about-us-connect.php">About-us</a></li>
        <li class="hidePhone"><a href="clubs-connect.php">Clubs</a></li>
        <li class="hidePhone"><a href="event-connect.php">Évènements</a></li>
        <li class="hidePhone">
            <form id="logoutFormNavbar" method="POST" style="display:inline;">
                <input type="hidden" name="logout" value="1">
                <button type="button" onclick="confirmLogout('logoutFormNavbar')" class="form-btn">Se déconnecter</button>
            </form>
        </li>
        <li class="menu-btn" onclick="showSidebar()">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#2c2c2c">
                    <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
                </svg>
            </a>
        </li>
    </ul>

    <ul class="sidebar">
        <li onclick="hideSidebar()">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" fill="#2c2c2c">
                    <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                </svg>
            </a>
        </li>
        <li><a href="home-connect.php">Accueil</a></li>
        <li><a href="about-us-connect.php">About-us</a></li>
        <li><a href="clubs-connect.php">Nos Clubs</a></li>
        <li><a href="event-connect.php">Évènements</a></li>
        <li>
            <form id="logoutFormSidebar" method="POST" style="display:inline;">
                <input type="hidden" name="logout" value="1">
                <button type="button" onclick="confirmLogout('logoutFormSidebar')" class="form-btn">Se déconnecter</button>
            </form>
        </li>
    </ul>
</nav>

<script>
function showSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.display = 'flex';
}

function hideSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.display = 'none';
}

// ✅ Confirmation de déconnexion
function confirmLogout(formId) {
    if (confirm("Voulez-vous vraiment vous déconnecter ?")) {
        document.getElementById(formId).submit();
    }
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
        <li><a href="home-connect.php">accueil </a></li>
            <li><a href="about-us-connect.php">about us</a></li>
            <li><a href="clubs-connect.php">clubs</a></li>
            <li><a href="event-connect.php">évènements</a></li>
            <li><a href="clubs-connect.php">rechercher</a></li>
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
    <p class="title">Connectez vous</p>
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

    <div style="margin-bottom: 10px;">
        <label><input type="radio" name="login_type" value="user" checked> Utilisateur</label>
        <label><input type="radio" name="login_type" value="admin"> Admin</label>
    </div>

    <button class="form-btn" name="login" type="submit">Se connecter</button>
</form>
  
  </div>
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
