<?php
include 'db_connect.php';
include 'login.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <link rel="stylesheet" href="navbar.css"> 
    <link rel="stylesheet" href="footer.css"> 
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<style>
/* =================== Container ======================== */
.container {
  max-width: 1000px;
  width: 100%;
}

.first-home {
  display: flex;
  width: 1000px;
  padding: 100px;
}

.container {
  display: flex;
  height: 100vh;
  margin: 70px 40px 40px 40px;
  height: fit-content;
  justify-content: center;
  align-items: center;
}

.line-style {
  width: 100%;
  height: 1px;
  border: none;
  background-color: #333;
}

.text-section {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 20px;
  text-align: center;
}

.text-section h1 {
  font-size: 38px;
  margin-bottom: 20px;
}

.text-section p {
  font-size: 1.2rem;
  margin-bottom: 20px;
  max-width: 500px;
}

.text-section input {
  padding: 10px;
  width: 80%;
  max-width: 400px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
}

.text-section button {
  padding: 10px 20px;
  border: none;
  background-color: #007bff;
  color: white;
  font-size: 1rem;
  border-radius: 10px;
  cursor: pointer;
}

.image-section {
  flex: 1;
  margin-top: 50px;
  margin-right: 70px;
  margin-bottom: 88px;
  background: url('https://source.unsplash.com/800x600/?nature,landscape') center/cover no-repeat;
}

.image-section img {
  border-radius: 15px;
}

@media (max-width: 768px) {
  .container {
      flex-direction: column;
  }

  .image-section {
      height: 50vh;
      width: 90%;
      margin-left: 60px;
  }
  .engage-container {
      margin-left: 0px;
  }
  .quote-section {
      width: 120%;
  }
  .footer {
      width: 120%;
  }
}

/* =================== Engage Section =================== */
.wrapper {
  padding: 2rem;
  max-width: 100%; 
  margin-top: 20px;
  margin: 150px auto;
  width: 93%;
}


.engage-container {
  background-color: white;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
  border-radius: 4px;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  padding: 2rem; 
  width: 100%;
}

.engage-left {
  flex: 1;
  max-width: 250px;
  margin: 5px 25px 5px 0px; 
  padding: 10px;
}

.engage-right {
  flex: 2;
  min-width: 250px;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
  width: 100%; 
}

