<?php
include 'db_connect.php'; // crée $conn
include 'login.php';      // traite le login et remplit $message

// Récupération des clubs triés par topics
$sql = "SELECT * FROM info_clubs ORDER BY topics, nomclub";
$result = $conn->query($sql);

$clubs_by_topic = [];

while ($row = $result->fetch_assoc()) {
    $topic = $row['topics'];
    $clubs_by_topic[$topic][] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Clubs par Thèmes</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <link href="navbar.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- tailwind css -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css"/>
    <!-- Boxicons for arrows -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <style>
/* ======= Base ======= */
body {
  overflow-x: hidden;
}
a {
    text-decoration: none;
    color: inherit;
}
/* ======= Titre de section ======= */
.titre-section {
    text-align: center;
    font-size: 2em;
    color: #333;
    margin: 40px 0 20px;
    position: relative;
}

.titre-section::after {
    content: '';
    display: block;
    width: 80px;
    height: 4px;
    background: #6c63ff;
    margin: 10px auto 0;
    border-radius: 2px;
}

/* ======= Cartes d'Événements ======= */
.events-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    padding: 20px;
}

.event-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    width: 300px;
    position: relative;
    transition: transform 0.3s ease;
}

.event-card:hover {
    transform: translateY(-10px);
}

.event-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.event-content {
    padding: 15px;
}

.event-content h3 {
    font-size: 1.2em;
    margin-bottom: 10px;
    color: #333;
}

.event-content p {
    font-size: 0.95em;
    color: #555;
    line-height: 1.4em;
    height: 4.2em;
    overflow: hidden;
    text-overflow: ellipsis;
}

.event-date {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #6c63ff;
    color: white;
    padding: 5px 10px;
    border-radius: 12px;
    font-size: 0.85em;
    font-weight: bold;
}

.more-btn {
    display: block;
    text-align: center;
    margin: 15px auto 10px;
    padding: 8px 20px;
    background: #6c63ff;
    color: white;
    border-radius: 20px;
    font-size: 0.9em;
    opacity: 0;
    transition: opacity 0.3s ease;
    width: fit-content;
}

.event-card:hover .more-btn {
    opacity: 1;
}

/* ======= Clubs par Topics (Swiper + Cards) ======= */
.swiper-container {
    margin-top: 40px;
}

.swiper-slide {
    display: flex;
    justify-content: center;
}

.topic-title {
    width: 100%;
    text-align: left;
    font-size: 1.8em;
    color: #333;
    font-weight: 600;
    margin: 40px 0 20px;
    padding-left: 10px;
    position: relative;
}

.topic-title::after {
    content: '';
    display: block;
    width: 60px;
    height: 3px;
    background-color: #6c63ff;
    margin-top: 8px;
    border-radius: 2px;
}
/* ======= Responsive ======= */
@media screen and (max-width: 1024px) {
    .events-container {
        justify-content: center;
    }
}

@media screen and (max-width: 768px) {
    .events-container {
        flex-direction: column;
        align-items: center;
    }

    .event-card,
    .club-card {
        width: 90%;
    }

    .topic-title {
        font-size: 1.4em;
        padding-left: 5px;
        margin: 30px 0 15px;
        text-align: center;
    }

    .topic-title::after {
        margin: 8px auto 0;
    }
}

@media screen and (max-width: 480px) {
    .topic-title {
        font-size: 1.2em;
        margin: 25px 0 10px;
    }

    .topic-title::after {
        width: 40px;
        height: 2px;
    }
}

