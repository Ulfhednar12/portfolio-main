<?php
session_start(); // Démarre la session, permettant d'accéder aux variables de session
// Vérifier si la variable de session est définie
if (isset($_SESSION['form_sent']) && $_SESSION['form_sent'] === true) {
    // Afficher le modal ici
    echo '<div class="modal" id="myModal">
      <div class="modal-content">
        <h2 class="modal-title">Votre message a bien été envoyé. </h2>
        <p class="modal-body">Je vous répondrai dans les meilleurs délais.</p>
        <span class="close-button" onclick="closeModal()">&times;</span>
      </div>
    </div>';

    // Supprimer la variable de session
    unset($_SESSION['form_sent']);
}
require "./admin/connexion.php"; // Inclut le fichier de connexion à la base de données

$sql = "SELECT * FROM realisation 
    WHERE etat= 'visible'
    ORDER BY id DESC"; // Requête pour sélectionner les réalisations visibles dans l'ordre décroissant d'ID
$query = $db->prepare($sql);
$query->execute();
$resultat = $query->fetchAll(); // Récupère les résultats de la requête dans un tableau associatif
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/styles.css">

    <!-- ===== BOX ICONS ===== -->

    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>


    <title>Portfolio</title>
</head>

<body>
    <!--===== HEADER =====-->
    <header class="l-header">
        <nav class="nav bd-grid">
            <div>
                <a href="#" class="nav__logo">Emmanuel Piot</a>
            </div>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="#home" class="nav__link active">Accueil</a></li>
                    <li class="nav__item"><a href="#about" class="nav__link">A propos</a></li>
                    <li class="nav__item"><a href="#skills" class="nav__link">Skills</a></li>
                    <li class="nav__item"><a href="#portfolio" class="nav__link">Portfolio</a></li>
                    <li class="nav__item"><a href="#contact" class="nav__link">Contact</a></li>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-menu'></i>
            </div>
        </nav>
    </header>

    <main class="l-main">
        <!--===== HOME =====-->
        <section class="home" id="home">
            <div class="home__container bd-grid">
                <h1 class="home__title"><span>DEVELOPPEUR</span><br>FULL STACK.</h1>

                <div class="home__scroll">
                    <a href="#about" class="home__scroll-link"><i class='bx bx-up-arrow-alt'></i>Scroll</a>
                </div>

                <img src="assets/img/4paradox-animation.gif" alt="" class="home__img">
            </div>
        </section>

        <!--===== ABOUT =====-->
        <section class="about section" id="about">
            <h2 class="section-title">A PROPOS</h2>

            <div class="about__container bd-grid">
                <div class="about__img">
                    <img src="assets/img/thoughtworks-gif_dribbble.gif" alt="">
                </div>

                <div>
                    <h2 class="about__subtitle">Je suis Emmanuel Piot</h2>
                    <span class="about__profession">Développeur Full Stack</span>
                    <p class="about__text">Actuellement en reconversion professionnel, je me suis lançé un nouveau défi
                        et j'ai entrepri la formation de développeur web chez Onlineformapro. Le développement web est
                        devenu pour moi bien plus qu'un travail mais une véritable passion.</p>


                    <a href="CV.pdf" class="btn3" target="_blank">Découvrir mon CV</a>
                </div>
            </div>
        </section>

        <!--===== SKILLS =====-->
        <section class="skills section" id="skills">
            <h2 class="section-title">SKILLS</h2>

            <div class="skills-box" data-skills-box>

                <ul class="skills-list">

                    <li>
                        <div class="skill-card">
                            <div class="card-icon">
                                <img src="./assets/img/html5.png" alt="HTML5 logo">
                            </div>
                        </div>
                        <div class="tooltip">HTML5</div>
                    </li>

                    <li>
                        <div class="skill-card">
                            <div class="card-icon">
                                <img src="./assets/img/css3.png" alt="CSS3 logo">
                            </div>
                        </div>
                        <div class="tooltip">CSS3</div>
                    </li>

                    <li>
                        <div class="skill-card">
                            <div class="card-icon">
                                <img src="./assets/img/javascript.png" alt="JavaScript logo">
                            </div>
                        </div>
                        <div class="tooltip">JavaScript</div>
                    </li>

                    <li>
                        <div class="skill-card">
                            <div class="card-icon">
                                <img src="./assets/img/php.png" alt="PHP logo">
                            </div>
                        </div>
                        <div class="tooltip">PHP</div>
                    </li>

                    <li>
                        <div class="skill-card">
                            <div class="card-icon">
                                <img src="./assets/img/mysql_logo.png" alt="mysql logo">
                            </div>
                        </div>
                        <div class="tooltip">MySQL</div>
                    </li>

                    <li>
                        <div class="skill-card">
                            <div class="card-icon">
                                <img src="./assets/img/logo_boostrap2.png" alt="Bootstrap logo">
                            </div>
                        </div>
                        <div class="tooltip">Bootstrap</div>
                    </li>

                    <li>
                        <div class="skill-card">
                            <div class="card-icon">
                                <img src="./assets/img/git.png" alt="git logo">
                            </div>
                        </div>
                        <div class="tooltip">Git</div>
                    </li>

                    <li>
                        <div class="skill-card">
                            <div class="card-icon">
                                <img src="./assets/img/github1.png" alt="github logo">
                            </div>
                        </div>
                        <div class="tooltip">Github</div>
                    </li>

                    <li>
                        <div class="skill-card">
                            <div class="card-icon">
                                <img src="./assets/img/figma.png" alt="figma logo">
                            </div>
                        </div>
                        <div class="tooltip">Figma</div>
                    </li>
                </ul>


            </div>
        </section>
        <!--===== Diplome =====-->
        <div id="timeline">
            <ul>
                <li style="--accent-color:#41516C">
                    <div class="date">Depuis mars 2023</div>
                    <div class="title">Titre professionnel Niveau BAC +2</div>
                    <div class="descr">Développeur Web/Web Mobile à OnlineFormaPro, Nevers</div>
                </li>
                <li style="--accent-color:#FBCA3E">
                    <div class="date">Janvier 2023</div>
                    <div class="title">Immersion Formation</div>
                    <div class="descr">Immersion à la formation de Développeur Web à OnlineFormaPro, Nevers</div>
                </li>

            </ul>
        </div>
        <!--===== PORTFOLIO =====-->
        <section id="portfolio" class="portfolio section">
            <h2 class="section-title">PORTFOLIO</h2>
            <div class="container_card">
                <?php foreach ($resultat as $valeur) { ?>
                    <div class="card">
                        <div class="content">
                            <div class="imgBx"><img src="./assets/img/<?= $valeur['image'] ?>"></div>
                            <div class="contentBx">
                                <h3><?= $valeur['titre'] ?><br><span><?= $valeur['paragraphe'] ?></span></h3>
                            </div>
                        </div>
                        <ul class="sci">
                            <li style="--i:3"><a href="<?= $valeur['lien_github'] ?>"><i class='bx bxl-github'></i></a></li>
                        </ul>
                    </div>
                <?php } ?>

            </div>

        </section>

        <!--===== CONTACT =====-->
        <section id="contact" class="contact section">
            <h2 class="section-title">CONTACT</h2>

            <div class="contact__container bd-grid">
                <div class="contact__info">
                    <h3 class="contact__subtitle">EMAIL</h3>
                    <span class="contact__text">emmanuel.piot@gmail.com</span>

                    <h3 class="contact__subtitle">TELEPHONE</h3>
                    <span class="contact__text">06 00 00 00 00</span>

                </div>

                <form action="admin/recup_form.php" method="post" class="contact__form">
                    <div class="contact__inputs">
                        <input type="text" placeholder="Nom" class="contact__input" name="nom">
                        <input type="text" placeholder="Prénom" class="contact__input" name="prenom">
                        <input type="mail" placeholder="Email" class="contact__input" name="email">
                        <input type="text" placeholder="Téléphone" class="contact__input" name="telephone">
                    </div>

                    <textarea id="" cols="0" rows="10" class="contact__input" placeholder="Votre message" name="message"></textarea>

                    <input type="submit" value="Envoyer" class="button">
                </form>
            </div>
        </section>
    </main>

    <!--===== FOOTER =====-->
    <footer class="footer section">
        <div class="footer__container bd-grid">
            <div class="footer__data">
                <div class="about__social">
                    <a href="https://github.com/Ulfhednar12" class="about__social-icon" target="_blank"><i class='bx bxl-linkedin'></i></a>
                    <a href="https://github.com/Ulfhednar12" class="about__social-icon" target="_blank"><i class='bx bxl-github'></i></a>
                </div>
            </div>

            <div class="footer__data">
                <h2 class="footer__title">INFORMATIONS LEGALES</h2>
                <ul>

                    <li class="box"><a href="#popup" class="footer__link">Mentions légales</a></li>


                    <div id="popup" class="overlay">
                        <div class="popup">
                            <h2>Mentions légales</h2>
                            <a href="#section5" class="cross">&times;</a>
                            <p>Mentions légales 2023<br><br>

                                Cette page vous informe de la politiques concernant la collecte, l'utilisation et la divulgation des informations personnelles lorsque vous utilisez ce formulaire de contact. Vos informations ne seront pas partagées. En utilisant le formulaire, vous acceptez la collecte et l'utilisation d'informations conformément à cette politique. <br><br>

                                Collecte et utilisation des informations<br>
                                Lors de l'utilisation de mon formulaire, il vous est demandé de fournir certaines informations personnellement identifiables qui peuvent être utilisées pour vous contacter ou vous identifier. Les informations personnelles identifiables («Informations personnelles») peuvent inclure, sans s'y limiter:
                                <br>
                                Nom
                                Adresse électronique

                                <br><br>
                                En accord avec les lois<br>
                                Les modifications apportées à cette politique de confidentialité sont effectives lorsqu'elles sont publiées sur cette page.

                            </p>
                        </div>
                    </div>
                    </li>

                </ul>
            </div>

            <div class="footer__data">
                <h2 class="footer__title">Rejoignez-moi</h2>
                <a href="#" class="footer__social"><i class='bx bxl-facebook'></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-instagram'></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
            </div>


        </div>
        <a href="admin/login.php" class="co">co</a>
    </footer>

    <!--===== SCROLL REVEAL =====
        <script src="https://unpkg.com/scrollreveal"></script>-->

    <!--===== MAIN JS =====-->
    <script src="./assets/js/main.js"></script>
    <script>
        // Fonction pour fermer le modal
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        // Fermer le modal lorsque l'utilisateur clique en dehors du contenu
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>





    </script>
</body>

</html>