.feature {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.feature-icon {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 4px;
}

.feature-icon img {
  max-width: 100%;
  max-height: 100%;
}

@media (max-width: 768px) {
  .engage-container {
    flex-direction: column;
    align-items: center; 
    width: 100%;
    padding: 2rem; 
  }
  
  .engage-left {
    margin: 10px 0; 
    max-width: 100%; 
    padding: 10px;
  }

  .engage-right {
    grid-template-columns: 1fr;
    gap: 1rem;
    width: 100%;
  }
}

/* =================== Explore Button =================== */
.explore {
  display: inline-block;
  padding: 12px 30px;
  background-color: #2196F3;
  color: white;
  font-size: 18px;
  font-weight: bold;
  text-transform: lowercase;
  border: none;
  border-radius: 15px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.explore:hover {
  background-color: #0d8bf2;
}

/* =================== Transition ===================== */
.text-section,
.image-section,
.engage-container,
.quote-section,
.footer,
.explore {
  opacity: 0;
  transform: translateY(50px);
  transition: opacity 1s ease-out, transform 1s ease-out;
}

.text-section.show,
.image-section.show,
.engage-container.show,
.quote-section.show,
.footer.show,
.explore.show {
  opacity: 1;
  transform: translateY(0);
}

.image-section {
  transition-delay: 0.5s;
}

/* =================== Quote Section ================== */
.quote-section {
  background-color: #e6f7ff;
  padding: 60px 20px;
  font-family: Arial, sans-serif;
  margin-top: 70px;
  width: 100%;
}

.quote-container {
  display: flex;
  align-items: center;
  justify-content: center;
  max-width: 1000px;
  margin: auto;
  position: relative;
  width: 100%;
}

.quote-mark {
  font-size: 60px;
  font-weight: bold;
  color: black;
}

.quote-mark.left {
  margin-right: 20px;
}

.quote-mark.right {
  margin-left: 20px;
}

.quote-content {
  display: flex;
  align-items: flex-start;
  max-width: 800px;
}

.blue-bars {
  display: flex;
  align-items: flex-end;
  margin-right: 15px;
}

.blue-bars span {
  display: inline-block;
  width: 6px;
  background-color: #1f73c2;
  border-radius: 2px;
  margin-right: 6px;
}

.blue-bars span:first-child {
  height: 50px;
}

.blue-bars span:last-child {
  height: 70px;
}

.quote-content p {
  font-size: 16px;
  color: #000;
  line-height: 1.6;
}

/* =================== Footer ========================== */

</style>
<body>
    <!-- Navbar -->
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

    <div class="container">
        <div class="text-section">
            <h1>Boostez votre expérience,<br>
                liberer votre passion.</h1>
            <p>Rejoignez une communauté dynamique où l’apprentissage rime avec plaisir. Découvrez des clubs, développez vos compétences et faites de belles rencontres.</p>
            <button><a href="clubs.php">rechercher</a></button>
        </div>
        <div class="image-section"><img src="image1.png"></div>
    </div>

    <br><hr class="line-style">
    <div class="wrapper">
        <div class="engage-container">
            <!-- Zone gauche : barres + textes -->
            <div class="engage-left">
            <img src="photo2.png" alt="gg">
            </div>
    
            <!-- Zone droite : fonctionnalités -->
            <div class="engage-right">
            <!-- Élément 1 -->
            <div class="feature">
                <div class="feature-icon">
                <!-- Icône de démonstration (remplacez par une vraie icône ou un <img>) -->
                <img src="../icon-home/developer_1875602.png" alt="icon">
                </div>
                <p>Gestion rationalisée de l’organisation</p>
            </div>
    
            <!-- Élément 2 -->
            <div class="feature">
                <div class="feature-icon">
                    <img src="../icon-home/workflow_2640577.png" alt="icon">
                </div>
                <p>Flux de travail d’événements efficaces</p>
            </div>
    
            <!-- Élément 3 -->
            <div class="feature">
                <div class="feature-icon">
                    <img src="../icon-home/transaction_5865955.png" alt="icon">
                </div>
                <p>Comprendre l’implication des étudiants</p>
            </div>
    
            <!-- Élément 4 -->
            <div class="feature">
                <div class="feature-icon">
                    <img src="../icon-home/guidance_17787737.png" alt="icon">
                </div>
                <p>Parcours guidés</p>
            </div>
    
            <!-- Élément 5 -->
            <div class="feature">
                <div class="feature-icon">
                    <img src="../icon-home/cloud-storage_6151660.png" alt="icon">
                </div>
                <p>API puissantes et intégration de données</p>
            </div>
    
            <!-- Élément 6 -->
            <div class="feature">
                <div class="feature-icon">
                    <img src="../icon-home/collaboration_5862352.png" alt="icon">
                </div>
                <p>Impliquer tous les élèves</p>
                </div>
            </div>
            </div>
        </div>
    <br><hr class="line-style">

    <div class="container">
        <div class="image-section"><img src="photo3.png" alt="gg"></div>
        <div class="text-section">
        <h1>Établir des liens communautaires</h1>
        <p class="g">Les clubs FSBM ne se résument pas aux études. Ils permettent de tisser des liens, développer des amitiés et élargir son réseau professionnel dans un cadre collaboratif.</p>
    </div>
    </div>
        
    <div class="container">
    <div class="text-section">
        <h1>Croissance collaborative grâce aux Clubs</h1>
        <p>Rejoindre un club, c’est l’opportunité de collaborer sur des projets, d’échanger des idées et de développer ses compétences dans un cadre dynamique et collectif.
        </p>
    </div>
    <div class="image-section"><img src="photo4.png"></div>
</div>

<div class="container">
    <div class="image-section"><img src="photo5.png" alt="gg"></div>
    <div class="text-section">
    <h1>Environnement étudiant <br>accessible et favorable
    </h1>
    <p class="g">Les clubs FSBM visent à offrir un cadre inclusif et stimulant, propice à l’épanouissement de chaque étudiant, à travers des ressources variées et des événements enrichissants.
</p>
</div>
</div>
<div class="container">
    <button class="explore"><a href="about-us.php">En Savoir Plus</a></button>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll('.text-section, .image-section, .engage-container, .quote-section, .footer,.explore');

    function checkScroll() {
        elements.forEach((el) => {
        let rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
            el.classList.add("show");
        }
        });
    }

    window.addEventListener("scroll", checkScroll);
    checkScroll();
});

</script>
<br><hr class="line-style">
<br><br><br>
<section class="quote-section">
    <div class="quote-container">
    <div class="quote-mark left">“</div>
    <div class="quote-content">
        <div class="blue-bars">
        <span></span>
        <span></span>
        </div>
        <p>
        Nous avons créé une plateforme en ligne conçue spécifiquement pour les étudiants, en tirant parti d’Engage pour surveiller et analyser la participation des étudiants. Cela nous permet d’identifier des opportunités d’amélioration ciblées, d’aider les élèves à atteindre leurs objectifs et de participer activement aux clubs et aux activités.
        </p>
    </div>
    <div class="quote-mark right">”</div>
    </div>
</section>
<br><br><br>
<!---------------------start footer--------------------->
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
</body>
</html>