<?php
include 'db_connect.php';
include 'login.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="footer.css">
</head>
<style>
    /* ===================start initialization======================== */
*{
    margin: 0;
    padding:0;
}

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow-x: hidden;
    }
/* ===================end initialization======================== */

/* ===================start navbar======================== */

nav{
    background-color: #f5f5f5;
    box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.1);
    padding: 10px 10%;
    margin: 5px -10px;
    width: 80%;
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
    nav ul{
    width:100%;
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
    }
    nav li{
    height: 50px;
    }
    nav a{
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
    nav li :first-child{
        margin-right: auto ;
    }
    .sidebar{
        position: fixed;
        top: 0;
        right:0;
        height: 100vh;
        width: 250px;
        background-color: #e6e5e523;
        box-shadow: -10px 0 10px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        z-index:10;
        display: none;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
    }
    .sidebar li{
        width: 100%;
    }
    .menu-btn{
        display: none;
    }
@media(max-width:800px){
    .hidePhone{
    display: none;
    }
    .input:focus {
    min-width: 250px;
    }
}
    .menu-btn{
    display: block;
    }

@media(min-width:800px){
    .menu-btn{
    display: none;
    }
}

@media(max-width:400px){
    .sidebar{
    width: 100%;
    }
    .input:focus {
    min-width: 120px;
    }
}


/* ===================end navbar======================== */






/* ===================start section======================== */
  .guide-section {
    padding: 40px 10%;
  }
  
  .guide-container {
    display: flex;
    align-items: center;
    gap: 40px;
  }
  
  .guide-image img {
    width: 280px;
    height: 360px;
    object-fit: cover;
    border-radius: 50% / 30%;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }
  
  .guide-text h2 {
    margin: 0;
    font-size: 24px;
    line-height: 1.4;
  }
  
  .guide-text .highlight {
    color: #a0461d; /* Orange foncé comme dans l'image */
  }
  
  .guide-text p {
    margin-top: 10px;
    color: #333;
    max-width: 500px;
  }
  
  @media (max-width: 600px) {
    .guide-container {
      flex-direction: column;
      text-align: center;
    }
  
    .guide-image img {
      margin-bottom: 20px;
    }
  
    .guide-text p {
      margin-left: auto;
      margin-right: auto;
    }
  }
  
/* ===================end section======================== */

.line-style {
    width: 100%;       /* La ligne occupe toute la largeur du conteneur */
    height: 1px;       /* Épaisseur de la ligne */
    border: none;      /* Pas de bordure par défaut */
    background-color: #333; /* Couleur de la ligne */
  }





/* ===================start line======================== */

.timeline {
    position: relative;
    width: 60%;
    max-width: 900px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.line {
    position: absolute;
    width: 4px;
    background-color: #007BFF;
    top: 0;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
}
.line::before, .line::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    background-color: #007BFF;
    border-radius: 50%;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1;
}
.line::before {
    top: 0;
}
.line::after {
    bottom: 0;
}
.block {
    position: relative;
    width: 40%;
    background: #D9D9D9;
    padding: 20px;
    padding-bottom: 70px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin: 20px 0;
    opacity: 0;
    transform: translateY(50px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}
.block.visible {
    opacity: 1;
    transform: translateY(0);
}
.block:nth-child(odd) {
    align-self: flex-start;
}
.block:nth-child(even) {
    align-self: flex-end;
}
.connector {
    position: absolute;
    width: 30px;
    height: 4px;
    background-color: #007BFF;
    top: 50%;
    transform: translateY(-50%);
}
.block:nth-child(odd) .connector {
    left: 100%;
}
.block:nth-child(even) .connector {
    right: 100%;
}
.triangle {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 90px;
    height: 120px;
    overflow: hidden;
    border-bottom-right-radius: 10px;
}
.triangle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    clip-path: polygon(0% 100%, 100% 0%, 100% 100%);
    position: absolute;
    bottom: 0;
    right: 0;
}
.fter {
    text-align: center;
    margin-top: 50px;
}
.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
}

