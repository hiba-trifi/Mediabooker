<?php
require_once '../includes/dbh.inc.php';
session_start();
if (isset($_SESSION["Id"])) {
  header('location:./accueil.php');
} else {
  // header('location:./landing_page_user.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../main-css.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <title>Reservation</title>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar_landing navbar navbar-expand-md mt-0 mb-5  fixed-top">
    <div class="container  mt-0">
      <img class="navbar-brand " src="../logo/logo.png" alt="">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse  justify-content-center navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item mx-3 fw-bold fs-5">
            <a class="nav-link" href="#sm">Réseaux sociaux</a>
          </li>
          <li class="nav-item mx-3 fw-bold fs-5">
            <a class="nav-link" href="#gr">Galerie</a>
          </li>
          <li class="nav-item mx-3 fw-bold fs-5">
            <a class="nav-link " aria-current="page" href="#about">À propos</a>
          </li>
          <a href="./connecter.php" class="button btn btn   rounded-pill mx-5">Se connecter</a>
        </ul>
      </div>

    </div>
  </nav>
  <!-- image wrapper -->
  <div class="image-wrapper position-relative">
    <img class="backround" src="../logo/1.jpg" alt="" style=" filter: blur(3px); ">
    <div
      class="background-image-overlay position-absolute d-flex flex-column justify-content-center align-items-start  h-100  m-5">
      <div class=" fs-1 fw-bold text-light ">
        <h1 class="fs-1 fw-bold mt-5">Bienvenue, <br> consulter nos library online est resrveer vos ouvrage preferee
        </h1>

      </div>
      <a href="./inscription.php" class="button mt-4  btn  btn-lg  rounded-pill mx-5 ">S'inscrire</a>
    </div>
  </div>

  <!--about container -->
  <div data-aos="fade-up" class="container about ">
    <!--  section  -->
    <div class="gallery-section   align-items-center ">
      <!-- div -->
      <div data-aos="fade-right" class="mx-1 w-75  me-5 align-self-center ">
        <h1 class="">À propos</h1>
        <hr class="mb-5 ">
        <p class=" fw-bold  fs-4  ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident nesciunt
          accusantium ad eos autem aspernatur obcaecati impedit, nulla, optio architecto exercitationem at placeat
          repellendus sapiente, perspiciatis perferendis ratione praesentium a.</p>
      </div>
      <!-- gallerie -->
      <div data-aos="fade-left" id="carouselExampleFade1" class="carousel carousel-dark   w-75   slide carousel-fade">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleFade1" data-bs-slide-to="0" class="active"
            aria-label="Slide 1" aria-current="true"></button>
          <button type="button" data-bs-target="#carouselExampleFade1" data-bs-slide-to="1" aria-label="Slide 2"
            class=""></button>

        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../logo/gallery1.jpg" class="d-block w-100 rounded-4" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../logo/gallery2.jpg" class="d-block w-100 rounded-4" alt="...">
          </div>

        </div>


      </div>

    </div>
  </div>


  <!--card section -->
  <div data-aos="fade-up" class="d-flex flex-column  mx-5 " style="margin-top:5%;">
    <div class="align-self-center">
      <h1 class="">Categories populaire</h1>
      <hr class="mb-5 ">
    </div>
    <div class="cards d-flex ">

      <div class="col-md-3 mx-1 col-sm-6">
        <div class="card">
          <i class="fa-solid fa-photo-film" aria-hidden="true"></i>
          <h3><a href="#">Memoire de recherche</a></h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident nesciunt.</p>
          <a href="#" class="read-more">Check out</a>
        </div>
      </div>
      <div class="col-md-3 mx-1 col-sm-6">
        <div class="card">
          <i class="fa-solid fa-compact-disc" aria-hidden="true"></i>
          <h3><a href="#">CD &amp; DVD</a></h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident nesciunt.</p>
          <a href="#" class="read-more">Check out</a>
        </div>
      </div>
      <div class="col-md-3 mx-1 col-sm-6">
        <div class="card">
          <i class="fa fa-clone" aria-hidden="true"></i>
          <h3><a href="#">Magazine</a></h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident nesciunt.</p>
          <a href="#" class="read-more">Check out</a>
        </div>
      </div>
      <div class="col-md-3 mx-1 col-sm-6">
        <div class="card">
          <i class="fa fa-book" aria-hidden="true"></i>
          <h3><a href="#">Roman</a></h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident nesciunt.</p>
          <a href="#" class="read-more">Check out</a>
        </div>
      </div>
    </div>
  </div>

  <!-- tetimonials section -->
  <section data-aos="fade-up" class="testimonials ">
    <div class="container">
      <h2>Ce que disent nos Membres</h2>
      <div class="row">
        <div class="col-md-6">
          <div class="testimonial">
            <div class="quote">
              <i class="fas fa-quote-left" aria-hidden="true"></i>
            </div>
            <p>"J'adore utiliser ce site de réservation de bibliothèque. Il est si facile de réserver des livres en
              ligne et de les récupérer sur
              la bibliothèque. Le processus est fluide et me fait gagner beaucoup de temps !"</p>
            <div class="author">
              <i class="fas fa-user" aria-hidden="true"></i>
              <div class="name">John Doe</div>
              <div class="location">San Francisco, CA</div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="testimonial">
            <div class="quote">
              <i class="fas fa-quote-left" aria-hidden="true"></i>
            </div>
            <p>"Ce site Web m'a rendu la vie tellement plus facile. J'avais l'habitude d'aller physiquement à la
              bibliothèque pour réserver
              livres, mais maintenant je peux tout faire dans le confort de ma propre maison."</p>
            <div class="author">
              <i class="fas fa-user" aria-hidden="true"></i>
              <div class="name">Jane Smith</div>
              <div class="location">New York, NY</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--gallery container -->
  <div class="container">
    <!-- section  -->
    <div id="gr" class="gallery-section   align-items-center  ">
      <!-- div -->
      <div data-aos="fade-right" class="mx-1 w-50 me-5  ">
        <h1 class="">Gallerie</h1>
        <hr class="mb-5 ">
        <p class=" fw-bold  fs-4  ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident nesciunt
          accusantium ad eos autem aspernatur obcaecati impedit, nulla, optio architecto exercitationem at placeat
          repellendus sapiente, perspiciatis perferendis ratione praesentium a.</p>
      </div>

      <!-- gallery -->
      <div data-aos="fade-left" id="carouselExampleFade" class="carousel mx-1   slide carousel-fade"
        style="width:100% ;">
        <div class="carousel-inner">
          <div class="carousel-item ">
            <img src="../logo/gallery7.jpg" class="d-block w-100 rounded-4" alt="image de media library">
          </div>
          <div class="carousel-item active">
            <img src="../logo/gallery5.jpg" class="d-block w-100 rounded-4" alt="image de media library">
          </div>
          <div class="carousel-item">
            <img src="../logo/gallery6.jpg" class="d-block w-100 rounded-4" alt="image de media library">
          </div>
          <div class="carousel-item">
            <img src="../logo/gallery8.jpg" class="d-block w-100 rounded-4" alt="image de media library">
          </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>

  <!-- footer -->
  <footer class="footer  ">
    <div class="footer_content  ">
      <div>
        <img class="mb-4  " src="../logo/logo.png" alt="">
        <div class="end_footer ">

          <ul class="list-unstyled d-flex mt-3 ">
            <li><a href="#" class="social-icon"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#" class="social-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#" class="social-icon"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="d-block  mt-5 ">



        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3238.184323766385!2d-5.827633185087737!3d35.74627403401008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0b87c216892bc7%3A0x48bdf85995e9c186!2sSolicode%20Tanger!5e0!3m2!1sen!2sma!4v1678563249970!5m2!1sen!2sma"
          width="1000px" height="300" style="border:0;border-radius:10px;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>



        <p class="mt-4">© 2023 My Company</p>

      </div>





      <div class="mb-3">
        <h3>Contact Us :</h3>
        <form class="mb-3">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name">
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email">
          </div>
          <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" rows="1"></textarea>
          </div>
          <button type="submit" class="button btn bt-lg mt-3">Submit</button>
        </form>

      </div>
    </div>
  </footer>

  <script src="../script.js"></script>

</body>

</html>