<?php
// Connexion à la base de données
include 'db_connect.php';

// Vérification de l'ID passé en paramètre
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Initialisation du message de connexion
$message = '';

include 'logout.php';

// Vérifier si un ID valide a été passé
if ($id <= 0) {
    echo "<h2>ID de club invalide.</h2>";
    exit;
}

// Requête pour récupérer les détails du club
$sql = "SELECT * FROM info_clubs WHERE idclub = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$club = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Vérifier si le club existe
if (!$club) {
    echo "<h2>Club non trouvé.</h2>";
    exit;
}

// Initialiser le nom du responsable
$nom_responsable = "Responsable inconnu";

// Récupérer le nom du responsable à partir de son ID, si l'ID existe
if (!empty($club['responsable_id'])) {
    $resp_stmt = $conn->prepare("SELECT full_name FROM responsable WHERE id_responsable = ?");
    $resp_stmt->bind_param("i", $club['responsable_id']);
    $resp_stmt->execute();
    $result_resp = $resp_stmt->get_result();
    if ($resp = $result_resp->fetch_assoc()) {
        $nom_responsable = $resp['full_name'];
    }
    $resp_stmt->close();
}

// Récupérer les activités du club depuis la table 'activites'
$activites = [];
$act_stmt = $conn->prepare("SELECT titre FROM activites WHERE idclub = ?");
$act_stmt->bind_param("i", $id);
$act_stmt->execute();
$result = $act_stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $activites[] = $row['titre'];
}
$act_stmt->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($club['nomclub']) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <!-- <link href="navbar.css" rel="stylesheet"> -->
  <link href="footer.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/a2c3a1d36d.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<style>
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
</style>
<!-- ======= Start Navbar ======= -->
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
<style>
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
<!-- ======= End Navbar ======= -->
  <!-- Hero Section avec fond bleu captivant -->
  <section class="relative h-[85vh] flex items-center justify-center text-white bg-gradient-to-br from-blue-600 via-blue-500 to-purple-600">
    <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('<?= $club['logo_url'] ?>');"></div>
    <div class="z-10 text-center" data-aos="fade-zoom-in">
        <div class="flex justify-center">
            <div class="w-[150px] h-[150px] rounded-full overflow-hidden">
                <img src="<?= $club['logo_url'] ?>" alt="Logo du club" class="w-full h-full object-cover" />
            </div>
        </div>

        <h1 class="text-4xl md:text-5xl font-bold drop-shadow-lg"><?= htmlspecialchars($club['nomclub']) ?></h1>
        <p class="mt-2 text-lg italic drop-shadow-sm">Club FSBM</p>
    </div>
</section>


  <!-- Contenu principal -->
  <main class="container mx-auto px-6 py-12 space-y-10 max-w-5xl bg-white">
    <!-- Topics -->
    <div class="flex flex-wrap gap-3 justify-center" data-aos="fade-up">
      <?php foreach (explode(',', $club['topics']) as $topic): ?>
        <span class="bg-purple-100 text-purple-800 px-4 py-1 rounded-full shadow text-sm"><?= htmlspecialchars(trim($topic)) ?></span>
      <?php endforeach; ?>
    </div>

    <!-- Description -->
    <section class="glass rounded-xl p-6 shadow-xl" data-aos="fade-right">
  <h2 class="text-2xl font-semibold mb-3 relative overflow-hidden">
    <span class="hover:underline hover:underline-offset-8 hover:text-[rgb(107,33,168)] transition-all duration-300 ease-in-out"> Description</span>
  </h2>
  <p><?= nl2br(htmlspecialchars($club['description'])) ?></p>
</section>


    <!-- Vision & Objectif -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
  <section class="glass rounded-xl p-6 shadow-xl" data-aos="fade-left">
    <h2 class="text-xl font-semibold mb-3 relative overflow-hidden">
      <span class="hover:underline hover:underline-offset-8 hover:text-[rgb(107,33,168)] transition-all duration-300 ease-in-out"> Vision</span>
    </h2>
    <p><?= nl2br(htmlspecialchars($club['vision'])) ?></p>
  </section>
  <section class="glass rounded-xl p-6 shadow-xl" data-aos="fade-left" data-aos-delay="100">
    <h2 class="text-xl font-semibold mb-3 relative overflow-hidden">
      <span class="hover:underline hover:underline-offset-8 hover:text-[rgb(107,33,168)] transition-all duration-300 ease-in-out"> Objectif</span>
    </h2>
    <p><?= nl2br(htmlspecialchars($club['objectif'])) ?></p>
  </section>
</div>


    <!-- Activités -->
<section class="glass rounded-xl p-6 shadow-xl" data-aos="fade-up">
  <h2 class="text-2xl font-semibold mb-3 relative overflow-hidden">
    <span class="hover:underline hover:underline-offset-8 hover:text-[rgb(107,33,168)] transition-all duration-300 ease-in-out"> Activités</span>
  </h2>
  <?php if (!empty($activites)): ?>
    <ul class="list-disc pl-5 space-y-2 text-gray-700">
      <?php foreach ($activites as $titre): ?>
        <li><?= htmlspecialchars($titre) ?></li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>Aucune activité enregistrée pour ce club.</p>
  <?php endif; ?>
</section>

<!-- Responsable -->
<section class="glass rounded-xl p-6 shadow-xl" data-aos="zoom-in">
  <h2 class="text-2xl font-semibold mb-3 relative overflow-hidden">
    <span class="hover:underline hover:underline-offset-8 hover:text-[rgb(107,33,168)] transition-all duration-300 ease-in-out"> Responsable</span>
  </h2>
  <p class="font-medium text-lg"><?= htmlspecialchars($nom_responsable) ?></p>
</section>


    <!-- Site Web -->
    <?php if (!empty($club['website'])): ?>
      <section class="text-center" data-aos="flip-up">
        <a href="<?= $club['website'] ?>" target="_blank" class="inline-block mt-4 bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-full transition shadow-lg">
          🌐 Visiter le site du club
        </a>
      </section>
    <?php endif; ?>

    <!-- Réseaux Sociaux -->
    <section class="text-center" data-aos="fade-up">
      <h2 class="text-2xl font-semibold mb-5"> Suivez-nous</h2>
      <div class="flex justify-center gap-6 text-3xl">
        <?php if (!empty($club['facebook'])): ?>
          <a href="<?= $club['facebook'] ?>" class="hover:text-blue-600" target="_blank">
            <i class="fab fa-facebook-f"></i>
          </a>
        <?php endif; ?>
        <?php if (!empty($club['instagram'])): ?>
          <a href="<?= $club['instagram'] ?>" class="hover:text-pink-500" target="_blank">
            <i class="fab fa-instagram"></i>
          </a>
        <?php endif; ?>
        <?php if (!empty($club['linkedin'])): ?>
          <a href="<?= $club['linkedin'] ?>" class="hover:text-blue-800" target="_blank">
            <i class="fab fa-linkedin-in"></i>
          </a>
        <?php endif; ?>
        <?php if (!empty($club['x_url'])): ?>
          <a href="<?= $club['x_url'] ?>" class="hover:text-black" target="_blank">
            <i class="fab fa-x-twitter"></i>
          </a>
        <?php endif; ?>
      </div>
    </section>
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
  </script>
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
</body>
</html>