@media (max-width: 768px) {
    .timeline {
        width: 100%;
        padding: 0 10px;
        box-sizing: border-box;
    }
    .line {
        display: none;
    }
    .block {
        width: calc(100% - 40px);
        align-self: center !important;
        margin: 20px;
    }
    .connector {
        display: none;
    }
    .nav{
      width: 100%;
    }
}

@media (width: 1024px) {
    .connector{
        width: 23px;
    }
}
@media (min-width: 1440px) {
    .connector{
        width: 49px;
    }
}
/* ===================end line======================== */

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
/* ===================end footer======================== */
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
<body>
<!-------------------start Navbar------------------------->
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
<!---------------------end navbar --------------------->

     <!---------------------start sections--------------------->
     <section class="guide-section">
        <div class="guide-container">
          <div class="guide-image">
            <img src="img1.png" alt="Guide Image" />
          </div>
          <div class="guide-text">
            <h2><span class="highlight">Fsbm-clubs</span><br>Votre guide vers le succès</h2>
            <p>
            Les clubs FSBM proposent une variété d’organisations étudiantes conçues pour soutenir votre éducation. Découvrez des clubs qui correspondent à votre personnalité et à vos objectifs, vous aidant à apprendre, grandir et vous connecter avec des pairs partageant les mêmes idées.
            </p>
          </div>
        </div>
      </section>
      <br><br><hr class="line-style">
    <!---------------------end sections--------------------->

    <div class="" style="height: 200px;"></div>

    <!---------------------start info--------------------->
    <div class="timeline">
        <div class="line"></div>
        <div class="block">
            <div class="connector"></div>
            <h3>DÉVELOPPEZ VOS COMPÉTENCES</h3>
            <p  style="
    margin-top: revert;" >Les connaissances prennent de la profondeur lorsqu’elles sont liées à l’expérience pratique, transformant des idées abstraites en compétences concrètes.</p>
            <div class="triangle"><img src="image1.png" alt="Triangle"></div>
        </div>
        <div class="block">
            <div class="connector"></div>
            <h3>CONNECTEZ-VOUS ET RÉSEAUTEZ</h3>
            <p style="
    margin-top: revert;" >Collaborer avec des étudiants et professionnels partageant les mêmes idées favorise l’échange d’idées, combinant curiosité académique et expertise du monde réel pour stimuler l’innovation.</p>
            <div class="triangle"><img src="image1.png" alt="Triangle"></div>
        </div>
        <div class="block">
            <div class="connector"></div>
            <h3>S’AMUSER TOUT EN APPRENANT</h3>
            <p style="
    margin-top: revert;" >Explorez un univers d'activités interactives et de projets passionnants, où l'apprentissage devient une aventure et chaque défi une opportunité de grandir et d'innover.</p>
            <div class="triangle"><img src="image1.png" alt="Triangle"></div>
        </div>
        <div class="block">
            <div class="connector"></div>
            <h3>FAÇONNEZ VOTRE AVENIR</h3>
            <p style="
            margin-top: revert;" >Améliorez vos compétences en leadership en dirigeant des projets, tout en boostant votre carrière grâce au réseautage et à une expérience pratique.</p>
            <div class="triangle"><img src="image1.png" alt="Triangle"></div>
        </div>
    </div>
    <div class="fter">
        <h2>Nous sommes impatients de commencer notre voyage ensemble.</h2>
        <p>Connectez-vous avec nous dès aujourd’hui !</p>
        <a href="#" class="btn">Connectez-vous</a>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const blocks = document.querySelectorAll(".block");
            function checkVisibility() {
                const triggerPoint = window.innerHeight * 0.75;
                blocks.forEach(block => {
                    const blockTop = block.getBoundingClientRect().top;
                    if (blockTop < triggerPoint) {
                        block.classList.add("visible");
                    }
                });
            }
            window.addEventListener("scroll", checkVisibility);
            checkVisibility();
        });
        </script>



<!---------------------end info--------------------->
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