/* ======= Section wrapper ======= */
section {
    max-width: 100%;
    width: min(90%, 80rem);
    margin: 0 auto;
    min-height: 100vh;
    padding-block: 5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.swiper {
    width: 90%;
    padding: 60px 0 95px;
}

.swiper-wrapper {
    align-items: center;
}

.swiper-slide {
    width: 14rem;
    height: 22rem;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.slide-content {
    width: 100%;
    height: 100%;
}

.slide-content img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.swiper-button-prev,
.swiper-button-next {
    background: #fff;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    top: 50%;
    transform: translateY(-50%);
    box-shadow: 0px 2px 11px rgba(0, 0, 0, 0.17);
    display: none;
    justify-content: center;
    align-items: center;
}

.swiper-button-prev::after,
.swiper-button-next::after {
    content: "";
}

.swiper-button-prev i,
.swiper-button-next i {
    font-size: 25px;
}

@media (min-width: 760px) {
    .swiper-button-prev,
    .swiper-button-next {
        display: flex;
    }
}

@media (min-width: 1024px) {
    .swiper-slide {
        width: 16rem;
    }
}

/* ======= Cards container et style ======= */
.card-container {
    display: flex;
    justify-content: center;
    gap: 30px;
    padding: 50px;
    flex-wrap: wrap;
}

.card {
    background-color: #ffffff;
    border-radius: 20px;
    width: 300px;
    padding: 20px;
    padding-bottom: 40px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 480px;
    box-sizing: border-box;
    position: relative;
    line-height: 1.6;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.logo-section {
    background-color: #eeeeee;
    border-radius: 50%;
    width: 120px;
    height: 120px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 20px;
    overflow: hidden;
}

.logo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card h2 {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin: 0 0 15px;
    text-align: left;
    padding-left: 10px;
}

h3 {
    font-size: 18px;
    font-weight: 500;
    color: #555;
    margin: 10px 0;
    text-align: left;
    padding-left: 10px;
}

.card p {
    margin: 0 0 20px;
    text-align: left;
    color: #666;
    font-size: 14px;
    padding-left: 10px;
    line-height: 1.5;
}

.card-footer {
    background-color: #f3f3f3;
    border-bottom-left-radius: 15px;
    text-align: center;
    padding: 15px 0;
    font-size: 16px;
    font-weight: 500;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
}

.card a {
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.card a:hover {
    color: #0056b3;
}
</style>

</head>
<body>
<!------------------------------start Navbar------------------------------>


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

<!------------------------------start search bar------------------------------>
<div class="container px-4 sm:px-6 lg:px-8">
<div class="first-home flex flex-col items-center justify-center min-h-screen">

        <div class="text-section text-center sm:text-left">
            
            <!-- Texte d’intro -->
            <h1 class="text-2xl sm:text-4xl font-bold mb-2">Bienvenue à FSBM CLUBS</h1>
            <p class="text-base sm:text-lg mb-4">
                Découvrez nos clubs étudiants et rejoignez une communauté dynamique et ambitieuse.
            </p>

            <!-- Barre de recherche -->
            <div class="flex flex-col sm:flex-row items-center sm:items-start justify-center sm:justify-start p-5">
                <div class="w-full sm:w-auto rounded-lg bg-gray-200 p-5" style="background-color: #f5f5f5; box-shadow: 1px 1px 10px 0px #b4cde0;">
                    <div class="flex flex-col sm:flex-row w-full sm:w-auto" style="background-color: #f5f5f5; box-shadow: 1px 1px 10px 0px #b4cde0;">

                        <!-- Icône -->
                        <div class="flex items-center justify-center border-b sm:border-b-0 sm:border-r border-gray-200 bg-white p-3 sm:p-5 rounded-t-lg sm:rounded-t-none sm:rounded-l-lg" style="background-color: #f5f5f5;">
                            <svg viewBox="0 0 20 20" aria-hidden="true" class="w-5 fill-gray-500">
                                <path d="M16.72 17.78a.75.75 0 1 0 1.06-1.06l-1.06 1.06ZM9 14.5A5.5 5.5 0 0 1 3.5 9H2a7 7 0 0 0 7 7v-1.5ZM3.5 9A5.5 5.5 0 0 1 9 3.5V2a7 7 0 0 0-7 7h1.5ZM9 3.5A5.5 5.5 0 0 1 14.5 9H16a7 7 0 0 0-7-7v1.5Zm3.89 10.45 3.83 3.83 1.06-1.06-3.83-3.83-1.06 1.06ZM14.5 9a5.48 5.48 0 0 1-1.61 3.89l1.06 1.06A6.98 6.98 0 0 0 16 9h-1.5Zm-1.61 3.89A5.48 5.48 0 0 1 9 14.5V16a6.98 6.98 0 0 0 4.95-2.05l-1.06-1.06Z"></path>
                            </svg>
                        </div>

                        <!-- Champ texte -->
                        <input type="text" 
                            class="w-full sm:max-w-[300px] bg-white pl-2 text-base font-semibold outline-0 p-2" 
                            placeholder="Rechercher un club" 
                            id="search" 
                            oninput="debounceFilter()">

                        <!-- Bouton -->
                        <button 
                            class="w-full sm:w-auto bg-blue-500 p-2 text-sm sm:text-base rounded-b-lg sm:rounded-bl-none sm:rounded-tr-lg sm:rounded-br-lg text-white font-semibold hover:bg-blue-800 transition-colors mt-2 sm:mt-0" 
                            onclick="filterClubs()">
                            Search
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!------------------------------end search bar------------------------------>

<script>
    function filterClubs() {
    const searchInput = document.getElementById("search");
    const searchQuery = searchInput.value.toLowerCase().trim();
    const topics = document.querySelectorAll(".results section"); // Correction ici
    let anyVisibleClub = false;

    topics.forEach((topic) => {
        const clubCards = topic.querySelectorAll(".card");
        let topicVisible = false;

        clubCards.forEach((card) => {
            const titleElement = card.querySelector("h2");
            const clubName = titleElement ? titleElement.textContent.toLowerCase() : "";

            const isMatch = clubName.includes(searchQuery);
            card.style.display = isMatch ? "block" : "none";
            if (isMatch) topicVisible = true;
        });

        topic.style.display = topicVisible ? "block" : "none";
        if (topicVisible) anyVisibleClub = true;
    });

    if (anyVisibleClub && searchQuery !== "") {
        const resultsSection = document.getElementById("club-results");
        if (resultsSection) {
            resultsSection.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });
        }
    }
}

</script>

<!------------------------------end search bar------------------------------>  


<!------------------------------start swiper------------------------------>


    
    <div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <?php foreach ($clubs_by_topic as $topic => $clubs): ?>
        <div class="swiper-slide">
            <a href="#<?= htmlspecialchars(strtolower(str_replace(' ', '-', $topic))) ?>" class="text-center text-lg font-semibold text-gray-700 hover:text-purple-600">
                <?= htmlspecialchars($topic) ?>
            </a>
        </div>
    <?php endforeach; ?>
  </div>

  <!-- Arrows -->
  <div class="swiper-button-next"><i class='bx bx-right-arrow-alt'></i></div>
  <div class="swiper-button-prev"><i class='bx bx-left-arrow-alt'></i></div>
</div>

    
    <!--// Swiper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <script>
    const swiper = new Swiper(".swiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        loop: true,
        slidesPerView: "auto", // Affiche les cartes partiellement visibles
        spaceBetween: 30,
        coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 150,
        modifier: 3,
        slideShadows: false
        },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
        },
        keyboard: {
        enabled: true
        },
        mousewheel: {
        thresholdDelta: 70
        },
        breakpoints: {
        560: {
            slidesPerView: 2.5
        },
        768: {
            slidesPerView: 3
        },
        1024: {
            slidesPerView: 3.5
        }
        }
    });
    </script>



<!-- ----------------------------end swiper---------------------------- -->
<div class="results" id="club-results">
<?php foreach ($clubs_by_topic as $topic => $clubs): ?>
    <section id="<?= htmlspecialchars(strtolower(str_replace(' ', '-', $topic))) ?>">
        <h2 class="topic-title"><?= htmlspecialchars($topic) ?></h2>
        <div class="card-container">
            <?php foreach ($clubs as $club): ?>
                <div class="card">
                    <div class="logo-section">
                        <img src="<?= htmlspecialchars($club['logo_url']) ?>" alt="Logo" class="logo-img">
                    </div>
                    <h2><?= htmlspecialchars($club['nomclub']) ?></h2>
                    <p><?= htmlspecialchars($club['description']) ?></p>
                    <div class="card-footer">
                        <a href="pageuni.php?id=<?= $club['idclub'] ?>">Voir plus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endforeach; ?>


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
