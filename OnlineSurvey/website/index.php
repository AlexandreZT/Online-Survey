<?php
  session_start(); // Démarre une nouvelle session ou reprend une session existante
  $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Online Survey</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon3.png" rel="icon">
  
  <!-- Google Fonts --> 
  <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Vesperr - v2.0.0
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <!--<h1 class="text-light"><a href="index.html"><span>Vesperr</span></a></h1>-->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="index.php"><img src="assets/img/banner3.png" alt="" class="img-fluid"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <!--<li class="active"><a href="#header">Accueil</a></li>-->
          <li><a href="#about">Plus d'Infos</a></li>
          <li><a href="#pricing">Tarification & Abonnements</a></li>
          <li><a href="dashboard.php">Tableau de bord</a></li>
          
          <?php
              if(isset($_SESSION['pseudo'])) {
            ?> 
            <li class="get-started"><a href="logout.php">Déconnexion</a></li>
            <!-- <li class="get-started"><a href="login.php">Connexion</a></li> -->
            <?php
              }
              else {
            ?>
            <li class="get-started"><a href="login.php">Connexion</a></li>
            <!-- <li><a href="logout.php">Déconnexion</a></li> -->
            <?php
          }
          ?>
        </ul>
      </nav>
      <!-- .nav-menu -->

    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">



    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
        
          <h1 data-aos="fade-up">Créez <span>rapidement</span> et <span>facilement</span> vos sondages</h1>
          <h5 data-aos="fade-up" data-aos-delay="400">Vous avez des questions ? Nous vous donnons des réponses</h5>
          <div data-aos="fade-up" data-aos-delay="800">
            <a href="signin.php" class="btn-get-started scrollto">Inscription gratuite</a>
          </div>
        </div>  
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">    
         <img src="assets/img/survey2.png" class="img-fluid animated" alt="">
      </div>
    </div>
  

  </section>
  
  <!-- End Hero -->

  <main id="main">

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients clients">
          <div class="container">
    
            <div class="row">
    
              <div class="col-lg-2 col-md-4 col-6">
                <img src="assets/img/clients/client-7.png" class="img-fluid" alt="" data-aos="zoom-in">
              </div>
    
              <div class="col-lg-2 col-md-4 col-6">
                <img src="assets/img/clients/client-8.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
              </div>
    
              <div class="col-lg-2 col-md-4 col-6">
                <img src="assets/img/clients/client-9.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="200">
              </div>
    
              <div class="col-lg-2 col-md-4 col-6">
                <img src="assets/img/clients/client-4.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="300">
              </div>
    
              <div class="col-lg-2 col-md-4 col-6">
                <img src="assets/img/clients/client-5.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="400">
              </div>
    
              <div class="col-lg-2 col-md-4 col-6">
                <img src="assets/img/clients/client-6.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="500">
              </div>
    
            </div>
    
          </div>
        </section><!-- End Clients Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Plus d'infos</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
            <p>
            Big Brother, société éditrice de logiciels professionnels basée dans le 14e arrondissement de Paris vous propose
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Un éditeur de sondage totalement personnalisable</li>
              <li><i class="ri-check-double-line"></i> La possibilité de récupérer un nombre de réponses illimité</li>
              <li><i class="ri-check-double-line"></i> Notre système d'analyse de résultat</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <p>
              ONLINE SURVEY est notre réponse à vos questions, cet outils très puissant permet de prendre de meilleur décision pour son entreprise
            </p>
            <a href="#" class="btn-learn-more">En savoir plus</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row">
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-xl-start" data-aos="fade-right" data-aos-delay="150">
            <img src="assets/img/counts-img.svg" alt="" class="img-fluid">
          </div>

          <div class="col-xl-7 d-flex align-items-stretch pt-4 pt-xl-0" data-aos="fade-left" data-aos-delay="300">
            <div class="content d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="icofont-simple-smile"></i>
                    <span data-toggle="counter-up">65</span>
                    <p><strong>Clients satisfaits</strong> nous ont déjà recommandé</p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="icofont-document-folder"></i>
                    <span data-toggle="counter-up">85</span>
                    <p><strong>Projets</strong> déjà accompagnés</p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="icofont-clock-time"></i>
                    <span data-toggle="counter-up">12</span>
                    <p><strong>Années d'expériences</strong> dans l'édition de logiciels professionnels</p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="icofont-award"></i>
                    <span data-toggle="counter-up">5</span>
                    <p><strong>Récompensé</strong> meilleur plateforme de sondage en ligne de l'année</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Testimonials</h2>
          <p>Quelques mots de nos clients</p>
        </div>

        <div class="owl-carousel testimonials-carousel" data-aos="fade-up" data-aos-delay="200">

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
              <h3>Saul Goodman</h3>
              <h4>Ceo &amp; Founder</h4>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Les enquêtes nous permettent de vérifier si nous respectons nos engagements.<i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
              <h3>Sara Wilsson</h3>
              <h4>Designer</h4>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Nous avons toujours été une entreprise centrée sur le client, mais ONLINE SURVEY nous aide à être encore plus centrés sur ce point. <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
              <h3>Jena Karlis</h3>
              <h4>Store Owner</h4>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                ONLINE SURVEY nous a vraiment aidés à comprendre où vont nos tendances et nous aide vraiment à prévoir les choses.<i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
              <h3>Matt Brandon</h3>
              <h4>Freelancer</h4>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Pour toujours satisfaire mes clients je peux compter sur ONLINE SURVEY.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

          <div class="testimonial-wrap">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
              <h3>John Larson</h3>
              <h4>Entrepreneur</h4>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                ONLINE SURVEY est l'un de nos outils fondamentaux.<i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">

        <div class="section-title">
          <h2>Tarification & Abonnements</h2>
          <p>Trouvez l'offre qui vous correspond</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="box" data-aos="zoom-in-right" data-aos-delay="200">
              <h3>Compte Gratuit</h3>
              <h4><sup>€</sup>0<span> / Mois</span></h4>
              <ul>
                <li>limite de 5 sondages/mois</li>
                <li>limite de 10 questions/sondages</li>
                <li>limite de 5 réponses/questions</li>
                <li class="na">Exportation de données</li>
                <li class="na">Analyseur d'enqûete</li>
                <li class="na">Assistance 24h/24 et 7j/7</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Inscrivez-vous !</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
            <div class="box recommended" data-aos="zoom-in" data-aos-delay="100">
              <h3>Compte Profesionnel</h3>
              <h4><sup>€</sup>24,99<span> / Mois</span></h4>
              <ul>
                <li>Nombre de sondage illimité</li>
                <li>Nombre de questions/sondages illimité</li>
                <li>Nombre de réponses/questions illimité</li>
                <li>Exportation de données</li>
                <li>Analyseur d'enqûete</li>
                <li class="na">Assistance 24h/24 et 7j/7</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Sélectionner !</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in-left" data-aos-delay="200">
              <h3>Compte Premium</h3>
              <h4><sup>€</sup>59,99<span> / Mois</span></h4>
              <ul>
                <li>Nombre de sondage illimité</li>
                <li>Nombre de questions/sondages illimité</li>
                <li>Nombre de réponses/questions illimité</li>
                <li>Exportation de données</li>
                <li>Analyseur d'enqûete</li>
                <li>Assistance 24h/24 et 7j/7</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Sélectionner !</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Contactez-nous</h2>
        </div>

        <div class="row">

          <div data-aos="fade-up" data-aos-delay="100">
            <div class="contact-about">
              <p>Besoins de renseignements ? Une proposition commercial ? Ou autres ? Nous sommes disponible 24h/24 et 7j/7 alors n'hésitez plus, contactez-nous !</p>
              <div class="social-links">
                <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
                <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
                <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
                <a href="#" class="linkedin"><i class="icofont-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div data-aos="fade-up" data-aos-delay="200">
            <div class="info">
              <div>
                <i class="ri-map-pin-line"></i>
                <p>143 Rue d'Alésia<br>PARIS, 75014</p>
              </div>

              <div>
                <i class="ri-mail-send-line"></i>
                <p>contact@bigbrother.com</p>
              </div>

              <div>
                <i class="ri-phone-line"></i>
                <p>+33987654321</p>
              </div>

            </div>
          </div>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-6 text-lg-left text-center">
          <div class="copyright">
            Copyright &copy; 2008-2020 <strong>ONLINE SURVEY</strong>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>